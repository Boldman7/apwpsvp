<div class='wrap' align="center">

	<h2>Add new playlist</h2>

	<form method="post" action="<?php echo admin_url("admin.php?page=wpsvp_playlist_manager"); ?>">

		<div class="wpsvp-admin">

			<div class="wpsvp-admin-inner">

			<table class="form-table">
				
				<tr valign="top">
					<th>Enter playlist title</th>
					<td><input type="text" name="title" required placeholder="Enter playlist title"></td>
				</tr>

			</table>

		</div>

		</div>

		<?php wp_nonce_field('wpsvp_add_playlist_action', 'wpsvp_add_playlist_nonce_field'); ?>
		<input type="submit" name="add_playlist" class="button-primary" value="Save Changes" <?php disabled( !current_user_can(WPSVP_CAPABILITY) ); ?>>
		<a class='button-primary' href="<?php echo admin_url("admin.php?page=wpsvp_playlist_manager"); ?>">Back to Playlist manager</a>

	</form>

</div>

