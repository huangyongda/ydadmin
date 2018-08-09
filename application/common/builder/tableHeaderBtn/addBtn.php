<?php

/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/12
 * Time: 10:45
 */
namespace app\common\builder\tableHeaderBtn;

use app\common\builder\api\tableHeaderBtn;
use app\common\builder\btn;

/**
 * 头部添加按钮
 * Class addBtn
 * @package app\common\builder\tableHeaderBtn
 */
class addBtn extends btn  implements tableHeaderBtn
{
    public function __construct()
    {
        parent::__construct();
        $this->BtnName="添加";
        $this->setStyleGreen();
    }
    /**
     * 返回编译后的模板字符串
     * @return string
     */
    public function fetch()
    {
        $this->view->assign("OpenType",$this->OpenType);
        return $this->view->fetch(
            APP_PATH.'/common/builder/'.$this->templet."/tableHeaderBtn/addBtn.html");
    }


}