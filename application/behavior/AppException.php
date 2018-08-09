<?php
/**
 * Created by PhpStorm.
 * User: huangyd
 * Date: 2018/6/6
 * Time: 10:53
 */
namespace app\behavior;
use app\common\builder\ViewBuilder;

class AppException{
    public function run(\Exception $e){
        if(request()->isAjax() ){
            ViewBuilder::returnError([],$e->getMessage())->send();
        }
        else{
            throw $e;
        }
    }
}