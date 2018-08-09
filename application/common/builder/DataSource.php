<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/11/15
 * Time: 11:39
 */

namespace app\common\builder;


class DataSource
{
    private $data=[];

    /**
     * 设置数据源
     * @param $list
     * @return $this
     */
    public function setDataSource($list){
        $this->data["list"]=$list;
        return $this;
    }

    /**
     * 设置其他数据
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function setOtherData($key="",$value=""){
        $this->data[$key]=$value;
        return $this;
    }

    /**
     * 删除这个某个数据
     * @param string $key
     * @return $this
     */
    public function removeDataKey($key=""){
        unset($this->data[$key]);
        return $this;
    }

    /**
     * 获取全部返回数据
     * @return array
     */
    public function getData(){
        return $this->data;
    }
}