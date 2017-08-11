<?php
/**
 * Created by PhpStorm.
 * User: masaka9
 * Date: 2017/8/11
 * Time: 下午12:28
 */

namespace GomePay;

class Config
{
    private $tid;               // 端口ID
    private $api_id;            //
    private $api_server_code;   // 服务编码+@+"接口编码"
    private $debug;             // 是否调试模式
    private $url;               // 10步模式接口地址
    private $mode;              // mode:模式，可选项（默认：0，0=10步模式；1=4步模式），使用4步模式时打开注释
    private $url_ac;            // 4步模式的M2服务地址，4步模式时必填项。
    private $url_ac_token;      // 4步模式的得到访问令牌的M2服务地址，4步模式时必填项。
    private $max_token;         // 获取令牌最大次数
    private $is_data_sign;      // 是否对数据包执行签名 1是  0否
    private $memcache_open;     // 是否使用memcache
    private $memcached_server;  // memcache地址

    private $aid;               // 应用ID
    private $key;               // 密钥
    private $bonuse_merchno;    // 钱包商户号
    private $bonuse_key;        // 钱包密钥

    private $wallet_id;                 // 付款钱包id
    private $asset_id;                  // 付款资产id

    private $app_code;                  // app_code
    private $app_version;               // service_code
    private $service_code;              // 版本
    private $plat_form;                 // 平台

    private $password_type;             // 密码类型
    private $encrypt_type;              // 加密类型
    private $customer_type;             // 收款人客户类型
    private $currency;                  // 币种
    private $asset_type_code;           //
    private $account_type_code;         //

    public function __construct($aid, $key, $bonuse_merchno, $bonuse_key,
                                $wallet_id, $asset_id,
                                $app_code, $app_version, $service_code, $plat_form)
    {
        $this->tid = '';
        $this->api_id = ['DP_SERVICE' => 'epay_api_deal@agent_for_paying', 'login_token' => 'epay_api_security@company_login'];
        $this->api_server_code = '';
        $this->debug = false;
        $this->url = 'https://api.gomepay.com/CoreServlet';
        $this->mode = '1';
        $this->url_ac = 'https://api.gomepay.com/CoreServlet';
        $this->url_ac_token = 'https://api.gomepay.com/access_token';
        $this->max_token = 2;
        $this->is_data_sign = '0';
        $this->memcache_open = false;
        $this->memcached_server = '127.0.0.1:11211';

        $this->password_type = '02';
        $this->encrypt_type = '02';
        $this->customer_type = '01';
        $this->currency = 'CNY';
        $this->asset_type_code = '000002';
        $this->account_type_code = '01';

        $this->aid = $aid;
        $this->key = $key;
        $this->bonuse_merchno = $bonuse_merchno;
        $this->bonuse_key = $bonuse_key;

        $this->wallet_id = $wallet_id;
        $this->asset_id = $asset_id;

        $this->app_code = $app_code;
        $this->app_version = $app_version;
        $this->service_code = $service_code;
        $this->plat_form = $plat_form;

    }

    public function get_m_arr()
    {
        return [
            'aid' => $this->aid,    //
            'tid' => $this->tid,
            'key' => $this->key,    //
            'api_id' => $this->api_id,
            'bonuse_merchno' => $this->bonuse_merchno,  //
            'bonuse_key' => $this->bonuse_key,          //
            'api_server_code' => $this->api_server_code,
            'nonce' => rand(000000, 999999),
            'debug' => $this->debug,
            'url' => $this->url,
            'mode' => $this->mode,
            'url_ac' => $this->url_ac,
            'url_ac_token' => $this->url_ac_token,
            'max_token' => $this->max_token,
            'is_data_sign' => $this->is_data_sign,
            'memcache_open' => $this->memcache_open,
            'memcached_server' => $this->memcached_server,
        ];
    }

    public function agent_pay_data($order_number, $pay_password, $customer_name, $account_number, $amount, $req_no, $async_notification_addr)
    {
        return [
            'merchant_number' => $this->bonuse_merchno,
            'order_number' => $order_number,
            'wallet_id' => $this->wallet_id,
            'asset_id' => $this->asset_id,
            'password_type' => $this->password_type,
            'encrypt_type' => $this->encrypt_type,
            'pay_password' => $pay_password,
            'customer_type' => $this->customer_type,
            'customer_name' => $customer_name,
            'account_number' => $account_number,
            'currency' => $this->currency,
            'amount' => $amount,
            'asset_type_code' => $this->asset_type_code,
            'account_type_code' => $this->account_type_code,

            'app_code' => $this->app_code,
            'app_version' => $this->app_version,
            'service_code' => $this->service_code,
            'plat_form' => $this->plat_form,
            'login_token' => '',
            'req_no' => $req_no,
            'async_notification_addr' => $async_notification_addr
        ];
    }

    /**
     * @param string $tid
     */
    public function setTid(string $tid)
    {
        $this->tid = $tid;
    }

    /**
     * @param array $api_id
     */
    public function setApiId(array $api_id)
    {
        $this->api_id = $api_id;
    }

    /**
     * @param string $api_server_code
     */
    public function setApiServerCode(string $api_server_code)
    {
        $this->api_server_code = $api_server_code;
    }

    /**
     * @param bool $debug
     */
    public function setDebug(bool $debug)
    {
        $this->debug = $debug;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @param string $mode
     */
    public function setMode(string $mode)
    {
        $this->mode = $mode;
    }

    /**
     * @param string $url_ac
     */
    public function setUrlAc(string $url_ac)
    {
        $this->url_ac = $url_ac;
    }

    /**
     * @param string $url_ac_token
     */
    public function setUrlAcToken(string $url_ac_token)
    {
        $this->url_ac_token = $url_ac_token;
    }

    /**
     * @param int $max_token
     */
    public function setMaxToken(int $max_token)
    {
        $this->max_token = $max_token;
    }

    /**
     * @param string $is_data_sign
     */
    public function setIsDataSign(string $is_data_sign)
    {
        $this->is_data_sign = $is_data_sign;
    }

    /**
     * @param bool $memcache_open
     */
    public function setMemcacheOpen(bool $memcache_open)
    {
        $this->memcache_open = $memcache_open;
    }

    /**
     * @param string $memcached_server
     */
    public function setMemcachedServer(string $memcached_server)
    {
        $this->memcached_server = $memcached_server;
    }

    /**
     * @param mixed $aid
     */
    public function setAid($aid)
    {
        $this->aid = $aid;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @param mixed $bonuse_merchno
     */
    public function setBonuseMerchno($bonuse_merchno)
    {
        $this->bonuse_merchno = $bonuse_merchno;
    }

    /**
     * @param mixed $bonuse_key
     */
    public function setBonuseKey($bonuse_key)
    {
        $this->bonuse_key = $bonuse_key;
    }

    /**
     * @param mixed $wallet_id
     */
    public function setWalletId($wallet_id)
    {
        $this->wallet_id = $wallet_id;
    }

    /**
     * @param mixed $asset_id
     */
    public function setAssetId($asset_id)
    {
        $this->asset_id = $asset_id;
    }

    /**
     * @param mixed $app_code
     */
    public function setAppCode($app_code)
    {
        $this->app_code = $app_code;
    }

    /**
     * @param mixed $app_version
     */
    public function setAppVersion($app_version)
    {
        $this->app_version = $app_version;
    }

    /**
     * @param mixed $service_code
     */
    public function setServiceCode($service_code)
    {
        $this->service_code = $service_code;
    }

    /**
     * @param mixed $plat_form
     */
    public function setPlatForm($plat_form)
    {
        $this->plat_form = $plat_form;
    }

    /**
     * @param string $password_type
     */
    public function setPasswordType(string $password_type)
    {
        $this->password_type = $password_type;
    }

    /**
     * @param string $encrypt_type
     */
    public function setEncryptType(string $encrypt_type)
    {
        $this->encrypt_type = $encrypt_type;
    }

    /**
     * @param string $customer_type
     */
    public function setCustomerType(string $customer_type)
    {
        $this->customer_type = $customer_type;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @param string $asset_type_code
     */
    public function setAssetTypeCode(string $asset_type_code)
    {
        $this->asset_type_code = $asset_type_code;
    }

    /**
     * @param string $account_type_code
     */
    public function setAccountTypeCode(string $account_type_code)
    {
        $this->account_type_code = $account_type_code;
    }

}