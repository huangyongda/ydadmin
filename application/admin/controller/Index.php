<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/16
 * Time: 9:50
 */
namespace app\admin\controller;
use app\Lib\Model\Menu\Menu;
use think\Controller;
use think\Url;

class Index  extends Controller {
    public function Index()
    {

        $left_menu_list=[
            [
                "title"=>"通用模板",

                "icon"=>"fa fa-handshake-o",
                "spread"=>"",
                "children"=>[
                    [
                        "title"=>"模板",
                        "icon"=>"fa-cubes",
                        "href"=>Url::build("Demo/Index"),
                    ]
                ],
            ]
        ];

        $this->assign('left_menu_list',json_encode($left_menu_list));
//        $this->assign('userInfo',$this->userInfo);
        $this->assign('web_title',"demo");
        $this->assign('userInfo',[
            'role_name'=>"超级管理员",
            'account'=>"123@qq.com",
        ]);
        $this->assign('top_menu_list',[]);
        return $this->fetch();

    }

    public function main()
    {
        return $this->fetch();
    }

}