<?php
/**
 * 
 * @author xubing
 *
 */

class Libs_Render extends Be_Libs_Render
{
    /**
     * 公共标准头
     * @param int $vt 版本号 1 简版 3 3g版 4 touch版
     * @param enum(true,false) $notWml true 不带wml false 带wml 
     * @param array $option 附加参数
     * @return string
     */
    public static function header($vt=-1, $notWml = FALSE, $option = array()){
        $html = parent::header($vt, $notWml, $option);

        $keywords = empty($option['refresh']) ? '' : '<meta http-equiv="refresh" content="' . $option['refresh'] . '" />';
        $html .= $keywords;
        return $html;
    }
    
    /**
     * 根据vt版本和样式类型获取公共导航链接
     * @param int $vt 版本
     * @param style int 类型
     * @return string html
     */
    public static function footer_links($vt = -1, $style = 1) {
        if ( $vt == -1 ) $vt = Be_Libs_Vt::get();
        $html = '';
        if ( $vt == 1 ) {//简版
        }
        if ( $vt == 4 ) {//touch触屏版
            //财经url
            $finance_url = Be_Libs_Url::buildUrl(Be_Config::k('url.comm_finance_url'));
            //股票url
            $stock_url   = Be_Libs_Url::buildUrl(Be_Config::k('url.comm_stock_url'));
            //基金rul
            $fund_url    = Be_Libs_Url::buildUrl(Be_Config::k('url.comm_fund_home_url'));
            switch ( $style ) {
            case 1:
                $html = <<<END
                <div class="text">
	                <div class="content">
		                <div class="hx mg"></div>
		                <div class="msg">
                            <a href="{$finance_url}">财经</a>&gt;&gt;<a href="{$stock_url}">股票</a>&gt;&gt;<a href="{$fund_url}">基金</a>					
                        </div>
	                </div>
                </div>
END;
                break;
            case 2:
                $html = <<<END
                <div class="text">
                    <div class="content">
                        <div class="hx mg"></div>
                        <div class="msg">
                            <a href="{$finance_url}">财经</a>&gt;&gt;<a href="{$stock_url}">股票</a>
                        </div>
                    </div>
                </div>
END;
                break;
            case 3:
                break;
            default : 
                break;
            }
        }
        return $html;
    }

}
