<?php
return [
    // +----------------------------------------------------------------------
    // | 基础配置
    // +----------------------------------------------------------------------
    'debug'                        => true, // 是否开启调试
    'trace'                        => true, // 是否显示页面Trace信息
    'tag_trans'                    => false, //是否开启标签翻译功能
    'app_debug'                    => true, // app接口调试模式
    'error_log'                    => true, // 错误日志保存 true保存 false不保存

    'ststic'                       => URL . '/ststic',
    'vendor'                       => URL . '/vendor',
    'uploadfile'                   => URL . '/uploadfile/', // URL . '/uploadfile/',
    'imgUrl'                       => URL, // URL,
    'auth_key'                     => 'QGa9h95r9Q5dYsnpsPb9', //助手函数auth密钥 用于可逆加密

    // +----------------------------------------------------------------------
    // | 项目结构层数配置
    // | level
    // |    ture:开启项目结构
    // |    false:关闭项目结构目录
    // | 关闭后取SCRIPT_NAME 最后一个为Action 倒数第二个为Controller 参数/s区分
    // +----------------------------------------------------------------------

    'route'                        => [
        'level'      => 4, // 项目结构层数数量
        'open_level' => false,
        'open_route' => true, // 是否开启路由转换功能 true开启 false关闭
        'type'       => 'sqlite', // 保存类型
    ],

    // +----------------------------------------------------------------------
    // | Cookie配置
    // +----------------------------------------------------------------------

    'cookie'                       => [
        // Cookie 作用域
        'domain' => '',
        // Cookie 作用路径
        'path'   => '/',
        // Cookie 前缀，同一域名下安装多套系统时，请修改Cookie前缀
        'prefix' => 'dh_',
        // Cookie 保存时间
        'expire' => 0,
        // Cookie 内容加密
        'auth'   => true,
    ],

    // +----------------------------------------------------------------------
    // | 缓存配置
    // +----------------------------------------------------------------------

    'cache'                        => [
        // 类型
        'type' => 'File',
        'dir'  => DATA_CACHE_PATH,
    ],

    // +----------------------------------------------------------------------
    // | 视图模板替换字符串
    // +----------------------------------------------------------------------

    'view_replace_str'             => [
        '__PUBLIC__' => '',

    ],

    // +----------------------------------------------------------------------
    // | CORS配置
    // +----------------------------------------------------------------------
    'cores'                        => [
        // 开启状态
        'open'        => false,
        // 允许请求来源 多个来源请用数组表示
        'origin'      => '*',
        // GET,POST,PUT,DELETE
        'methods'     => ['GET', 'POST'],
        // 秒
        'maxAge'      => 1800,
        // 携带证书式访问保存cookie [当值为ture时origin不能为*]
        'credentials' => false,
    ],

    // +----------------------------------------------------------------------
    // | 磁盘容量检测
    // +----------------------------------------------------------------------

    'check_disk'                   => true, //是否开启容量检测
    'disk_space'                   => 0.1, //预警容量阀值G单位 发送邮箱提示

    // +----------------------------------------------------------------------
    // | 邮件发送配置
    // +----------------------------------------------------------------------

    'send_debug_mail'              => true, //错误信息是否发送邮箱
    'send_mail'                    => '350375092@qq.com', //接收邮箱账户
];
