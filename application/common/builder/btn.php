<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/12
 * Time: 17:38
 */

namespace app\common\builder;

use \app\common\builder\api\btn as apibtn;
use think\View;

class btn implements apibtn
{
    protected $view;
    protected $OpenType;
    protected $isDisabled;
    protected $style;
    public function __construct()
    {
        $this->view=new View();
        $this->BtnName="添加";
        $this->style="";
        $this->templet="";
        $this->OpenType="NewTab";//打开方式
        $this->Url="";
        $this->view->assign("btn_id","btn_id".rand(1000,99999));
    }


    public function setStyleDanger()
    {
        $this->style=" layui-btn-danger ";
        $this->view->assign("style",$this->style);
        return $this;
    }

    public function setStyleBlue()
    {
        $this->style=" layui-btn-normal ";
        $this->view->assign("style",$this->style);
        return $this;
    }

    public function setDisabled(){
        $this->isDisabled=true;
        return $this;
    }

    public function setStyleGreen()
    {
        $this->style="";
        $this->view->assign("style",$this->style);
        return $this;
    }

    /**
     * @param string $name
     *               fa-wrench:小扳手;
     *               fa-search:放大镜;
     *               fa-plus:加号;
     *               fa-plus:勾(√);
     *               fa-close:叉叉(×);
     * @return $this
     */
    public function setIcoName($name="fa-plus")
    {
        $this->view->assign("icoName",$name);
        return $this;
    }

    /**
     * 设置按钮名称
     * @return $this
     */
    public function setBtnName($name="")
    {
        $this->BtnName=$name;
        $this->view->assign("BtnName",$this->BtnName);
        return $this;
    }

    public function confirm($text="",$ico=3)
    {
        $confirm=["text"=>$text,"ico"=>$ico];
        $this->view->assign("confirm",$confirm);
        return $this;
    }

    public function getFromData($fromName =''){
        $this->view->assign("fromName",$fromName);
        return $this;
    }
    /**
     * 设置弹窗打开方式
     * @return $this
     */
    public function setOpenTypePop()
    {
        $this->OpenType="Pop";
        return $this;
    }

    /**
     * 设置新选项卡打开方式
     * @return $this
     */
    public function setOpenTypeNewTab()
    {
        $this->OpenType="NewTab";
        return $this;
    }

    /**
     * 设置新页面打开方式
     * @return $this
     */
    public function setOpenTypeNewPage()
    {
        $this->OpenType="NewPage";
        return $this;
    }

    /**
     * 设置新页面打开方式
     * @return $this
     */
    public function setOpenTypeAjax()
    {
        $this->OpenType="Ajax";
        return $this;
    }

    /**
     * 设置打开目标url
     * @return $this
     */
    public function setUrl($url = "")
    {
        $this->Url=$url;
        $this->view->assign("BtnUrl",$url);
        return $this;
    }

    /**
     * 设置模板名称
     * @param string $name
     * @return $this
     */
    public function setTempletName($name="")
    {
        $this->templet=$name;
        return $this;
    }

    /**
     * 返回编译后的模板字符串
     * @return string
     */
    public function fetch()
    {
        if($this->isDisabled){
            $this->OpenType="";
            $this->style=" layui-btn-disabled";
            $this->view->assign("style",$this->style);
        }
        $this->view->assign("OpenType",$this->OpenType);
        return $this->view->fetch(
            APP_PATH.'/common/builder/'.$this->templet."/tableHeaderBtn/addBtn.html");
    }
}