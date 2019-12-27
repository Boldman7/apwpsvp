<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/wp-db.php' ); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(@$_POST['id']){
	
	global $wpdb;
	
	$random_clip = $wpdb->get_results( "SELECT random_clip_time,all_clip FROM {$wpdb->prefix}wpsvp_media WHERE 	playlist_id=" .$_POST['id'], ARRAY_A);
	if(!empty($random_clip)){
		
		if($random_clip[0]['all_clip']){
			
			$data= array();
			
			for($i=0.10; $i<=10; $i= $i+0.01){

				$data[]=round($i,2);
			}
			
			echo json_encode($data);
					
		}else{
			
			$data = unserialize($random_clip[0]['random_clip_time']);
		
			echo json_encode($data);
			
		}
	}
}

?>