<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/12
 * Time: 15:05
 */

namespace app\common\builder;
use think\Exception ;

/**
 * 表格树类
 * Class tree
 * @package app\common\builder
 */
class tree extends table
{
    protected $dataSource;
    protected $pid_origin_value;
    protected $treePidName;
    protected $treePrimaryKey;
    protected $treeField;
    protected $treeOpen;
    protected $treeOpenLevel;
    protected $showTreeOpenOrCloseBtn;
    protected $searchInput='';
    protected $addBth;
    public function __construct()
    {
        parent::__construct();
        $this->treePidName="";//树父节点名称
        $this->treePrimaryKey="";//树主键id名称
        $this->pid_origin_value="";//父节点起始值  0
        $this->treeField="";//展示树效果的字段
        $this->type="tree";
        $this->treeOpen=true;//默认树是不是展开的
        $this->treeOpenLevel=0;//默认树展开层级
        $this->showTreeOpenOrCloseBtn=0;//是否显示展开或不展开的按钮
        $this->searchInput = false;
        $this->dataSource=[];
    }

    /**
     * 展示树效果的字段
     * @param string $name
     * @return $this
     */
    public function setTreeField($name="")
    {
        $this->treeField=$name;
        $this->view->assign("treeField",$name);
        return $this;
    }
    /**
     * 展示树效果的字段
     * @param string $name
     * @return $this
     */
    public function setTreeOpen($open=true)
    {
        $this->treeOpen=$open;
        return $this;
    }
    public function setTreeOpenLevel($TreeOpenLevel=true)
    {
        $this->treeOpenLevel=$TreeOpenLevel;
        return $this;
    }
    public function setShowTreeOpenOrCloseBtn($showTreeOpenOrCloseBtn=true)
    {
        $this->showTreeOpenOrCloseBtn=$showTreeOpenOrCloseBtn?1:0;
        return $this;
    }

    /**
     * 设置树的主键名称
     * @param string $name
     * @return $this
     */
    public function setTreePrimaryKey($name="")
    {
        $this->treePrimaryKey=$name;
        $this->view->assign("treePrimaryKey",$name);
        return $this;
    }

    /**
     * 设置树 的父节点名称 和起始值
     * @param string $name
     * @param string $origin_value
     * @return $this
     */
    public function setTreePidName($name="",$origin_value=""){
        $this->treePidName=$name;
        $this->pid_origin_value=$origin_value;//父节点起始值  0
        $this->view->assign("treePidName",$name);
        $this->view->assign("pid_origin_value",$origin_value);
        return $this;
    }

    public function setSearchInput($searchInput = true){
        $this->searchInput = $searchInput?1:0;
        return $this;
    }

    /**
     * 格式化和排序
     * @param string $dataSource
     * @param string $pid
     * @return array
     */
    private function sortAndFormat($dataSource=[],$pid="",$level=0)
    {
        $array=[];
        foreach ($dataSource as $key=>$item) {
            $array_key=$item[$this->treePidName];
            $array[$array_key][]=$item;
        }
        $data=$this->sortAndFormatExec($array,$pid,$level);
        return $data;
    }
    /**
     * 格式化和排序
     * @param string $dataSource
     * @param string $pid
     * @return array
     */
    private function sortAndFormatExec($dataSource=[],$pid="",$level=0)
    {
        $array=[];

        if(isset($dataSource[$pid]) ){
            foreach ($dataSource[$pid] as $key=>$item) {
                unset($dataSource[$pid]);
                $son=$this->sortAndFormatExec($dataSource,$item[$this->treePrimaryKey],$level+1);
                $item["cur_tree_level"]=$level;
                if($son){
                    $item["cur_tree_has_son"]=1;
                }
                else{
                    $item["cur_tree_has_son"]=0;
                }
                $array[]=$item;
                if($son){
                    $array=array_merge($array,$son);
                }
            }
        }
        return $array;
    }

    private function checkData()
    {
        if($this->treePidName ===""){
            throw new Exception("请设置树父节点名称");
        }
        if($this->treePrimaryKey ===""){
            throw new Exception("请设置树主键id名称");
        }
        if($this->pid_origin_value ===""){
            throw new Exception("请设置父节点起始值");
        }
        if($this->treeField ===""){
            throw new Exception("请设置展示树节点效果的字段");
        }
    }
    public function fetch($template = '')
    {
        $this->checkData();
        $dataSource=$this->dataSource;

        $dataSource=$this->sortAndFormat($dataSource,$this->pid_origin_value);
//        print_r($dataSource);exit;
        $this->view->assign("dataSource",$dataSource);
        $this->view->assign("searchInput",$this->searchInput);
        $this->view->assign("treeOpen",$this->treeOpen);
        $this->view->assign("treeOpenLevel",$this->treeOpenLevel);
        $this->view->assign("showTreeOpenOrCloseBtn",$this->showTreeOpenOrCloseBtn);
        return parent::fetch($template);
    }

    public function dataSource($dataSource="")
    {
        $this->dataSource=$dataSource;
        return $this;
    }

}