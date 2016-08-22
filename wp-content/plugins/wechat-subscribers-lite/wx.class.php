<?php

/**
 * WeChat Interface for WeChat Subscribers Lite
 */
class WXTest
{

    private $token;
    private $data;
    private $appid;
    private $appsecret;

    public function __construct($_token, $_data = null)
    {
        $this->appid = 'wx967f6267a1c8d081';
        $this->appsecret = 'eba965182e56a5f9d0d8ae0708ba8529';

        $this->token = $_token;
        if ($_data != null) {
            $this->load($_data);
        }
    }

    private function accessErrCode()
    {
        return ['-1' => '系统繁忙，此时请开发者稍候再试'
            , '0' => '请求成功'
            , '40001' => '获取access_token时AppSecret错误，或者access_token无效。请开发者认真比对AppSecret的正确性，或查看是否正在为恰当的公众号调用接口'
            , '40002' => '不合法的凭证类型'
            , '40003' => '不合法的OpenID，请开发者确认OpenID（该用户）是否已关注公众号，或是否是其他公众号的OpenID'
            , '40004' => '不合法的媒体文件类型'
            , '40005' => '不合法的文件类型'
            , '40006' => '不合法的文件大小'
            , '40007' => '不合法的媒体文件id'
            , '40008' => '不合法的消息类型'
            , '40009' => '不合法的图片文件大小'
            , '40010' => '不合法的语音文件大小'
            , '40011' => '不合法的视频文件大小'
            , '40012' => '不合法的缩略图文件大小'
            , '40013' => '不合法的AppID，请开发者检查AppID的正确性，避免异常字符，注意大小写'
            , '40014' => '不合法的access_token，请开发者认真比对access_token的有效性（如是否过期），或查看是否正在为恰当的公众号调用接口'
            , '40015' => '不合法的菜单类型'
            , '40016' => '不合法的按钮个数'
            , '40017' => '不合法的按钮个数'
            , '40018' => '不合法的按钮名字长度'
            , '40019' => '不合法的按钮KEY长度'
            , '40020' => '不合法的按钮URL长度'
            , '40021' => '不合法的菜单版本号'
            , '40022' => '不合法的子菜单级数'
            , '40023' => '不合法的子菜单按钮个数'
            , '40024' => '不合法的子菜单按钮类型'
            , '40025' => '不合法的子菜单按钮名字长度'
            , '40026' => '不合法的子菜单按钮KEY长度'
            , '40027' => '不合法的子菜单按钮URL长度'
            , '40028' => '不合法的自定义菜单使用用户'
            , '40029' => '不合法的oauth_code'
            , '40030' => '不合法的refresh_token'
            , '40031' => '不合法的openid列表'
            , '40032' => '不合法的openid列表长度'
            , '40033' => '不合法的请求字符，不能包含\uxxxx格式的字符'
            , '40035' => '不合法的参数'
            , '40038' => '不合法的请求格式'
            , '40039' => '不合法的URL长度'
            , '40050' => '不合法的分组id'
            , '40051' => '分组名字不合法'
            , '40117' => '分组名字不合法'
            , '40118' => 'media_id大小不合法'
            , '40119' => 'button类型错误'
            , '40120' => 'button类型错误'
            , '40121' => '不合法的media_id类型'
            , '40132' => '微信号不合法'
            , '40137' => '不支持的图片格式'
            , '41001' => '缺少access_token参数'
            , '41002' => '缺少appid参数'
            , '41003' => '缺少refresh_token参数'
            , '41004' => '缺少secret参数'
            , '41005' => '缺少多媒体文件数据'
            , '41006' => '缺少media_id参数'
            , '41007' => '缺少子菜单数据'
            , '41008' => '缺少oauth code'
            , '41009' => '缺少openid'
            , '42001' => 'access_token超时，请检查access_token的有效期，请参考基础支持-获取access_token中，对access_token的详细机制说明'
            , '42002' => 'refresh_token超时'
            , '42003' => 'oauth_code超时'
            , '43001' => '需要GET请求'
            , '43002' => '需要POST请求'
            , '43003' => '需要HTTPS请求'
            , '43004' => '需要接收者关注'
            , '43005' => '需要好友关系'
            , '44001' => '多媒体文件为空'
            , '44002' => 'POST的数据包为空'
            , '44003' => '图文消息内容为空'
            , '44004' => '文本消息内容为空'
            , '45001' => '多媒体文件大小超过限制'
            , '45002' => '消息内容超过限制'
            , '45003' => '标题字段超过限制'
            , '45004' => '描述字段超过限制'
            , '45005' => '链接字段超过限制'
            , '45006' => '图片链接字段超过限制'
            , '45007' => '语音播放时间超过限制'
            , '45008' => '图文消息超过限制'
            , '45009' => '接口调用超过限制'
            , '45010' => '创建菜单个数超过限制'
            , '45015' => '回复时间超过限制'
            , '45016' => '系统分组，不允许修改'
            , '45017' => '分组名字过长'
            , '45018' => '分组数量超过上限'
            , '46001' => '不存在媒体数据'
            , '46002' => '不存在的菜单版本'
            , '46003' => '不存在的菜单数据'
            , '46004' => '不存在的用户'
            , '47001' => '解析JSON/XML内容错误'
            , '48001' => 'api功能未授权，请确认公众号已获得该接口，可以在公众平台官网-开发者中心页中查看接口权限'
            , '50001' => '用户未授权该api'
            , '50002' => '用户受限，可能是违规后接口被封禁'
            , '61451' => '参数错误(invalid parameter)'
            , '61452' => '无效客服账号(invalid kf_account)'
            , '61453' => '客服帐号已存在(kf_account exsited)'
            , '61454' => '客服帐号名长度超过限制(仅允许10个英文字符，不包括@及@后的公众号的微信号)(invalid kf_acount length)'
            , '61455' => '客服帐号名包含非法字符(仅允许英文+数字)(illegal character in kf_account)'
            , '61456' => '客服帐号个数超过限制(10个客服账号)(kf_account count exceeded)'
            , '61457' => '无效头像文件类型(invalid file type)'
            , '61450' => '系统错误(system error)'
            , '61500' => '日期格式错误'
            , '61501' => '日期范围错误'
            , '9001001' => 'POST数据参数不合法'
            , '9001002' => '远端服务不可用'
            , '9001003' => 'Ticket不合法'
            , '9001004' => '获取摇周边用户信息失败'
            , '9001005' => '获取商户信息失败'
            , '9001006' => '获取OpenID失败'
            , '9001007' => '上传文件缺失'
            , '9001008' => '上传素材的文件类型不合法'
            , '9001009' => '上传素材的文件尺寸不合法'
            , '9001010' => '上传失败'
            , '9001020' => '帐号不合法'
            , '9001021' => '已有设备激活率低于50%，不能新增设备'
            , '9001022' => '设备申请数不合法，必须为大于0的数字'
            , '9001023' => '已存在审核中的设备ID申请'
            , '9001024' => '一次查询设备ID数量不能超过50'
            , '9001025' => '设备ID不合法'
            , '9001026' => '页面ID不合法'
            , '9001027' => '页面参数不合法'
            , '9001028' => '一次删除页面ID数量不能超过10'
            , '9001029' => '页面已应用在设备中，请先解除应用关系再删除'
            , '9001030' => '一次查询页面ID数量不能超过50'
            , '9001031' => '时间区间不合法'
            , '9001032' => '保存设备与页面的绑定关系参数错误'
            , '9001033' => '门店ID不合法'
            , '9001034' => '设备备注信息过长'
            , '9001035' => '设备申请参数不合法'
            , '9001036' => '查询起始值begin不合法'];
    }

    /**
     * 返回access_token
     * @param string $appid
     * @param string $appsecret
     * @return mixed
     */
    public function getAccessToken($appid = '', $appsecret = '')
    {
        $appid = $appid?:$this->appid;
        $appsecret = $appsecret?:$this->appsecret;

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";

        //{"access_token":"ACCESS_TOKEN","expires_in":7200}
        //{"errcode":40013,"errmsg":"invalid appid"}
        $json = file_get_contents($url);
        $arr = json_decode($json);

        if ($arr and $arr->access_token) {
            //TODO
            return $arr->access_token;
        }elseif($arr->errcode){
            echo $this->accessErrCode()[$arr->errcode];
        }else{
            echo '网络error';
        }
        exit;
        //header('Location: '. $url);
    }

    /**
     * 自定义菜单
     * @param $menujson json字符串
     */
    public function createMenu($menujson){
        //$post_data = stripslashes($post_data);

        $access_token = $this->getAccessToken();

        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $menujson);
        $output = curl_exec($ch);
        curl_close($ch);
        //打印获得的数据
        $output = json_decode($output);
        if($output->errcode){
            echo '失败';
            exit;
        }
    }



    //==================== old ===================================//

    public function load($_data)
    {
        $this->data = $_data;
    }

    public function valid()
    {
        if (isset($_GET["echostr"])) {
            $echoStr = $_GET["echostr"];
        }
        //valid signature , option
        if ($this->checkSignature()) {
            if (isset($echoStr) && $echoStr != '') {
                echo $echoStr;
                exit;
            }
            return true;
        } else {
            return false;
        }
    }

    public function responseMsg($_data = null)
    {
        if ($_data != null) {
            $this->load($_data);
        }

        //get post data, May be due to the different environments
        if (IS_DEBUG) {
            $postStr = "<xml>
    						<ToUserName><![CDATA[toUser]]></ToUserName>
    						<FromUserName><![CDATA[fromUser]]></FromUserName>
    						<CreateTime>1348831860</CreateTime>
    						<MsgType><![CDATA[text]]></MsgType>
    						<Content><![CDATA[testsearch]]></Content>
    						<MsgId>1234567890123456</MsgId>
    						</xml>";
        } else {
            $postStr = file_get_contents('php://input');
        }

        //extract post data
        if (!empty($postStr) && $this->checkSignature() && isset($this->data)) {

            $postObj = simplexml_load_string($postStr,
                'SimpleXMLElement',
                LIBXML_NOCDATA);
            $msgType = $postObj->MsgType;

            if ($msgType == 'event') {
                $msg = $this->eventRespon($postObj);
            } else {
                $msg = $this->sendAutoReply($postObj);
            }

            echo $msg;

        } else {
            echo "";
            exit;
        }
    }

    private function saveKeyWord($fromUsername, $keyword, $match)
    {
        $messageRow = array("openid" => $fromUsername,
            "keyword" => $keyword,
            "is_match" => $match,
            "time" => current_time("Y-m-d H:i:s", 0));
        global $wpdb;
        $rows_affected = $wpdb->insert(DB_TABLE_WPWSL_HISTORY, $messageRow);
    }


    private function sendAutoReply($postObj)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $topic_keyword = '';
        $resultStr = '';

        $is_match = false;
        if ($keyword != '') {
            if (substr_count($keyword, '#') == 1) {
                $keyword = "#" . $keyword;
            }
            if (preg_match("/(#.*?#)/i", $keyword, $re) !== false) {
                $topic_keyword = $re[1] ? strtolower($re[1]) : '';
            }
            $keyword = strtolower($keyword);

            foreach ($this->data as $d) {
                if ($d->trigger == 'default' || $d->trigger == 'subscribe') {
                    continue;
                }
                $curr_key = $d->key;
                foreach ($curr_key as $k) {
                    $_k = strtolower(trim($k));
                    if ($keyword == $_k || $topic_keyword == $_k) {
                        $is_match = true;
                    }
                }
                if ($is_match) {
                    $resultStr = $this->get_msg_by_type($d, $fromUsername, $toUsername);
                    break;
                }
            }
        }
        $match = $is_match ? "y" : "n";
        if (!$is_match) {
            foreach ($this->data as $d) {
                if ($d->trigger == 'default') {
                    $d->key[0] = $keyword;
                    $resultStr = $this->get_msg_by_type($d, $fromUsername, $toUsername);
                    break;
                }
            }
        }
        $this->saveKeyWord($fromUsername, $keyword, $match);
        return $resultStr;
    }


    private function eventRespon($postObj)
    {

        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $eventType = $postObj->Event;
        $resultStr = '';

        foreach ($this->data as $d) {
            if ($d->trigger == $eventType) {
                $resultStr = $this->get_msg_by_type($d, $fromUsername, $toUsername);
                break;
            }
        }

        return $resultStr;
    }

    private function parseurl($url = "")
    {
        $url = rawurlencode($url);
        $a = array("%3A", "%2F", "%40");
        $b = array(":", "/", "@");
        $url = str_replace($a, $b, $url);
        return $url;
    }

    private function get_msg_by_type($d, $fromUsername, $toUsername)
    {
        switch ($d->type) {
            case "news":
                $resultStr = $this->sendPhMsg($fromUsername, $toUsername, $d->phmsg);
                break;
            case "recent":
                $messages = $this->getRecentlyPosts($d->remsg);
                $resultStr = $this->sendMsgBase($fromUsername, $toUsername, $messages);
                break;
            case "random":
                $messages = $this->getRandomPosts($d->remsg);
                $resultStr = $this->sendMsgBase($fromUsername, $toUsername, $messages);
                break;
            case "search":
                $messages = $this->getSearchPosts($d->key[0], $d->remsg);
                $resultStr = $this->sendMsgBase($fromUsername, $toUsername, $messages);
                break;
            default: //text
                $resultStr = $this->sendMsg($fromUsername, $toUsername, $d->msg);
        }

        return $resultStr;
    }

    private function sendMsg($fromUsername, $toUsername, $contentData)
    {

        if ($contentData == '') {
            return '';
        }

        $textTpl = "<xml>
          			<ToUserName><![CDATA[%s]]></ToUserName>
          			<FromUserName><![CDATA[%s]]></FromUserName>
          			<CreateTime>%s</CreateTime>
          			<MsgType><![CDATA[%s]]></MsgType>
          			<Content><![CDATA[%s]]></Content>
          			<FuncFlag>0</FuncFlag>
          			</xml>";

        $msgType = "text";
        $time = time();
        $resultStr = sprintf($textTpl,
            $fromUsername,
            $toUsername,
            $time,
            $msgType,
            $contentData);
        return $resultStr;
    }

    private function sendPhMsg($fromUsername, $toUsername, $contentData)
    {
        if ($contentData == '') {
            return '';
        }

        $headerTpl = "<ToUserName><![CDATA[%s]]></ToUserName>
        	        <FromUserName><![CDATA[%s]]></FromUserName>
        	        <CreateTime>%s</CreateTime>
        	        <MsgType><![CDATA[%s]]></MsgType>
        	        <ArticleCount>%s</ArticleCount>";

        $itemTpl = "<item>
      					<Title><![CDATA[%s]]></Title>
      					<Description><![CDATA[%s]]></Description>
      					<PicUrl><![CDATA[%s]]></PicUrl>
      					<Url><![CDATA[%s]]></Url>
      					</item>";

        $itemStr = "";
        $mediaCount = 0;
        foreach ($contentData as $mediaObject) {
            $title = $mediaObject->title;
            $des = $mediaObject->des;
            $media = $this->parseurl($mediaObject->pic);
            $url = $mediaObject->url;
            $itemStr .= sprintf($itemTpl, $title, $des, $media, $url);
            $mediaCount++;
        }

        $msgType = "news";
        $time = time();
        $headerStr = sprintf($headerTpl,
            $fromUsername,
            $toUsername,
            $time,
            $msgType,
            $mediaCount);

        $resultStr = "<xml>" . $headerStr . "<Articles>" . $itemStr . "</Articles></xml>";

        return $resultStr;
    }

    private function getSearchPosts($keyword, $contentData = null)
    {
        if (!$contentData) return null;
        $re_type = isset($contentData['type']) ? $contentData['type'] : "";
        $re_cate = isset($contentData['cate']) ? $contentData['cate'] : "";
        $re_count = isset($contentData['count']) ? $contentData['count'] : 6;
        $args = array(
            'posts_per_page' => $re_count,
            'orderby' => 'post_date',
            'order' => 'desc',
            'ignore_sticky_posts' => 1,
        );
        if ($re_type != "") {
            $args['post_type'] = $re_type;
            if ($re_type == "post" && $re_cate != "") {
                $args['category'] = $re_cate;
            }
        } else {
            $args['post_type'] = 'any';
        }
        $args['post_status'] = "publish";

        $args['posts_per_page'] = $re_count;
        $args['s'] = $keyword;
        $posts = get_posts($args);
        return $posts;
    }

    private function getRandomPosts($contentData = null)
    {
        if (!$contentData) return null;
        $re_type = isset($contentData['type']) ? $contentData['type'] : "";
        $re_cate = isset($contentData['cate']) ? $contentData['cate'] : "";
        $re_count = isset($contentData['count']) ? $contentData['count'] : 6;
        $args = array(
            'posts_per_page' => $re_count,
            'orderby' => 'rand',
        );
        if ($re_type != "") {
            $args['post_type'] = $re_type;
            if ($re_type == "post" && $re_cate != "") {
                $args['category'] = $re_cate;
            }
        } else {
            $args['post_type'] = 'any';
        }
        $args['post_status'] = "publish";

        $posts = get_posts($args);
        return $posts;
    }

    private function getRecentlyPosts($contentData = null)
    {
        if (!$contentData) return null;
        $re_type = isset($contentData['type']) ? $contentData['type'] : "";
        $re_cate = isset($contentData['cate']) ? $contentData['cate'] : "";
        $re_count = isset($contentData['count']) ? $contentData['count'] : 6;
        $args = array(
            'posts_per_page' => $re_count,
            'orderby' => 'post_date',
            'order' => 'desc',
        );
        if ($re_type != "") {
            $args['post_type'] = $re_type;
            if ($re_type == "post" && $re_cate != "") {
                $args['category'] = $re_cate;
            }
        } else {
            $args['post_type'] = 'any';
        }
        $args['post_status'] = "publish";

        $posts = get_posts($args);
        return $posts;
    }

    private function getImgsSrcInPost($post_id = null,
                                      $post_content = '',
                                      $i = 1,
                                      $type = '',
                                      $post_excerpt = '')
    {

        $imageSize = $i == 1 ? "sup_wechat_big" : "sup_wechat_small";
        $text = "";
        $rimg = WPWSL_PLUGIN_URL . "/img/" . $imageSize . ".png";

        $setting_opts = get_option(WPWSL_SETTINGS_OPTION);

        if (isset($setting_opts[$imageSize]) && $setting_opts[$imageSize] != '') {
            $rimg = $setting_opts[$imageSize];
        }

        if ($type == "attachment") {
            $tmp_img_obj = wp_get_attachment_image_src($post_id, $imageSize);
            $rimg = $tmp_img_obj[0];
        } else {
            if (get_the_post_thumbnail($post_id) != '') {
                $_tmp_id = get_post_thumbnail_id($post_id);
                $tmp_img_obj = wp_get_attachment_image_src($_tmp_id,
                    $imageSize);
                $rimg = $tmp_img_obj[0];
            } else {
                $attachments = get_posts(array(
                    'post_type' => 'attachment',
                    'posts_per_page' => -1,
                    'post_parent' => $post_id,
                    'exclude' => get_post_thumbnail_id($post_id)
                ));
                if (count($attachments) > 0) {
                    $tmp_img_obj = wp_get_attachment_image_src($attachments[0]->ID,
                        $imageSize);
                    $rimg = $tmp_img_obj[0];
                }
            }
        }
        if (trim($post_excerpt) != "") {
            $text = trim_words($post_excerpt, SYNC_EXCERPT_LIMIT);
        } else if (trim($post_content != "")) {
            $text = trim_words($post_content, SYNC_EXCERPT_LIMIT);
        }
        $result = array("src" => $rimg, "text" => $text);
        return $result;
    }

    private function sendMsgBase($fromUsername, $toUsername, $messages)
    {
        if (count($messages) > 0) {
            $headerTpl = "<ToUserName><![CDATA[%s]]></ToUserName>
      			        <FromUserName><![CDATA[%s]]></FromUserName>
      			        <CreateTime>%s</CreateTime>
      			        <MsgType><![CDATA[%s]]></MsgType>
      			        <ArticleCount>%s</ArticleCount>";

            $itemTpl = "<item>
        					<Title><![CDATA[%s]]></Title>
        					<Description><![CDATA[%s]]></Description>
        					<PicUrl><![CDATA[%s]]></PicUrl>
        					<Url><![CDATA[%s]]></Url>
        					</item>";

            $itemStr = "";
            $mediaCount = 0;
            $i = 1;
            foreach ($messages as $mediaObject) {
                $src_and_text = $this->getImgsSrcInPost($mediaObject->ID,
                    $mediaObject->post_content,
                    $i,
                    $contentData['type'],
                    $mediaObject->post_excerpt);

                $title = trim_words($mediaObject->post_title, SYNC_TITLE_LIMIT);
                $des = $src_and_text['text'];  // strip_tags or not
                $media = $this->parseurl($src_and_text['src']);
                if ($contentData['type'] == "attachment") {
                    $url = home_url('/?attachment_id=' . $mediaObject->ID);
                } else {
                    $url = html_entity_decode(get_permalink($mediaObject->ID));
                }

                $itemStr .= sprintf($itemTpl, $title, $des, $media, $url);
                $mediaCount++;
                $i++;
            }

            $msgType = "news";
            $time = time();
            $headerStr = sprintf($headerTpl,
                $fromUsername,
                $toUsername,
                $time,
                $msgType,
                $mediaCount);

            $resultStr = "<xml>" . $headerStr . "<Articles>" . $itemStr . "</Articles></xml>";

        } else {
            $textTpl = "<xml>
        					<ToUserName><![CDATA[%s]]></ToUserName>
        					<FromUserName><![CDATA[%s]]></FromUserName>
        					<CreateTime>%s</CreateTime>
        					<MsgType><![CDATA[%s]]></MsgType>
        					<Content><![CDATA[%s]]></Content>
        					<FuncFlag>0</FuncFlag>
        					</xml>";

            $msgType = "text";
            $time = time();
            $no_result = __('Sorry! No result.', 'WPWSL');
            $resultStr = sprintf($textTpl,
                $fromUsername,
                $toUsername,
                $time,
                $msgType,
                $no_result);
        }
        return $resultStr;
    }

    private function checkSignature()
    {
        if (IS_DEBUG) {
            return true;
        }
        $signature = isset($_GET["signature"]) ? $_GET["signature"] : '';
        $timestamp = isset($_GET["timestamp"]) ? $_GET["timestamp"] : '';
        $nonce = isset($_GET["nonce"]) ? $_GET["nonce"] : '';

        $token = $this->token;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
}

function get_data()
{
    $args = array(
        'post_type' => 'wpwsl_template',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'post_status' => 'publish',
        'order' => 'DESC'
    );

    $raw = get_posts($args);

    $data = array();

    foreach ($raw as $p) {

        $_gp = get_post_meta($p->ID, '_phmsg_item');
        $phmsg_group = array();

        foreach ($_gp as $_item) {
            $_tmp_item = json_decode($_item);

            $_tmp_item->title = urldecode($_tmp_item->title);
            $_tmp_item->pic = urldecode($_tmp_item->pic);
            $_tmp_item->des = urldecode($_tmp_item->des);
            $_tmp_item->url = urldecode($_tmp_item->url);

            $phmsg_group[] = $_tmp_item;
        }
        $tmp_key = trim(get_post_meta($p->ID, '_keyword', TRUE));
        $array_key = explode(',', $tmp_key);


        $tmp_msg = new stdClass();

        $tmp_msg->title = $p->post_title;
        $tmp_msg->type = get_post_meta($p->ID, '_type', TRUE);
        $tmp_msg->key = $array_key;
        $tmp_msg->trigger = get_post_meta($p->ID, '_trigger', TRUE);
        $tmp_msg->msg = get_post_meta($p->ID, '_content', TRUE);
        $tmp_msg->phmsg = $phmsg_group;

        //response source
        $tmp_msg->remsg = array(
            "type" => get_post_meta($p->ID, '_re_type', TRUE),
            "cate" => get_post_meta($p->ID, '_re_cate', TRUE),
            "count" => get_post_meta($p->ID, '_re_count', TRUE)
        );

        $data[] = $tmp_msg;
    }
    return $data;
}

