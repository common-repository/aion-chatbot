<?php


?>
<div class="">
    <div class="an-top-bar">
        <div class="an-top-bar-left">
            <img src="<?php echo plugins_url('../public/images/img.png', __FILE__); ?>" />
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        </div>
        <div class="an-top-bar-right">
            <a href="https://aionchat.com" target="_blank" title="connect to your account to have more info about your chat assistant " class="an-acount-link"><span class="dashicons dashicons-admin-users"></span> Connect to account</a>
        </div>
    </div>
</div>

<div class="wrap">
<h1 style="display: none;"><?php echo esc_html(get_admin_page_title()); ?></h1>
    <!-- <?php $options = aionchat_get_admin_options();
    $op = $options['agent_id'] ?>
    <?php if (isset($_POST['submit'])) { ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e('Congratulations, you did it!', 'shapeSpace'); ?></p>
        </div>
    <?php } ?> -->
</div>
<div class="wrap">

    <!-- <?php $options = aionchat_get_admin_options();
    $op = $options['agent_id'] ?>
    <?php if (isset($_POST['submit'])) { ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e('Congratulations, you did it!', 'shapeSpace'); ?></p>
        </div>
    <?php } ?> -->
    <form action="options.php" method="post" id="aionchat-options">
        <?php verify_activationcode(); ?>
    </form>
</div>

<?php
