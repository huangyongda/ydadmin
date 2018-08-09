<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2018/1/2
 * Time: 17:54
 */

namespace app\behavior;


use think\Hook;

class AppBegin
{
    public function run(){
        //set_exception_handler
        set_exception_handler([__CLASS__, 'appException']);
    }
    /**
     * Exception Handler
     * @param  \Exception|\Throwable $e
     */
    public static function appException($e)
    {
        // 监听app_exception
        dump($e);
        Hook::listen('app_exception',$e);
//        throw $e;
    }
}