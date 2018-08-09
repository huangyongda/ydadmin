<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/12
 * Time: 17:21
 */
namespace app\common\builder\conlumnsBtn;

use app\common\builder\btn;

class conlumnsBtn extends btn  implements \app\common\builder\api\conlumnsBtn
{
    public function __construct()
    {
        parent::__construct();
        $this->BtnName="添加";
        $this->setStyleGreen();
    }


    /**
     * 返回编译后的模板字符串
     * @return string
     */
    public function fetch()
    {
        $this->view->assign("OpenType",$this->OpenType);
        return $this->view->fetch(
            APP_PATH.'/common/builder/'.$this->templet."/conlumnsBtn/btn.html");
    }


}