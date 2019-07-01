<?php

if(!empty($_POST) && check_admin_referer("wpsvp_edit_settings_action", "wpsvp_edit_settings_nonce_field")){

    $youtube_id = str_replace('"', "'", stripslashes($_POST['youtube_id']));
    $facebook_id = str_replace('"', "'", stripslashes($_POST['facebook_id']));
    $vimeo_key = str_replace('"', "'", stripslashes($_POST['vimeo_key']));
    $vimeo_secret = str_replace('"', "'", stripslashes($_POST['vimeo_secret']));
    $vimeo_token = str_replace('"', "'", stripslashes($_POST['vimeo_token']));
    $youtube_no_cookie = str_replace('"', "'", stripslashes($_POST['youtube_no_cookie']));
    $js_to_footer = str_replace('"', "'", stripslashes($_POST['js_to_footer']));
    $no_conflict = str_replace('"', "'", stripslashes($_POST['no_conflict']));

    $id = $wpdb->get_row("SELECT id FROM {$settings_table}");
    if($wpdb->num_rows > 0){

    	$stmt = $wpdb->update(
	    	$settings_table,
			array( 
				'youtube_id' => $youtube_id,
				'facebook_id' => $facebook_id,
				'vimeo_key' => $vimeo_key,
				'vimeo_secret' => $vimeo_secret,
				'vimeo_token' => $vimeo_token,
				'youtube_no_cookie' => $youtube_no_cookie,
				'js_to_footer' => $js_to_footer,
				'no_conflict' => $no_conflict
			), 
			array('id' => 0),
			array('%s','%s','%s','%s','%s','%d','%d','%d'),
			array('%d')
	    );

    }else{

    	$stmt = $wpdb->insert(
	    	$settings_table,
			array( 
				'youtube_id' => $youtube_id,
				'facebook_id' => $facebook_id,
				'vimeo_key' => $vimeo_key,
				'vimeo_secret' => $vimeo_secret,
				'vimeo_token' => $vimeo_token,
				'youtube_no_cookie' => $youtube_no_cookie,
				'js_to_footer' => $js_to_footer,
				'no_conflict' => $no_conflict
			), 
			array('%s','%s','%s','%s','%s','%d','%d','%d')
	    );

    }

    if($stmt !== false){
		$msg = 'Success!';
	}else{
		$msge = 'Error occured!';	
	}

}



//load settings
$settings = $wpdb->get_row("SELECT * FROM {$settings_table}", ARRAY_A);

?>


<div class="wrap">

	<?php if(isset($vim_msge)) : ?>	
		<div class="error notice is-dismissible">
		    <p><strong><?php echo($vim_msge); ?></strong></p>
		</div>
	<?php else : include("notice.php"); ?>
	<?php endif; ?>


	<h2>General settings</h2>

	<p></p>

	<form method="post" action="<?php echo admin_url("admin.php?page=wpsvp_settings&action=save_options"); ?>">

		<div class="wpsvp-admin">

            <div class="option-tab">
                <div class="option-toggle">
                    <span class="option-title">Credentials</span>
                </div>
                <div class="option-content">
                    
                	<table class="form-table">
					    <tr valign="top">
					        <th>Youtube application ID</th>
					        <td>
					            <input type="text" name="youtube_id" value="<?php if(isset($settings['youtube_id']))echo($settings['youtube_id']); ?>"><br>
					            <span class="info">Required if Youtube is used (<strong>not required</strong> if you just want to use Youtube single videos without API).<br>Register here: <a href="https://console.developers.google.com" target="_blank">https://console.developers.google.com</a> and create new project, enable YouTube Data API, go to Credentials, create Browser key and enter API key.</span>
					        </td>
					    </tr>
					    <tr valign="top">
					        <th>Facebook application ID</th>
					        <td>
					            <input type="text" name="facebook_id" value="<?php if(isset($settings['facebook_id']))echo($settings['facebook_id']); ?>"><br>
					            <span class="info">Required for Facebook social sharing. Register here: <a href="https://developers.facebook.com/apps" target="_blank">https://developers.facebook.com/apps</a> and enter App ID.</span>
					        </td>
					    </tr>
					    <tr valign="top">
					        <th>Vimeo Client Identifier</th>
					        <td>
					            <input type="text" name="vimeo_key" value="<?php if(isset($settings['vimeo_key']))echo($settings['vimeo_key']); ?>"><br>
					            <span class="info">Required if Vimeo is used (<strong>not required</strong> if you just want to use Vimeo single videos without API).<br>Register here: <a href="https://developer.vimeo.com/apps/new" target="_blank">https://developer.vimeo.com/apps/new</a> and create new application, and from Authentication tab get: Client Identifier, Client Secrets and Access Token.</span><br>
					        </td>
					    </tr>
					    <tr valign="top">
					        <th>Vimeo Client Secrets</th>
					        <td>
					            <input type="text" name="vimeo_secret" value="<?php if(isset($settings['vimeo_secret']))echo($settings['vimeo_secret']); ?>"><br>
					        </td>
					    </tr>
					    <tr valign="top">
					        <th>Vimeo Access Token</th>
					        <td>
					            <input type="text" name="vimeo_token" value="<?php if(isset($settings['vimeo_token']))echo($settings['vimeo_token']); ?>"><br>
					        </td>
					    </tr>
					</table>

                </div>
            </div>

            <div class="option-tab">
                <div class="option-toggle">
                    <span class="option-title">Miscellaneous</span>
                </div>
                <div class="option-content">
                    
                    <table class="form-table">
                		<tr valign="top">
					        <th>Youtube No Cookie</th>
					        <td>
					            <select name="youtube_no_cookie">
					                <option value="0" <?php if(isset($settings['youtube_no_cookie']) && $settings['youtube_no_cookie'] == "0") echo 'selected' ?>>no</option>
					                <option value="1" <?php if(isset($settings['youtube_no_cookie']) && $settings['youtube_no_cookie'] == "1") echo 'selected' ?>>yes</option>
					            </select><br>
					            <span class="info">Serve Youtube videos from No Cookie domain</span>
					        </td>
					    </tr>
					    <tr valign="top">
					        <th>Insert javascript into footer</th>
					        <td>
					            <select name="js_to_footer">
					                <option value="0" <?php if(isset($settings['js_to_footer']) && $settings['js_to_footer'] == "0") echo 'selected' ?>>no</option>
					                <option value="1" <?php if(isset($settings['js_to_footer']) && $settings['js_to_footer'] == "1") echo 'selected' ?>>yes</option>
					            </select><br>
					            <span class="info">Putting the js to footer (instead of the head) can fix some javascript conflicts.</span>
					        </td>
					    </tr>
					    <tr valign="top">
					        <th>jQuery No Conflict mode</th>
					        <td>
					            <select name="no_conflict">
					                <option value="0" <?php if(isset($settings['no_conflict']) && $settings['no_conflict'] == "0") echo 'selected' ?>>no</option>
					                <option value="1" <?php if(isset($settings['no_conflict']) && $settings['no_conflict'] == "1") echo 'selected' ?>>yes</option>
					            </select><br>
					            <span class="info">Can fix some javascript conflicts on the page.</span>
					        </td>
					    </tr>
					</table>

                </div>
            </div>

        </div>

        <p class="wpsvp-actions"> 
			<?php wp_nonce_field('wpsvp_edit_settings_action', 'wpsvp_edit_settings_nonce_field'); ?>
			<input type="submit" name="save_options" class="button-primary" value="Save Changes" <?php disabled( !current_user_can(WPSVP_CAPABILITY) ); ?> >
		</p>

	</form>
	
</div>

