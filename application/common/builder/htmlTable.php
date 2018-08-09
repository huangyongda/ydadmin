<?php
/**
 * Created by PhpStorm.
 * User: pengyx
 * Date: 2017/8/30
 * Time: 11:39
 */

namespace app\common\builder;


class htmlTable
{
    private $tableHtml = '';
    private $cssPath = '';
    private $theadData;
    private $tbodyData;

    public function __construct()
    {
        $this->cssPath = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["SCRIPT_NAME"])."/static/layui";
        $this->tableHtml .= '<link rel="stylesheet" href="'.$this->cssPath.'/plugins/layui/css/layui.css?s=99" media="all" />';
    }

    public function thead($data=[])
    {
        $this->theadData = $data;
        return $this;
    }

    public function tbody($data=[])
    {
        $this->tbodyData = $data;
        return $this;
    }

    public function printHtml()
    {
        $html = '<div class="layui-field-box layui-form"><table class="layui-table admin-table">';
        if($this->theadData)
        {
            $html .= '<thead><tr>';
            foreach($this->theadData as $k => $v)
                $html .= "<th>{$v}</th>";
            $html .= '</tr></thead>';

        }

        if($this->tbodyData)
        {
            $html .= '<tbody id="content" style="height:auto">';
            foreach($this->tbodyData as $kk => $vv)
            {
                $html .= '<tr>';
                foreach($vv as $kkk => $vvv)
                    $html .= "<td>{$vvv}</td>";
                $html .= '</tr>';

            }
            $html .= '</tbody>';
        }

        $html .= '</table></div>';

        $this->tableHtml .= $html;
        return $this->tableHtml;
    }

    public function prinImg(){
        $html = "<img src='".$this->tbodyData."'  >";
        return $html;
    }
}