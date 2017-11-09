<?php
class Libs_Mroute{
	static $_dir = array(1 => 'simple', 3=> '3g', 4 => 'touch');
	static $_class_name='';
	
	public static function setClassName($class_name){
		self::$_class_name = $class_name;
	}
	 
	public static function getClassName(){
		if (self::$_class_name != '') return self::$_class_name;
		if (IS_CLI){
			$dir = '';
			if (!isset($GLOBALS['argv'][1])){
				throw new Be_Exception('cli mode arv 1 not set');//@todo add exception code
			}
			$pathInfo = str_replace('_', '/', $GLOBALS['argv'][1]);
			$dir_str = '';
		} else {
			$pathInfo = self::detect_pathInfo();
			$dir_str = 'Controller_';
			$pathInfo_tmp = ltrim($pathInfo, '/.');
			if (substr($pathInfo_tmp,0,3) != 'aj/'){
				Be_Libs_Vt::setPathInfo($pathInfo);
				$vt = Be_Libs_Vt::get();
				$dir = self::$_dir[$vt];
				
				if (empty($_POST) && empty($_FILES) && ((Be_Libs_Vt::getFromEnv() != $vt) || $_GET['vt'] == '')){//如果从环境变量中取到的vt值和适配过得vt值不一样或者是get请求中不带vt值的做一次302跳转
                    if ( $_COOKIE['vt'] == '' )
					    Be_Libs_Cookie::setCookie('vt', $vt);
					$request_uri = '';
					if (isset($_SERVER['REQUEST_URI'])){
						$tmp = explode('?', $_SERVER['REQUEST_URI'], 2);
						$request_uri = $tmp[0];
						if (isset($tmp[1])){
							$params = array();
							parse_str($tmp[1], $params);
							$params['vt'] = $vt;
							$param_str = http_build_query($params);
							$request_uri .=  '?'. $param_str;
						} else {
							$request_uri .=  '?vt='. $vt;
						}
					}
					$url = $_SERVER['HTTP_HOST']. $request_uri;
					header("Location: http://{$url}");
					exit;
				}
			}
		}
		$pathInfo = ltrim($pathInfo, '/.');
        if ( '' == $pathInfo ) {//默认跳转到我的收藏模块
            $pathInfo = 'index';
        }
		$tmp = explode("/", $pathInfo);
		if ($dir != '') array_unshift($tmp, $dir);
		$tmp = array_map("ucfirst", $tmp);
		$controller_class = $dir_str. implode("_", $tmp);
		if (substr($controller_class, -1) == '_') $controller_class = $controller_class. 'Index';
		return $controller_class;
	}
	
	/**
	 * 获取请求URI,
	 *
	 * @return  string  URI
	 * @throws  Swift_Exception_Program
	 */
	public static function detect_pathInfo() {
		if (isset($_SERVER['REQUEST_URI'])) {
			// 提取path部分
			$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$uri = rawurldecode($uri);
		} else {
			throw new Be_Exception('can not detect uri');
		}
		return $uri;
	}
}
