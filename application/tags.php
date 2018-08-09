<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用行为扩展定义文件
return [
    // 应用初始化
    'app_init'     => [],
    // 应用开始
    'app_begin'    => ['app\\behavior\\AppBegin'],
    // 模块初始化
    'module_init'  => [],
    // 操作开始执行
    'action_begin' => [],

    'app_exception' => ['app\\behavior\\AppException'],

    // 视图内容过滤
    'view_filter'  => [],
    // 日志写入
    'log_write'    => [],


    'response_send'      => ['app\\behavior\\ApiTrace'],

    'response_end'      => [],

    // 应用结束
    'app_end'      => ['app\\behavior\\AppEnd'],
];
