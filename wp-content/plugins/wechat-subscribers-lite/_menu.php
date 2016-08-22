<?php
/*
 * Settings Page, It's required by WPWSLGeneral Class only.
 *
 */
$options=get_option(WPWSL_SETTINGS_OPTION);
global $token;
$token=isset($options['token'])?$options['token']:'';


require_once( 'class-wpwsl-list-table.php' );
require_once( 'wx.class.php' );

if(isset($_GET['action']) && isset($_GET['action2'])){
	if($_GET['action']=='delete' || $_GET['action2']=='delete'){
		if(isset($_GET['tpl'])){
	        foreach($_GET['tpl'] as $tpl){
	        	delete_template($tpl);
	        }
        }
	}
}
if(isset($_GET['delete'])){
	delete_template($_GET['delete']);
}

function delete_template($id){
	if(!is_wp_error(get_post($id))){
		wp_delete_post($id,true);
	}
}

$args = array(
		'post_type' => 'wpwsl_template',
		'posts_per_page' => -1,
		'orderby' => 'post_date',
		'post_status' => 'any',
		'order'=> 'ASC'
);

$raw=get_posts($args);

$weixin_menu = ($_POST['weixin_menu']);




$post_data = $weixin_menu;
if($post_data){

    $post_data = stripslashes($post_data);

    $wx = new WXTest($token);

    $access_token = $wx->getAccessToken();

    $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // post数据
    curl_setopt($ch, CURLOPT_POST, 1);
    // post的变量
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $output = curl_exec($ch);
    curl_close($ch);
    //打印获得的数据
    $output = json_decode($output);
    if($output->errcode){
        echo '失败';
        exit;
    }


}



$all_keys=array();
foreach($raw as $e){
  if(get_post_meta($e->ID,'_trigger',TRUE)!='-'){
    continue;
  }
  $tmp_key_str=trim(get_post_meta($e->ID,'_keyword',TRUE));
  $tmp_keys=explode(',', $tmp_key_str);
  foreach($tmp_keys as $_k){
    $all_keys[] = $_k;
  }
}

$data=array();
foreach($raw as $d){
	$status=$d->post_status;

	$tmp_key=trim(get_post_meta($d->ID,'_keyword',TRUE));
	$key=$tmp_key;
	$array_key=explode(',', $tmp_key);

  if(count($array_key)>0){
    foreach($array_key as $k){
      if($k!=''){
        $count_dup_key = 0;
        foreach($all_keys as $k2){
          if(strtolower(trim($k))==strtolower(trim($k2))){
            $count_dup_key++;
          }
          if ($count_dup_key > 1){
            $conflicted='<br><span class="msg_conflict">'.__('Conflict','WPWSL').'[<i>'.$k.'</i>]</span>';
            $key=$key.$conflicted;
            break;
          }
        }
      }
    }
  }

	$type=get_post_meta($d->ID,'_type',TRUE);
	$_trigger=get_post_meta($d->ID,'_trigger',TRUE);

	switch($_trigger){
		case 'default':
			$key='<span class="msg_highlight">'.__('*Default*','WPWSL').'</span>';
		break;
		case 'subscribe':
			$key='<span class="msg_highlight">'.__('*Subscribed*','WPWSL').'</span>';
		break;
	}
	if($d->post_status!='publish'){
		$key='<span class="msg_disabled">'.__('*Deactivation*','WPWSL').'</span>';
	}
	$post_title=$d->post_title?$d->post_title:__('(empty)','WPWSL');
	$data[]=array('ID'=>$d->ID, 'title'=>$post_title, 'type'=>$type, 'date'=>mysql2date('Y.m.d', $d->post_date), 'trigger_by' => $key);
}

//Prepare Table of elements
$wp_list_table = new WPWSL_List_Table($data);
$wp_list_table->prepare_items();

//Load content
//require_once( 'content.php' );
?>
<link href="<?php echo WPWSL_PLUGIN_URL;?>/css/style.css" rel="stylesheet">
<div class="wrap">
	<?php echo $content['header'];?>
	<?php echo $content['tips_content'];?>
	<p class="header_func">
		<?php if(current_user_can('manage_options')):?>
		<a href="<?php menu_page_url(WPWSL_SETTINGS_PAGE);?>"><?php _e('Settings','WPWSL');?></a>
		<?php endif;?>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.imredy.com/wp_wechat/" target="_blank"><?php _e('Help','WPWSL');?></a>
	</p>
	<hr>
	<h2>
	<?php _e('Custom Menu','WPWSL');?>
	<a href="<?php menu_page_url(WPWSL_GENERAL_MENU);?>&edit" class="add-new-h2"><?php _e('Add New Reply','WPWSL');?></a>
	</h2>
	<br>

	<form action="" method="post">
        <textarea name="weixin_menu" id="ping_sites" class="large-text code" rows="20">{
    "button": [
        {
            "name": "扫码",
            "sub_button": [
                {
                    "type": "scancode_waitmsg",
                    "name": "扫码带提示",
                    "key": "rselfmenu_0_0",
                    "sub_button": [ ]
                },
                {
                    "type": "scancode_push",
                    "name": "扫码推事件",
                    "key": "rselfmenu_0_1",
                    "sub_button": [ ]
                }
            ]
        },
        {
            "name": "发图",
            "sub_button": [
                {
                    "type": "pic_sysphoto",
                    "name": "系统拍照发图",
                    "key": "rselfmenu_1_0",
                   "sub_button": [ ]
                 },
                {
                    "type": "pic_photo_or_album",
                    "name": "拍照或者相册发图",
                    "key": "rselfmenu_1_1",
                    "sub_button": [ ]
                },
                {
                    "type": "pic_weixin",
                    "name": "微信相册发图",
                    "key": "rselfmenu_1_2",
                    "sub_button": [ ]
                }
            ]
        },
        {
            "name": "发送位置",
            "type": "location_select",
            "key": "rselfmenu_2_0"
        },
        {
           "type": "media_id",
           "name": "图片",
           "media_id": "MEDIA_ID1"
        },
        {
           "type": "view_limited",
           "name": "图文消息",
           "media_id": "MEDIA_ID2"
        }
    ]
}</textarea>

        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
	</form>
</div>