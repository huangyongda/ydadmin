<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/12/30
 * Time: 17:58
 */

namespace app\admin\controller;


use think\Request;

class ApiTrace
{
    public function getdebuginfo(Request $request)
    {


        $str=$request->param("str","") ;
        $trace=new \app\behavior\ApiTrace();
        return $trace->showDebugInfo($str);
    }
}