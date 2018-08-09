<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/12
 * Time: 15:05
 */

namespace app\common\builder;

use app\common\builder\api\btn;
use app\common\builder\api\tableHeaderBtn;

/**
 * 表单类
 * Class table
 * @package app\common\builder
 */
class table extends ViewBuilder
{
    protected $ConlumnsBtn;
    protected $HeaderBtn;
    protected $BatchBtn;
    protected $BatchKey;
    public function __construct()
    {
        parent::__construct();
        $this->type="table";
        $this->BatchKey="";
        $this->columnsConfig=[];
        $this->HeaderBtn=[];
        $this->BatchBtn=[];
        $this->ConlumnsBtn=[];//列表按钮
    }

    /**
     * 设置批量处理的key
     * @param $val
     * @return $this
     */
    public function setBatchKey($val)
    {
        $this->BatchKey=trim($val);
        return $this;
    }

    public function dataList($data=[])
    {
        $this->view->assign("dataSource",$data);
        return $this;
    }

    public function dataSourceUrl($dataSourceUrl="")
    {
        $this->view->assign("dataSourceUrl",$dataSourceUrl);
        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function addColumns($data)
    {
        $this->columnsConfig=$data;
        $this->view->assign("columnsConfig",$data);

        return $this;
    }

    /**
     * 添加操作的按钮
     * @return $table
     */
    public function addConlumnsBtn(btn $Btn)
    {
        $this->ConlumnsBtn[]=$Btn;
        return $this;
    }

    public function search($data)
    {
        $this->view->assign("search",$data);
        return $this;
    }


    /**
     * 添加头部按钮
     * @param tableHeaderBtn $tableHeaderBtn
     * @return $this
     */
    public function addHeaderBtn(tableHeaderBtn $tableHeaderBtn)
    {
        $this->HeaderBtn[]=$tableHeaderBtn;
        return $this;
    }


    /**
     * 添加批量操作按钮
     * @param tableHeaderBtn $tableHeaderBtn
     * @return $this
     */
    public function addBatchBtn(tableHeaderBtn $tableHeaderBtn)
    {
        $this->BatchBtn[]=$tableHeaderBtn;
        return $this;
    }

    public function fetch($template = '')
    {
        $btnStr="";
        $TempletName=$this->getTempletName();
        foreach ($this->HeaderBtn as $HeaderBtnObj) {
            $btnStr.=$HeaderBtnObj->setTempletName($TempletName)->fetch();
        }
        $this->view->assign("HeaderBtn",$btnStr);

        $btnStr="";
        foreach ($this->BatchBtn as $BatchBtnObj) {
            $btnStr.=$BatchBtnObj->setTempletName($TempletName)->fetch();
        }
        $this->view->assign("BatchBtn",$btnStr);

        $ConlumnsBtnStr="";
        foreach ($this->ConlumnsBtn as $ConlumnsBtnObj) {
            $ConlumnsBtnStr.=$ConlumnsBtnObj->setTempletName($TempletName)->fetch();
        }
        $this->view->assign("BatchKey",$this->BatchKey);
        $this->view->assign("ConlumnsBtn",$ConlumnsBtnStr);
        return parent::fetch($template);
    }
}