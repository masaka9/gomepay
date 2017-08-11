<?php
/**
 * Created by PhpStorm.
 * User: masaka9
 * Date: 2017/8/11
 * Time: 下午12:33
 */

namespace GomePay\API;

use GomePay\Utils\DES_JAVA;

class LibBonus
{
    /**
     * 获取签名数据
     * @param string $bonuse_key
     * @param array $params
     * @return string
     */
    public function get_dstbdatasign($bonuse_key, $params)
    {

        $sign = "";
        if (isset($params ['merchno']) && !is_null($params ['merchno']) && $params ['merchno'] != '') {
            $sign .= "merchno=" . $params ['merchno'];
        }
        if (isset($params ['mediumno']) && !is_null($params ['mediumno']) && $params ['mediumno'] != '') {
            $sign .= "&mediumno=" . $params ['mediumno'];
        }
        if (isset($params ['cardno']) && !is_null($params ['cardno']) && $params ['cardno'] != '') {
            $sign .= "&cardno=" . $params ['cardno'];
        }
        if (isset($params ['usertype']) && !is_null($params ['usertype']) && $params ['usertype'] != '') {
            $sign .= "&usertype=" . $params ['usertype'];
        }
        if (isset($params ['dsorderid']) && !is_null($params ['dsorderid']) && $params ['dsorderid'] != '') {
            $sign .= "&dsorderid=" . $params ['dsorderid'];
        }
        if (isset($params ['amount']) && !is_null($params ['amount']) && $params ['amount'] != '') {
            $sign .= "&amount=" . $params ['amount'];
        }
        if (isset($params ['dsyburl']) && !is_null($params ['dsyburl']) && $params ['dsyburl'] != '') {
            $sign .= "&dsyburl=" . $params ['dsyburl'];
        }
        if (isset($params ['dstburl']) && !is_null($params ['dstburl']) && $params ['dstburl'] != '') {
            $sign .= "&dstburl=" . $params ['dstburl'];
        }
        if (isset($params ['orderurl']) && !is_null($params ['orderurl']) && $params ['orderurl'] != '') {
            $sign .= "&orderurl=" . $params ['orderurl'];
        }
        if (isset($params ['currency']) && !is_null($params ['currency']) && $params ['currency'] != '') {
            $sign .= "&currency=" . $params ['currency'];
        }
        if (isset($params ['productdesc']) && !is_null($params ['productdesc']) && $params ['productdesc'] != '') {
            $sign .= "&productdesc=" . $params ['productdesc'];
        }
        if (isset($params ['ebcbankid']) && !is_null($params ['ebcbankid']) && $params ['ebcbankid'] != '') {
            $sign .= "&ebcbankid=" . $params ['ebcbankid'];
        }
        if (isset($params ['bankcard']) && !is_null($params ['bankcard']) && $params ['bankcard'] != '') {
            $sign .= "&bankcard=" . $params ['bankcard'];
        }
        if (isset($params ['username']) && !is_null($params ['username']) && $params ['username'] != '') {
            $sign .= "&username=" . $params ['username'];
        }
        if (isset($params ['userbankcustom']) && !is_null($params ['userbankcustom']) && $params ['userbankcustom'] != '') {
            $sign .= "&userbankcustom=" . $params ['userbankcustom'];
        }
        if (isset($params ['address']) && !is_null($params ['address']) && $params ['address'] != '') {
            $sign .= "&address=" . $params ['address'];
        }
        if (isset($params ['cardtype']) && !is_null($params ['cardtype']) && $params ['cardtype'] != '') {
            $sign .= "&cardtype=" . $params ['cardtype'];
        }
        if (isset($params ['flag']) && !is_null($params ['flag']) && $params ['flag'] != '') {
            $sign .= "&flag=" . $params ['flag'];
        }
        if (isset($params ['app_code']) && !is_null($params ['app_code']) && $params ['app_code'] != '') {
            $sign .= "app_code=" . $params ['app_code'];
        }
        if (isset($params ['app_version']) && !is_null($params ['app_version']) && $params ['app_version'] != '') {
            $sign .= "app_version=" . $params ['app_version'];
        }
        if (isset($params ['service_code']) && !is_null($params ['service_code']) && $params ['service_code'] != '') {
            $sign .= "service_code=" . $params ['service_code'];
        }
        if (isset($params ['plat_form']) && !is_null($params ['plat_form']) && $params ['plat_form'] != '') {
            $sign .= "plat_form=" . $params ['plat_form'];
        }
        $des = new DES_JAVA($bonuse_key);

        $dstbdatasign = $des->encrypt($sign);

        return $dstbdatasign;
    }

    /**
     * 获取m2传输需要的数据
     * @param string $bonuse_key
     * @param array $params
     * @return string json
     */
    public function get_params($bonuse_key, $params)
    {
        $dstbdatasign = $this->get_dstbdatasign($bonuse_key, $params);

        $params ['dstbdatasign'] = $dstbdatasign;

        return json_encode($params);
    }

    /**
     * @param $bonuse_key
     * @param array $params
     * @param $return_sign
     * @return bool
     * @internal param string $dstbdatasign
     */
    function verify_sign($bonuse_key, $params, $return_sign)
    {
        $sign = "";
        if (isset($params ['dstbdata']) && !is_null($params ['dstbdata']) && $params ['dstbdata'] != '') {
            $sign = $params ['dstbdata'];
        }

        $des = new DES_JAVA($bonuse_key);

        $dstbdatasign = $des->encrypt($sign);

        return ($dstbdatasign == $return_sign);
    }
}