<?php


namespace app\admin\model;


use think\Model;
use think\Db;
class GoodsModel extends Model
{

    //获取当前商品的最低价
    public function getSkuMinPriceAttr($value,$data)
    {
        return Db::name('goods_sku')->where('goods_id',$data['id'])->order('id asc')->limit(1)->value('price');
    }
    //获取当前商品的最高价
    public function getSkuMaxPriceAttr($value,$data)
    {
        return Db::name('goods_sku')->where('goods_id',$data['id'])->order('id desc')->limit(1)->value('price');
    }

    //获取当前商品的总销量
    public function getSalesVolumeAttr($value,$data){
        return Db::name('goods_sku')->where('goods_id',$data['id'])->sum('sales_volume');
    }

    //获取当前分类的名称
    public function getCategoryNameAttr($value,$data){
        return Db::name('goods_category')->where('id',$data['category_id'])->value('name');
    }

    //获取商品列表
    public function getGoodsList($where = null)
    {
       $data = $this->alias('g')->leftJoin('goods_category c','g.category_id = c.id')->field("g.*,c.name as category")->where(function ($query) use ($where){
            if ($where){
                $query->where($where);
            }
        })
        ->order('g.status')
        ->paginate(10);

       return $data;
    }

    //添加多规格商品
    public function addData($data){

        //开启事务
        Db::transaction(function () use ($data)  {

            $skuData = $data['tableData'];
            $skuName = $data['skuName'];

            $goodsData = [
                'goods_name'  => $data['goods_name'],
                'category_id' => $data['category_id'],
                'thumbnail'   => $data['thumbnail'],
                'details'     => $data['details'],
                'is_top'      => $data['is_top'],
                'recommended' => $data['recommended'],
                'status'      => $data['status']
            ];
            //添加商品到商品表
           $goods_id =  Db::name('goods')->insertGetId($goodsData);

           //添加规格到规格表并返回当前规格key_id
           if ($goods_id != false){
               $key_ids = [];
                foreach ($skuName as $key => $value){
                    $key_id = Db::name('goods_attr_key')->where("key",$value)->value('id');
                    if ($key_id == null){
                        $key_id = Db::name('goods_attr_key')->insertGetId(['key'=>$value]);
                    }
                    array_push($key_ids,$key_id);
                }

                //遍历规格表
               foreach ($skuData as $key => $value){

                   //写入规格到规格表
                   $sku_data = [
                       'goods_id'      => $goods_id,
                       'price'         => $value['price'],
                       'stock'         =>$value['stock'],
                       'spec_num'      =>$value['specNum'],
                       'cost_price'    =>$value['costPrice'],
                       'sales_volume'  =>$value['SalesVolume']
                   ];
                   $sku_id = Db::name('goods_sku')->insertGetId($sku_data);

                    if ($sku_id != false){
                       $skus = $value['sku'];

                       foreach ($skus as $k => $v){
                           //插入value获取value_id
                           $value_id = Db::name('goods_attr_value')->where('value',$v)->where('key_id',$key_ids[$k])->value('id');
                           if ($value_id == null){
                               $value_id = Db::name('goods_attr_value')->insertGetId(['key_id'=>$key_ids[$k],'value'=>$v]);
                           }

                           //将数据写入到规格关联数据表中
                            $relationData = [
                                'goods_id'      => $goods_id,
                                'sku_id'      => $sku_id,
                                'key_id'      => $key_ids[$k],
                                'value_id'    => $value_id
                            ];

                           $res = Db::name('goods_relation')->insert($relationData);

                       }
                    }
               }

           }
        });

        return true;
    }

    //修改多规格数据
    public function editData($data){

        //开启事务
        Db::transaction(function () use ($data)  {

            $goods_id = $data['id'];
            $skuData = $data['tableData'];
            $skuName = $data['skuName'];

            $goodsData = [
                'goods_name'  => $data['goods_name'],
                'category_id' => $data['category_id'],
                'thumbnail'   => $data['thumbnail'],
                'details'     => $data['details'],
                'is_top'      => $data['is_top'],
                'recommended' => $data['recommended'],
                'status'      => $data['status']
            ];
            // 更新商品到商品表
            $res =  Db::name('goods')->where('id',$goods_id)->update($goodsData);

            //添加新的规格到规格表并返回当前规格key_id
            if ($res !== false){
                $key_ids = [];
                foreach ($skuName as $key => $value){

                    //如果当前规格删除就跳过
                    if ($value['is_del'] == 1 || empty($value['sku_name']) ){
                        continue;
                    }



                    //查询当前已经开启的规格键
                    $key_id = Db::name('goods_attr_key')->where("key",$value['sku_name'])->value('id');
                    if ($key_id == null){
                        $key_id = Db::name('goods_attr_key')->insertGetId(['key'=>$value['sku_name']]);
                    }
                    array_push($key_ids,$key_id);
                }

                //遍历规格表

                Db::name('goods_relation')->where('goods_id',$goods_id)->delete();

                foreach ($skuData as $key => $value){

                    //写入规格到规格表
                    $sku_data = [
                        'goods_id'      => $goods_id,
                        'price'         => $value['price'],
                        'stock'         =>$value['stock'],
                        'spec_num'      =>$value['specNum'],
                        'cost_price'    =>$value['costPrice'],
                        'sales_volume'  =>$value['SalesVolume']
                    ];

                    //更新当前数据
                    if ($value['is_del'] == 1){
                        $sku_id = false;
                        $res = Db::name('goods_sku')->where('id',$value['id'])->delete();
                    }
                    else if ($value['id'] == ''){
                        $sku_id = Db::name('goods_sku')->insertGetId($sku_data);
                    }
                    else{
                        $sku_id = $value['id'];
                        $res = Db::name('goods_sku')->where('id',$sku_id)->update($sku_data);
                    }

                    if ($sku_id !== false){
                        $skus = $value['sku'];

                        foreach ($skus as $k => $v){
                            //插入value获取value_id
                            $value_id = Db::name('goods_attr_value')->where('value',$v['value'])->where('key_id',$key_ids[$k])->value('id');

                            if ($value_id == null){
                                $value_id = Db::name('goods_attr_value')->insertGetId(['key_id'=>$key_ids[$k],'value'=>$v['value']]);
                            }



                            //将数据写入到规格关联数据表中
                            $relationData = [
                                'goods_id'      => $goods_id,
                                'sku_id'      => $sku_id,
                                'key_id'      => $key_ids[$k],
                                'value_id'    => $value_id
                            ];
                            $res = Db::name('goods_relation')->where($relationData)->find();

                            if ($res == null)
                            {
                                $res = Db::name('goods_relation')->insert($relationData);
                            }
                        }
                    }
                }

            }
        });

        return true;
    }

    //修改商品的商家下架状态
    public function setGoodsStatus($id){
        //获取当前商品的状态
        $status = $this->where('id',$id)->value('status');
        $status = $status ? 0 : 1;
        return $this->where('id',$id)->update(['status' => $status]);
    }

    //获取当前商品的商品和规格信息
    public function getAllDataById($id){

        //获取当前商品的通用属性

       $data = $this->where('id',$id)->find();

       $addData = [];
       $addLog = [];

        //启用多规格
        if ($data['use_sku'] == 1)
        {
            //获取全部键值
           $sku_data = Db::name('goods_sku')->alias('sku')->leftJoin('goods_relation r','sku.id = r.sku_id')->where('sku.goods_id',$id)->select();
           foreach ($sku_data as $key => $value){

               //根据键id获取键相关属性
               $attr_key = Db::name('goods_attr_key')->where('id',$value['key_id'])->find();


               $arr = $cache = [
                   'id'       => $attr_key['id'],
                   'sku_name' => $attr_key['key'],
                   'is_del'   => 0
               ];

               $arr['sku_attr'] = [

               ];

               //去重键值，获取最终键值数组
               if (!in_array($cache,$addLog)){
                   $attr_value = Db::name('goods_relation')->where('goods_id',$id)->where('key_id',$value['key_id'])->select();

                   foreach ($attr_value as $key => $v){

                       $value_name = Db::name('goods_attr_value')->where('id',$v['value_id'])->value('value');
                       $json_value = ['is_del'=> 0,'value' => $value_name,'id' => $v['value_id']];

                       if (!in_array($json_value,$arr['sku_attr'])){
                           $arr['sku_attr'][] = $json_value;
                       }

                       /*$res = Db::name('goods_relation')->where('goods_id',$id)->where('value_id',$v['value_id'])->find();
                       print_r($res);
                       if ($res != null){
                           if (!in_array($json_value,$arr['sku_attr'])){
                               $arr['sku_attr'][] = $json_value;
                           }
                       }*/


                   }

                   array_push($addLog,$cache);

                   array_push($addData,$arr);

               };



           }
            $data['skuName'] = $addLog;
            $data['addData'] = $addData;

           //获取全部规格值
            $tableData = [];
            $sku_data = Db::name('goods_sku')->where('goods_id',$id)->select();
            foreach ($sku_data as $key => $value){
                //获取当前关系的键值
               $re_data = Db::name('goods_relation')->alias('r')->leftJoin('goods_attr_value v','r.value_id = v.id')->where('r.sku_id',$value['id'])->order('r.sku_id,r.key_id')->select();

               $sku = [];

              foreach ($re_data as $k => $v){
                  $sku[] = [
                      'is_del' => 0,
                      'value' =>  $v['value']
                  ];
              }

               $arr = [
                   'id'  => $value['id'],
                   'sku' => $sku,
                   'price'=> $value['price'],
                   'stock'=> $value['stock'],
                   'specNum'=> $value['spec_num'],
                   'costPrice'=> $value['cost_price'],
                   'SalesVolume'=> $value['sales_volume'],
                   'is_del'   => 0
               ];

                $tableData[] = $arr;

            }
            $data['tableData'] = $tableData;
        }

       return $data;
    }
}