<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/16
 * Time: 14:54
 */

namespace app\admin\controller;


class Upload
{
    public function uploadImg()
    {
        request()->server(['HTTP_X_REQUESTED_WITH'=>'xmlhttprequest']);
        $filename="";
        foreach ( request()->file() as $file_name=>$file) {
            $filename=$file_name;
            break;
        }
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file($filename);

        // 移动到框架应用根目录/html/uploads/ 目录下

        $info = $file->move(dirname($_SERVER['SCRIPT_FILENAME']). DS . 'Uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            $SCRIPT_NAME=dirname($_SERVER['SCRIPT_NAME']);
            $path= ($SCRIPT_NAME=="/"?"":$SCRIPT_NAME)."/Uploads/".$info->getSaveName();

           // $IMGID=(new UploadImg())->setPath($path)->save();
            $IMGID=123;
            echo "{
                  \"code\": 0
                  ,\"msg\": \"上传成功\"
                  ,\"data\": {
                    \"src\": \"".$path."\"
                    ,\"alt\": \"666\"
                    ,\"id\": \"{$IMGID}\"
                  }
                }";
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            //echo $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            //echo $info->getFilename();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }
}