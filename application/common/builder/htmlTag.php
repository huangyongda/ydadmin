<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/21
 * Time: 17:46
 */

namespace app\common\builder;


class htmlTag
{
    static private function htmlClass($htmlClass="",$text="")
    {
        return "<span class=\"".$htmlClass."\">$text</span>";
    }


    /**
     * 红
     * @param $text
     * @return string
     */

    static public function red($text)
    {
        return self::htmlClass("layui-badge",$text);
    }


    /**
     * 橙
     * @param $text
     * @return string
     */
    static public function orange($text)
    {
        return self::htmlClass("layui-badge layui-bg-orange",$text);
    }


    /**
     * 绿
     * @param $text
     * @return string
     */
    static public function green($text)
    {
        return self::htmlClass("layui-badge layui-bg-green",$text);
    }


    /**
     * 青
     * @param $text
     * @return string
     */
    static public function cyan($text)
    {
        return self::htmlClass("layui-badge layui-bg-cyan",$text);
    }


    /**
     * 蓝
     * @param $text
     * @return string
     */
    static public function blue($text)
    {
        return self::htmlClass("layui-badge layui-bg-blue",$text);
    }


    /**
     * 黑
     * @param $text
     * @return string
     */
    static public function black($text)
    {
        return self::htmlClass("layui-badge layui-bg-black",$text);
    }

    /**
     * 灰
     * @param $text
     * @return string
     */
    static public function gray($text)
    {
        return self::htmlClass("layui-badge layui-bg-gray",$text);
    }
}