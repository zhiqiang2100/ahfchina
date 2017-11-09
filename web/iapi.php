<?php
define('BE_ROOT',  realpath(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'be');//框架所在的目录
define('APP_ROOT', realpath(dirname(__FILE__)));//当前app的目录
require BE_ROOT. DIRECTORY_SEPARATOR. 'core.php';
try{
	Be_Core::init();
	//Be_PluginManager::add('before_route', $plugin_name);
	//Be_PluginManager::add('after_route', $plugin_name);
	
	Be_Dispatcher::setRouteClass('Be_Libs_Apiroute');
	//Be_PluginManager::add('after_route', 'Be_Plugins_Delurlgsid');
	// Be_PluginManager::add('after_route', 'Be_Plugins_Header');
	
	
	Be_Dispatcher::dispatch();
}
catch(Exception $e){
	header("Location:http://sina.cn");
}
