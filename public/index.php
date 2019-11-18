<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]


/**
 * 跨域：协议 域名  端口号
 * 1.JSONP：动态插入script标签对
 * 2.代理
 * 3.服务器
 */

header("Access-Control-Allow-Origin: *");//允许与别的域名共享资源
header("Access-Control-Allow-Headers: Origin, X-Requested-With,Authorization,Content-Type,RetryAfter,retry-after,Accept, token");//允许头信息里面加的字段
header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS');//允许的请求方式

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){//过滤OPTIONS请求方式

    exit();
}


// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
