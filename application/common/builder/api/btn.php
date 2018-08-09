<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/12
 * Time: 17:33
 */

namespace app\common\builder\api;


interface btn
{

    /**
     * 设置按钮名称
     * @return $this
     */
    public function setBtnName();

    /**
     * 设置弹窗打开方式
     * @return $this
     */
    public function setOpenTypePop();

    /**
     * 设置新选项卡打开方式
     * @return $this
     */
    public function setOpenTypeNewTab();

    /**
     * 设置打开目标url
     * @return $this
     */
    public function setUrl($url="");

    /**
     * 点击按钮时询问
     * @param string $text
     * @param int $ico
     * @return $this
     */
    public function confirm($text="",$ico=3);

    /**
     * 返回编译后的模板字符串
     * @return string
     */
    public function fetch();


    /**
     * 设置按钮样式
     * @return $this
     */
    public function setStyleDanger();

    /**
     * 设置按钮样式
     * @return $this
     */
    public function setStyleBlue();

    /**
     * 设置按钮样式
     * @return $this
     */
    public function setStyleGreen();

    /**
     * 设置按钮图标
     * @return $this
     */
    public function setIcoName();

    /**
     * 设置主题名称
     * @return $this
     */
    public function setTempletName();
}