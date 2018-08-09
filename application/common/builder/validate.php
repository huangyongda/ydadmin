<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/17
 * Time: 15:29
 */

namespace app\common\builder;

use think\Validate as tpValidate;

class validate extends tpValidate
{
    public function getErrorField(){
        $error="";
        foreach ($this->message as $key=>$val) {
            if($val==$this->getError()){
                $ruleName=explode(".",$key);
                $ruleName=$ruleName[0];
                if(isset($this->rule[$ruleName]) ){
                    $error=$ruleName;
                }
            }
        }
        return $error;
    }
}