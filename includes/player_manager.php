<?php



if(isset($_POST['save_options']) && check_admin_referer("wpsvp_edit_player_action", "wpsvp_edit_player_nonce_field")){

	if(isset($_POST['player_id'])){//edit player

		$player_id = $_POST['player_id'];
		$title = stripslashes($_POST['title']);

		$options = array();
		//get all options from post
		foreach($_POST as $key => $value){
			if($key != 'save_options' && $key != 'wpsvp_edit_player_nonce_field' && $key != '_wp_http_referer'){//exclude defaults
				if(is_string($value))$value = wpsvp_removeSlashes($value);
				$options[$key] = $value;
			}
		}

	    $stmt = $wpdb->update(
	    	$player_table,
			array('title' => $title,'options' => serialize($options)), 
			array('id' => $player_id),
			array('%s','%s'),
			array('%d')
	    );

	}else{//add new player

		$title = stripslashes($_POST['title']);

		$options = array();
		//get all options from post
		foreach($_POST as $key => $value){
			if($key != 'save_options' && $key != 'wpsvp_edit_player_nonce_field' && $key != '_wp_http_referer'){//exclude defaults
				if(is_string($value))$value = wpsvp_removeSlashes($value);
				$options[$key] = $value;
			}
		}

		$stmt = $wpdb->insert(
	    	$player_table,
			array( 
				'title' => $title,
				'options' => serialize($options)
			), 
			array( 
				'%s',
				'%s'				
			) 
	    );

	}

    if($stmt !== false){
		$msg = 'Success!';
	}else{
		$msge = 'Error occured!';	
	}

}
else if(isset($_GET['action']) && isset($_GET['player_id'])){//delete player

	$action = $_GET['action'];
    $player_id = $_GET['player_id'];

    if($action == 'delete_player'){

    	$stmt = $wpdb->query($wpdb->prepare("DELETE FROM {$player_table} WHERE id = %d", $player_id));

	}else if($action == 'duplicate_player' && isset($_GET['player_title'])){//duplicate player

		$options = $wpdb->get_var($wpdb->prepare("SELECT options FROM {$player_table} WHERE id = %d", $player_id));
		
		if($options !== false){

			$title = stripslashes($_GET['player_title']);

		    $stmt = $wpdb->insert(//copy player
		    	$player_table,
				array( 
					'title' => $title,
					'options' => $options
				), 
				array( 
					'%s',
					'%s'				
				) 
		    );

		}
	}

	if($stmt !== false){
		$msg = 'Success!';
	}else{
		$msge = 'Error occured!';	
	}
}


//load players
$players = $wpdb->get_results("SELECT id, title FROM {$player_table} ORDER BY title ASC", ARRAY_A);

?>


<div class="wrap" align="center">

	<?php include("notice.php"); ?>

	<h2>Manage Players</h2>

	<p>From this section you can create and edit players. You can change player name by clicking on title row.</p>

	<div class="list-actions" align="center">
  		<input type="text" id="filter-player" style = "width: 300px;" placeholder="Search by title..">
    </div>

	<table class='wpsvp-table wp-list-table widefat'>
		<thead>
			<tr>
				<th style="width:5%">ID</th>
				<th style="width:50%">Title</th>
				<th style="width:10%">Actions</th>
			</tr>
		</thead>
		<tbody id="player-item-list">
			<?php foreach($players as $player) : ?>
				<tr class="player-item">
					<td><?php echo($player['id']); ?></td>							
					<td><input type="text" name="title" class="title-editable player-title" data-title="<?php echo(htmlspecialchars($player['title'])); ?>" value="<?php echo(htmlspecialchars($player['title'])); ?>" data-player-id="<?php echo($player['id']); ?>"/></td>
					<td><a href='admin.php?page=wpsvp_player_manager&action=edit_player&player_id=<?php echo($player['id']); ?>' title='Edit player'>Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='admin.php?page=wpsvp_player_manager&action=duplicate_player&player_id=<?php echo($player['id']); ?>' title='Duplicate player' onclick="return wpsvp_duplicatePlayer('Enter title for new player:', this)">Duplicate</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='admin.php?page=wpsvp_player_manager&action=delete_player&player_id=<?php echo($player['id']); ?>' title='Delete player' onclick="return confirm('Are you sure you want to delete player <?php echo($player['title']); ?> ?')" style="color:#f00;">Delete</a></td>
				</tr>
			<?php endforeach; ?>	

			<script type="text/javascript">
				function wpsvp_duplicatePlayer(msg, target){
					var title = prompt(msg);

					if(title == null){//cancel
			        	return false;
			        }else if(title.replace(/^\s+|\s+$/g, '').length == 0) {//empty
			            wpsvp_duplicatePlayer(msg, target);
			            return false;
			        }else{
			        	$(target).attr('href', target.getAttribute("href")+'&player_title='+title);//send title
			        	return true;
			        }
				}
			</script>

		</tbody>		 
	</table>

	<p align = "center">			
		<a class='button-primary' href='<?php echo admin_url("admin.php?page=wpsvp_player_manager&action=add_player"); ?>'>Add New Player</a> 
	</p>    
	
</div>

