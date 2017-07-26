<?php
namespace denha;

class Route
{
    public static $path;
    public static $class;

    public static function mca()
    {
        if (!isset($_GET['module']) && isset($_SERVER['SCRIPT_NAME']) && isset($_SERVER['REQUEST_URI'])) {
            $uri = self::parseUri();

            if ($uri) {
                $array = explode('/', $uri);

                if (isset($array[0]) && $array[0]) {
                    $_GET['module'] = $array[0];
                    if (isset($array[1]) && $array[1]) {
                        if (is_numeric($array[1])) {
                            $_GET['controller'] = 'detail';
                            $_GET['action']     = 'index';
                            $_GET['id']         = $array[1];
                        } else {
                            $_GET['controller'] = $array[1];
                        }

                        if (isset($array[2]) && $array[2]) {
                            if (is_numeric($array[2])) {
                                $_GET['action'] = 'detail';
                                $_GET['id']     = $array[2];
                            } else {
                                $_GET['action'] = $array[2];
                            }

                            if (isset($array[3]) && $array[3]) {
                                $_GET['penult'] = $array[3];
                                if (isset($array[4]) && $array[4]) {
                                    $_GET['last'] = $array[4];
                                }
                            }
                        }
                    }
                }
            }
        }

        $module     = self::initValue('module', 'index');
        $controller = self::initValue('controller', 'index');
        $action     = self::initValue('action', 'index');
        $penult     = self::initValue('penult', null);
        $last       = self::initValue('last', null);
        define('MODULE', $module);
        define('CONTROLLER', $controller);
        define('ACTION', $action);
        define('PENULT', $penult);
        define('LAST', $last);

        self::$path  = APP ? APP . DS : '';
        self::$class = 'app' . DS . APP . DS . 'Controller\\' . parsename(MODULE, true) . '\\' . parsename(CONTROLLER, true);
    }

    public static function ca()
    {
        if (!isset($_GET['controller']) && isset($_SERVER['SCRIPT_NAME']) && isset($_SERVER['REQUEST_URI'])) {
            $uri = self::parseUri();

            if ($uri) {
                $array = explode('/', $uri);
                if (isset($array[0]) && $array[0]) {
                    $_GET['controller'] = $array[0];
                    if (isset($array[1]) && $array[1]) {
                        if (is_numeric($array[1])) {
                            $_GET['action'] = 'detail';
                            $_GET['id']     = $array[1];
                        } else {
                            $_GET['action'] = $array[1];
                        }

                        if (isset($array[2]) && $array[2]) {
                            $_GET['penult'] = $array[2];
                            if (isset($array[3]) && $array[3]) {
                                $_GET['last'] = $array[3];
                            }
                        }
                    }
                }
            }
        }

        $controller = self::initValue('controller', 'index');
        $action     = self::initValue('action', 'index');
        $penult     = self::initValue('penult', null);
        $last       = self::initValue('last', null);

        define('CONTROLLER', $controller);
        define('ACTION', $action);
        define('PENULT', $penult);
        define('LAST', $last);
        self::$path  = APP . DS;
        self::$class = 'app' . DS . APP . DS . 'Controller\\' . parsename(CONTROLLER, true);
    }

    //获取直接参数
    private static function initValue($flag, $value)
    {
        $res = (isset($_GET[$flag]) && $_GET[$flag] ? strip_tags($_GET[$flag]) : $value);
        return $res;
    }

    //解析路由
    private static function parseUri()
    {
        $uri = urldecode($_SERVER['REQUEST_URI']);

        if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
            $uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
        }

        $uri = trim($uri, '/');

        if (!$uri) {
            return false;
        }

        $pos = strpos($uri, '?');

        if ($pos !== false) {
            $uri = substr($uri, 0, $pos);
        }

        if ($uri) {
            return $uri;
        } else {
            return false;
        }
    }

}