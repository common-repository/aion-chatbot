<div class="wrap">
    <div class="postbox-container" style="width: 100%;">
        <div class="metabox-holder">
            <div class="meta-box-sortables ui-sortable">
                <img src=<?php echo plugins_url(('../assets/images/logo.png'), __FILE__) ?> class="aion_chatbot_logo">

                    <?php settings_fields('aionchat'); ?>
                    <?php do_settings_sections('aionchat_options'); ?>
                    <?php $options = aionchat_get_admin_options(); ?>
                    <div class="postbox">
                        <div style="padding:0 0 10px 10px ">
                            <input type="hidden" name="aionchat_options[account_created]" value=<?php  if(isset($options['account_created'])) _e($options['account_created']); ?>>
                            <div class="choices-main-container">
                                <div class="choices-title">Do you have an account?</div>
                                <div class="choices-container">
                                    <input type="radio" name="choices" value="1" onchange="handleChange(this.value);" 
                                        <?php
                                        if(isset($options['account_created']))
                                        checked($options['account_created'], 1); 
                                        ?> 
                                     />
                                    Yes
                                    <input type="radio" name="choices" value="0" onchange="handleChange(this.value);" 
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


                    <?php
                    // output security fields for the registered setting "aionchat_options"

                    // output setting sections and their fields
                    // (sections are registered for "aionchat", each field is registered to a specific section)

                    // output save settings button
                    submit_button(__('Save Settings', 'aionchat'));
                    ?>

            </div>
        </div>
    </div>
</div>