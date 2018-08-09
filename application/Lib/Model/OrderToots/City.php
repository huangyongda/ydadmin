<?php

/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/24
 * Time: 13:59
 */
namespace app\Lib\Model\OrderToots;

use app\Lib\Api\Common\getCityInfo;
use app\Lib\Api\Common\getCityList;
use app\Lib\TopClient;

class City
{
    public function getInfo($id)
    {
        $id=\intval($id);
        $res=[];
        $info=$this->areaInfo();
        foreach ($info as $item) {
            if($item['id']==$id){
                $res=$item;
                $res["area_id_list"]=[$id];
            }
        }

        $pid=isset($res["pid"])?$res["pid"]:0;
        for($i=0;$i<10;$i++){
            foreach ($info as $item) {
                if($pid ==$item['id']){
                    $res["area_id_list"]=array_merge([$item['id']],$res["area_id_list"]);
                    $pid=$item["pid"];
                    if($item["pid"] ==0){
                        break;
                    }
                }
            }
        }

        return $res;
    }


    public function getCitySelectData($id=0)
    {
        if($id){
            $info=$this->getInfo($id);
        }
        if(!isset($info["area_id_list"])  || !$info["area_id_list"]){
            $info["area_id_list"]=[0];
        }
        $SelectData=[];
        $cityIdList=[0];
        foreach ($info["area_id_list"] as $key=>$item) {
            $cityIdList[]=$item;
        }
        foreach ($info["area_id_list"] as $key=>$areaId) {
            $cityInfo=$this->getCityList($cityIdList[$key]);
            $data=[];
            foreach ($cityInfo as $city) {
                $data[$city["title"]]=$city["id"];
            }
            $defVal=$info["area_id_list"][$key];
            $SelectData[$defVal]=$data;
        }

        return $SelectData;

    }

    public function getCityList($city_pid=0)
    {
        $info=$this->areaInfo();
        $res=[];
        foreach ($info as $item) {
            if($item['pid']==$city_pid){
                $res[]=$item;
            }
        }
        return $res;
    }

    /**
     * 地址 写死的 实际情况是不能写死
     */
    private function areaInfo()
    {
        return [

           ["pid"=>0,"title"=>"广东","id"=>1],
           ["pid"=>0,"title"=>"广西","id"=>2],
           ["pid"=>1,"title"=>"深圳市","id"=>3],
           ["pid"=>3,"title"=>"龙岗区","id"=>19],
           ["pid"=>19,"title"=>"南湾街道","id"=>5],
           ["pid"=>5,"title"=>"下李朗村","id"=>6],
           ["pid"=>5,"title"=>"上李朗村","id"=>7],

            ["pid"=>2,"title"=>"广西市","id"=>8],
            ["pid"=>8,"title"=>"广西区","id"=>9],
            ["pid"=>9,"title"=>"广西街道","id"=>10],
            ["pid"=>10,"title"=>"广西村","id"=>11],
            ["pid"=>10,"title"=>"广西村2","id"=>12],
        ];
    }

}