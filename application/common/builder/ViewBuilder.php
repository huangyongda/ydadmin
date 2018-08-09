<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/10
 * Time: 13:31
 */
namespace app\common\builder;

use think\Config;
use think\Response;
use think\View;

class ViewBuilder{
    protected $type="";

    public function __construct()
    {
        $this->view=new View();
        $this->view->replace("__TPL__",
            "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["SCRIPT_NAME"])."/static/layui");
        $this->templet="admin";

        $this->view->assign("uploadImgUrl",\url("admin/upload/uploadImg") );
        $this->setTitle();
        $this->setPageSize();
        $this->setRemark();
    }

    protected function setViewType($ViewType="")
    {
        $this->view->assign("ViewType",$ViewType);
        return $this;
    }

    public function getTempletName()
    {
        return $this->templet;
    }

    public function view()
    {
        return $this->view;
    }

    public function setTitle($title="联保后台系统")
    {
        $this->view->assign("title",$title);
        return $this;
    }

    public function setPageSize($pageSize="10")
    {
        $this->view->assign("pageSize",$pageSize);
        return $this;
    }

    public function setRemark($Remark="")
    {
        $this->view->assign("remark",$Remark);
        return $this;
    }

    /**
     * 操作成功并跳转
     * @param string $msg
     * @param string $url
     * @return Response|\think\response\Json|\think\response\Jsonp|\think\response\Redirect|\think\response\View|\think\response\Xml
     */
    static public function returnSuccessAndToUrl($msg="获取成功",$url=""){
        return self::returnJson([] ,$msg,true,$count=null,$url);
    }

    /**
     * 返回成功并关闭窗口
     * @param string $msg
     * @return Response|\think\response\Json|\think\response\Jsonp|\think\response\Redirect|\think\response\View|\think\response\Xml
     */
    static public function returnSuccessAndCloseWindow($msg="获取成功")
    {
        return self::returnJson([] ,$msg,true,$count=null,$url="",$closeWindow=true);
    }

    /**
     * 操作成功并刷新
     * @param array $data
     * @param string $msg
     * @param null $count
     * @return Response|\think\response\Json|\think\response\Jsonp|\think\response\Redirect|\think\response\View|\think\response\Xml
     */
    static public function returnSuccess($data = [], $msg="获取成功", $count=null){
        return self::returnJson($data ,$msg,true,$count);
    }

    /**
     * 操作失败
     * @param array $data
     * @param string $msg
     * @param null $count
     * @return Response|\think\response\Json|\think\response\Jsonp|\think\response\Redirect|\think\response\View|\think\response\Xml
     */
    static public function returnError($data = [], $msg="获取失败", $count=null){
        return self::returnJson($data ,$msg,false,$count);
    }


    static public function returnJson($data = [],$msg="获取成功",$status=true,$count=null,$url="",$closeWindow=false)
    {
        if($data instanceof DataSource){
            $DataSource=$data->getData();
            $jsondata = $DataSource;
            $jsondata["rel"]=$status;
            $jsondata["msg"]=$msg;
        }
        else{
            $jsondata = [
                "rel"  => $status,
                "msg"  => $msg,
                "list" => $data
            ];
        }
        if($closeWindow){
            $jsondata["closeWindow"]=1;
        }
        if($url){
            $jsondata["url"]=$url;
        }

        if($count !== null){
            $jsondata["count"]=$count;
        }
        $code = 200;
        return Response::create($jsondata, 'json', $code);
    }

    public function fetch($template = '')
    {
        $tableTplPath=APP_PATH.'/common/builder/'.$this->templet.'/table/index.html';
        $tplPath=APP_PATH.'/common/builder/'.$this->templet."/".$this->type.'/index.html';
        $this->view->assign("tableTplPath",$tableTplPath);
        if($template)
        {
            $this->view->assign("viewbasetpl",$tplPath);
        }
        $this->view->assign("appdebug",Config::get('APP_DEBUG'));
        $this->setViewType($this->type);
        return $this->view->fetch($template?$template:$tplPath);
    }
}