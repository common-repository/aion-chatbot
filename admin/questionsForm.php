<div class="an-form-data">
            <div class="postbox-container " style="width: 100%;">
                <div class="metabox-holder ">
                    <div class="meta-box-sortables ui-sortable">

                        <?php settings_fields('aionchat'); ?>
                        <?php do_settings_sections('aionchat_options'); ?>
                        <?php $options = aionchat_get_admin_options(); ?>

                        <!-- create acount -->
                        <div class="postbox">
                            <div style="padding:0 0 10px 10px ">
                                <input type="hidden" name="aionchat_options[account_created]" value="<?php  if(isset($options['account_created'])) _e($options['account_created']); ?>">
                                <div class="choices-main-container">
                                    <div class="choices-title">
                                        <h3>Do you have an account?</h3>
                                    </div>
                                    <div class="choices-container">
                                        <input type="radio" id="choice-yes" name="choices" value="1" onchange="handleChange(this.value);" 
                                            <?php
                                            if(isset($options['account_created']))
                                            checked($options['account_created'], 1); 
                                            ?> 
                                        />
                                        Yes
                                        <input type="radio" id="choice-no" name="choices" value="0" onchange="handleChange(this.value);" 
                                            <?php 
                                            if(isset($options['account_created']))
                                                checked($options['account_created'], 0); 
                                            
                                            ?> 
                                        />
                                        No<br />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- -->

                        <!-- no account -->

                        <div class="wrap">
                            <div class="postbox-container" style="width: 100%;">
                                <div class="metabox-holder">
                                    <div class="meta-box-sortables ui-sortable">
                                        <div class="postbox guest-form" id="guest-form-container">
                                            <div style="padding:10px ">
                                                <p>To enable the chatbot in your website, first you need to create an account in: <a class="aion_chatbot_btn" href="https://aionchat.com" target="_blank">aionchat.com</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- -->

                        <div class="postbox infochat-form" id="infos-chatbot">
                            <div style="padding:0 0 10px 10px ">
                                <h3 id="valid-box" class="hidden">
                                    <?php

                                    $checkagent = checkkeyapi();

                                    if($checkagent === True){
                                        ?>
                                            <div class="notice notice-success is-dismissible">
                                                <p><?php _e('Congratulations, your account was activated successfully', 'shapeSpace'); ?></p>
                                            </div>
                                            <script>
                                                document.getElementById('choice-no').disabled = true;
                                            </script>
                                        <?php
                                    }elseif($checkagent === False){
                                        ?>
                                            <div class="notice notice-warning is-dismissible">
                                                <p><?php _e('Error, Activate your account', 'shapeSpace'); ?></p>
                                            </div>
                                            <script>
                                                document.getElementById('choice-no').disabled = false;
                                            </script>
                                        <?php
                                    }else{
                                        ?>
                                            <div class="notice notice-warning is-dismissible">
                                                <p><?php _e('please, activate your account !', 'shapeSpace'); ?></p>
                                            </div>
                                        <?php
                                    }

                                    ?>
                                </h3>

                                <table class="form-table user-form" id="user-form-table">
                                    <tbody>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[agent_id]">
                                                    <?php _e('Agent id: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="aion_chatbot_input" id="aionchat_options[agent_id]" name="aionchat_options[agent_id]" value="<?php _e((empty($options['agent_id'])  ? '' : $options['agent_id']), 'aion_chatbot', 'aion_chatbot'); ?>" placeholder="Your agent id here" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aion_chatbot_options[chat_icon]">
                                                    <?php _e('Logo : ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="aion_chatbot_input" id="aionchat_options[chat_icon]" name="aionchat_options[chat_icon]" value="<?php _e(empty($options['chat_icon'])  ? '' : $options['chat_icon'], 'aion_chatbot', 'aion_chatbot'); ?>" placeholder="Your chat icon URL here" />

                                                <!-- <input type="hidden" name="aion_chatbot_options[chat_icon]" value=<?php _e(empty($options['chat_icon']) ? 'your_chat_icon_URL_here' : $options['chat_icon'], 'aion_chatbot', 'aion_chatbot'); ?> /> -->
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[chat_title]">
                                                    <?php _e('Chat title: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="aion_chatbot_input" id="aionchat_options[chat_title]" name="aionchat_options[chat_title]" value="<?php _e(empty($options['chat_title'])  ? '' : $options['chat_title'], 'aion_chatbot'); ?>" placeholder="Your title here" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat-options[chat_sub_title]">
                                                    <?php _e('Chat sub title: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="aion_chatbot_input" id="aionchat_options[chat_sub_title]" name="aionchat_options[chat_sub_title]" value="<?php _e(empty($options['chat_sub_title'])  ? '' : esc_attr($options['chat_sub_title']), 'aion_chatbot'); ?>" placeholder="Your sub title here" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[chat_background_color]">
                                                    <?php _e('Chatbot background color: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" id="aionchat_options[chat_background_color]"  name="aionchat_options[chat_background_color]" value=<?php _e($options['chat_background_color'], 'aion_chatbot'); ?> />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[chat_background_image]">
                                                    <?php _e('Chatbot background image: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input class="aion_chatbot_input" id="aionchat_options[chat_background_image]" type="text" name="aionchat_options[chat_background_image]" value="<?php _e(empty($options['chat_background_image']) ? '' : esc_attr($options['chat_background_image']), 'aion_chatbot'); ?>" placeholder="Your chat background image here" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[chat_header_background_color]">
                                                    <?php _e('Chatbot header background color: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" id="aionchat_options[chat_header_background_color]"  name="aionchat_options[chat_header_background_color]" value="<?php _e(empty($options['chat_header_background_color']) ? '' : esc_attr($options['chat_header_background_color']), 'aion_chatbot'); ?>" placeholder="Your chat header background color here" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[chat_header_background_image]">
                                                    <?php _e('Chatbot header background image: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input class="aion_chatbot_input" id="aionchat_options[chat_header_background_image]" type="text" name="aionchat_options[chat_header_background_image]" value="<?php _e(empty($options['chat_header_background_image']) ? '' : esc_attr($options['chat_header_background_image']), 'aion_chatbot'); ?>" placeholder="Your chat header background image here" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[chat_title_color]">
                                                    <?php _e('Chatbot title color: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" id="aionchat_options[chat_title_color]" name="aionchat_options[chat_title_color]" value="<?php _e(empty($options['chat_title_color']) ? '' : esc_attr($options['chat_title_color']), 'aion_chatbot'); ?>" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[chat_sub_title_color]">
                                                    <?php _e('Chatbot sub title color: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" id="aionchat_options[chat_sub_title_color]" name="aionchat_options[chat_sub_title_color]" value="<?php _e(empty($options['chat_sub_title_color']) ? '' : esc_attr($options['chat_sub_title_color']), 'aion_chatbot'); ?>" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[bot_message_color]">
                                                    <?php _e('Chatbot Message color: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" id="aionchat_options[bot_message_color]"  name="aionchat_options[bot_message_color]" value="<?php _e($options['bot_message_color'], 'aion_chatbot'); ?>" />
                                            </td>
                                        </tr>

                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[bot_background_message_color]">
                                                    <?php _e('Chatbot message background color: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" id="aionchat_options[bot_background_message_color]" name="aionchat_options[bot_background_message_color]" value="<?php _e($options['bot_background_message_color'], 'aion_chatbot'); ?>" />
                                            </td>
                                        </tr>

                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[welcom_message]">
                                                    <?php _e('Welcom message: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text"  class="aion_chatbot_input" id="aionchat_options[welcom_message]" name="aionchat_options[welcom_message]" value="<?php _e($options['welcom_message'], 'aion_chatbot'); ?>" placeholder="Your welcome message" />
                                            </td>
                                        </tr>

                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[user_message_color]">
                                                    <?php _e('User message color: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" id="aionchat_options[user_message_color]" name="aionchat_options[user_message_color]" value="<?php _e($options['user_message_color'], 'aion_chatbot'); ?>" />
                                            </td>
                                        </tr>

                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[user_background_message_color]">
                                                    <?php _e('User message background color: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" id="aionchat_options[user_background_message_color]" name="aionchat_options[user_background_message_color]" value="<?php _e($options['user_background_message_color'], 'aion_chatbot'); ?>" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[send_button_background_color]">
                                                    <?php _e('Send button background color: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" id="aionchat_options[send_button_background_color]" name="aionchat_options[send_button_background_color]" value="<?php _e($options['send_button_background_color'], 'aion_chatbot'); ?>" />
                                            </td>
                                        </tr>

                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[send_icon_color]">
                                                    <?php _e('Send button icon color: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" id="aionchat_options[send_icon_color]" name="aionchat_options[send_icon_color]" value="<?php _e($options['send_icon_color'], 'aion_chatbot'); ?>" />
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="aionchat_options[close_icon_color]">
                                                    <?php _e('Close button icon color: ', 'aion_chatbot'); ?>
                                                </label>
                                            </th>
                                            <td>
                                                <input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" id="aionchat_options[close_icon_color]" name="aionchat_options[close_icon_color]" value="<?php _e($options['close_icon_color'], 'aion_chatbot'); ?>" />
                                            </td>
                                        </tr>

                                        <!-- <tr valign="top">
                                    <td>
                                        <input class="aion_chatbot_btn" type="button" name="aion_chatbot_save" id="aion_chatbot_save" value="Save" />
                                        <?php //$error = new WP_Error(); ?>
                                        <?php //if (is_wp_error($error)) {
                                            //echo $error->get_error_message();
                                        //} ?>
                                    </td>
                                </tr> -->


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- <input class="aion_chatbot_btn" type="button" name="aion_chatbot_save" id="aion_chatbot_save" value="Save" /> -->
                    <?php
                    // output security fields for the registered setting "wporg_options"

                    // output setting sections and their fields
                    // (sections are registered for "wporg", each field is registered to a specific section)

                    // output save settings button
                    submit_button(__('Save Settings', 'aionchat'));
                    ?>

                </div>

            </div>
        </div>