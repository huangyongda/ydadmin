<?php
/**
 * 后台登录控制器
 * User: pengyx
 * Date: 2017/12/7
 * Time: 13:48
 */

namespace app\admin\controller;


use app\common\builder\table;
use app\Lib\Model\User\AdminUser\AdminUserLogin;
use think\captcha\Captcha;
use think\Controller;
use think\Exception;
use think\Request;
use think\Url;
use think\Validate;
use think\View;

class Login extends Controller
{
    /**
     * 后台用户登录
     */
    public function signIn(Request $request)
    {
        if($request->isPost())
        {
            try
            {

                $params = array_map('trim',$request->param());
                /** 数据验证 */
                $rule = [
                    'account'=>'require',
                    'passwd'=>'require',
                    'captcha'=>'require',
                ];
                $msg = [
                    'account' => '登录名不能为空',
                    'passwd' => '密码不能为空',
                    'captcha' => '验证码不能为空',
                ];
                $v = new Validate($rule);
                $v->message($msg);
                if(!$v->check($params))
                {
                    throw new Exception($v->getError());
                }
                // 验证码验证
                $captcha = (new Captcha())->check($params['captcha'],'signIn');
                if(!$captcha) {
                    throw new Exception('验证码错误');
                }

//                /** 数据提交 */
//                $isLogin = (new AdminUserLogin())
//                    ->setAccount($params['account'])
//                    ->setPasswd($params['passwd'])
//                    ->signIn();
//                if(!$isLogin) {
//                    throw new Exception('登录失败');
//                }

                return table::returnSuccess([],'登录成功');
            }
            catch(Exception $e)
            {
                return table::returnError([],$e->getMessage(),false);
            }
        }
        else
        {
            return (new View())->fetch('signIn');
        }
    }

    /**
     * 推出登录
     */
    public function signOut()
    {
//        (new AdminUserLogin())->signOut();

        $this->success('成功退出',url('signIn'),[],2);
        return true;
    }

    public function captcha()
    {
        $config = [
            'useCurve'  => false,
            'fontSize'=>18,
            'imageW'   => 140,
            'imageH'   => 36,
            'length'   => 4,
            'expire'=>60,


        ];
        $captcha = new Captcha($config);

        return $captcha->entry('signIn');
    }

}