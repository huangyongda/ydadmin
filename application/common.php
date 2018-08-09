<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 *
 * 对输入数据进行安全过滤,如果是字符串,则可控制是否在返回值两端加上单引号
 * $is_contains_quote: true,返回值两端加上单引号
 *                     false,默认,不加
 */
function safe_input($value,$is_contains_quote=false, $always_strip_first = false) {
    if(!isset($value)) return $value;
    $value = trim($value);
    // 去除反斜杠
    if (get_magic_quotes_gpc() || $always_strip_first) {
        $value = stripslashes($value);
    }

    if (!is_numeric($value)) {
        $value = addslashes($value); //addslashes
    }
    if($is_contains_quote) {
        $value = '\''.$value.'\'';
    }
    return $value;
}

/**
 *安全过滤,支持字串,数组与对象.
 */
function safe_input_obj($obj,$is_contains_quote=false, $always_strip_first = false) {
    if(!isset($obj)) return $obj;

    if(is_string($obj) ) {
        return safe_input($obj,$is_contains_quote, $always_strip_first);
    }
    else if(is_array($obj)){
        foreach ( $obj as $key => &$val ) {
            if (is_array($val)) {
                safe_input_obj($val,$is_contains_quote, $always_strip_first);
            }
            else {
                $val = safe_input($val,$is_contains_quote, $always_strip_first);
            }
        }
        return $obj;
    }
    else if(is_object($obj)) {
        $vars = get_object_vars($obj);
        foreach($vars as $key=>$val) {
            $obj->$key = safe_input($val,$is_contains_quote, $always_strip_first);
        }
        return $obj;
    }
    else{
        return $obj;
    }
}