<?php

/**
 * Plugin Name: Aionchat Assistant
 * Plugin URI: https://wordpress.org/plugins/aion-chatbot/
 * Description: End-to-end solution for implementing custom smart assistants.
 * Version: 1.1.1
 * Author: Aionchat
 * Author URI: https://aionchat.com
 * License:  GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */


if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Activate plugin
 */
register_activation_hook(__file__, 'aionchat_admin_activation');

/**
 * Deactivate plugin
 */
register_deactivation_hook(__file__, 'aionchat_admin_deactivation');

function aionchat_admin_activation()
{
    aionchat_get_admin_options(false);
}
function aionchat_admin_deactivation()
{
    delete_option('aionchat_options');
}

/**
 * insert chatbot code
 */
add_action('the_content', 'my_content_code');

function my_content_code($content)
{
    $checkkeys = checkkeyapi();
    if($checkkeys === True){

    $srcimg = plugin_dir_url(dirname(__FILE__)) . 'aion-chatbot/public/images/img.png';
    $srcbgimg = plugin_dir_url(dirname(__FILE__)) . 'aion-chatbot/public/images/bg.png';
    $srcheaderbgimg = plugin_dir_url(dirname(__FILE__)) . 'aion-chatbot/public/images/bg-header.png';
    $scpt = plugin_dir_url(dirname(__FILE__)) . 'aion-chatbot/public/js/index.js';

    $option = get_option('aionchat_options');

    $img = !empty($option['chat_icon']) ? $option['chat_icon'] : $srcimg;
    $chatbgimage=!empty($option['chat_background_image']) ? $option['chat_background_image'] : $srcbgimg;
    $chatbgcolor = !empty($option['chat_background_color']) ? $option['chat_background_color'] : '#fff';
    $bgcolorheader = !empty($option['chat_header_background_color']) ? $option['chat_header_background_color'] : '#331255';
    $chatheaderbgimage=!empty($option['chat_header_background_image']) ? $option['chat_header_background_image'] : $srcheaderbgimg;
    $chat_title=!empty($option['chat_title']) ? $option['chat_title'] : 'Aion chat';
    $chat_sub_title=!empty($option['chat_sub_title']) ? $option['chat_sub_title'] : 'Your smart assistant';
    $titlecolor = !empty($option['chat_title_color']) ? $option['chat_title_color'] : '#ffffff';
    $subtitlecolor = !empty($option['chat_sub_title_color']) ? $option['chat_sub_title_color'] : 'rgba(255, 255, 255, 0.5)';
    $chat_message_bgcolor = !empty($option['bot_background_message_color']) ? $option['bot_background_message_color'] : 'linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(51,18,85,1) 0%, rgba(51,18,85,1) 58%)';
    $chat_message_beforbordertop = !empty($option['bot_background_message_color']) ? $option['bot_background_message_color'] :'rgba(51,18,85)';
    $chat_message_color = !empty($option['bot_message_color']) ? $option['bot_message_color'] :'#fff';
    $user_message_bgcolor = !empty($option['user_background_message_color']) ? $option['user_background_message_color'] : 'linear-gradient(90deg, rgba(255,255,255,1) 0%, rgb(102 17 190) 0%, rgb(132 87 180) 58%)';
    $user_message_beforbordertop = !empty($option['user_background_message_color']) ? $option['user_background_message_color'] :'rgb(132, 87, 180)';
    $user_message_color = !empty($option['user_message_color']) ? $option['user_message_color'] :'#fff';
    $sendmsgbtncolor = !empty($option['send_icon_color']) ? $option['send_icon_color'] :'#fff';
    $sendmsgbtnbgcolor = !empty($option['send_button_background_color']) ? $option['send_button_background_color'] :'#331255';
    $closebtncolor = !empty($option['close_icon_color']) ? $option['close_icon_color'] :'#fff';
    
    $ctn = '<style>
    .an-chatassistant-wrapper{ background-image: url("'.$chatbgimage.'") !important; }
    .an-chatassistant-wrapper{ background-color: '.$chatbgcolor.' !important; }
    an-chatheader{background-color: '.$bgcolorheader.' !important;} 
    an-chatheader{ background-image: url("'.$chatheaderbgimage.'") !important; background-position: center center; background-size: cover !important; }
    an-chatheader an-chatheader-title { color: '.$titlecolor.' !important ;}
    an-chatheader an-chatheader-title #an-subtitle { color: '.$subtitlecolor.' !important ;}
    an-chatbody .an-messages .message{background: '.$chat_message_bgcolor.' !important;}
    an-chatbody .an-messages .message.new{ color: '.$chat_message_color.' !important }
    an-chatbody .an-messages .message.message-personal{ color: '.$user_message_color.' !important }
    an-chatbody .an-messages .message::before{border-top-color:'.$chat_message_beforbordertop.'!important;}
    an-chatbody .an-messages .message.message-personal{background: '.$user_message_bgcolor.' !important}
    an-chatbody .an-messages .message.message-personal::before{border-top: 4px solid '.$user_message_beforbordertop.' !important}
    an-chatfooter .message-box .message-submit, an-chatfooter .message-box .message-submit:hover{color: '.$sendmsgbtncolor.' !important; background-color: '.$sendmsgbtnbgcolor.' !important;}
    an-chatheader an-chatheader-closeicon #closechat i.fas { color: '.$closebtncolor.' !important ;}
     </style>';

    return $content .= '
<input type="hidden" id="user-agent-id" value="'.$option['agent_id'].'" />
<input type="hidden" id="user-welcome-message" value="'.$option['welcom_message'].'" />
<an-chatassistant>
'.$ctn.'
<div class="an-chatassistant-wrapper chat" id="chatblock">
    <an-chatassistant-chat>
        <an-chatheader>
            <an-chatheader-title>
                <div id="an-title"> '.$chat_title.' </div>
                <div id="an-subtitle">'.$chat_sub_title.'</div>
            </an-chatheader-title>
            <an-chatheader-figure>
            <img src="' .  $img . '" data-an-logo="' .  $img . '" id="an-logo" />
            </an-chatheader-figure>
            <an-chatheader-closeicon>
                <button id="closechat" onclick="btnaction()"><i class="fas fa-times"></i></button>
            </an-chatheader-closeicon>
        </an-chatheader>
        <an-chatbody>
            <div class="an-messages">
                <div class="an-messages-content"></div>
                <div class="an-suggession">
                 
                </div>
            </div>
        </an-chatbody>
        <an-chatfooter>
            <form class="message-box" id="mymsg" method="POST">
                <input type="text" id="MSG" name="MSG" class="an-message-input" placeholder="Type message..." >
                <!-- <i class="fas fa-microphone" id="start-record-btn"></i> -->
                <button type="submit" class="message-submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </form>
            <p class="no-browser-support" hidden><i class="fas fa-exclamation-circle"></i> Sorry, Your Browser Doesn\'t Support the Web Speech API. Try Opening This Demo In Google Chrome.</p>
        </an-chatfooter>
    </an-chatassistant-chat>
</div>
<an-chatassistant-button>
    <div id="chatbtnsection">
        <a href="javascript:return" id="actionchat" onclick="btnaction()"><img src="' .  $img . '"/></a>
      </div>
</an-chatassistant-button>
</an-chatassistant>
<script src="' . $scpt . '"></script>
';
    }
    else{
        return $content.='';
    }
}

function geticonbot(){
    $srcimg = plugin_dir_url(dirname(__FILE__)) . 'aion-chatbot/public/images/img.png';
    $img = !empty($option['chat_icon']) ? $option['chat_icon'] : $srcimg;
    return $img;
}

/**
 * Init plugin
 **/
add_action('admin_init', 'aionchat_options_init');
function aionchat_options_init()
{
    register_setting('aionchat', 'aionchat_options', 'aionchat_validate_options');
}

/** 
 * Sanitize and validate input. Accepts an array, return a sanitized array. 
 **/
function aionchat_validate_options($input)
{
    $current_options = get_option('aionchat_options');

    if (isset($input['account_created'])) {
        $sanitary_values['account_created'] = intval($input['account_created']);
    }
    if (isset($input['agent_id'])) {
        $sanitary_values['agent_id'] = sanitize_text_field($input['agent_id']);
    }
    if (isset($input['chat_icon'])) {
        $sanitary_values['chat_icon'] = sanitize_text_field($input['chat_icon']);
    }
    if (isset($input['chat_title'])) {
        $sanitary_values['chat_title'] = sanitize_text_field($input['chat_title']);
    }
    if (isset($input['chat_sub_title'])) {
        $sanitary_values['chat_sub_title'] = sanitize_text_field($input['chat_sub_title']);
    }
    if (isset($input['chat_background_color'])) {
        $sanitary_values['chat_background_color'] = sanitize_text_field($input['chat_background_color']);
    }
    if (isset($input['chat_background_image'])) {
        $sanitary_values['chat_background_image'] = sanitize_text_field($input['chat_background_image']);
    }
    if (isset($input['chat_header_background_color'])) {
        $sanitary_values['chat_header_background_color'] = sanitize_text_field($input['chat_header_background_color']);
    }
    if (isset($input['chat_header_background_image'])) {
        $sanitary_values['chat_header_background_image'] = sanitize_text_field($input['chat_header_background_image']);
    }
    if (isset($input['chat_title_color'])) {
        $sanitary_values['chat_title_color'] = sanitize_text_field($input['chat_title_color']);
    }
    if (isset($input['chat_sub_title_color'])) {
        $sanitary_values['chat_sub_title_color'] = sanitize_text_field($input['chat_sub_title_color']);
    }
    if (isset($input['bot_message_color'])) {
        $sanitary_values['bot_message_color'] = sanitize_text_field($input['bot_message_color']);
    }
    if (isset($input['bot_background_message_color'])) {
        $sanitary_values['bot_background_message_color'] = sanitize_text_field($input['bot_background_message_color']);
    }
    if (isset($input['welcom_message'])) {
        $sanitary_values['welcom_message'] = sanitize_text_field($input['welcom_message']);
    }
    if (isset($input['user_message_color'])) {
        $sanitary_values['user_message_color'] = sanitize_text_field($input['user_message_color']);
    }
    if (isset($input['user_background_message_color'])) {
        $sanitary_values['user_background_message_color'] = sanitize_text_field($input['user_background_message_color']);
    }
    if (isset($input['send_button_background_color'])) {
        $sanitary_values['send_button_background_color'] = sanitize_text_field($input['send_button_background_color']);
    }
    if (isset($input['send_icon_color'])) {
        $sanitary_values['send_icon_color'] = sanitize_text_field($input['send_icon_color']);
    }
    if (isset($input['close_icon_color'])) {
        $sanitary_values['close_icon_color'] = sanitize_text_field($input['close_icon_color']);
    }


    return $sanitary_values;
}

/**
 * admin options, set default values if empty
 **/
function aionchat_get_admin_options($return = true)
{
    $options = array(
        'agent_id' => '',
        'chat_icon' => '',
        'chat_title' => '',
        'chat_sub_title' => '',
        'chat_background_color' => '',
        'chat_background_image' => '',
        'chat_header_background_color' => '',
        'chat_header_background_image' => '',
        'chat_title_color' => '',
        'chat_sub_title_color' => '',
        'bot_message_color' => '',
        'bot_background_message_color' => '',
        'welcom_message' => '',
        'user_message_color' => '',
        'user_background_message_color' => '',
        'send_button_background_color' => '',
        'send_icon_color' => '',
        'close_icon_color' => '',
    );
    $current_options = get_option('aionchat_options');

    if (!empty($current_options && isset($options))) {
        foreach ($current_options as $key => $option) {
            $options[$key] = $option;
        }
    }

    update_option('aionchat_options', $options);
    if ($return) return $options;
}

/**
 * enqeue styles
 */

function aion_chat_enqueue()
{

    wp_enqueue_style('normalize.min', "https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css");
    wp_enqueue_style('googlefountcss', "https://fonts.googleapis.com/css?family=Open+Sans");

    wp_enqueue_style('mCustomscrollbar', plugins_url('public/scss/mCustomscrollbar.min.css', __FILE__));
    wp_enqueue_style('fontawesome', "https://use.fontawesome.com/releases/v5.7.2/css/all.css");
    wp_enqueue_style('style-aion', plugins_url('public/css/style.css', __FILE__));

    wp_register_script('jquery-js',  "http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js");
    wp_enqueue_script('jquery-js');

    wp_enqueue_script('mCustomscrollbar-js', plugins_url('public/js/mCustomscrollbar.js', __FILE__));


    // wp_register_script('man-js',  plugins_url('/js/index.js', __FILE__));
    // wp_enqueue_script('man-js');

}

/**
 * enqeue styles admin
 */
function aionchat_enqueue_admin()
{
    if (isset($_GET["page"]) && $_GET["page"] == "aionchat") {
        wp_enqueue_script('custom', plugins_url('admin/js/custom.js', __FILE__));
        wp_enqueue_style('custom', plugins_url('admin/css/custom.css', __FILE__), array(), true, 'all');
        wp_enqueue_script( 'wp-color-picker-alpha', plugins_url( 'admin/js/wp-color-picker-alpha.min.js',  __FILE__ ), array( 'wp-color-picker' ), '3.0.0', true );
        wp_enqueue_script( 'wp-color-picker-init',  plugins_url( 'admin/js/wp-color-picker-alpha-init.js',  __FILE__ ), array( 'wp-color-picker-alpha' ), '3.0.0', true );
    }
}

add_action('wp_enqueue_scripts', 'aion_chat_enqueue');
add_action('admin_enqueue_scripts', 'aionchat_enqueue_admin');

/**
 * admin page
 */
function aionchat_options_page_html()
{
    if (is_admin()) {
        require_once "admin/my-plugin-admin.php";
    }
}

/**
 * setup menu admin
 */
add_action('admin_menu', 'aionchat_options_page');
function aionchat_options_page()
{
    add_menu_page(
        'aionchat',
        'aionchat Options',
        'manage_options',
        'aionchat',
        'aionchat_options_page_html',
        'dashicons-admin-generic',
        20
    );
}

function verify_activationcode()
{

    $checkkeys = checkkeyapi();
    if($checkkeys === True){
        //print_r('success');
        echo (__('<h4><b>Status :</b> <span style="color: green;">Activated</span></h4>'));
        require_once('admin/questionsForm.php');
    }
    else{
        echo (__('<h4><b>Status :</b> <span style="color: red;">Deactivated</span></h4>'));
        require_once('admin/questionsForm.php');
    }
}

/**
 * check agent id
 */
function checkkeyapi(){
    $option = get_option('aionchat_options');

    $postdata = array(
        'agent-id' => $option['agent_id'],
    );

    $url = "http://51.68.172.81:8080/checkid";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postdata));

    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    $dcc = json_decode($json_response);

    curl_close($curl);

    if ($status == 200) {
        return $dcc->answer;
    } 
}