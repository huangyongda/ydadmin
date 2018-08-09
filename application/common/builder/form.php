<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/15
 * Time: 11:00
 */

namespace app\common\builder;


use think\Validate;

class form extends ViewBuilder
{
    public function __construct()
    {
        parent::__construct();
        $this->type="form";
    }

    public function setData($data)
    {
        foreach ($data as $key=>$datum) {

            if(isset($datum[0]) && strpos($datum[0],"|") !== false){
                $fieldConfig=explode("|",$datum[0]);

                foreach ($fieldConfig as $k=>$v) {
                    if($k>0){
                        $configData=explode(":",$v);
                        $data[$key][$configData[0]]=isset($configData[1])?$configData[1]:true;
                    }
                }
                $data[$key][0]=$fieldConfig[0];


            }

            if(!isset($datum[3])){
                $data[$key][3]="";
            }
            if(!isset($datum[4])){
                $data[$key][4]="";
            }
            /*兼容select 可以允许部分只读*/
            if($data[$key][2] == 'select' && is_array($data[$key][4])){
                /*部分只读*/
                if(isset($data[$key][4]['noReadonly'])){
                    $data[$key]['noReadonly'] = explode(',',$data[$key][4]['noReadonly']);
                }
                if(isset($data[$key][4]['default'])){
                    $data[$key][4]= $data[$key][4]['default'];
                }
            }
        }
       // dump($data);
        $this->view->assign("formData",$data);
        return $this;
    }

    public function setSubmitUrl($Url="")
    {
        $this->view->assign("submitUrl",$Url);
        return $this;
    }

    public function setValidate(Validate $validate)
    {
        $this->validate=$validate;
        return $this;
    }
}