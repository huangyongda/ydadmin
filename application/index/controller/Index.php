<?php
namespace app\index\controller;

use app\Lib\Api\Demo\Demo;
use app\Lib\TopClient;
use think\Config;

class Index
{

    public function index()
    {
        echo "这个是前台页面  <a href='".url("admin/Login/signIn")."' >点击进入后台页面</>";
    }

}
