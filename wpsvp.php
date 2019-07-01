<?php

/*
Plugin Name: Wiz PS Video Player
Plugin URI: 
Description: Wiz PS Video Player
Version: 1.0
Author: Vizyp
Author URI: https://www.vizyp.com/
*/

	if(!defined('ABSPATH'))exit;// Exit if accessed directly

	if(!defined('WPSVP_FILE_DIR'))define('WPSVP_FILE_DIR', WP_CONTENT_DIR . '/uploads/wpsvp-file-dir/');
	if(!defined('WPSVP_CAPABILITY'))define('WPSVP_CAPABILITY', 'manage_options');
	if(!defined('WPSVP_BSF_MATCH'))define('WPSVP_BSF_MATCH', 'ebsfm:');//encrypt self hosted media and subtitles (not folders)

	include(dirname(__FILE__) . '/includes/utils.php');

	if(is_admin()){

		register_activation_hook(__FILE__, 'wpsvp_player_activate'); 
		//register_deactivation_hook(__FILE__, 'wpsvp_player_deactivate'); 

		add_action('admin_menu', 'wpsvp_admin_menu');
		add_action('plugins_loaded', 'wpsvp_plugins_loaded');

		add_action('wp_ajax_wpsvp_update_media_order', 'wpsvp_update_media_order');
		add_action('wp_ajax_wpsvp_edit_player_title', 'wpsvp_edit_player_title');
		add_action('wp_ajax_wpsvp_edit_playlist_title', 'wpsvp_edit_playlist_title');
		add_action('wp_ajax_wpsvp_load_playlists', 'wpsvp_load_playlists');

		add_action('wp_ajax_wpsvp_delete_media', 'wpsvp_delete_media');
		add_action('wp_ajax_wpsvp_copy_media', 'wpsvp_copy_media');
		add_action('wp_ajax_wpsvp_move_media', 'wpsvp_move_media');

		add_action('wp_ajax_wpsvp_export_playlist', 'wpsvp_export_playlist');
		add_action('wp_ajax_wpsvp_import_playlist', 'wpsvp_import_playlist');

		add_filter('widget_text', 'do_shortcode');

	}else{

		include(dirname(__FILE__) . '/includes/html_markup.php');
		include(dirname(__FILE__) . '/includes/shortcode.php');

		add_shortcode('apwpsvp', 'wpsvp_add_player');
		add_action('wp_enqueue_scripts', 'wpsvp_enqueue_scripts');

		add_filter('wp_video_shortcode_override', 'wpsvp_video_shortcode_override', 10, 2 );

	}

	function wpsvp_video_shortcode_override( $html, $attr ) {

		if(isset($attr['mp4'])){
			$attr['type'] = 'video';
			$attr['path'] = $attr['mp4'];
			$attr['playlist_position'] = 'no-playlist';
			return wpsvp_add_player($attr);
		}else{
			return "No video mp4 source set!";
		}

	};

	function wpsvp_admin_menu(){

		$menu = add_menu_page("Wiz PS Video Player Player manager", "Wiz PS Video Player", WPSVP_CAPABILITY, "wpsvp_player_manager", "wpsvp_player_manager_page", 'dashicons-playlist-video');

		//$submenu = add_submenu_page("wpsvp_settings", "Wiz PS Video Player Settings", "General Settings", WPSVP_CAPABILITY, 'wpsvp_settings', "wpsvp_settings_page");
		$submenu2 = add_submenu_page("wpsvp_player_manager", "Wiz PS Video Player Player manager", "Player manager", WPSVP_CAPABILITY, 'wpsvp_player_manager', "wpsvp_player_manager_page");	
		$submenu3 = add_submenu_page("wpsvp_player_manager", "Wiz PS Video Player Playlist manager", "Playlist manager", WPSVP_CAPABILITY, 'wpsvp_playlist_manager', 'wpsvp_playlist_manager_page');
		$submenu4 = add_submenu_page("wpsvp_player_manager", "Wiz PS Video Player Shortcodes", "Shortcodes", WPSVP_CAPABILITY, 'wpsvp_shortcodes', 'wpsvp_shortcodes_page');
		//$submenu5 = add_submenu_page("wpsvp_player_manager", "Wiz PS Video Player Demo", "Demos", WPSVP_CAPABILITY, 'wpsvp_demo', 'wpsvp_demo_page');

		add_action( 'load-' . $menu, 'wpsvp_admin_enqueue_scripts' );
		//add_action( 'load-' . $submenu, 'wpsvp_admin_enqueue_scripts' );
		add_action( 'load-' . $submenu2, 'wpsvp_admin_enqueue_scripts' );
		add_action( 'load-' . $submenu3, 'wpsvp_admin_enqueue_scripts' );
		add_action( 'load-' . $submenu4, 'wpsvp_admin_enqueue_scripts' );
		//add_action( 'load-' . $submenu5, 'wpsvp_admin_enqueue_scripts' );

	}

	function wpsvp_player_manager_page(){

		global $wpdb;
		$wpdb->show_errors(); 
		$player_table = $wpdb->prefix . "wpsvp_players";
		$playlist_table = $wpdb->prefix . "wpsvp_playlists";

		$action = "";
		if(isset($_GET['action'])){
			$action = $_GET['action'];
		}

		switch($action) {
		
			case 'add_player':
			case 'edit_player':
				include("includes/edit_player.php");
				break;

			case 'save_options':
			case 'delete_player':
			default:
				include("includes/player_manager.php");
				break;
				
		}
		
	}

	function wpsvp_playlist_manager_page(){
		
		global $wpdb;
		$wpdb->show_errors(); 
		$playlist_table = $wpdb->prefix . "wpsvp_playlists";
		$media_table = $wpdb->prefix . "wpsvp_media";
		$ad_table = $wpdb->prefix . "wpsvp_ad";
		$annotation_table = $wpdb->prefix . "wpsvp_annotation";
		$path_table = $wpdb->prefix . "wpsvp_path";
		$subtitle_table = $wpdb->prefix . "wpsvp_subtitle";
		$taxonomy_table = $wpdb->prefix . "wpsvp_taxonomy";

		$action = "";
		if(isset($_GET['action'])){
			$action = $_GET['action'];
		}

		switch($action) {
		
			case 'add_playlist':
				include("includes/add_playlist.php");
				break;
			
			case 'edit_playlist':
			case 'add_media_form':
			case 'delete_media':
				include("includes/edit_playlist.php");
				break;

			case 'delete_playlist':
				include("includes/playlist_manager.php");
				break;

			case 'add_media':
			case 'edit_media':
				include("includes/add_media.php");
				break;

			default:
				include("includes/playlist_manager.php");
				break;
				
		}

	}

	function wpsvp_settings_page(){

		global $wpdb;
		$wpdb->show_errors(); 
		$settings_table = $wpdb->prefix . "wpsvp_settings";

		include("includes/settings.php");
	}

	function wpsvp_shortcodes_page(){

		global $wpdb;
		$wpdb->show_errors(); 
		$player_table = $wpdb->prefix . "wpsvp_players";
		$playlist_table = $wpdb->prefix . "wpsvp_playlists";

		include("includes/shortcode_manager.php");
	}

	function wpsvp_demo_page(){

		global $wpdb;
		$wpdb->show_errors(); 

		include("includes/demo.php");
	}

	

	function wpsvp_admin_enqueue_scripts() {

		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_media();

		wp_enqueue_style("wpsvp-spectrum-css", plugins_url('/css/spectrum.css', __FILE__));
		wp_enqueue_script("wpsvp-spectrum-js", plugins_url('/js/spectrum.js', __FILE__), array('jquery'));	

		wp_enqueue_style('wpsvp-admin-css', plugins_url('/css/admin.css', __FILE__));	
		wp_enqueue_script('wpsvp-admin-js', plugins_url('/js/admin.js', __FILE__), array('jquery', 'jquery-ui-sortable'));

		wp_localize_script('wpsvp-admin-js', 'wpsvp_data', array('plugins_url' => plugins_url('', __FILE__), 'ajax_url' => admin_url( 'admin-ajax.php'))); 
	}

	function wpsvp_enqueue_scripts() {

		wp_enqueue_style('wpsvp-icons', plugins_url('/source/css/font-awesome.css', __FILE__));//icons 
		wp_enqueue_style('wpsvp-style', plugins_url('/source/css/wpsvp.css', __FILE__));//main css
		wp_enqueue_script('wpsvp-main', plugins_url('/source/js/new.js', __FILE__), array('jquery'));//main js

	}

	//############################################//
	/* ajax */
	//############################################//

	function wpsvp_update_media_order(){

		if(isset($_POST['media_id_arr']) && isset($_POST['order_id_arr']) && isset($_POST['playlist_id'])){

			$media_id_arr = explode(",",$_POST["media_id_arr"]);
			$order_id_arr = explode(",",$_POST["order_id_arr"]);
			$playlist_id = $_POST["playlist_id"];

			global $wpdb;
			$wpdb->show_errors(); 

		    $media_table = $wpdb->prefix . "wpsvp_media";

		    for($i=0;$i<count($media_id_arr);$i++) {

		        $wpdb->update(
			    	$media_table,
					array( 
						'order_id' => $order_id_arr[$i]
					), 
					array('playlist_id' => $playlist_id, 'id' => $media_id_arr[$i]),
					array( 
						'%d'
					),
					array( 
						'%d','%d'
					) 
			    );

		    }

		    wp_die();

		}
	}

	function wpsvp_edit_player_title(){

		if(isset($_POST['title']) && isset($_POST['id'])){

			$title = stripcslashes($_POST["title"]);
			$id = $_POST["id"];

			global $wpdb;
		    $player_table = $wpdb->prefix . "wpsvp_players";

		    $wpdb->update(
		    	$player_table,
				array( 
					'title' => $title
				), 
				array('id' => $id),
				array( 
					'%s'
				),
				array( 
					'%d'
				) 
		    );

		    wp_die();

		}
	}

	function wpsvp_edit_playlist_title(){

		if(isset($_POST['title']) && isset($_POST['id'])){

			$title = stripcslashes($_POST["title"]);
			$id = $_POST["id"];

			global $wpdb;
		    $playlist_table = $wpdb->prefix . "wpsvp_playlists";

		    $wpdb->update(
		    	$playlist_table,
				array( 
					'title' => $title
				), 
				array('id' => $id),
				array( 
					'%s'
				),
				array( 
					'%d'
				) 
		    );

		    wp_die();

		}
	}

	function wpsvp_load_playlists(){

		header("Content-Type: application/json");

		if(isset($_POST['playlist_id'])){

			$playlist_id = $_POST['playlist_id'];

			global $wpdb;
			$wpdb->show_errors(); 
		    $playlist_table = $wpdb->prefix . "wpsvp_playlists";

		    //load select playlists

			if(!empty($playlist_id)){

				$ids = explode(',',$playlist_id);
				$in = implode(',', array_fill(0, count($ids), '%d'));

			    $query = "SELECT id, title FROM {$playlist_table} WHERE id IN ($in) ORDER BY title ASC";
			    $stmt = $wpdb->get_results($wpdb->prepare($query, $ids), ARRAY_A);

			}else{
			    $stmt = $wpdb->get_results("SELECT id, title FROM {$playlist_table} ORDER BY title ASC", ARRAY_A);
			}

		    if($stmt !== false){
	    		echo json_encode($stmt);
	    		wp_die();
	    	}else{
				wp_die();
	    	}

		}else{
			wp_die();
		}
	}


	function wpsvp_delete_media(){

		header("Content-Type: application/json");

		if(isset($_POST['media_id'])){

			$media_id = $_POST['media_id'];

			global $wpdb;
			$wpdb->show_errors(); 
		    $media_table = $wpdb->prefix . "wpsvp_media";

			$ids = explode(',',$media_id);
			$in = implode(',', array_fill(0, count($ids), '%d'));

		    $stmt = $wpdb->query($wpdb->prepare("DELETE FROM {$media_table} WHERE id IN ($in)", $ids));

			if($stmt !== false){
	    		echo json_encode($stmt);
	    	}

	    	wp_die();
	    	
		}else{
			wp_die();
		}
	}

	function wpsvp_copy_media(){

		header("Content-Type: application/json");

		if(isset($_POST['media_id']) && isset($_POST['destination_playlist_id'])){

			$media_id = $_POST['media_id'];
			$lastid = $_POST['destination_playlist_id'];

			global $wpdb;
			$wpdb->show_errors(); 
		    $media_table = $wpdb->prefix . "wpsvp_media";
		    $ad_table = $wpdb->prefix . "wpsvp_ad";
			$annotation_table = $wpdb->prefix . "wpsvp_annotation";
			$path_table = $wpdb->prefix . "wpsvp_path";
			$subtitle_table = $wpdb->prefix . "wpsvp_subtitle";
			$taxonomy_table = $wpdb->prefix . "wpsvp_taxonomy";

			$ids = explode(',',$media_id);

			//get order
		    $stmt = $wpdb->get_row($wpdb->prepare("SELECT IFNULL(MAX(order_id)+1,0) AS order_id FROM {$media_table} WHERE playlist_id = %d", $lastid), ARRAY_A);
	        $order_id = $stmt['order_id'];

	        $tn = 'wpsvp_temp_table'.time();

			foreach ($ids as $id) {
				//copy track by track
				$stmt = $wpdb->query($wpdb->prepare("CREATE TEMPORARY TABLE {$tn} SELECT * FROM $media_table WHERE id=%d", $id));

				if($stmt !== false){

					$wpdb->query("UPDATE {$tn} SET id=NULL, order_id=$order_id, playlist_id='$lastid'");//update playlist id
					$wpdb->query("INSERT INTO $media_table SELECT * FROM {$tn}");
					$last_media_insert_id = $wpdb->insert_id;//media_id
					$wpdb->query("DROP TABLE {$tn}");

					//copy path

					$wpdb->query($wpdb->prepare("CREATE TEMPORARY TABLE {$tn} SELECT * FROM $path_table WHERE media_id=%d", $id));
					$wpdb->query("UPDATE {$tn} SET id=NULL, media_id='$last_media_insert_id'");//update media id
					$wpdb->query("INSERT INTO $path_table SELECT * FROM {$tn}");
					$wpdb->query("DROP TABLE {$tn}");

					//copy subtitles

					$wpdb->query($wpdb->prepare("CREATE TEMPORARY TABLE {$tn} SELECT * FROM $subtitle_table WHERE media_id=%d", $id));
					$wpdb->query("UPDATE {$tn} SET id=NULL, media_id='$last_media_insert_id'");//update media id
					$wpdb->query("INSERT INTO $subtitle_table SELECT * FROM {$tn}");
					$wpdb->query("DROP TABLE {$tn}");

					//copy taxonomy

					$wpdb->query($wpdb->prepare("CREATE TEMPORARY TABLE {$tn} SELECT * FROM $taxonomy_table WHERE media_id=%d", $id));
					$wpdb->query("UPDATE {$tn} SET id=NULL, media_id='$last_media_insert_id'");//update media id
					$wpdb->query("INSERT INTO $taxonomy_table SELECT * FROM {$tn}");
					$wpdb->query("DROP TABLE {$tn}");

					//copy ads

					//media ads
					$wpdb->query($wpdb->prepare("CREATE TEMPORARY TABLE {$tn} SELECT * FROM $ad_table WHERE media_id=%d", $id));
					$wpdb->query("UPDATE {$tn} SET id=NULL, media_id='$last_media_insert_id'");//update media id
					$wpdb->query("INSERT INTO $ad_table SELECT * FROM {$tn}");
					$wpdb->query("DROP TABLE {$tn}");

					//copy annotations

					//media annotations
					$wpdb->query($wpdb->prepare("CREATE TEMPORARY TABLE {$tn} SELECT * FROM $annotation_table WHERE media_id=%d", $id));
					$wpdb->query("UPDATE {$tn} SET id=NULL, media_id='$last_media_insert_id'");//update media id
					$wpdb->query("INSERT INTO $annotation_table SELECT * FROM {$tn}");
					$wpdb->query("DROP TABLE {$tn}");

				}

				$order_id++;
			}

			if($stmt !== false){
	    		echo json_encode($stmt);
	    	}

	    	wp_die();
	    	
		}else{
			wp_die();
		}
	}

	function wpsvp_move_media(){

		header("Content-Type: application/json");

		if(isset($_POST['media_id']) && isset($_POST['destination_playlist_id'])){

			$media_id = $_POST['media_id'];
			$destination_playlist_id = $_POST['destination_playlist_id'];

			global $wpdb;
			$wpdb->show_errors(); 
		    $media_table = $wpdb->prefix . "wpsvp_media";

			$ids = explode(',',$media_id);
			$in = implode(',', array_fill(0, count($ids), '%d'));

			//only update playlist_id

			$stmt = $wpdb->query($wpdb->prepare("UPDATE {$media_table} SET playlist_id = $destination_playlist_id WHERE id IN ($in)", $ids));

			if($stmt !== false){
	    		echo json_encode($stmt);
	    	}

	    	wp_die();
	    	
		}else{
			wp_die();
		}
	}

	function wpsvp_export_playlist(){

		if(isset($_POST['playlist_id']) && isset($_POST['playlist_title'])){

			$playlist_id = $_POST['playlist_id'];
			$playlist_title = $_POST['playlist_title'];

			global $wpdb;
			$wpdb->show_errors(); 

		    $playlist_table = $wpdb->prefix . "wpsvp_playlists";
			$media_table = $wpdb->prefix . "wpsvp_media";
			$ad_table = $wpdb->prefix . "wpsvp_ad";
			$annotation_table = $wpdb->prefix . "wpsvp_annotation";
			$path_table = $wpdb->prefix . "wpsvp_path";
			$subtitle_table = $wpdb->prefix . "wpsvp_subtitle";
			$taxonomy_table = $wpdb->prefix . "wpsvp_taxonomy";

			// create zip file
			$zipname = 'wpsvp_playlist_id_'.$playlist_id.'_'.$playlist_title.'_'.date('m-d-Y_hia').'.zip';
			$zip = new ZipArchive;
			$zip->open($zipname, ZipArchive::CREATE);


			//playlist
			$stmt = $wpdb->prepare("SELECT * FROM {$playlist_table} WHERE id = %d", $playlist_id);
			$result = $wpdb->get_results($stmt, ARRAY_N);
			wpsvp_getOutput($playlist_table, $result, $zip);

			//media 
			$stmt = $wpdb->prepare("SELECT * FROM {$media_table} WHERE playlist_id = %d", $playlist_id);
			$result = $wpdb->get_results($stmt, ARRAY_A);

			if($wpdb->num_rows > 0){
				wpsvp_getOutput($media_table, $result, $zip);

				$ids = array();
				foreach($result as $row){
				    $ids[] = $row['id'];
				}
				$in = implode(',', array_fill(0, count($ids), '%d'));

				//path
				$stmt = $wpdb->prepare("SELECT * FROM {$path_table} WHERE media_id IN ($in)", $ids);
				$result = $wpdb->get_results($stmt, ARRAY_N);
				wpsvp_getOutput($path_table, $result, $zip);

				//subtitle
				$stmt = $wpdb->prepare("SELECT * FROM {$subtitle_table} WHERE media_id IN ($in)", $ids);
				$result = $wpdb->get_results($stmt, ARRAY_N);
				wpsvp_getOutput($subtitle_table, $result, $zip);

				//taxonomy
				$stmt = $wpdb->prepare("SELECT * FROM {$taxonomy_table} WHERE media_id IN ($in)", $ids);
				$result = $wpdb->get_results($stmt, ARRAY_N);
				wpsvp_getOutput($taxonomy_table, $result, $zip);

				$ids[] = $playlist_id;

				//ad
				$stmt = $wpdb->prepare("SELECT * FROM {$ad_table} WHERE media_id IN ($in) OR playlist_id = %d", $ids);
				$result = $wpdb->get_results($stmt, ARRAY_N);
				wpsvp_getOutput($ad_table, $result, $zip);

				//annotation
				$stmt = $wpdb->prepare("SELECT * FROM {$annotation_table} WHERE media_id IN ($in) OR playlist_id = %d", $ids);
				$result = $wpdb->get_results($stmt, ARRAY_N);
				wpsvp_getOutput($annotation_table, $result, $zip);

			}

			// close the archive
			$zip->close();

			echo json_encode(array('zip' => $zipname));

	    	wp_die();
	    	
		}else{
			wp_die();
		}
	}

	function wpsvp_getOutput($table, $result, $zip){

	    // create a temporary file
	    $size = 1 * 1024 * 1024;
	    $fp = fopen('php://temp/maxmemory:$size', 'w');
	    if (false === $fp) {
	        die('Failed to create temporary file');
	    }

	    //column names
	    /*$num_fields = mysqli_num_fields($result);

	    $headers = array();
	    for ($i = 0; $i < $num_fields; $i++) {
	        $headers[] = mysqli_fetch_field_direct($result, $i)->name;
	    }*/

	    foreach($result as $row){
	      
	        $trimmed_array = array_map('trim',array_values($row));
	        $line = str_replace('^', '', $trimmed_array);
	        fputcsv($fp, $line, '|','^');
	                
	    }

	    // return to the start of the stream
	    rewind($fp);

	    // add the in-memory file to the archive, giving a name
	    $zip->addFromString($table.'.csv', stream_get_contents($fp) );
	    //close the file
	    fclose($fp);

	}

	function wpsvp_import_playlist(){

		if(check_ajax_referer('wpsvp-import-playlist-nonce', 'nonce')){

			header("Content-Type: application/json");

			$posted_data =  isset( $_POST ) ? $_POST : array();
			$file_data = isset( $_FILES ) ? $_FILES : array();

			$data = array_merge( $posted_data, $file_data );

			$fileName = $data["wpsvp_file_upload"]["name"];
			$temp_name = $data["wpsvp_file_upload"]["tmp_name"];
			$fileError = $data["wpsvp_file_upload"]["error"];
			$upload_path = WPSVP_FILE_DIR."/plzip/";
			$local = $data['local'];

			if(!file_exists($upload_path))wp_mkdir_p($upload_path);

			$response = array();

			if($fileError > 0){

				$error = array(
					0 => "There is no error, the file uploaded with success",
					1 => "The uploaded file exceeds the upload_max_files in server settings",
					2 => "The uploaded file exceeds the MAX_FILE_SIZE from html form",
					3 => "The uploaded file uploaded only partially",
					4 => "No file was uploaded",
					6 => "Missing a temporary folder",
					7 => "Failed to write file to disk",
					8 => "A PHP extension stoped file to upload" );

				$response["response"] = "ERROR";
	            $response["error"] = $error[ $fileError ];

			} else {

				if( move_uploaded_file( $temp_name, $upload_path.$fileName ) ){
		            		
					//unzip

		            WP_Filesystem();

		            $unzipfile = unzip_file( $upload_path.$fileName, $upload_path);
					   
				    if ( is_wp_error( $unzipfile ) ) {
				    	$response["response"] = "ERROR";
				        $response["error"] = 'There was an error unzipping the file.'; 
				    } else {
				    	$response["response"] = "SUCCESS";



				        //process csv

				        global $wpdb;
						$wpdb->show_errors(); 
						$playlist_table = $wpdb->prefix . "wpsvp_playlists";
						$media_table = $wpdb->prefix . "wpsvp_media";
						$ad_table = $wpdb->prefix . "wpsvp_ad";
						$annotation_table = $wpdb->prefix . "wpsvp_annotation";
						$path_table = $wpdb->prefix . "wpsvp_path";
						$subtitle_table = $wpdb->prefix . "wpsvp_subtitle";
						$taxonomy_table = $wpdb->prefix . "wpsvp_taxonomy";

				        //playlists
					    $csv = str_replace('\\', '/', $upload_path.$playlist_table.'.csv');
					    if(!file_exists($csv)){//in case wrong zip is uploaded (check only one file)
					    	$response["response"] = "ERROR";
	            			$response["error"] = "No playlist file inside archive!";
	            			echo json_encode( $response );
							die();
					    } 
					    $playlists_temp = 'playlists_temp'.time();

					    $sql = "CREATE TEMPORARY TABLE {$playlists_temp} (
					      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					      `title` varchar(255) NOT NULL,
					      `options` text,
					      PRIMARY KEY (`id`)
					    ) ENGINE=InnoDB";
						$wpdb->query($sql);

					    $sql = "LOAD DATA {$local} INFILE '$csv' INTO TABLE {$playlists_temp}
					              FIELDS OPTIONALLY ENCLOSED BY '^'
					              TERMINATED BY '|'
					              ESCAPED BY ''
					              LINES TERMINATED BY '\n'
					              (id, title, @voptions)
					              SET options = nullif(@voptions,'')";//https://stackoverflow.com/questions/2675323/mysql-load-null-values-from-csv-data
					    $wpdb->query($sql);  

					    $old_playlist_id = $wpdb->get_var("SELECT id from {$playlists_temp} LIMIT 1");
					    //var_dump($old_playlist_id);
					    $wpdb->query("UPDATE {$playlists_temp} SET id=NULL");  
					    $wpdb->query("INSERT INTO $playlist_table SELECT * FROM {$playlists_temp}");  
					    $last_playlist_id = $wpdb->insert_id;
					    //var_dump($last_playlist_id);
   						$wpdb->query("DROP TABLE {$playlists_temp}"); 



					   	//media
					    $csv = str_replace('\\', '/', $upload_path.$media_table.'.csv');
					    $media_temp = 'media_temp'.time();

					    $sql = "CREATE TEMPORARY TABLE {$media_temp} (
					      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					      `type` varchar(255) NOT NULL,
					      `title` varchar(255) DEFAULT NULL,
					      `description` varchar(1000) DEFAULT NULL,
					      `limit` smallint(11) unsigned DEFAULT NULL,
					      `share` varchar(300) DEFAULT NULL,
					      `download` varchar(300) DEFAULT NULL,
					      `thumb` varchar(300) DEFAULT NULL,
					      `poster` varchar(300) DEFAULT NULL,
					      `poster_frame_time` decimal(2,1) DEFAULT NULL,
					      `start` smallint(11) unsigned DEFAULT NULL,
					      `end` smallint(11) unsigned DEFAULT NULL,
					      `random_clip_time` decimal(4,2) DEFAULT NULL,
					      `playback_rate` decimal(2,1) DEFAULT NULL,
					      `width` smallint(11) unsigned DEFAULT NULL,
					      `height` smallint(11) unsigned DEFAULT NULL,
					      `noapi` tinyint(1) unsigned DEFAULT NULL,
					      `user_id` varchar(100) DEFAULT NULL,
					      `load_more` tinyint(1) unsigned DEFAULT NULL,
					      `is360` tinyint(1) unsigned DEFAULT NULL,
					      `preview_seek` varchar(300) DEFAULT NULL,
					      `upnext` tinyint(1) unsigned DEFAULT NULL,
					      `upnext_time` smallint(11) unsigned DEFAULT NULL,
					      `chapters` text,
					      `disable_adverts` tinyint(1) unsigned DEFAULT NULL,
					      `disable_annotations` tinyint(1) unsigned DEFAULT NULL,
					      `custom_content` text,
					      `end_link` varchar(100) DEFAULT NULL,
					      `end_target` varchar(10) DEFAULT NULL,
					      `sort_type` varchar(20) DEFAULT NULL,
					      `sort_dir` varchar(10) DEFAULT NULL,
					      `pwd` varchar(100) DEFAULT NULL,
					      `alt_text` varchar(100) DEFAULT NULL,
					      `hover_preview` varchar(100) DEFAULT NULL,
					      `order_id` smallint(11) unsigned DEFAULT NULL,
					      `playlist_id` smallint(11) unsigned NOT NULL,
					      PRIMARY KEY (`id`)
					    ) ENGINE=InnoDB";
					    $wpdb->query($sql);

					    $sql = "LOAD DATA {$local} INFILE '$csv' INTO TABLE {$media_temp}
					              FIELDS OPTIONALLY ENCLOSED BY '^'
					              TERMINATED BY '|'
					              ESCAPED BY ''
					              LINES TERMINATED BY '\n'
					              (id, type, @vtitle, @vdescription, @vlimit, @vshare, @vdownload, @vthumb, @vposter, @vposter_frame_time, @vstart, @vend, @random_clip_time, @vplayback_rate, @vwidth, @vheight, @vnoapi, @vuser_id, @vload_more, @vis360, @vpreview_seek, @vupnext, @vupnext_time, @vchapters, @vdisable_adverts, @vdisable_annotations, @vcustom_content, @vend_link, @vend_target, @vsort_type, @vsort_dir, @vpwd, @valt_text, @vhover_preview, order_id, playlist_id)
					              SET  title = nullif(@vtitle,''),
					                   description = nullif(@vdescription,''),
					                   `limit` = nullif(@vlimit,''),
					                   share = nullif(@vshare,''),
					                   download = nullif(@vdownload,''),
					                   thumb = nullif(@vthumb,''),
					                   poster = nullif(@vposter,''),
					                   poster_frame_time = nullif(@vposter_frame_time,''),
					                   start = nullif(@vstart,''),
					                   end = nullif(@vend,''),
					                   random_clip_time = nullif(@vrandom_clip_time,''),
					                   playback_rate = nullif(@vplayback_rate,''),
					                   width = nullif(@vwidth,''),
					                   height = nullif(@vheight,''),
					                   noapi = nullif(@vnoapi,''),
					                   user_id = nullif(@vuser_id,''),
					                   load_more = nullif(@vload_more,''),
					                   is360 = nullif(@vis360,''),
					                   preview_seek = nullif(@vpreview_seek,''),
					                   upnext = nullif(@vupnext,''),
					                   upnext_time = nullif(@vupnext_time,''),
					                   chapters = nullif(@vchapters,''),
					                   disable_adverts = nullif(@vdisable_adverts,''),
					                   disable_annotations = nullif(@vdisable_annotations,''),
					                   custom_content = nullif(@vcustom_content,''),
					                   end_link = nullif(@vend_link,''),
					                   end_target = nullif(@vend_target,''),
					                   sort_type = nullif(@vsort_type,''),
					                   sort_dir = nullif(@vsort_dir,''),
					                   pwd = nullif(@vpwd,''),
					                   alt_text = nullif(@valt_text,''),
					                   hover_preview = nullif(@vhover_preview,'')";
					    $wpdb->query($sql); 

					    //select all media id
					    $stmt = $wpdb->get_results("SELECT id FROM {$media_temp}", ARRAY_A);    
					    $ids = array();
					    foreach($stmt as $m){
					        $ids[] = $m['id'];
					    }

					    //path

					    $csv = str_replace('\\', '/', $upload_path.$path_table.'.csv');
					    $path_temp = 'path_temp'.time();

					    $sql = "CREATE TEMPORARY TABLE {$path_temp} (
					      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					      `quality_title` varchar(255) DEFAULT NULL,
					      `path` varchar(300) NOT NULL,
					      `def` varchar(50) DEFAULT NULL,
					      `mp4` varchar(300) DEFAULT NULL,
					      `media_id` int(11) unsigned NOT NULL,
					      PRIMARY KEY (`id`)
					    ) ENGINE=InnoDB";
					    $wpdb->query($sql); 

					    $sql = "LOAD DATA {$local} INFILE '$csv' INTO TABLE {$path_temp}
					              FIELDS OPTIONALLY ENCLOSED BY '^'
					              TERMINATED BY '|'
					              ESCAPED BY ''
					              LINES TERMINATED BY '\n'
					              (id, @vquality_title, path, @vdef, @vmp4, media_id)
					              SET quality_title = nullif(@vquality_title,''),
					                  def = nullif(@vdef,''),
					                  mp4 = nullif(@vmp4,'')";
					    $wpdb->query($sql);     

					    //subtitle

					    $csv = str_replace('\\', '/', $upload_path.$subtitle_table.'.csv');
					    $subtitle_temp = 'subtitle_temp'.time();

					    $sql = "CREATE TEMPORARY TABLE {$subtitle_temp} (
					      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					      `label` varchar(255) NOT NULL,
					      `src` varchar(300) NOT NULL,
					      `def` tinyint(1) unsigned DEFAULT NULL,
					      `media_id` int(11) unsigned NOT NULL,
					      PRIMARY KEY (`id`)
					    ) ENGINE=InnoDB";
					    $wpdb->query($sql);    

					    $sql = "LOAD DATA {$local} INFILE '$csv' INTO TABLE {$subtitle_temp}
					              FIELDS OPTIONALLY ENCLOSED BY '^'
					              TERMINATED BY '|'
					              ESCAPED BY ''
					              LINES TERMINATED BY '\n'
					              (id, label, src, @vdef, media_id)
					              SET def = nullif(@vdef,'')";
					    $wpdb->query($sql);    


					    //taxonomy

					    $csv = str_replace('\\', '/', $upload_path.$taxonomy_table.'.csv');
					    $taxonomy_temp = 'taxonomy_temp'.time();

					    $sql = "CREATE TEMPORARY TABLE $taxonomy_temp (
						    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
						    `type` varchar(10) NOT NULL,
						    `title` varchar(255) NOT NULL,
						  	`media_id` int(11) unsigned NOT NULL,
						    PRIMARY KEY (`id`)
						) ENGINE=InnoDB";
						$wpdb->query($sql);  

					    $sql = "LOAD DATA {$local} INFILE '$csv' INTO TABLE {$taxonomy_temp}
					              FIELDS OPTIONALLY ENCLOSED BY '^'
					              TERMINATED BY '|'
					              ESCAPED BY ''
					              LINES TERMINATED BY '\n'
					              (id, type, title, media_id)";
					    $wpdb->query($sql);    



					    //ad

					    $csv = str_replace('\\', '/', $upload_path.$ad_table.'.csv');
					    $ad_temp = 'ad_temp'.time();

					    $sql = "CREATE TEMPORARY TABLE {$ad_temp} (
					      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					      `ad_type` varchar(10) NOT NULL,
					      `type` varchar(50) NOT NULL,
					      `path` varchar(500) DEFAULT NULL,
					      `is360` tinyint(1) unsigned DEFAULT NULL,
					      `yt_quality` varchar(10) DEFAULT NULL,
					      `poster` varchar(500) DEFAULT NULL,
					      `duration` smallint(11) unsigned DEFAULT NULL,
					      `begin` smallint(11) unsigned DEFAULT NULL,
					      `skip_enable` smallint(11) unsigned DEFAULT NULL,
					      `link` varchar(500) DEFAULT NULL,
					      `target` varchar(10) DEFAULT NULL,
					      `active` tinyint(1) unsigned DEFAULT '1',
					      `media_id` int(11) unsigned DEFAULT NULL,
					      `playlist_id` int(11) unsigned DEFAULT NULL,
					      PRIMARY KEY (`id`)
					    ) ENGINE=InnoDB";
					    $wpdb->query($sql);    

					    $sql = "LOAD DATA {$local} INFILE '$csv' INTO TABLE {$ad_temp}
					              FIELDS OPTIONALLY ENCLOSED BY '^'
					              TERMINATED BY '|'
					              ESCAPED BY ''
					              LINES TERMINATED BY '\n'
					              (id, ad_type, type, @vpath, @vis360, @vyt_quality, @vposter, @vduration, @vbegin, @vskip_enable, @vlink, @vtarget, @vactive, @vmedia_id, @vplaylist_id)
					              SET path = nullif(@vpath,''),
					                  is360 = nullif(@vis360,''),
					                  yt_quality = nullif(@vyt_quality,''),
					                  poster = nullif(@vposter,''),
					                  duration = nullif(@vduration,''),
					                  begin = nullif(@vbegin,''),
					                  skip_enable = nullif(@vskip_enable,''),
					                  link = nullif(@vlink,''),
					                  target = nullif(@vtarget,''),
					                  active = nullif(@vactive,''),
					                  media_id = nullif(@vmedia_id,''),
					                  playlist_id = nullif(@vplaylist_id,'')";
					    $wpdb->query($sql);    



					    //annotation

					    $csv = str_replace('\\', '/', $upload_path.$annotation_table.'.csv');
					    $annotation_temp = 'annotation_temp'.time();

					    $sql = "CREATE TEMPORARY TABLE {$annotation_temp} (
					      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					      `type` varchar(15) NOT NULL,
					      `adit_class` varchar(100) DEFAULT NULL,
					      `path` varchar(2000) DEFAULT NULL,
					      `show_time` smallint(11) unsigned DEFAULT NULL,
					      `hide_time` smallint(11) unsigned DEFAULT NULL,
					      `link` varchar(500) DEFAULT NULL,
					      `target` varchar(10) DEFAULT NULL,
					      `close_btn` tinyint(1) unsigned DEFAULT NULL,
					      `css` varchar(2000) DEFAULT NULL,
					      `adsense_client` varchar(30) DEFAULT NULL,
					      `adsense_slot` varchar(15) DEFAULT NULL,
					      `adsense_code` varchar(500) DEFAULT NULL,
					      `width` smallint(11) unsigned DEFAULT NULL,
					      `height` smallint(11) unsigned DEFAULT NULL,
					      `position` varchar(10) DEFAULT NULL,
					      `margin_top` smallint(11) unsigned DEFAULT NULL,
					      `margin_right` smallint(11) unsigned DEFAULT NULL,
					      `margin_bottom` smallint(11) unsigned DEFAULT NULL,
					      `margin_left` smallint(11) unsigned DEFAULT NULL,
						  `opacity` decimal(2,1) DEFAULT NULL,
						  `close_btn_position` varchar(10) DEFAULT NULL,
						  `active` tinyint(1) unsigned DEFAULT '1',
						  `media_id` int(11) unsigned DEFAULT NULL,
					      `playlist_id` int(11) unsigned DEFAULT NULL,
					      PRIMARY KEY (`id`)
					    ) ENGINE=InnoDB";
					    $wpdb->query($sql);    

					    $sql = "LOAD DATA {$local} INFILE '$csv' INTO TABLE {$annotation_temp}
					              FIELDS OPTIONALLY ENCLOSED BY '^'
					              TERMINATED BY '|'
					              ESCAPED BY ''
					              LINES TERMINATED BY '\n'
					              (id, type, @vadit_class, @vpath, @vshow_time, @vhide_time, @vlink, @vtarget, @vclose_btn, @vcss, @vadsense_client, @vadsense_slot, @vadsense_code, @vwidth, @vheight, @vposition, @vmargin_top, @vmargin_right, @vmargin_bottom, @vmargin_left, @vopacity, @vclose_btn_position, @vactive, @vmedia_id, @vplaylist_id)
					              SET adit_class = nullif(@vadit_class,''),
					                  path = nullif(@vpath,''),
					                  show_time = nullif(@vshow_time,''),
					                  hide_time = nullif(@vhide_time,''),
					                  link = nullif(@vlink,''),
					                  target = nullif(@vtarget,''),
					                  close_btn = nullif(@vclose_btn,''),
					                  css = nullif(@vcss,''),
					                  adsense_client = nullif(@vadsense_client,''),
					                  adsense_slot = nullif(@vadsense_slot,''),
					                  adsense_code = nullif(@vadsense_code,''),
					                  width = nullif(@vwidth,''),
					                  height = nullif(@vheight,''),
					                  position = nullif(@vposition,''),
					                  margin_top = nullif(@vmargin_top,''),
					                  margin_right = nullif(@vmargin_right,''),
					                  margin_bottom = nullif(@vmargin_bottom,''),
					                  margin_left = nullif(@vmargin_left,''),
					                  opacity = nullif(@vopacity,''),
					                  close_btn_position = nullif(@vclose_btn_position,''),
					                  active = nullif(@vactive,''),
					                  media_id = nullif(@vmedia_id,''),
					                  playlist_id = nullif(@vplaylist_id,'')";
					    $wpdb->query($sql);    



					    $wpdb->query("SET FOREIGN_KEY_CHECKS=0");



					    //playlist ad

					    $sql = "INSERT INTO $ad_table (id, ad_type, type, path, is360, yt_quality, poster, duration, `begin`, skip_enable, link, target, active, media_id, playlist_id)
					              SELECT NULL, ad_type, type, path, is360, yt_quality, poster, duration, `begin`, skip_enable, link, target, active, NULL, $last_playlist_id
					              FROM {$ad_temp} WHERE playlist_id='$old_playlist_id'";
					    $wpdb->query($sql); 

					    //playlist annotation

					    $sql = "INSERT INTO $annotation_table (id, type, adit_class, path, show_time, hide_time, link, target, close_btn, css, media_id, playlist_id, adsense_client, adsense_slot, width, height, position, margin_top, margin_right, margin_bottom, margin_left, adsense_code, opacity, close_btn_position, active)
					              SELECT NULL, type, adit_class, path, show_time, hide_time, link, target, close_btn, css, NULL, $last_playlist_id, adsense_client, adsense_slot, width, height, position, margin_top, margin_right, margin_bottom, margin_left, adsense_code, opacity, close_btn_position, active
					              FROM {$annotation_temp} WHERE playlist_id='$old_playlist_id'";
					    $wpdb->query($sql); 





					    //media

					    foreach ($ids as $id) {

					        //var_dump($id);

					        $sql = "INSERT INTO $media_table (id, type, title, description, `limit`, share, download, thumb, poster, poster_frame_time, start, end, random_clip_time, playback_rate, width, height, noapi, user_id, order_id, playlist_id, load_more, is360, preview_seek, upnext, upnext_time, chapters, disable_adverts, disable_annotations, custom_content, end_link, end_target, sort_type, sort_dir, pwd, alt_text, hover_preview)
					                  SELECT NULL, type, title, description, `limit`, share, download, thumb, poster, poster_frame_time, start, end, random_clip_time, playback_rate, width, height, noapi, user_id, order_id, $last_playlist_id, load_more, is360, preview_seek, upnext, upnext_time, chapters, disable_adverts, disable_annotations, custom_content, end_link, end_target, sort_type, sort_dir, pwd, alt_text, hover_preview
					                  FROM {$media_temp} WHERE id='$id'";

					        $wpdb->query($sql); 
					        $last_media_id = $wpdb->insert_id;
					        //var_dump($last_media_id);
					        
					        //path

					        $sql = "INSERT INTO $path_table (id, quality_title, path, def, mp4, media_id)
					                  SELECT NULL, quality_title, path, def, mp4, $last_media_id
					                  FROM {$path_temp} WHERE media_id='$id'";
					        $wpdb->query($sql); 

					        //subtitles

					        $sql = "INSERT INTO $subtitle_table (id, label, src, def, media_id)
					                  SELECT NULL, label, src, def, $last_media_id
					                  FROM {$subtitle_temp} WHERE media_id='$id'";
					        $wpdb->query($sql); 

					        //taxonomy

					        $sql = "INSERT INTO $taxonomy_table (id, type, title, media_id)
					                  SELECT NULL, type, title, $last_media_id
					                  FROM {$taxonomy_temp} WHERE media_id='$id'";
					        $wpdb->query($sql); 

					        //ad

					        $sql = "INSERT INTO $ad_table (id, ad_type, type, path, is360, yt_quality, poster, duration, `begin`, skip_enable, link, target, media_id, playlist_id)
					                  SELECT NULL, ad_type, type, path, is360, yt_quality, poster, duration, `begin`, skip_enable, link, target, $last_media_id, NULL
					                  FROM {$ad_temp} WHERE media_id='$id'";
					        $wpdb->query($sql); 

					        //annotation

					        $sql = "INSERT INTO $annotation_table (id, type, adit_class, path, show_time, hide_time, link, target, close_btn, css, media_id, playlist_id, adsense_client, adsense_slot, width, height, position, margin_top, margin_right, margin_bottom, margin_left, adsense_code, opacity, close_btn_position)
					                  SELECT NULL, type, adit_class, path, show_time, hide_time, link, target, close_btn, css, $last_media_id, NULL, adsense_client, adsense_slot, width, height, position, margin_top, margin_right, margin_bottom, margin_left, adsense_code, opacity, close_btn_position
					                  FROM {$annotation_temp} WHERE media_id='$id'";
					        $wpdb->query($sql); 


					    }

					    //drop temp tables
					    $wpdb->query("DROP TABLE {$media_temp}");
					    $wpdb->query("DROP TABLE {$path_temp}");
					    $wpdb->query("DROP TABLE {$subtitle_temp}");
					    $wpdb->query("DROP TABLE {$ad_temp}");
					    $wpdb->query("DROP TABLE {$annotation_temp}");
					    $wpdb->query("SET FOREIGN_KEY_CHECKS=1");
						



				        //delete files
				        $files = glob($upload_path.'/*'); 
						foreach($files as $file){ 
							if(is_file($file))unlink($file); 
						}

				    }
	        		
	        	} else {

	        		$response["response"] = "ERROR";
	        		$response["error"]= "Upload Failed!";
	        	}

	        }

	        echo json_encode( $response );
			die();

		}



	}

	function wpsvp_player_deactivate(){

		global $wpdb;
		$wpdb->show_errors(); 

		$wpdb->query('SET foreign_key_checks=0');

	    $settings_table = $wpdb->prefix . "wpsvp_settings";
	    $sql = "DROP TABLE IF EXISTS $settings_table;";
	    $wpdb->query($sql);

	    $player_table = $wpdb->prefix . "wpsvp_players";
	    $sql = "DROP TABLE IF EXISTS $player_table;";
	    $wpdb->query($sql);

		$path_table = $wpdb->prefix . "wpsvp_path";
	    $sql = "DROP TABLE IF EXISTS $path_table;";
	    $wpdb->query($sql);

		$subtitle_table = $wpdb->prefix . "wpsvp_subtitle";
	    $sql = "DROP TABLE IF EXISTS $subtitle_table;";
	    $wpdb->query($sql);

	    $ad_table = $wpdb->prefix . "wpsvp_ad";
	    $sql = "DROP TABLE IF EXISTS $ad_table;";
	    $wpdb->query($sql);

		$annotation_table = $wpdb->prefix . "wpsvp_annotation";
	    $sql = "DROP TABLE IF EXISTS $annotation_table;";
	    $wpdb->query($sql);

	    $taxonomy_table = $wpdb->prefix . "wpsvp_taxonomy";
	    $sql = "DROP TABLE IF EXISTS $taxonomy_table;";
	    $wpdb->query($sql);

	    $media_table = $wpdb->prefix . "wpsvp_media";
	    $sql = "DROP TABLE IF EXISTS $media_table;";
	    $wpdb->query($sql);

	    $playlist_table = $wpdb->prefix . "wpsvp_playlists";
	    $sql = "DROP TABLE IF EXISTS $playlist_table;";
	    $wpdb->query($sql);

		delete_option('wpsvp_version');
	}

	function wpsvp_player_activate(){

		//file dir for reading files from directory
		if(!file_exists(WPSVP_FILE_DIR))wp_mkdir_p(WPSVP_FILE_DIR);

		//database
		global $wpdb;
		$wpdb->show_errors(); 
		$charset_collate = $wpdb->get_charset_collate();
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		//WHEN altering tables, playlist_manager.php copy playlist; wpsvp.php copy tracks, import playlist!

		$settings_table = $wpdb->prefix . "wpsvp_settings";
		if($wpdb->get_var( "show tables like '$settings_table'" ) != $settings_table){

			$sql = "CREATE TABLE $settings_table ( 
				`id` tinyint NOT NULL,
				`youtube_id` varchar(100) NOT NULL DEFAULT '',
			    `facebook_id` varchar(100) NOT NULL DEFAULT '',
			    `vimeo_key` varchar(500) NOT NULL DEFAULT '',
			    `vimeo_secret` varchar(500) NOT NULL DEFAULT '',
			    `vimeo_token` varchar(500) NOT NULL DEFAULT '',
			    `youtube_no_cookie` tinyint(1) unsigned DEFAULT '0',
			    `no_conflict` tinyint(1) unsigned DEFAULT '0', 
				`js_to_footer` tinyint(1) unsigned DEFAULT '0',
			    PRIMARY KEY (`id`)
			) $charset_collate;";
			dbDelta( $sql );

		}

		$player_table = $wpdb->prefix . "wpsvp_players";
		if($wpdb->get_var( "show tables like '$player_table'" ) != $player_table){

			$sql = "CREATE TABLE $player_table ( 
				`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			    `title` varchar(100) NOT NULL,
			    `preset` varchar(50) NOT NULL,
			    `options` text NOT NULL,
			    PRIMARY KEY (`id`)
			) $charset_collate;";
			dbDelta( $sql );

		}

		$playlist_table = $wpdb->prefix . "wpsvp_playlists";
		if($wpdb->get_var( "show tables like '$playlist_table'" ) != $playlist_table){

			$sql = "CREATE TABLE $playlist_table (
			    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
				`title` varchar(100) NOT NULL,
				`options` text DEFAULT NULL,
			    PRIMARY KEY (`id`)
			) $charset_collate;";
			dbDelta( $sql );

		}

		$media_table = $wpdb->prefix . "wpsvp_media";
		if($wpdb->get_var( "show tables like '$media_table'" ) != $media_table){

			$sql = "CREATE TABLE $media_table (
			    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			    `type` varchar(50) NOT NULL,
			    `title` varchar(255) DEFAULT NULL,
			    `description` varchar(1000) DEFAULT NULL,
			    `limit` smallint(11) unsigned DEFAULT NULL,
			    `share` varchar(300) DEFAULT NULL,
			    `download` varchar(300) DEFAULT NULL,
			    `thumb` varchar(300) DEFAULT NULL,
			    `alt_text` varchar(100) DEFAULT NULL,
			    `poster` varchar(300) DEFAULT NULL,
			    `poster_frame_time` decimal(2,1) DEFAULT NULL,
			    `start` smallint(11) unsigned DEFAULT NULL,
			    `end` smallint(11) unsigned DEFAULT NULL,
			    `random_clip_time` decimal(4,2) DEFAULT NULL,
			    `playback_rate` decimal(2,1) DEFAULT NULL,
			    `width` smallint(11) unsigned DEFAULT NULL,
			    `height` smallint(11) unsigned DEFAULT NULL,
			    `noapi` tinyint(1) unsigned DEFAULT NULL,
			    `user_id` varchar(50) DEFAULT NULL,
			    `load_more` tinyint(1) unsigned DEFAULT NULL,
			    `is360` tinyint(1) unsigned DEFAULT NULL,
			    `preview_seek` varchar(300) DEFAULT NULL,
			    `duration` smallint(11) unsigned DEFAULT NULL, 
				`upnext` tinyint(1) unsigned DEFAULT NULL, 
				`upnext_time` smallint(11) unsigned DEFAULT NULL,
				`chapters` text DEFAULT NULL,
				`disable_adverts` tinyint(1) unsigned DEFAULT NULL, 
				`disable_annotations` tinyint(1) unsigned DEFAULT NULL, 
				`custom_content` text, 
				`end_link` varchar(100) DEFAULT NULL, 
				`end_target` varchar(10) DEFAULT NULL,
				`sort_type` varchar(20) DEFAULT NULL, 
	    		`sort_dir` varchar(10) DEFAULT NULL,
	    		`pwd` varchar(50) DEFAULT NULL,
	    		`hover_preview` varchar(300) DEFAULT NULL,
			    `order_id` int(11) unsigned DEFAULT NULL,
			    `playlist_id` int(11) unsigned NOT NULL,
			    PRIMARY KEY (`id`),
			    INDEX `playlist_id` (`playlist_id`),
			    CONSTRAINT `wpsvp_media_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES {$playlist_table} (`id`) ON DELETE CASCADE ON UPDATE CASCADE
			) $charset_collate;";
			dbDelta( $sql );

		}

		$path_table = $wpdb->prefix . "wpsvp_path";
		if($wpdb->get_var( "show tables like '$path_table'" ) != $path_table){

			$sql = "CREATE TABLE $path_table (
			    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			    `quality_title` varchar(50) DEFAULT NULL,
			    `path` varchar(300) NOT NULL,
			    `def` varchar(50) DEFAULT NULL,
			    `mp4` varchar(300) DEFAULT NULL,
			    `media_id` int(11) unsigned NOT NULL,
			    PRIMARY KEY (`id`),
			    INDEX `media_id` (`media_id`),
			    CONSTRAINT `wpsvp_path_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES {$media_table} (`id`) ON DELETE CASCADE ON UPDATE CASCADE
			) $charset_collate;";
			dbDelta( $sql );

		}

		$subtitle_table = $wpdb->prefix . "wpsvp_subtitle";
		if($wpdb->get_var( "show tables like '$subtitle_table'" ) != $subtitle_table){

			$sql = "CREATE TABLE $subtitle_table (
			    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			    `label` varchar(50) NOT NULL,
			    `src` varchar(300) NOT NULL,
			    `def` tinyint(1) unsigned DEFAULT NULL,
			    `media_id` int(11) unsigned NOT NULL,
			    PRIMARY KEY (`id`),
			    INDEX `media_id` (`media_id`),
			    CONSTRAINT `wpsvp_subtitle_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES {$media_table} (`id`) ON DELETE CASCADE ON UPDATE CASCADE
			) $charset_collate;";
			dbDelta( $sql );

		}

		$ad_table = $wpdb->prefix . "wpsvp_ad";
		if($wpdb->get_var( "show tables like '$ad_table'" ) != $ad_table){

			$sql = "CREATE TABLE $ad_table (
			    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			    `ad_type` varchar(10) NOT NULL,
			    `type` varchar(50) NOT NULL,
			    `path` varchar(300) DEFAULT NULL,
			    `is360` tinyint(1) unsigned DEFAULT NULL,
			    `yt_quality` varchar(10) DEFAULT NULL,
			    `poster` varchar(500) DEFAULT NULL,
			    `duration` smallint(11) unsigned DEFAULT NULL,
			    `begin` smallint(11) unsigned DEFAULT NULL,
			    `skip_enable` smallint(11) unsigned DEFAULT NULL,
			    `link` varchar(100) DEFAULT NULL,
			    `target` varchar(10) DEFAULT NULL,
			    `active` tinyint(1) unsigned DEFAULT '1',
			    `media_id` int(11) unsigned DEFAULT NULL,
			    `playlist_id` int(11) unsigned DEFAULT NULL,
			    PRIMARY KEY (`id`),
			    INDEX `media_id` (`media_id`),
			    CONSTRAINT `wpsvp_ad_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES {$media_table} (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
			    CONSTRAINT `wpsvp_ad_glob_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES {$playlist_table} (`id`) ON DELETE CASCADE ON UPDATE CASCADE
			) $charset_collate;";
			dbDelta( $sql );

		}

		$annotation_table = $wpdb->prefix . "wpsvp_annotation";
		if($wpdb->get_var( "show tables like '$annotation_table'" ) != $annotation_table){

			$sql = "CREATE TABLE $annotation_table (
			    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			    `type` varchar(15) NOT NULL,
			    `adit_class` varchar(100) DEFAULT NULL,
			    `path` varchar(2000) DEFAULT NULL,
			    `show_time` smallint(11) unsigned DEFAULT NULL,
			    `hide_time` smallint(11) unsigned DEFAULT NULL,
			    `link` varchar(100) DEFAULT NULL,
			    `target` varchar(10) DEFAULT NULL,
			    `close_btn` tinyint(1) unsigned DEFAULT NULL,
			    `css` varchar(2000) DEFAULT NULL,
			    `adsense_client` varchar(30) DEFAULT NULL, 
				`adsense_slot` varchar(15) DEFAULT NULL, 
				`adsense_code` varchar(500) DEFAULT NULL, 
				`width` smallint(11) unsigned DEFAULT NULL,
				`height` smallint(11) unsigned DEFAULT NULL,
				`position` varchar(10) DEFAULT NULL,
				`margin_top` smallint(11) unsigned DEFAULT NULL,
				`margin_right` smallint(11) unsigned DEFAULT NULL,
				`margin_bottom` smallint(11) unsigned DEFAULT NULL,
				`margin_left` smallint(11) unsigned DEFAULT NULL,
				`opacity` decimal(2,1) DEFAULT NULL,
				`close_btn_position` varchar(10) DEFAULT NULL,
				`active` tinyint(1) unsigned DEFAULT '1',
			    `media_id` int(11) unsigned DEFAULT NULL,
			    `playlist_id` int(11) unsigned DEFAULT NULL,
			    PRIMARY KEY (`id`),
			    INDEX `media_id` (`media_id`),
			    CONSTRAINT `wpsvp_annotation_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES {$media_table} (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
			    CONSTRAINT `wpsvp_annotation_glob_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES {$playlist_table} (`id`) ON DELETE CASCADE ON UPDATE CASCADE
			) $charset_collate;";
			dbDelta( $sql );

		}

		$taxonomy_table = $wpdb->prefix . "wpsvp_taxonomy";
		if($wpdb->get_var( "show tables like '$taxonomy_table'" ) != $taxonomy_table){

			$sql = "CREATE TABLE $taxonomy_table (
			    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			    `type` varchar(10) NOT NULL,
			    `title` varchar(255) NOT NULL,
			  	`media_id` int(11) unsigned NOT NULL,
			    PRIMARY KEY (`id`),
			    INDEX `media_id` (`media_id`),
			    CONSTRAINT `wpsvp_taxonomy_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES {$media_table} (`id`) ON DELETE CASCADE ON UPDATE CASCADE
			) $charset_collate;";
			dbDelta( $sql );

		}
	
	}

	function wpsvp_plugins_loaded() {

	    $current_version = get_option('wpsvp_version');

	    if($current_version == FALSE){
	    	update_option('wpsvp_version', '1.0');
	    }
	    $current_version = get_option('wpsvp_version');

	    global $wpdb;
		$wpdb->show_errors(); 

		/*$settings_table = $wpdb->prefix . "wpsvp_settings";
		$player_table = $wpdb->prefix . "wpsvp_players";
		$media_table = $wpdb->prefix . "wpsvp_media";
		$playlist_table = $wpdb->prefix . "wpsvp_playlists";
		$path_table = $wpdb->prefix . "wpsvp_path";
		$ad_table = $wpdb->prefix . "wpsvp_ad";
		$annotation_table = $wpdb->prefix . "wpsvp_annotation";*/

		if($current_version < '2.56'){
			update_option('wpsvp_version', '2.56');
			$current_version = get_option('wpsvp_version');
		}
		if($current_version == '2.56'){
			update_option('wpsvp_version', '2.57');
			$current_version = get_option('wpsvp_version');
		}
		if($current_version == '2.57'){
			update_option('wpsvp_version', '2.58');
			$current_version = get_option('wpsvp_version');
		}
		if($current_version == '2.58'){
			update_option('wpsvp_version', '2.59');
			$current_version = get_option('wpsvp_version');
		}
		
	
	}


?>