<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/24
 * Time: 9:51
 */

namespace app\admin\controller;


use app\common\builder\table;
use app\Lib\Model\OrderToots\City as ModelCity;

class City
{
    public function getCity($id=0)
    {
        try {
            $city=new ModelCity();
            $res=$city->getCityList($id);
            return table::returnSuccess($res, '成功');
        } catch (\Exception $e) {
            return table::returnError([], $e->getMessage());
        }
    }
    public function getCityInfo($city_pid=0)
    {
        try {
            $city=new ModelCity();
            $res=$city->getInfo($city_pid);
            return table::returnSuccess($res, '成功');
        } catch (\Exception $e) {
            return table::returnError([], $e->getMessage());
        }
    }
    public function getCitySelectData($city_pid=0)
    {
        try {
            $city=new ModelCity();
            $res=$city->getCitySelectData($city_pid);

            dump($res);
        } catch (\Exception $e) {
            throw  $e;
        }
    }
}