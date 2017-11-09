<?php
/**
 * @file controller/Aj/qing.php
 * @author zhiqiang18@staff.sina.com.cn
 * @date 2014-01-22
 * @description 轻应用ajax交互接口
 */
class Controller_Aj_Qing
{
    const TYPE_TOUTIAO = 'toutiao';
    const SECOND_PAGE  = 2;
    private $_data  = array(); 
    
    public function run() {
        $type   = Be_Data::param('type') ? Be_Data::param('type') : self::TYPE_TOUTIAO;
        $page   = Be_Data::param('page') ? Be_Data::param('page') : self::SECOND_PAGE;

        //从model层获取业务数据
        $lists = Model_Qing::getQingMessagesForAj($type, $page);

        if ( is_array($lists) && count($lists) > 0 ) {
            $ret = array(
                'status'    => 1,
                'message'   => 'success',
                'data'      => $lists,
            );
        } else
            $ret = array(
                'status'    => 0,
                'message'   => '已经没有数据了',
            );

        Be_Libs_Ajax::displayJson($ret);
    }
    
}
