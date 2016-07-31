<?php
class Guess
{
    private $appid = 'wx7eb470b5b3f72020';
    private $apsecret = 'cb51f63f5939469cd974c50364c1863e';
    private $redirect_url = 'http://fy913m.cn/wordpress/wp-content/plugins/wechat-subscribers-lite/guess.php';
//define('APPID','wx7eb470b5b3f72020');
//define('APSECRET','cb51f63f5939469cd974c50364c1863e');
//define('REDIRECT_URI','http://fy913m.cn/wordpress/wp-content/plugins/wechat-subscribers-lite/guess.php');

    function get_info()
    {
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->appid . "&redirect_uri=".$this->redirect_url."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        //echo $url;

        header('Location: '.$url);

//        $auto = file_get_contents($url);
//
//        var_dump($auto);
    }

}

$guess = new Guess();
$guess->get_info();

