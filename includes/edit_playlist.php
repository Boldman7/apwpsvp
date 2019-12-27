<?php 

if(isset($_GET['playlist_id'])){
	$playlist_id = $_GET['playlist_id'];
}

if(isset($_POST['add_media']) || isset($_POST['edit_media'])){
		//echo "<pre>"; print_r(serialize($_POST['random_clip_time'])); die("1233455");
	if(check_admin_referer("wpsvp_add_media_action", "wpsvp_add_media_nonce_field")){

		$type = $_POST['type'];
		$title = !wpsvp_nullOrEmpty($_POST['title']) ? str_replace('"', "'", stripslashes($_POST['title'])) : NULL;
	    $description = !wpsvp_nullOrEmpty($_POST['description']) ? str_replace('"', "'", stripslashes($_POST['description'])) : NULL;
        $thumb = !wpsvp_nullOrEmpty($_POST['thumb']) ? str_replace('"', "'", stripslashes($_POST['thumb'])) : NULL;
        $alt_text = !wpsvp_nullOrEmpty($_POST['alt_text']) ? str_replace('"', "'", stripslashes($_POST['alt_text'])) : NULL;
        $poster = !wpsvp_nullOrEmpty($_POST['poster']) ? str_replace('"', "'", stripslashes($_POST['poster'])) : NULL;
        $poster_frame_time = !wpsvp_nullOrEmpty($_POST['poster_frame_time']) ? $_POST['poster_frame_time'] : NULL;
        $share = !wpsvp_nullOrEmpty($_POST['share']) ? str_replace('"', "'", stripslashes($_POST['share'])) : NULL;
        $download = !wpsvp_nullOrEmpty($_POST['download']) ? str_replace('"', "'", stripslashes($_POST['download'])) : NULL;
        $preview_seek = !wpsvp_nullOrEmpty($_POST['preview_seek']) ? str_replace('"', "'", stripslashes($_POST['preview_seek'])) : NULL;
        $hover_preview = !wpsvp_nullOrEmpty($_POST['hover_preview']) ? str_replace('"', "'", stripslashes($_POST['hover_preview'])) : NULL;
        $chapters = !wpsvp_nullOrEmpty($_POST['chapters']) ? str_replace('"', "'", stripslashes($_POST['chapters'])) : NULL;
	    $width = !wpsvp_nullOrEmpty($_POST['width']) ? $_POST['width'] : NULL;
	    $height = !wpsvp_nullOrEmpty($_POST['height']) ? $_POST['height'] : NULL;
	    $start = !wpsvp_nullOrEmpty($_POST['start']) ? $_POST['start'] : NULL;
	    $end = !wpsvp_nullOrEmpty($_POST['end']) ? $_POST['end'] : NULL;
	    // Added by Boldman.
	    // $playing_length = !wpsvp_nullOrEmpty($_POST['playing_length']) ? $_POST['playing_length'] : NULL;
		/*	Added by Boldman*/
	    //$random_clip_time = !wpsvp_nullOrEmpty($_POST['random_clip_time']) ? $_POST['random_clip_time'] : NULL;
		$random_clip_time = !wpsvp_nullOrEmpty($_POST['random_clip_time']) ? serialize($_POST['random_clip_time']) : NULL;
		$all_clip = !wpsvp_nullOrEmpty($_POST['all_clip']) ? 1 : 0;
		
	    $normal_play_mode = !wpsvp_nullOrEmpty($_POST['normal_play_mode']) ? $_POST['normal_play_mode'] : NULL;

	    $playback_rate = !wpsvp_nullOrEmpty($_POST['playback_rate']) ? $_POST['playback_rate'] : NULL;
	    $limit = !wpsvp_nullOrEmpty($_POST['limit']) ? $_POST['limit'] : NULL;
	    $yt_quality = (strpos($type, 'youtube_') !== false) ? (!wpsvp_nullOrEmpty($_POST['yt_quality']) ? $_POST['yt_quality'] : NULL) : NULL;
	    $user_id = !wpsvp_nullOrEmpty($_POST['user_id']) ? str_replace('"', "'", $_POST['user_id']) : NULL;
	    $noapi = ($type == 'youtube_single' || $type == 'vimeo_single') ? $_POST['noapi'] : NULL;
	    $is360 = ($type == 'youtube_single' || $type == 'vimeo_single') ? $_POST['is360'] : NULL;
	    $load_more = !wpsvp_nullOrEmpty($_POST['load_more']) ? $_POST['load_more'] : NULL;
	    $disable_adverts = !wpsvp_nullOrEmpty($_POST['disable_adverts']) ? $_POST['disable_adverts'] : NULL; 
	    $disable_annotations = !wpsvp_nullOrEmpty($_POST['disable_annotations']) ? $_POST['disable_annotations'] : NULL;
	    $end_link = !wpsvp_nullOrEmpty($_POST['end_link']) ? str_replace('"', "'", stripslashes($_POST['end_link'])) : NULL;
	    $end_target = ($end_link != NULL) ? (!wpsvp_nullOrEmpty($_POST['end_target']) ? str_replace('"', "'", stripslashes($_POST['end_target'])) : NULL) : NULL;
	    $custom_content = !wpsvp_nullOrEmpty($_POST['custom_content']) ? str_replace('"', "'", stripslashes($_POST['custom_content'])) : NULL;
	    $pwd = !wpsvp_nullOrEmpty($_POST['pwd']) ? $_POST['pwd'] : NULL;

	    //sort
	    $yt_sort = ($type == 'youtube_video_query') ? $_POST['yt_sort'] : NULL;
	    $vimeo_channel_album_sort = ($type == 'vimeo_channel' || $type == 'vimeo_user_album') ? $_POST['vimeo_channel_album_sort'] : NULL;
	    $vimeo_group_sort = ($type == 'vimeo_group') ? $_POST['vimeo_group_sort'] : NULL; 
	    $vimeo_video_query_sort = ($type == 'vimeo_video_query') ? $_POST['vimeo_video_query_sort'] : NULL; 
	    $vimeo_sort_dir = ($type == 'vimeo_channel' || $type == 'vimeo_user_album' || $type == 'vimeo_group' || $type == 'vimeo_video_query') ? $_POST['vimeo_sort_dir'] : NULL; 

	    if($yt_sort)$sort_type = $yt_sort;
	    else if($vimeo_channel_album_sort)$sort_type = $vimeo_channel_album_sort;
	    else if($vimeo_group_sort)$sort_type = $vimeo_group_sort;
	    else if($vimeo_video_query_sort)$sort_type = $vimeo_video_query_sort;
	    else $sort_type = NULL;

	    $sort_dir = $vimeo_sort_dir;


	    if(isset($_POST['add_media'])){//add new media
			
			//media order
	        $stmt = $wpdb->get_row($wpdb->prepare("SELECT IFNULL(MAX(order_id)+1,0) AS order_id FROM {$media_table} WHERE playlist_id = %d", $playlist_id), ARRAY_A);
	        $order_id = $stmt['order_id'];

		    $stmt = $wpdb->insert(
		    	$media_table,
				array( 
					'type' => $type,
					'title' => $title,
					'description' => $description,
					'thumb' => $thumb,
					'alt_text' => $alt_text,
					'poster' => $poster,
					'poster_frame_time' => $poster_frame_time,
					'share' => $share,
					'download' => $download,
					'width' => $width,
					'height' => $height,
					'start' => $start,
					'end' => $end,
					//	Added by Boldman
					// 'playing_length' => $playing_length,
					/*	Added by Boldman*/
					'normal_play_mode' => $normal_play_mode,
					'random_clip_time' => $random_clip_time,
					'all_clip' => $all_clip,
					'playback_rate' => $playback_rate,
					'limit' => $limit,
					'user_id' => $user_id,
					'preview_seek' => $preview_seek,
					'hover_preview' => $hover_preview,
					'chapters' => $chapters,
					'noapi' => $noapi,
					'is360' => $is360,
					'load_more' => $load_more,
					'disable_adverts' => $disable_adverts,
					'disable_annotations' => $disable_annotations,
					'end_link' => $end_link,
					'end_target' => $end_target,
					'custom_content' => $custom_content,
					'pwd' => $pwd,
					'sort_type' => $sort_type,
					'sort_dir' => $sort_dir,
					'playlist_id' => $playlist_id,
					'order_id' => $order_id
				), 
				array( 
					'%s','%s','%s','%s','%s','%s','%f','%s','%s','%d','%d','%d','%d','%d','%s','%s','%f','%d','%s','%s','%s','%s','%d','%d','%d','%d','%d','%s','%s','%s','%s','%s','%s','%d','%d'
				) 
		    );
			
			if($stmt !== false){

		    	$insert_id = $wpdb->insert_id;

		    	//multi path
		    	if($type == 'video' || $type == 'video_360' || $type == 'audio' || $type == 'image' || $type == 'image_360'){

		    		if(!empty($_POST['multi_path']) && !wpsvp_nullOrEmpty($_POST['multi_path'][0])){

			    		$multi_path = $_POST['multi_path'];
			    		$quality_title = $_POST['quality_title'];

	            		for($i = 0; $i < count($multi_path); $i++){    

			                $quality_default = count($multi_path) > 1 ? 0 : 1;//if only one quality available set default	

			                if(isset($_POST['quality_default'])){
		            			$quality_default = $_POST['quality_default'][0];

		            			if($quality_default == $quality_title[$i]){
		            				$quality_default = 1;
		            			}
		            		}

			                $stmt = $wpdb->insert(
						    	$path_table,
								array( 
									'path' => str_replace('"', "'", stripslashes($multi_path[$i])),
									'quality_title' => str_replace('"', "'", stripslashes($quality_title[$i])),
									'def' => $quality_default,
									'media_id' => $insert_id
								), 
								array( 
									'%s','%s','%d','%d'
								) 
						    );	
			            }
			        }
		    	}
		    	else{

		    		if(!empty($_POST['path'])){//path

			    		$quality_title = '';
			    		if($yt_quality)$quality_title = $yt_quality;

			    		$mp4 = !empty($_POST['mp4']) ? $_POST['mp4'] : NULL;

		                $stmt = $wpdb->insert(
					    	$path_table,
							array( 
								'path' => str_replace('"', "'", stripslashes($_POST['path'])),
								'quality_title' => $quality_title,
								'mp4' => $mp4,
								'media_id' => $insert_id
							), 
							array( 
								'%s','%s','%s','%d'
							) 
					    );	
			    	}
			    }

			    //tag
		    	if(!empty($_POST['tag'])){

		    		$tag = $_POST['tag'];
            		
            		for($i = 0; $i < count($tag); $i++){    

		                $stmt = $wpdb->insert(
					    	$taxonomy_table,
							array( 
								'type' => 'tag',
								'title' => str_replace('"', "'", stripslashes($tag[$i])),
								'media_id' => $insert_id
							), 
							array( 
								'%s','%s','%d'
							) 
					    );	
		            }
		    	}

		    	//category
		    	if(!empty($_POST['category'])){

		    		$category = $_POST['category'];
            		
            		for($i = 0; $i < count($category); $i++){    

		                $stmt = $wpdb->insert(
					    	$taxonomy_table,
							array( 
								'type' => 'category',
								'title' => str_replace('"', "'", stripslashes($category[$i])),
								'media_id' => $insert_id
							), 
							array( 
								'%s','%s','%d'
							) 
					    );	
		            }
		    	}


		    	//subtitles
		    	if(!empty($_POST['subtitle_src']) && !wpsvp_nullOrEmpty($_POST['subtitle_src'][0])){

		    		$subtitle_src = $_POST['subtitle_src'];
		    		$subtitle_label = $_POST['subtitle_label'];
            		
            		for($i = 0; $i < count($subtitle_src); $i++){    

		                $subtitle_default = 0;	

		                if(isset($_POST['subtitle_default'])){
	            			$subtitle_default = $_POST['subtitle_default'][0];

	            			if($subtitle_default == $subtitle_label[$i]){
	            				$subtitle_default = 1;
	            			}
	            		}

		                $stmt = $wpdb->insert(
					    	$subtitle_table,
							array( 
								'src' => str_replace('"', "'", stripslashes($subtitle_src[$i])),
								'label' => str_replace('"', "'", stripslashes($subtitle_label[$i])),
								'def' => $subtitle_default,
								'media_id' => $insert_id
							), 
							array( 
								'%s','%s','%d','%d'
							) 
					    );	
		            }
		    	}


		    	//ads

		    	if(!empty($_POST['ad_pre']) && !wpsvp_nullOrEmpty($_POST['ad_pre'][0])){
		    		
		    		$ad_pre = $_POST['ad_pre'][0];

		    		$stmt = $wpdb->insert(
				    	$ad_table,
						array( 
							'active' => $ad_pre['active'],
							'ad_type' => 'ad-pre',
							'type' => $ad_pre['type'],
							'path' => str_replace('"', "'", stripslashes($ad_pre['path'])),
							'is360' => $ad_pre['is360'],
							'yt_quality' => $ad_pre['yt_quality'],
							'poster' => $ad_pre['poster'] !== '' ? str_replace('"', "'", stripslashes($ad_pre['poster'])) : NULL,
							'duration' => $ad_pre['duration'] !== '' ? $ad_pre['duration'] : NULL,
							'skip_enable' => $ad_pre['skip_enable'] !== '' ? $ad_pre['skip_enable'] : NULL,
							'link' => $ad_pre['link'] !== '' ? str_replace('"', "'", stripslashes($ad_pre['link'])) : NULL,
							'target' => $ad_pre['target'],
							'media_id' => $insert_id
						), 
						array( 
							'%d','%s','%s','%s','%d','%s','%s','%d','%d','%s','%s','%d'
						) 
				    );	
		    	
		    	}

		    	if(!empty($_POST['ad_mid'])){
		    		
		    		$ad_mid_arr = $_POST['ad_mid'];

		    		for($i = 0; $i < count($ad_mid_arr); $i++){  

		    			$ad_mid = $ad_mid_arr[$i];

			    		$stmt = $wpdb->insert(
					    	$ad_table,
							array( 
								'active' => $ad_mid['active'],
								'ad_type' => 'ad-mid',
								'type' => $ad_mid['type'],
								'path' => str_replace('"', "'", stripslashes($ad_mid['path'])),
								'is360' => $ad_mid['is360'],
								'yt_quality' => $ad_mid['yt_quality'],
								'poster' => $ad_mid['poster'] !== '' ? str_replace('"', "'", stripslashes($ad_mid['poster'])) : NULL,
								'duration' => $ad_mid['duration'] !== '' ? $ad_mid['duration'] : NULL,
							    'skip_enable' => $ad_mid['skip_enable'] !== '' ? $ad_mid['skip_enable'] : NULL,
								'begin' => $ad_mid['begin'],
								'link' => $ad_mid['link'] !== '' ? str_replace('"', "'", stripslashes($ad_mid['link'])) : NULL,
								'target' => $ad_mid['target'],
								'media_id' => $insert_id
							), 
							array( 
								'%d','%s','%s','%s','%d','%s','%s','%d','%d','%d','%s','%s','%d'
							) 
					    );	

			    	}
			    	
		    	}

		    	if(!empty($_POST['ad_end']) && !wpsvp_nullOrEmpty($_POST['ad_end'][0])){
		    		
		    		$ad_end = $_POST['ad_end'][0];

		    		$stmt = $wpdb->insert(
				    	$ad_table,
						array( 
							'active' => $ad_end['active'],
							'ad_type' => 'ad-end',
							'type' => $ad_end['type'],
							'path' => str_replace('"', "'", stripslashes($ad_end['path'])),
							'is360' => $ad_end['is360'],
							'yt_quality' => $ad_end['yt_quality'],
							'poster' => $ad_end['poster'] !== '' ? str_replace('"', "'", stripslashes($ad_end['poster'])) : NULL,
							'duration' => $ad_end['duration'] !== '' ? $ad_end['duration'] : NULL,
							'skip_enable' => $ad_end['skip_enable'] !== '' ? $ad_end['skip_enable'] : NULL,
							'link' => $ad_end['link'] !== '' ? str_replace('"', "'", stripslashes($ad_end['link'])) : NULL,
							'target' => $ad_end['target'],
							'media_id' => $insert_id
						), 
						array( 
							'%d','%s','%s','%s','%d','%s','%s','%d','%d','%s','%s','%d'
						) 
				    );	
		    	
		    	}


		    	//annotations

				if(!empty($_POST['annotation'])){
		    		
		    		$annotation_arr = $_POST['annotation'];

		    		for($i = 0; $i < count($annotation_arr); $i++){  

		    			$an = $annotation_arr[$i];

						$type = $an['type'];
						if($type == 'html')$path = $an['path_html'] !== '' ? str_replace('"', "'", stripslashes($an['path_html'])) : NULL;
						else $path = $an['path'] !== '' ? str_replace('"', "'", stripslashes($an['path'])) : NULL;

			    		$stmt = $wpdb->insert(
					    	$annotation_table,
							array( 
								'active' => $an['active'],
								'type' => $type,
								'path' => $path,
								'adsense_code' => $an['adsense_code'] !== '' ? str_replace('"', "'",stripslashes( $an['adsense_code'])) : NULL,
								'adsense_client' => $an['adsense_client'] !== '' ? str_replace('"', "'", stripslashes($an['adsense_client'])) : NULL,
								'adsense_slot' => $an['adsense_slot'] !== '' ? str_replace('"', "'", stripslashes($an['adsense_slot'])) : NULL,
								'width' => $an['width'] !== '' ? $an['width'] : NULL,
								'height' => $an['height'] !== '' ? $an['height'] : NULL,
								'show_time' => $an['show_time'] !== '' ? $an['show_time'] : NULL,
							    'hide_time' => $an['hide_time'] !== '' ? $an['hide_time'] : NULL,
							    'link' => $an['link'] !== '' ? str_replace('"', "'", stripslashes($an['link'])) : NULL,
								'target' => $an['target'],
								'close_btn' => $an['close_btn'],
								'close_btn_position' => $an['close_btn_position'],
								'position' => $an['position'],
								'margin_top' => $an['margin_top'] !== '' ? $an['margin_top'] : NULL,
								'margin_right' => $an['margin_right'] !== '' ? $an['margin_right'] : NULL,
								'margin_bottom' => $an['margin_bottom'] !== '' ? $an['margin_bottom'] : NULL,
								'margin_left' => $an['margin_left'] !== '' ? $an['margin_left'] : NULL,
								'opacity' => $an['opacity'] !== '' ? $an['opacity'] : NULL,
								'adit_class' => $an['adit_class'] !== '' ? str_replace('"', "'", stripslashes($an['adit_class'])) : NULL,
								'css' => $an['css'] !== '' ? str_replace('"', "'", stripslashes($an['css'])) : NULL,
								'media_id' => $insert_id
							), 
							array( 
								'%d','%s','%s','%s','%s','%s','%d','%d','%d','%d','%s','%s','%d','%s','%s','%d','%d','%d','%d','%f','%s','%s','%d'
							) 
					    );	

			    	}
			    	
		    	}



				$msg = 'Success!';
			}else{
				$msge = 'Error occured!';	
			}

		}
		else if(isset($_POST['edit_media'])){//edit media

			$media_id = $_GET['media_id'];

		    $stmt = $wpdb->update(
		    	$media_table,
				array( 
					'type' => $type,
					'title' => $title,
					'description' => $description,
					'thumb' => $thumb,
					'alt_text' => $alt_text,
					'poster' => $poster,
					'poster_frame_time' => $poster_frame_time,
					'share' => $share,
					'download' => $download,
					'width' => $width,
					'height' => $height,
					'start' => $start,
					'end' => $end,
					//	Added by Boldman
					// 'playing_length' => $playing_length,
					/*	Added by Boldman*/
					'normal_play_mode' => $normal_play_mode,
					'random_clip_time' => $random_clip_time,
					'all_clip' => $all_clip,
					'playback_rate' => $playback_rate,
					'user_id' => $user_id,
					'preview_seek' => $preview_seek,
					'hover_preview' => $hover_preview,
					'chapters' => $chapters,
					'limit' => $limit,
					'noapi' => $noapi,
					'is360' => $is360,
					'load_more' => $load_more,
					'disable_adverts' => $disable_adverts,
					'disable_annotations' => $disable_annotations,
					'custom_content' => $custom_content,
					'pwd' => $pwd,
					'sort_type' => $sort_type,
					'sort_dir' => $sort_dir,
					'end_link' => $end_link,
					'end_target' => $end_target
				), 
				array('id' => $media_id, 'playlist_id' => $playlist_id),//playlist_id not really necessary since 'id' in media_table is primary
				array( 
					'%s','%s','%s','%s','%s','%s','%f','%s','%s','%d','%d','%d','%d','%d','%s','%s','%f','%s','%s','%s','%s','%d','%d','%d','%d','%d','%d','%s','%s','%s','%s','%s','%s'
				),
				array( 
					'%d','%d'
				) 
		    );

		    if($stmt !== false){

		    	//path

		    	//delete current values 
				$stmt = $wpdb->query($wpdb->prepare("DELETE FROM {$path_table} WHERE media_id = %d", $media_id));

		    	//multi path
		    	if($type == 'video' || $type == 'video_360' || $type == 'audio' || $type == 'image' || $type == 'image_360'){

		    		if(!empty($_POST['multi_path']) && !wpsvp_nullOrEmpty($_POST['multi_path'][0])){

			    		$multi_path = $_POST['multi_path'];
			    		$quality_title = $_POST['quality_title'];

	            		for($i = 0; $i < count($multi_path); $i++){    

			                $quality_default = 0;	

			                if(isset($_POST['quality_default'])){
		            			$quality_default = $_POST['quality_default'][0];

		            			if($quality_default == $quality_title[$i]){
		            				$quality_default = 1;
		            			}
		            		}

			                $stmt = $wpdb->insert(
						    	$path_table,
								array( 
									'path' => str_replace('"', "'", stripslashes($multi_path[$i])),
									'quality_title' => str_replace('"', "'", stripslashes($quality_title[$i])),
									'def' => $quality_default,
									'media_id' => $media_id
								), 
								array( 
									'%s','%s','%d','%d'
								) 
						    );	
			            }
			        }
		    	}
		    	else{//path

			    	if(!empty($_POST['path'])){

			    		$path = str_replace('"', "'", $_POST['path']);

			    		$quality_title = '';
			    		if($yt_quality)$quality_title = $yt_quality;

			    		$mp4 = !empty($_POST['mp4']) ? $_POST['mp4'] : NULL;

		                $stmt = $wpdb->insert(
					    	$path_table,
							array( 
								'path' => $path,
								'quality_title' => $quality_title,
								'mp4' => $mp4,
								'media_id' => $media_id
							), 
							array( 
								'%s','%s','%s','%d'
							) 
					    );	
			    	}
			    }

			    //tag

			    //delete current values
				$stmt = $wpdb->query($wpdb->prepare("DELETE FROM {$taxonomy_table} WHERE media_id = %d", $media_id));//delete tag and category

		    	if(!empty($_POST['tag'])){

		    		$tag = $_POST['tag'];
            		
            		for($i = 0; $i < count($tag); $i++){    

		                $stmt = $wpdb->insert(
					    	$taxonomy_table,
							array( 
								'type' => 'tag',
								'title' => str_replace('"', "'", stripslashes($tag[$i])),
								'media_id' => $media_id
							), 
							array( 
								'%s','%s','%d'
							) 
					    );	
		            }
		    	}

		    	//category
		    	if(!empty($_POST['category'])){

		    		$category = $_POST['category'];
            		
            		for($i = 0; $i < count($category); $i++){    

		                $stmt = $wpdb->insert(
					    	$taxonomy_table,
							array( 
								'type' => 'category',
								'title' => str_replace('"', "'", stripslashes($category[$i])),
								'media_id' => $media_id
							), 
							array( 
								'%s','%s','%d'
							) 
					    );	
		            }
		        }




		    	//subtitles

		    	//delete current values
				$stmt = $wpdb->query($wpdb->prepare("DELETE FROM {$subtitle_table} WHERE media_id = %d", $media_id));

		    	//new values
		    	if(!empty($_POST['subtitle_src']) && !wpsvp_nullOrEmpty($_POST['subtitle_src'][0])){
		    		
		    		$subtitle_src = $_POST['subtitle_src'];
		    		$subtitle_label = $_POST['subtitle_label'];
            		
            		for($i = 0; $i < count($subtitle_src); $i++){    

		                $subtitle_default = 0;	

		                if(isset($_POST['subtitle_default'])){
	            			$subtitle_default = $_POST['subtitle_default'][0];

	            			if($subtitle_default == $subtitle_label[$i]){
	            				$subtitle_default = 1;
	            			}
	            		}

		                $stmt = $wpdb->insert(
					    	$subtitle_table,
							array( 
								'src' => str_replace('"', "'", stripslashes($subtitle_src[$i])),
								'label' => str_replace('"', "'", stripslashes($subtitle_label[$i])),
								'def' => $subtitle_default,
								'media_id' => $media_id
							), 
							array( 
								'%s','%s','%d','%d'
							) 
					    );	
		            }
		    	}


		    	//ads

		    	//delete current values
				$stmt = $wpdb->query($wpdb->prepare("DELETE FROM {$ad_table} WHERE media_id = %d", $media_id));

		    	if(!empty($_POST['ad_pre'])){
		    		
		    		$ad_pre = $_POST['ad_pre'][0];

		    		$stmt = $wpdb->insert(
				    	$ad_table,
						array( 
							'active' => $ad_pre['active'],
							'ad_type' => 'ad-pre',
							'type' => $ad_pre['type'],
							'path' => str_replace('"', "'", stripslashes($ad_pre['path'])),
							'is360' => $ad_pre['is360'],
							'yt_quality' => $ad_pre['yt_quality'],
							'poster' => $ad_pre['poster'] !== '' ? str_replace('"', "'", stripslashes($ad_pre['poster'])) : NULL,
							'duration' => $ad_pre['duration'] !== '' ? $ad_pre['duration'] : NULL,
							'skip_enable' => $ad_pre['skip_enable'] !== '' ? $ad_pre['skip_enable'] : NULL,
							'link' => str_replace('"', "'", stripslashes($ad_pre['link'])),
							'target' => $ad_pre['target'],
							'media_id' => $media_id
						), 
						array( 
							'%d','%s','%s','%s','%d','%s','%s','%d','%d','%s','%s','%d'
						) 
				    );	
		    	
		    	}

		    	if(!empty($_POST['ad_mid'])){
		    		
		    		$ad_mid_arr = $_POST['ad_mid'];

		    		for($i = 0; $i < count($ad_mid_arr); $i++){  

		    			$ad_mid = $ad_mid_arr[$i];

			    		$stmt = $wpdb->insert(
					    	$ad_table,
							array( 
								'active' => $ad_mid['active'],
								'ad_type' => 'ad-mid',
								'type' => $ad_mid['type'],
								'path' => str_replace('"', "'", stripslashes($ad_mid['path'])),
								'is360' => $ad_mid['is360'],
								'yt_quality' => $ad_mid['yt_quality'],
								'poster' => $ad_mid['poster'] !== '' ? str_replace('"', "'", stripslashes($ad_mid['poster'])) : NULL,
								'duration' => $ad_mid['duration'] !== '' ? $ad_mid['duration'] : NULL,
							    'skip_enable' => $ad_mid['skip_enable'] !== '' ? $ad_mid['skip_enable'] : NULL,
								'begin' => $ad_mid['begin'],
								'link' => str_replace('"', "'", stripslashes($ad_mid['link'])),
								'target' => $ad_mid['target'],
								'media_id' => $media_id
							), 
							array( 
								'%d','%s','%s','%s','%d','%s','%s','%d','%d','%d','%s','%s','%d'
							) 
					    );	

			    	}
			    	
		    	}

		    	if(!empty($_POST['ad_end'])){
		    		
		    		$ad_end = $_POST['ad_end'][0];

		    		$stmt = $wpdb->insert(
				    	$ad_table,
						array( 
							'active' => $ad_end['active'],
							'ad_type' => 'ad-end',
							'type' => $ad_end['type'],
							'path' => str_replace('"', "'", stripslashes($ad_end['path'])),
							'is360' => $ad_end['is360'],
							'yt_quality' => $ad_end['yt_quality'],
							'poster' => $ad_end['poster'] !== '' ? str_replace('"', "'", stripslashes($ad_end['poster'])) : NULL,
							'duration' => $ad_end['duration'] !== '' ? $ad_end['duration'] : NULL,
							'skip_enable' => $ad_end['skip_enable'] !== '' ? $ad_end['skip_enable'] : NULL,
							'link' => str_replace('"', "'", stripslashes($ad_end['link'])),
							'target' => $ad_end['target'],
							'media_id' => $media_id
						), 
						array( 
							'%d','%s','%s','%s','%d','%s','%s','%d','%d','%s','%s','%d'
						) 
				    );	
		    	
		    	}


		    	//annotations

		    	//delete current values
				$stmt = $wpdb->query($wpdb->prepare("DELETE FROM {$annotation_table} WHERE media_id = %d", $media_id));

				if(!empty($_POST['annotation'])){
		    		
		    		$annotation_arr = $_POST['annotation'];

		    		for($i = 0; $i < count($annotation_arr); $i++){  

		    			$an = $annotation_arr[$i];

		    			$type = $an['type'];
						if($type == 'html')$path = $an['path_html'] !== '' ? str_replace('"', "'", stripslashes($an['path_html'])) : NULL;
						else $path = $an['path'] !== '' ? str_replace('"', "'", stripslashes($an['path'])) : NULL;

			    		$stmt = $wpdb->insert(
					    	$annotation_table,
							array( 
								'active' => $an['active'],
								'type' => $type,
								'path' => $path,
								'adsense_code' => $an['adsense_code'] !== '' ? str_replace('"', "'",stripslashes( $an['adsense_code'])) : NULL,
								'adsense_client' => $an['adsense_client'] !== '' ? str_replace('"', "'", stripslashes($an['adsense_client'])) : NULL,
								'adsense_slot' => $an['adsense_slot'] !== '' ? str_replace('"', "'", stripslashes($an['adsense_slot'])) : NULL,
								'width' => $an['width'] !== '' ? $an['width'] : NULL,
								'height' => $an['height'] !== '' ? $an['height'] : NULL,
								'show_time' => $an['show_time'] !== '' ? $an['show_time'] : NULL,
							    'hide_time' => $an['hide_time'] !== '' ? $an['hide_time'] : NULL,
							    'link' => $an['link'] !== '' ? str_replace('"', "'", stripslashes($an['link'])) : NULL,
								'target' => $an['target'],
								'close_btn' => $an['close_btn'],
								'position' => $an['position'],
								'close_btn_position' => $an['close_btn_position'],
								'margin_top' => $an['margin_top'] !== '' ? $an['margin_top'] : NULL,
								'margin_right' => $an['margin_right'] !== '' ? $an['margin_right'] : NULL,
								'margin_bottom' => $an['margin_bottom'] !== '' ? $an['margin_bottom'] : NULL,
								'margin_left' => $an['margin_left'] !== '' ? $an['margin_left'] : NULL,
								'opacity' => $an['opacity'] !== '' ? $an['opacity'] : NULL,
								'adit_class' => $an['adit_class'] !== '' ? str_replace('"', "'", stripslashes($an['adit_class'])) : NULL,
								'css' => $an['css'] !== '' ? str_replace('"', "'",stripslashes( $an['css'])) : NULL,
								'media_id' => $media_id
							), 
							array( 
								'%d','%s','%s','%s','%s','%s','%d','%d','%d','%d','%s','%s','%d','%s','%s','%d','%d','%d','%d','%f','%s','%s','%d'
							) 
					    );	

			    	}
		    	}

				$msg = 'Success!';
			}else{
				$msge = 'Error occured!';	
			}

		}
	}
}
else if(isset($_POST['playlist-options-save']) && check_admin_referer("wpsvp_edit_playlist_action", "wpsvp_edit_playlist_nonce_field") && isset($playlist_id)){

	//general options

	$options = array();

	$options['upnext'] = $_POST['upnext'];
	$options['upnext_time'] = $_POST['upnext_time'];
	$options['encrypt_media_paths'] = $_POST['encrypt_media_paths'];
	$options['disable_adverts'] = $_POST['disable_adverts'];
	$options['disable_annotations'] = $_POST['disable_annotations'];
	$options['pwd'] = $_POST['pwd'];
	$options['displayPosterOnMobile'] = $_POST['displayPosterOnMobile'];

    $stmt = $wpdb->update(
    	$playlist_table,
		array('options' => serialize($options)), 
		array('id' => $playlist_id),
		array('%s'),
		array('%d')
    );


    //ads

	//delete current values
	$stmt = $wpdb->query($wpdb->prepare("DELETE FROM {$ad_table} WHERE playlist_id = %d", $playlist_id));

	if(!empty($_POST['ad_pre'])){
		
		$ad_pre = $_POST['ad_pre'][0];

		$stmt = $wpdb->insert(
	    	$ad_table,
			array( 
				'active' => $ad_pre['active'],
				'ad_type' => 'ad-pre',
				'type' => $ad_pre['type'],
				'path' => str_replace('"', "'", stripslashes($ad_pre['path'])),
				'is360' => $ad_pre['is360'],
				'yt_quality' => $ad_pre['yt_quality'],
				'poster' => $ad_pre['poster'] !== '' ? str_replace('"', "'", stripslashes($ad_pre['poster'])) : NULL,
				'duration' => $ad_pre['duration'] !== '' ? $ad_pre['duration'] : NULL,
				'skip_enable' => $ad_pre['skip_enable'] !== '' ? $ad_pre['skip_enable'] : NULL,
				'link' => $ad_pre['link'] !== '' ? str_replace('"', "'", stripslashes($ad_pre['link'])) : NULL,
				'target' => $ad_pre['target'],
				'playlist_id' => $playlist_id
			), 
			array( 
				'%d','%s','%s','%s','%d','%s','%s','%d','%d','%s','%s','%d'
			) 
	    );	
	
	}

	if(!empty($_POST['ad_mid'])){
		
		$ad_mid_arr = $_POST['ad_mid'];

		for($i = 0; $i < count($ad_mid_arr); $i++){  

			$ad_mid = $ad_mid_arr[$i];

    		$stmt = $wpdb->insert(
		    	$ad_table,
				array( 
					'active' => $ad_mid['active'],
					'ad_type' => 'ad-mid',
					'type' => $ad_mid['type'],
					'path' => str_replace('"', "'", stripslashes($ad_mid['path'])),
					'is360' => $ad_mid['is360'],
					'yt_quality' => $ad_mid['yt_quality'],
					'poster' => $ad_mid['poster'] !== '' ? str_replace('"', "'", stripslashes($ad_mid['poster'])) : NULL,
					'duration' => $ad_mid['duration'] !== '' ? $ad_mid['duration'] : NULL,
				    'skip_enable' => $ad_mid['skip_enable'] !== '' ? $ad_mid['skip_enable'] : NULL,
					'begin' => $ad_mid['begin'],
					'link' => $ad_mid['link'] !== '' ? str_replace('"', "'", stripslashes($ad_mid['link'])) : NULL,
					'target' => $ad_mid['target'],
					'playlist_id' => $playlist_id
				), 
				array( 
					'%d','%s','%s','%s','%d','%s','%s','%d','%d','%d','%s','%s','%d'
				) 
		    );	

    	}

	}

	if(!empty($_POST['ad_end'])){
		
		$ad_end = $_POST['ad_end'][0];

		$stmt = $wpdb->insert(
	    	$ad_table,
			array( 
				'active' => $ad_end['active'],
				'ad_type' => 'ad-end',
				'type' => $ad_end['type'],
				'path' => str_replace('"', "'", stripslashes($ad_end['path'])),
				'is360' => $ad_end['is360'],
				'yt_quality' => $ad_end['yt_quality'],
				'poster' => $ad_end['poster'] !== '' ? str_replace('"', "'", stripslashes($ad_end['poster'])) : NULL,
				'duration' => $ad_end['duration'] !== '' ? $ad_end['duration'] : NULL,
				'skip_enable' => $ad_end['skip_enable'] !== '' ? $ad_end['skip_enable'] : NULL,
				'link' => $ad_end['link'] !== '' ? str_replace('"', "'", stripslashes($ad_end['link'])) : NULL,
				'target' => $ad_end['target'],
				'playlist_id' => $playlist_id
			), 
			array( 
				'%d','%s','%s','%s','%d','%s','%s','%d','%d','%s','%s','%d'
			) 
	    );	
	
	}

	//annotations

	//delete current values
	$stmt = $wpdb->query($wpdb->prepare("DELETE FROM {$annotation_table} WHERE playlist_id = %d", $playlist_id));

	if(!empty($_POST['annotation'])){
		
		$annotation_arr = $_POST['annotation'];

		for($i = 0; $i < count($annotation_arr); $i++){  

			$an = $annotation_arr[$i];

			$type = $an['type'];
			if($type == 'html')$path = $an['path_html'] !== '' ? str_replace('"', "'", stripslashes($an['path_html'])) : NULL;
			else $path = $an['path'] !== '' ? str_replace('"', "'", stripslashes($an['path'])) : NULL;

    		$stmt = $wpdb->insert(
		    	$annotation_table,
				array( 
					'active' => $an['active'],
					'type' => $type,
					'path' => $path,
					'adsense_code' => $an['adsense_code'] !== '' ? str_replace('"', "'",stripslashes( $an['adsense_code'])) : NULL,
					'adsense_client' => $an['adsense_client'] !== '' ? str_replace('"', "'", stripslashes($an['adsense_client'])) : NULL,
					'adsense_slot' => $an['adsense_slot'] !== '' ? str_replace('"', "'", stripslashes($an['adsense_slot'])) : NULL,
					'width' => $an['width'] !== '' ? $an['width'] : NULL,
					'height' => $an['height'] !== '' ? $an['height'] : NULL,
					'show_time' => $an['show_time'] !== '' ? $an['show_time'] : NULL,
				    'hide_time' => $an['hide_time'] !== '' ? $an['hide_time'] : NULL,
				    'link' => $an['link'] !== '' ? str_replace('"', "'", stripslashes($an['link'])) : NULL,
					'target' => $an['target'],
					'close_btn' => $an['close_btn'],
					'close_btn_position' => $an['close_btn_position'],
					'position' => $an['position'],
					'margin_top' => $an['margin_top'] !== '' ? $an['margin_top'] : NULL,
					'margin_right' => $an['margin_right'] !== '' ? $an['margin_right'] : NULL,
					'margin_bottom' => $an['margin_bottom'] !== '' ? $an['margin_bottom'] : NULL,
					'margin_left' => $an['margin_left'] !== '' ? $an['margin_left'] : NULL,
					'opacity' => $an['opacity'] !== '' ? $an['opacity'] : NULL,
					'adit_class' => $an['adit_class'] !== '' ? str_replace('"', "'", stripslashes($an['adit_class'])) : NULL,
					'css' => $an['css'] !== '' ? str_replace('"', "'", stripslashes($an['css'])) : NULL,
					'playlist_id' => $playlist_id
				), 
				array( 
					'%d','%s','%s','%s','%s','%s','%d','%d','%d','%d','%s','%s','%d','%s','%s','%d','%d','%d','%d','%f','%s','%s','%d'
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


if($action == 'delete_media' && isset($_GET['media_id']) && isset($_GET['playlist_id'])){//delete media

	$media_id = $_GET['media_id'];
    $playlist_id = $_GET['playlist_id'];

    $stmt = $wpdb->query($wpdb->prepare("DELETE FROM {$media_table} WHERE id = %d AND playlist_id = %d", $media_id, $playlist_id));

    if($stmt !== false){
    	$msg = 'Success!';
	}else{
		$msge = 'Error occured!';	
	}
}


if(isset($_GET['playlist_id'])){//load media

	//pagination

	// records per page
	$per_page = 50;
	// current page
	$curr_page = isset($_GET['page_num']) ? $_GET['page_num'] : 1;
	// number of records
	$num_records = $wpdb->get_var($wpdb->prepare("SELECT COUNT(id) FROM {$media_table} WHERE playlist_id = %d", $playlist_id));
	// total pages
	$total_pages = intval(($num_records - 1) / $per_page) + 1;
	// limits
	$curr_page = intval($curr_page);
	if(empty($curr_page) or $curr_page < 0) $curr_page = 1;
	else if($curr_page > $total_pages) $curr_page = $total_pages;
	// start
	$start = $curr_page * $per_page - $per_page;

	



	$stmt = $wpdb->prepare("SELECT id, type, title, order_id FROM {$media_table} WHERE playlist_id = %d ORDER BY order_id LIMIT $start, $per_page", $playlist_id);
	$medias = $wpdb->get_results($stmt, ARRAY_A);

	//playlist data
	$playlist_data = $wpdb->get_row($wpdb->prepare("SELECT title, options FROM {$playlist_table} WHERE id = %d", $playlist_id), ARRAY_A);
	$playlist_options = unserialize($playlist_data['options']);
	$disable_adverts = isset($playlist_options['disable_adverts']) ? $playlist_options['disable_adverts'] : '0';
	$disable_annotations = isset($playlist_options['disable_annotations']) ? $playlist_options['disable_annotations'] : '0';

	//ads

	$stmt = $wpdb->prepare("SELECT * FROM {$ad_table} WHERE playlist_id = %d", $playlist_id);
    $ad_data_global = $wpdb->get_results($stmt, ARRAY_A);

    //annotations

	$stmt = $wpdb->prepare("SELECT * FROM {$annotation_table} WHERE playlist_id = %d", $playlist_id);
    $annotation_data_global = $wpdb->get_results($stmt, ARRAY_A);

}

$yt_video_quality = array(
    'small' => 'small', 
    'medium' => 'medium', 
    'large' => 'large', 
    'hd720' => 'hd720', 
    'hd1080' => 'hd1080', 
    'hd1440' => 'hd1440',
    'highres' => 'highres', 
    'default' => 'default' 
);

?>

<script type="text/javascript">
    var adDataGlobal_arr = <?php echo(json_encode($ad_data_global, JSON_HEX_TAG)); ?>;
    var annotationDataGlobal_arr = <?php echo(json_encode($annotation_data_global, JSON_HEX_TAG)); ?>;
</script>

<div class="wrap" align="center">

	<?php include("notice.php"); ?>

	<div align="center">
		<a class='button-primary' href="<?php echo admin_url("admin.php?page=wpsvp_playlist_manager&playlist_id=".$playlist_id); ?>">Back to Playlist list</a>
	</div>

	<h2 align="center">Edit playlist <span style="color:#FF6600; font-weight:bold;"><?php echo($playlist_data['title']); echo(' - ID #' . $playlist_id); ?></span></h2>

	<div class="wpsvp-admin" data-playlist-id="<?php echo($playlist_id); ?>">


		<p>Global playlist options will be applied to every track in playlist.</p>

		<form id="wpsvpform-save-playlist-options" method="post" enctype="multipart/form-data" action="<?php echo admin_url("admin.php?page=wpsvp_playlist_manager&action=edit_playlist&playlist_id=".$playlist_id); ?>">

		<div class="option-tab">

		    <div class="option-toggle">
		        <span class="option-title">Global playlist options</span>
		    </div>

		    <div class="option-content">

			    <div id="wpsvp-playlist-tabs">

				    <ul style="display: none;"  class="wpsvp-tab-header">
				        <li style="display: none;"  id="wpsvp-tab-playlist-general">General</li>
				        <li style="display: none;"  id="wpsvp-tab-playlist-adverts">Adverts</li>
				        <li style="display: none;"  id="wpsvp-tab-playlist-annotations">Annotations</li>
				    </ul>

				    <div id="wpsvp-tab-playlist-general-content" class="wpsvp-tab-content">

				    	<table class="form-table" >

							<tr>
								<th>Show Up Next</th>
								<td>
									<select name="upnext">
				                        <option value="0" <?php if(isset($playlist_options['upnext']) && $playlist_options['upnext'] == "0") echo 'selected' ?>>no</option>
				                        <option value="1" <?php if(isset($playlist_options['upnext']) && $playlist_options['upnext'] == "1") echo 'selected' ?>>yes</option>
				                    </select><br>
				                    <span class="info">Show Up Next thumbnail before next media starts.</span>
								</td>
							</tr>
							<tr valign="top">
				                <th>Up Next Show Time</th>
				                <td>
				                    <input type="number" min="0" name="upnext_time" value="<?php echo($playlist_options['upnext_time']); ?>">
				                    <br>
				                    <span class="info">Time before "Up Next" thumbnail is shown for next playing media. For example, setting it to 20 will make it appear 20 seconds before current media ends.</span>
				                </td>
				            </tr>
				            <tr>
								<th>Encrypt media paths</th>
								<td>
									<select name="encrypt_media_paths">
				                        <option value="0" <?php if(isset($playlist_options['encrypt_media_paths']) && $playlist_options['encrypt_media_paths'] == "0") echo 'selected' ?>>no</option>
				                        <option value="1" <?php if(isset($playlist_options['encrypt_media_paths']) && $playlist_options['encrypt_media_paths'] == "1") echo 'selected' ?>>yes</option>
				                    </select><br>
				                    <span class="info">Hide video and subtitle urls from page source with encryption.</span>
								</td>
							</tr>
							<tr valign="top">
		                        <th>Password protected content</th>
		                        <td>
		                            <input type="text" id="wpsvp_pwd_g" name="pwd" placeholder="" value="<?php if(isset($playlist_options['pwd'])) echo ($playlist_options['pwd']); ?>" autocomplete="off" onfocus="this.removeAttribute('readonly');">
		                            <p class="info">Enter password to view this media.</p>
		                        </td>
		                    </tr>
		                    <tr>
								<th>Display poster on mobile</th>
								<td>
									<select name="displayPosterOnMobile">
				                        <option value="0" <?php if(isset($playlist_options['displayPosterOnMobile']) && $playlist_options['displayPosterOnMobile'] == "0") echo 'selected' ?>>no</option>
				                        <option value="1" <?php if(isset($playlist_options['displayPosterOnMobile']) && $playlist_options['displayPosterOnMobile'] == "1") echo 'selected' ?>>yes</option>
				                    </select><br>
				                    <span class="info">Display poster on mobile instead of playing media to preserve bandwidth. Note: each media in playlist needs to have poster defined for this to work.
							</tr>

						</table>

					</div>

		    		<div style="display: none;" id="wpsvp-tab-playlist-adverts-content" class="wpsvp-tab-content">
		    			<?php include('ad_section.php'); ?>
					</div>	

					<div style="display: none;" id="wpsvp-tab-playlist-annotations-content" class="wpsvp-tab-content">
		    			<?php include('annotation_section.php'); ?>
					</div>

				</div>
	  	    </div>

	  	</div>        

	  	<p class="wpsvp-actions">			
	  	    <input type="submit" name="playlist-options-save" class="submit" style="display:none;">
			<?php wp_nonce_field('wpsvp_edit_playlist_action', 'wpsvp_edit_playlist_nonce_field'); ?>
			<input id="wpsvp-playlist-options-save-submit"  type="button" class="button-primary" value="Save Global options" <?php disabled( !current_user_can(WPSVP_CAPABILITY) ); ?>>
		</p>

		</form>	

	  	<div class="option-tab-divider"></div>

	  	<p>From this section you can create and edit playlist tracks. Drag the tracks by ID column to change sort order in which they appear in the player.</p>
	  	
	  	<div class="list-actions">
	  		<button id="delete-selected">Delete selected</button>
       		<button id="copy-selected">Copy selected</button>
	  		<button id="move-selected">Move selected</button>
	  		<input type="text" id="filter-media" placeholder="Search by title..">
        </div>


        <div id="playlist-selector-wrap">
        	<span>Select destination playlist:</span><br>
			<select name="playlist_selector" id="playlist_selector" style="">
				<?php $playlists = $wpdb->get_results("SELECT id, title FROM {$playlist_table} ORDER BY title ASC", ARRAY_A); 
					foreach ($playlists as $pl) {
						echo('<option value="'.$pl['id'].'">'.$pl['title'].'</option>');
					}
				?>
			</select>
			<button id="selected-ok">Ok</button>
	  		<button id="selected-cancel">Cancel</button>
		</div>


	  	<div class="option-tab">

		    <div class="option-toggle">
		        <span class="option-title">Playlist tracks</span>
		    </div>

		    <div class="option-content wpsvp-edit-playlist">

				<table id="media-table" class='wpsvp-table wp-list-table widefat' data-playlist-id="<?php echo($playlist_id); ?>">
					<thead>
						<tr>
							<th style="width:3%"><input type="checkbox" class="wpsvp-media-all"></th>
							<th style="width:7%">ID</th>
							<th style="width:10%">Type</th>
							<th style="width:35%">Title</th>
							<th style="width:35%">Path</th>
							<th style="width:10%">Actions</th>
						</tr>
					</thead>
					<tbody id="media-item-list">
						<?php foreach($medias as $media) : ?>
							<tr class="media-item">
								<td><input type="checkbox" class="wpsvp-media-indiv" data-media-id="<?php echo($media['id']); ?>"></td>
								<td class="msort" data-media-id="<?php echo($media['id']); ?>" data-order-id="<?php echo($media['order_id']); ?>"><?php echo($media['id']); ?></td>
								<td><?php echo($media['type']); ?></td>
								<td class="media-title"><?php echo($media['title']); ?></td>
								<td><?php 
									$media_id = $media['id'];
									$paths = $wpdb->prepare("SELECT path FROM {$path_table} WHERE media_id = %d LIMIT 1", $media_id);
									$path = $wpdb->get_var($paths);
									echo($path); 
								?></td>
								<td><a href='<?php echo admin_url("admin.php?page=wpsvp_playlist_manager&action=edit_media&media_id=".$media['id']); ?>&playlist_id=<?php echo($playlist_id); ?>&media_type=<?php echo($media['type']); ?>&page_num=<?php echo($curr_page); ?>' title='Edit media'>Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='<?php echo admin_url("admin.php?page=wpsvp_playlist_manager&action=delete_media&media_id=".$media['id']); ?>&playlist_id=<?php echo($playlist_id); ?>' title='Delete media' onclick="return confirm('Are you sure you want to delete media <?php echo($media['title']); ?> ?')" style="color:#f00;">Delete</a></td>
							</tr>
						<?php endforeach; ?>	
					</tbody>		 
				</table>

			</div>
	    </div>
    </div>

	<p class="wpsvp-actions">				
		<a class='button-primary' href='<?php echo admin_url("admin.php?page=wpsvp_playlist_manager&action=add_media&playlist_id=".$playlist_id); ?>'>Add New Media</a> 
		<a class='button-primary' href="<?php echo admin_url("admin.php?page=wpsvp_playlist_manager&playlist_id=".$playlist_id); ?>">Back to Playlist list</a>
	</p>  

	<?php if($total_pages > 1) : ?>
	    <ul class="wpsvp-pgn">
	    <?php for($i = 1; $i <= $total_pages; $i++) : ?>
	        <?php if($i !== $curr_page) : ?>
	            <li><a class="wpsvp-pgn-btn" href="<?php echo admin_url("admin.php?page=wpsvp_playlist_manager&action=edit_playlist&playlist_id=$playlist_id&page_num=$i") ?>"><?php echo $i ?></a></li>
	        <?php else : ?>
	            <li><a class="wpsvp-pgn-btn wpsvp-pgn-current" href="<?php echo admin_url("admin.php?page=wpsvp_playlist_manager&action=edit_playlist&playlist_id=$playlist_id&page_num=1") ?>"><?php echo $i ?></a></li>
	        <?php endif; ?>
	    <?php endfor; ?>
	    </ul>
	<?php endif; ?>  
	
</div>



