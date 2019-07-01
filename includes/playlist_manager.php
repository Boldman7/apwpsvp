<?php

if(isset($_POST['add_playlist']) && isset($_POST['title']) && check_admin_referer("wpsvp_add_playlist_action", "wpsvp_add_playlist_nonce_field")){//add new playlist

    $title = stripslashes($_POST['title']);

    $stmt = $wpdb->insert(
    	$playlist_table,
		array( 
			'title' => $title
		), 
		array( 
			'%s'				
		) 
    );
 
    if($stmt !== false){
		$msg = 'Success!';
	}else{
		$msge = 'Error occured!';	
	}

}
else if(isset($_GET['action']) && isset($_GET['playlist_id'])){

	$action = $_GET['action'];
    $playlist_id = $_GET['playlist_id'];

    if($action == 'delete_playlist'){//delete playlist

    	$stmt = $wpdb->query($wpdb->prepare("DELETE FROM {$playlist_table} WHERE id = %d", $playlist_id));

    	if($stmt !== false){
			$msg = 'Success!';
		}else{
			$msge = 'Error occured!';	
		}

    }else if($action == 'duplicate_playlist' && isset($_GET['playlist_title'])){//duplicate playlist

		$title = stripslashes($_GET['playlist_title']);

		$options = $wpdb->get_var($wpdb->prepare("SELECT options FROM {$playlist_table} WHERE id = %d", $playlist_id));

	    $stmt = $wpdb->insert(
	    	$playlist_table,
			array( 
				'title' => $title,
				'options' => $options
			), 
			array( 
				'%s','%s'
			) 
	    );

	    if($stmt !== false){//copy tracks
	    	//https://stackoverflow.com/questions/4039748/in-mysql-can-i-copy-one-row-to-insert-into-the-same-table

		    $lastid = $wpdb->insert_id;//playlist_id

			$stmt = $wpdb->prepare("SELECT id FROM {$media_table} WHERE playlist_id = %d ORDER BY order_id", $playlist_id);
			$ids = $wpdb->get_results($stmt, ARRAY_A);

			//copy ads

			$tn = 'wpsvp_temp_table'.time();

			//playlist ads
			$wpdb->query($wpdb->prepare("CREATE TEMPORARY TABLE {$tn} SELECT * FROM $ad_table WHERE playlist_id=%d", $playlist_id));
			$wpdb->query("UPDATE {$tn} SET id=NULL, playlist_id='$lastid'");//update playlist id
			$wpdb->query("INSERT INTO $ad_table SELECT * FROM {$tn}");
			$wpdb->query("DROP TABLE {$tn}");

			//copy annotations

			//playlist annotations
			$wpdb->query($wpdb->prepare("CREATE TEMPORARY TABLE {$tn} SELECT * FROM $annotation_table WHERE playlist_id=%d", $playlist_id));
			$wpdb->query("UPDATE {$tn} SET id=NULL, playlist_id='$lastid'");//update playlist id
			$wpdb->query("INSERT INTO $annotation_table SELECT * FROM {$tn}");
			$wpdb->query("DROP TABLE {$tn}");

			foreach ($ids as $id) {

				//duplicate tracks

				$stmt = $wpdb->query($wpdb->prepare("CREATE TEMPORARY TABLE {$tn} SELECT * FROM $media_table WHERE id=%d", $id['id']));

				//copy track by track
				if($stmt !== false){

					//media

					$wpdb->query("UPDATE {$tn} SET id=NULL, playlist_id='$lastid'");//update playlist id
					$wpdb->query("INSERT INTO $media_table SELECT * FROM {$tn}");
					$last_media_insert_id = $wpdb->insert_id;//media_id
					$wpdb->query("DROP TABLE {$tn}");

					//copy path

					$wpdb->query($wpdb->prepare("CREATE TEMPORARY TABLE {$tn} SELECT * FROM $path_table WHERE media_id=%d", $id['id']));
					$wpdb->query("UPDATE {$tn} SET id=NULL, media_id='$last_media_insert_id'");//update media id
					$wpdb->query("INSERT INTO $path_table SELECT * FROM {$tn}");
					$wpdb->query("DROP TABLE {$tn}");

					//copy subtitles

					$wpdb->query($wpdb->prepare("CREATE TEMPORARY TABLE {$tn} SELECT * FROM $subtitle_table WHERE media_id=%d", $id['id']));
					$wpdb->query("UPDATE {$tn} SET id=NULL, media_id='$last_media_insert_id'");//update media id
					$wpdb->query("INSERT INTO $subtitle_table SELECT * FROM {$tn}");
					$wpdb->query("DROP TABLE {$tn}");

					//copy taxonomy

					$wpdb->query($wpdb->prepare("CREATE TEMPORARY TABLE {$tn} SELECT * FROM $taxonomy_table WHERE media_id=%d", $id['id']));
					$wpdb->query("UPDATE {$tn} SET id=NULL, media_id='$last_media_insert_id'");//update media id
					$wpdb->query("INSERT INTO $taxonomy_table SELECT * FROM {$tn}");
					$wpdb->query("DROP TABLE {$tn}");

					//copy ads

					//media ads
					$wpdb->query($wpdb->prepare("CREATE TEMPORARY TABLE {$tn} SELECT * FROM $ad_table WHERE media_id=%d", $id['id']));
					$wpdb->query("UPDATE {$tn} SET id=NULL, media_id='$last_media_insert_id'");//update media id
					$wpdb->query("INSERT INTO $ad_table SELECT * FROM {$tn}");
					$wpdb->query("DROP TABLE {$tn}");

					//copy annotations

					//media annotations
					$wpdb->query($wpdb->prepare("CREATE TEMPORARY TABLE {$tn} SELECT * FROM $annotation_table WHERE media_id=%d", $id['id']));
					$wpdb->query("UPDATE {$tn} SET id=NULL, media_id='$last_media_insert_id'");//update media id
					$wpdb->query("INSERT INTO $annotation_table SELECT * FROM {$tn}");
					$wpdb->query("DROP TABLE {$tn}");

				}
			}
		}

		if($stmt !== false){
			$msg = 'Success!';
		}else{
			$msge = 'Error occured!';	
		}
	}
 
}

//load playlists
$playlists = $wpdb->get_results("SELECT id, title FROM {$playlist_table} ORDER BY title ASC", ARRAY_A);


?>

<div class="wrap" align="center">

	<?php include("notice.php"); ?>

	<h2>Manage Playlists</h2>

	<p>From this section you can create and edit playlists. You can change playlist name by clicking on title row.</p>

	<div class="list-actions">
  		<input type="text" id="filter-playlist" placeholder="Search by title..">
    </div>

	<table class='wpsvp-table wp-list-table widefat'>
		<thead>
			<tr>
				<th style="width:5%">ID</th>
				<th style="width:50%">Title</th>
				<th style="width:10%">Actions</th>
			</tr>
		</thead>
		<tbody id="playlist-item-list">
			<?php foreach($playlists as $playlist) : ?>
				<tr class="wpsvp-playlist-row playlist-item">
					<td><?php echo($playlist['id']); ?></td>							
					<td><input type="text" name="title" class="title-editable playlist-title" data-title="<?php echo(htmlspecialchars($playlist['title'])); ?>" value="<?php echo(htmlspecialchars($playlist['title'])); ?>" data-playlist-id="<?php echo($playlist['id']); ?>"/></td>
					<td><a href='<?php echo admin_url("admin.php?page=wpsvp_playlist_manager&action=edit_playlist&playlist_id=".$playlist['id']); ?>' title='Edit playlist'>Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='admin.php?page=wpsvp_playlist_manager&action=duplicate_playlist&playlist_id=<?php echo($playlist['id']); ?>' title='Duplicate playlist' onclick="return wpsvp_duplicatePlaylist('Enter title for new playlist:', this)">Duplicate</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="wpsvp-export-playlist-btn" data-playlist-id="<?php echo($playlist['id']); ?>" href='admin.php?page=wpsvp_playlist_manager&action=export_playlist&playlist_id=<?php echo($playlist['id']); ?>' title='Export playlist'>Export</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='<?php echo admin_url("admin.php?page=wpsvp_playlist_manager&action=delete_playlist&playlist_id=".$playlist['id']); ?>' title='Delete playlist' onclick="return confirm('Are you sure you want to delete playlist <?php echo($playlist['title']); ?> ?')" style="color:#f00;">Delete</a></td>
				</tr>
			<?php endforeach; ?>	

			<script type="text/javascript">
				function wpsvp_duplicatePlaylist(msg, target){
					var title = prompt(msg);

					if(title == null){//cancel
			        	return false;
			        }else if(title.replace(/^\s+|\s+$/g, '').length == 0) {//empty
			            wpsvp_duplicatePlaylist(msg, target);
			            return false;
			        }else{
			        	$(target).attr('href', target.getAttribute("href")+'&playlist_title='+title);//send title
			        	return true;
			        }
				}
			</script>

		</tbody>		 
	</table>

	<div class="wpsvp-actions">		
  		<a class='button-primary' href='<?php echo admin_url("admin.php?page=wpsvp_playlist_manager&action=add_playlist"); ?>'>Add New Playlist</a> 
  		<form id="wpsvp-import-playlist-form" action="" method="POST" enctype="multipart/form-data">
  			<?php wp_nonce_field('wpsvp-import-playlist-nonce'); ?>
	  		<input type="file" id="wpsvp-file-input">
	  		<a class='button-secondary' href='#' id="wpsvp-import-playlist" title="Using Import Playlist requires FILE user permission in database.">Import Playlist</a> 
		  	<a class='button-secondary' href='#' id="wpsvp-import-playlist-local" title="Using Import Playlist Local requires local-infile=1 in my.cnf (or mysql configuration file on system).">Import Playlist Local</a> 
	  	</form>
	  	<p class='button-secondary' href='#' id="wpsvp-import-playlist-loader">Working<span>.</span><span>.</span><span>.</span></p> 
    </div>

</div>
