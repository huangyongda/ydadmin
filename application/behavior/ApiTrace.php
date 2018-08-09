<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/12/30
 * Time: 14:15
 */
namespace app\behavior;
use think\Cache;
use think\Env;
use think\Exception;
use think\Log;
use think\Response;
use think\response\Json;
use think\View;

class ApiTrace{
    public function run(&$params)
    {
        if( !($params instanceof Response ) ){
            return false;
        }

        if (request()->module()=="admin" && request()->controller()=="ApiTrace" &&request()->action()  =="getdebuginfo" )
        {
            return true;
        }
        if( ! \think\Config::get("APP_DEBUG")  ){ //必须调试模式
            return true;
        }
        if( ! Env::get("ApiTrace")  ){
            return true;
        }
        $runtime = number_format(microtime(true) - THINK_START_TIME, 10);
        $log=Log::getLog();

        $debug_log=isset($log['debug']) ?$log['debug']:[] ;
        foreach ($debug_log as $key=>$item) {
            $debug_log[$key]["return_json"]="无法解析json";
            if(isset($debug_log[$key]["return"])){
                $debug_log[$key]["return_json"]=var_export(json_decode($debug_log[$key]["return"],true),true);
            }
            if(isset($debug_log[$key]["post"])){
                $debug_log[$key]["post"]=var_export($debug_log[$key]["post"],true);
            }
            $debug_log[$key]["id"]=md5(var_export($debug_log[$key],true));
        }
        $data=[];
        $data["debug_log"]=$debug_log;
        $data["runtime"]=$runtime;


        if(request()->isAjax() || $params instanceof Json){
            $md5str=md5(json_encode($data) );
            header("ApiTrace:http://".$_SERVER["SERVER_NAME"].url("admin/ApiTrace/getdebuginfo",["str"=>$md5str]) );
            Cache::set($this->getCacheKey($md5str),$data,60*5);
        }
        else{
            if($params instanceof Response){
                $origin_data=$params->getData();
                $origin_data = (string) $origin_data;
                $af_data=$origin_data.$this->display($data);
                $params->data($af_data);
            }
        }


    }

    private function getCacheKey($strval="")
    {
        return "ApiTrace_".$strval;
    }

    public function showDebugInfo($keyStr="")
    {
        $keyStr=trim($keyStr);
        if(!$keyStr){
            throw new Exception("错误操作");
        }
        $data=Cache::get($this->getCacheKey($keyStr) );
        if(!$data){
            throw new Exception("debug信息不存在");
        }
        $data["ajax"]=true;
        return $this->display($data);
    }

    private function display($data)
    {
        $debug_log=$data["debug_log"];
        $runtime=$data["runtime"];
        $ajax=isset($data["ajax"])?1:0;
        $view=new View();
        $view->assign("debug_log",$debug_log);
        $view->assign("runtime",$runtime);
        $view->assign("ajax",$ajax);
        $tplPath=APP_PATH.'/behavior/view/ApiTrace.html';
        return $view->fetch($tplPath);
    }
}