<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：pic.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月03日
*   Description   ：
*/
class Model_Pic {

    public static function getPicList($type) {
        $list = Data_Pic::getPicList($type);
        return $list;
    }
}
