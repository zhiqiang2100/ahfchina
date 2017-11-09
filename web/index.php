<?php
/**
 * can be visit by cli or not cli mode
 * cli mode   xxx/index.php xxx_yyy_zzz  querystring    //  xxx/yyy... means the path
 * 
 */
define('BE_ROOT',  realpath(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'be');//框架所在的目录
define('APP_ROOT', realpath(dirname(__FILE__)));//当前app的目录
if ( $_GET['debug'] )
    ini_set('display_errors', 'On');
else
    ini_set('display_errors', 'Off');
require BE_ROOT. DIRECTORY_SEPARATOR. 'core.php';

//error_reporting(E_ERROR |E_WARNING| E_PARSE);
error_reporting(E_ERROR | E_PARSE);

try{
	Be_Core::init();
	
	Be_Dispatcher::setRouteClass('Be_Libs_Newmroute');//default PageRoute;

	Be_PluginManager::add('after_route', 'Be_Plugins_Header');

	Be_Dispatcher::dispatch();

}
catch(Exception $e){
	//var_dump($e);
    exit;
	header("Location: http://sina.cn", true, 301);
}
