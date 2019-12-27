<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

global $wpdb;
//load players
$players = $wpdb->get_results("SELECT id, title FROM {$player_table} ORDER BY title ASC", ARRAY_A);

//load playlists
$playlists = $wpdb->get_results("SELECT id, title FROM {$playlist_table} ORDER BY title ASC", ARRAY_A);

?>

<div class="wrap" align="center">
	<h2>Pagination</h2>
	<div class="wpsvp-admin wpsvp-shortcode-manager-wrap">
	<div class="option-tab">	  
<div class="option-content">

	    	<p>Select number of videos displayed on one page.</p>

    		<table class="wpsvp-table wp-list-table widefat">
				<tbody>

					<tr valign="top">
						<th style="width:15%">Pagination number</th>
						<td>
							<form action="" method="post">
				             <input type="number" name="pagination_number" value="<?php echo get_option('saves_the_pagination'); ?>">
				             <input type="submit" name="save_pagination" value="Save">
				            </form>
			            </td>
					</tr>

				
				</tbody>
			</table>
			<?php if (isset($_POST['save_pagination'])) {
				$number=$_POST['pagination_number'];
				update_option( 'saves_the_pagination', $number); 
				echo "<script>jQuery(document).ready(function(){window.location.reload();});</script>";
			} ?>
		</div>
    </div>
</div>
</div>