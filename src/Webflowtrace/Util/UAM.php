<?php
/**
 * PHP使用SOAP客户端认证
 * 调用webservice
 */
namespace Webflowtrace\Util;

use Silex\Application;

class UAM
{
    const UAMLoginUrl       = 'http://uam.corp.snda.com/Login.aspx';
    const PrivilegeService  = 'http://uam.corp.snda.com/Service/Privilege.asmx?WSDL';
    const LogService        = 'http://uam.corp.snda.com/Service/Log.asmx?WSDL';
    const EmailService      = 'http://uam.corp.snda.com/Service/EmailService.asmx';
    const SNDAUserService   = 'http://uam.corp.snda.com/Service/SNDAUserService.asmx';
    const UUIPServiceUrl    = 'http://uam.corp.snda.com/Service/UUIP/UUIP.asmx';
    const SMSServiceUrl     = 'http://uam.corp.snda.com/Service/SMS/SMS.asmx';
    private $SubSystemCode  = '0';
    private $EntranceCode   = '';
    private $Rtype          = 4;
    private $app;

    /**
     * @title 验证服务器的信息
     * @param  url
     */
    private function _soap ($url, $para, $mothed){
        $client = new \SoapClient($url);
        $response = $client->__Call($mothed, array(
            'parameters' => $para
        ));
        return $response;
    }

    /**
     * @title 设定用户接口
     * @param subSystemcode  系统子接口的信息
     * @param EntraceCode    系统跳转的接口
     * @param Rtype          跳转系统的类型
     * @return null
     */
    public function __construct($subSystemCode,$EntranceCode='',$Rtype = 4,Application $app = null){
        $this->SubSystemCode = $subSystemCode;
        $this->EntranceCode  = $EntranceCode;
        $this->Rtype         = $Rtype;
        $this->app = $app;
        date_default_timezone_set("PRC");
    }
    /**
     * 得到当前用户的URL
     */
    public function CurrentUrl (){
        return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }


    /** @title 得到用户的IP
     *  @param null
     *  @return String  返回客户端的IP
     * */
    private static function get_client_ip() {
        if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
            $ip = getenv ( "HTTP_CLIENT_IP" );
        else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
            $ip = getenv ( "HTTP_X_FORWARDED_FOR" );
        else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
            $ip = getenv ( "REMOTE_ADDR" );
        else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
            $ip = $_SERVER ['REMOTE_ADDR'];
        else
            $ip = "unknown";
        return ($ip);
    }


    /**
     * @title  判断是否已经经过UAM认证，若没有，则跳转到认证页面
     * @return null
     */
    public function RedirectToUamLogin()
    {
        header('location:' . self::UAMLoginUrl . '?entrancecode='
                   .$this->EntranceCode.'&SubSystemCode='
                   .$this->SubSystemCode . '&ReturnUrl='
                   .$this->CurrentUrl().'&Rtype='
                   .$this->Rtype);
        exit();
    }
    public function validate (){
        if (!isset($_GET['Ticket'])) {
            $this->RedirectToUamLogin();
        }
        $ticket = trim($_GET['Ticket']);
        $para = array(
            'ticket' => $ticket ,
            'subSystemCode' => $this->SubSystemCode ,
            'IPAddress' => self::get_client_ip()
        );
        $soap = $this->_soap(self::PrivilegeService, $para, 'Validate');
        $result = $soap->ValidateResult;

        if ($result->ExecuteStatu == 0) {
            $data = $result->Data;
            $this->app['session']->set("uaminfo",$data);
            return (array)$data;
        }else{
            $this->RedirectToUamLogin();
        }
        return FALSE;
    }


    /*  @title 若验证通过
     *  @params userid String   得到的USERID
     *  @return boolean 是否验证通过，则返回验证信息
     * */

    public function Authorize ($userid)
    {

        $para = array(
            'userID' => $userid , 'subSystemCode' => $this->SubSystemCode , 'IPAddress' => self::get_client_ip()
        );
        $response = $this->_soap(self::PrivilegeService, $para, 'Validate');
        $result = $response->ValidateResult;
        if ($result->ExecuteStatu == 0) {
            return array('ExecuteStatu'=>0,'Message'=>$result->Message);
        }
        return FALSE;
    }

    /*  @title 验证用户的权限
     *  @params String userid 用户的ID
     *  @params String userType  用户的类型
     *  @params String IPAddress 用户访问的IP地址
     * */
    public function AuthorizeWithUserType ($userID, $userType, $IPAddress)
    {
        $para = array(
            'userID' => $userID , 'userType' => $userType , 'subSystemCode' => $this->SubSystemCode , 'IPAddress' => $IPAddress
        );
        $response = $this->_soap(self::PrivilegeService, $para, 'AuthorizeWithUserType');

        $result = $response->AuthorizeWithUserTypeResult;
        if ($result->ExecuteStatu == 0) {

            return array('ExecuteStatu'=>0,'Message'=>$result->Message);
        }
        return FALSE;
    }
    /*  @title  写入警告信息
     *  @params String userid   用户的ID
     *  @params String usertype 用户类型
     *  @params String ipaddr  用户IP地址
     *  @params String warnningID   警告ID
     *  @params String warningMSG  方法
     *
     * */
    public function WarningWithUserType ($userid, $usertype, $ipaddr, $warningID, $warningMsg){
        $para = array(
            'userid' => $userid , 'usertype' => $usertype , 'ipaddr' => $ipaddr , 'appcode' => $this->SubSystemCode , 'warningID' => $warningID , 'warningMsg' => $warningMsg
        );
        $this->_soap(self::LogService, $para, 'WarningWithUserType');
    }
    public function WriteLogWithUserType ($userid, $usertype, $ipaddr, $content, $loglevel, $operateid){
        $para = array(
            'userid' => $userid , 'usertype' => $usertype , 'ipaddr' => $ipaddr , 'content' => $content , 'appcode' => $this->SubSystemCode , 'loglevel' => intval($loglevel) , 'operateid' => intval($operateid)
        );
        $this->_soap(self::LogService, $para, 'WriteLogWithUserType');
    }

    public function WriteLogWithWarning ($userid, $usertype, $ipaddr, $content, $loglevel, $operateid, $warningID, $warningMsg){
        $para = array(
            'userid' => $userid , 'usertype' => $usertype , 'ipaddr' => $ipaddr , 'content' => $content , 'appcode' => $this->SubSystemCode , 'loglevel' => intval($loglevel) , 'operateid' => intval($operateid) , 'warningID' => intval($warningID) , 'warningMsg' => $warningMsg
        );
        $this->_soap(self::LogService, $para, 'WriteLogWithWarning');
    }

    public function __destruct (){
    }
}

/*
示例:
$uam = new UAM(503,3,4);
$uam->validate();
 */



