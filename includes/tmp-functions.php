<?php

function register_settings() {
   add_option( 'TrueMail Api Key', 'XXXXXX');
   register_setting( 'options_group', 'option_name', 'callback' );
}
add_action( 'admin_init', 'register_settings' );
add_action('admin_init', 'truemail_plugin_admin_init');
add_action('admin_init', 'truemail_admin_notice');
function truemail_register_options_page() {
  add_options_page('Truemail Email Validator', 'Truemail Email Validator', 'manage_options', 'truemail-email-validator', 'truemail_options_page');
}

function truemail_options_page() {
?>
    <div style="background-color: #fff;padding:15px 30px 15px 30px;">
        <form id="clearout_setting_form" action="options.php" method="post">
        <?php settings_fields('truemail_email_validator'); ?>
        <?php do_settings_sections('truemail_plugin'); ?>
        <input name="truemail_submit" type="submit" value="<?php esc_attr_e('Apply'); ?>" class="button button-primary"/>
        </form>

        </form>

        <br/>
        <h4 style="font-size: 15px;margin: 0;"><b>Note:</b> </h4>
        <ul style="list-style-type: disc;padding-left: 10px;font-size: 14px;">
            <li>Option <b>Accept only Business Address</b> will supersede other options in priority </li>
            <li>If one or more options chosen then validation check will be perform based on the priority and result will be Valid atleast an option satisfy</li>
            <li>Priority of option <b>Accept only Business Address</b> is higher than Role or Disposable options. Role and Disposable share the same priority</li>
            </ul>
    </div>

        <form method="post" action="test.php">
            <input type="text" name="email">
            <input type="submit" value="click" name="submit">
        </form>
<?php
}

function truemail_plugin_section_text() {
    echo '<p style="font-size: 14px;">At here you can edit your Truemail API Token and timeout value, also you can adjust how the validation need to be performed. The default plugin options will result given email address as "<b>valid</b>" for Truemail statuses other than "<b>invalid</b>" nor "<b>disposable</b>" nor "<b>role</b>", further it can be fine tuned by choosing one or more options on what to consider as "<b>valid</b>" email address. Clicking "<b>Apply</b>" will save the settings and changes come into effect</p>';
}

function truemail_plugin_admin_init() {
    register_setting('truemail_email_validator', 'truemail_email_validator');
    add_settings_section('truemail_plugin_main', 'Plugin Settings', 'truemail_plugin_section_text', 'truemail_plugin');
    add_settings_field('truemail_api_key', 'API Token', 'truemail_api_key_setting', 'truemail_plugin', 'truemail_plugin_main');
    add_settings_field('truemail_timeout', 'Timeout (in Sec)', 'truemail_timeout_setting', 'truemail_plugin', 'truemail_plugin_main');
    add_settings_field('truemail_role_email_option', 'Accept role based email address', 'truemail_role_email_setting_option', 'truemail_plugin', 'truemail_plugin_main');
    add_settings_field('truemail_disposable_option', 'Accept disposable email address', 'truemail_disposable_setting_option', 'truemail_plugin', 'truemail_plugin_main');
}

function truemail_api_key_setting() {
    $options = get_option('truemail_email_validator');
    $api_key = isset($options['api_key']) ? sanitize_text_field($options['api_key']) : ' ';
    echo '<input id="api_key" name="truemail_email_validator[api_key]" size="60" type="text" value="' . $api_key . '" style="margin-bottom: 5px;" required/><br />';
}

function truemail_timeout_setting() {
    $options = get_option('truemail_email_validator');
    $timeout = (isset($options['timeout']) && is_numeric($options['timeout'])) ? $options['timeout'] : '15';
    echo '<input id="timeout" name="truemail_email_validator[timeout]" size="10" type="number" value="' . $timeout . '" style="margin-bottom: 5px;" required/><br />';
}

function truemail_role_email_setting_option() {
    $options = get_option('truemail_email_validator');
    $role_email_on_off = isset($options['role_email_on_off']) ? $options['role_email_on_off'] : 'off';
    echo '<label><input type="checkbox" name="truemail_email_validator[role_email_on_off]" id="role_email_option" value="on"' . (($role_email_on_off == 'on') ? ' checked' : 'unchecked') . ' /> </label><br/>';
}

function truemail_disposable_setting_option() {
    $options = get_option('truemail_email_validator');
    $disposable_on_off = isset($options['disposable_on_off']) ? $options['disposable_on_off'] : 'off';
    echo '<label><input type="checkbox" name="truemail_email_validator[disposable_on_off]" id="disposable_option" value="on"' . (($disposable_on_off == 'on') ? ' checked' : 'unchecked') . ' /></label>';
}

add_action('admin_menu', 'truemail_register_options_page');
add_filter('is_email', 'truemail_verify', 10, 5);

function truemail_verify($valid, $email)
    {
    try {
    if ($valid) {
    $options = get_option('truemail_email_validator');
        if ($options['api_key'] == '' || $options['api_key'] == ' ')
        {
            return true;
        } else {
	    $url = "https://truemail.io/api/v1/verify/single/?access_token=".$options['api_key']."&timeout=".$options['timeout']."&email=" . $email;
        $email = str_replace('+', '%2B', $email);

        $params = [
		    'timeout' => $options['timeout']
        ];

        if($timeout) {
            if(!is_int($timeout))
		        $params['timeout'] = 15;
            $params['timeout'] = $timeout;
        }

        $WP_Http = new WP_Http();
                $data = $WP_Http->request( $url, $params );
                $data = json_decode($data['body'], true);

        if ($data['error']) {
            return true;
        } else {
            if ($data['status_id'] == 3 || $data['status_id'] == 4 || ($data['status_id'] == 5 && $options['disposable_on_off']) || $data['status_id'] == 7 ) {
                return true;
            }
            else {
                return false;
            }
        }
        }
                } else
                return false;
        }catch(Exception $e) {
                 return true;
        }

    }

function truemail_admin_notice() {

    $options = get_option('truemail_email_validator');
    if ($options['api_key'] == '' || $options['api_key'] == ' ') {
        echo '<div class="notice notice-warning is-dismissible">
			 <p>Please get your Truemail API Token from <a href="https://truemail.io/app/api-keys" target="_blank">here</a> and save in <a href="options-general.php?page=truemail-email-validator">setting page</a>.</p>
		 </div>';
    }
}
