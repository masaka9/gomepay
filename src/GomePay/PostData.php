<?php
/**
 * Created by PhpStorm.
 * User: masaka9
 * Date: 2017/8/11
 * Time: 下午3:28
 */

namespace GomePay;


class PostData
{
    private $merchant_number;           // 商户号
    private $order_number;              // 商户订单号
    private $wallet_id;                 // 付款钱包id
    private $asset_id;                  // 付款资产id
    private $password_type;             // 密码类型
    private $encrypt_type;              // 加密类型
    private $pay_password;              // 支付密码
    private $customer_type;             // 收款人客户类型
    private $customer_name;             // 收款客户姓名
    private $account_number;            // 收款人银行卡
    private $currency;                  // 币种
    private $amount;                    // 订单金额
    private $asset_type_code;           //
    private $account_type_code;         //
    private $app_code;                  //
    private $app_version;               //
    private $service_code;              //
    private $plat_form;                 //
    private $login_token;               //
    private $req_no;                    //
    private $async_notification_addr;   // 异步回调地址

    public function __construct($merchant_number, )
    {
    }

    public function get_post_data()
    {

    }


}