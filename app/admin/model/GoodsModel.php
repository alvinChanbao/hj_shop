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

    //获取商品列表
    public function getGoodsList($where = null)
    {
       $data = $this->alias('g')->leftJoin('goods_category c','g.category_id = c.id')->field("g.*,c.name as category")->where(function ($query) use ($where){
            if ($where){
                $query->where($where);
            }
        })->paginate(10);

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
}