<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：hd.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年05月20日
*   Description   ：活动页
*/
Class Controller_Touch_HdAddrPost {
    protected $codedef = array();
    private   $name = '';
    private   $address = '';
    private   $phone = '';
    private   $code = '';
    private   $uid = '';
    public function __construct() {
        $this->codedef = Be_Config::k('codedef.outmsg');
    }

    public function run() {
        $this->getParam();
        $this->checkParam();
        $this->main();
    }

    public function main() {
        $this->uid = Model_Common::getUserId();
        if( empty($this->uid) )
             $this->formatOutput(E_USERNOLOGIN);
        $res = Model_Hd::postAddress($this->uid,$this->name,$this->phone,$this->code,$this->address) ;
        if( false === $res ){
             $this->formatOutput(E_INTERFACEERR);
        }else if( intval($res) > 0 ){
            $this->formatOutput( E_INTERFACE+intval($res) );
        }else{
            $this->formatOutput(E_SUCCESS);
        }
    }

    /**
     *  接收参数
     * @author 成凯丽  kaili2@staff.sina.com.cn
     * @return  
     * @since 2013-09-25
     */
    protected function getParam()
    {
        $this->name  = htmlspecialchars(Be_Data::form('name','',true));
        $this->phone = htmlspecialchars(Be_Data::form('phone','',true));
        $this->address = htmlspecialchars(Be_Data::form('address','',true));
        $this->code = htmlspecialchars(Be_Data::form('code','',true));

//        $this->name = '哈哈';
//        $this->phone = '13466551234';
//        $this->address = '哈哈哈哈哈';
//        $this->code = '031322';
    }

    /**
     *  接收并检查参数
     * @author 成凯丽  kaili2@staff.sina.com.cn
     * @return  
     * @since 2013-09-25
     */ 
    protected function checkParam()
    {   
        if( empty($this->name) || empty($this->phone) || empty($this->address) || empty($this->code) )
                $this->formatOutput(E_PARAMERR);
        //检查电话号码
        if( !Be_Libs_Valid::validPhoneNo($this->phone) )
                $this->formatOutput(E_PHONEERR);
//      var_dump(!preg_match( "/^[0-9]d{6}$/",$this->code ));
        //检查邮编
        if (strlen($this->code) != 6  )
            $this->formatOutput(E_CODEERR);

    }

            /**
     *  格式化输出结果
     * @author 成凯丽  kaili2@staff.sina.com.cn
     * @param int $code
     * @param string $msg
     * @param string $data
     * @return string 
     * @since 2013-09-25
     */
    protected function formatOutput($code='',$msg='', $data = '' )
    {
         if(empty($msg) && array_key_exists($code , $this->codedef))
             $msg = $this->codedef[$code];
         $result = json_encode(array(
             'code'=>$code,
             'message'=>$msg,
             'data'=>$data
             ));
        //$result = json_encode($result);
        isset($_GET['jsoncallback']) ?  exit(htmlspecialchars($_GET['jsoncallback'])."({$result})") : exit($result);
    
    }
}
