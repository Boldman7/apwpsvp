<?php


if(isset($_GET['playlist_id']))$playlist_id = $_GET['playlist_id'];
if(isset($_GET['media_type'])) $media_type = $_GET['media_type'];

$page_num = 1;
if(isset($_GET['page_num']))$page_num = $_GET['page_num'];

if(isset($_GET['media_id'])){//edit media

	$media_id = $_GET['media_id'];
	$header = 'Edit media';
	$submit_action = 'edit_media';

    $stmt = $wpdb->prepare("SELECT * FROM {$media_table} WHERE id = %d", $media_id);
    $data = $wpdb->get_row($stmt, ARRAY_A);

    $stmt = $wpdb->prepare("SELECT * FROM {$path_table} WHERE media_id = %d", $media_id);

    $mtype = $data['type'];
    if($mtype == 'video' || $mtype == 'video_360' || $mtype == 'audio' || $mtype == 'image' || $mtype == 'image_360'){
        $multi_path_query_result = $wpdb->get_results($stmt, ARRAY_A);
    }else{
        $path_query_result = $wpdb->get_results($stmt, ARRAY_A);
        $path = $path_query_result[0]['path'];
        $suggested_quality = $path_query_result[0]['quality_title'];//yt
        $mp4 = $path_query_result[0]['mp4'];
    }

    $stmt = $wpdb->prepare("SELECT * FROM {$subtitle_table} WHERE media_id = %d", $media_id);
	$subtitle_query_result = $wpdb->get_results($stmt, ARRAY_A);
	if($wpdb->num_rows == 0)$subtitle_query_result = array(array_fill_keys(array('label', 'src'), ''));

	//ads

	$stmt = $wpdb->prepare("SELECT * FROM {$ad_table} WHERE media_id = %d", $media_id);
    $ad_data = $wpdb->get_results($stmt, ARRAY_A);

    //annotations

	$stmt = $wpdb->prepare("SELECT * FROM {$annotation_table} WHERE media_id = %d", $media_id);
    $annotation_data = $wpdb->get_results($stmt, ARRAY_A);

    //tag and category
    $media_tag = array();
    $media_category = array();

    $stmt = $wpdb->prepare("SELECT title, type FROM {$taxonomy_table} WHERE media_id = %d", $media_id);
    $taxonomy = $wpdb->get_results($stmt, ARRAY_A);
    if($wpdb->num_rows > 0){
        foreach($taxonomy as $tax){//divide
            if($tax['type'] == 'tag')$media_tag[] = $tax['title'];
            else $media_category[] = $tax['title'];
        }
    }

}else{//add media

	$data = '';
    $multi_path_query_result = array(array_fill_keys(array('path', 'quality_title'), ''));
	$subtitle_query_result = array(array_fill_keys(array('label', 'src'), ''));
	$header = 'Add new media';
	$submit_action = 'add_media';

	$ad_data = array();
	$annotation_data = array();
    $media_tag = array();
    $media_category = array();

}

//tags and category general
$post_tag = get_tags(array(
    'hide_empty' => false
));
$post_category = get_categories();



$disable_adverts = isset($data['disable_adverts']) ? $data['disable_adverts'] : '0';
$disable_annotations = isset($data['disable_annotations']) ? $data['disable_annotations'] : '0';

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

$yt_sort_arr = array(
    'relevance' => 'relevance',
    'date' => 'date', 
    'rating' => 'rating', 
    'title' => 'title', 
    'videoCount' => 'videoCount',
    'viewCount' => 'viewCount', 
);

$vimeo_channel_sort_arr = array(
    'added' => 'added', 
    'alphabetical' => 'alphabetical', 
    'comments' => 'comments', 
    'date' => 'date', 
    'default' => 'default', 
    'duration' => 'duration',
    'likes' => 'likes', 
    'manual' => 'manual',
    'modified_time' => 'modified_time', 
    'plays' => 'plays'
);

$vimeo_album_sort_arr = array(
    'alphabetical' => 'alphabetical', 
    'comments' => 'comments', 
    'date' => 'date', 
    'default' => 'default', 
    'duration' => 'duration',
    'likes' => 'likes', 
    'manual' => 'manual',
    'modified_time' => 'modified_time', 
    'plays' => 'plays'
);

$vimeo_group_sort_arr = array(
    'alphabetical' => 'alphabetical', 
    'comments' => 'comments', 
    'date' => 'date', 
    'duration' => 'duration',
    'likes' => 'likes', 
    'plays' => 'plays'
);

$vimeo_video_query_sort_arr = array(
    'alphabetical' => 'alphabetical', 
    'comments' => 'comments', 
    'date' => 'date', 
    'duration' => 'duration',
    'likes' => 'likes', 
    'plays' => 'plays',
    'relevant' => 'relevant'
);

$vimeo_sort_dir_arr = array(    
    'asc' => 'ascending',
    'desc' => 'descending'
);

?>

<script type="text/javascript">
    var adData_arr = <?php echo(json_encode($ad_data, JSON_HEX_TAG)); ?>;
    var annotationData_arr = <?php echo(json_encode($annotation_data, JSON_HEX_TAG)); ?>;
    var media_tag_arr = <?php echo(json_encode($media_tag, JSON_HEX_TAG)); ?>;
    var media_category_arr = <?php echo(json_encode($media_category, JSON_HEX_TAG)); ?>;
</script>

<div class='wrap' align="center">

	<a class='button-primary' href="<?php echo admin_url("admin.php?page=wpsvp_playlist_manager&action=edit_playlist&playlist_id=".$playlist_id); ?>&page_num=<?php echo($page_num); ?>">Back to edit Playlist</a>

	<h2><?php echo($header); ?> 
    <?php if(isset($media_id)) : ?>
    <span style="color:#FF6600; font-weight:bold;"><?php echo($data['title']); echo(' - ID - ' . $media_id); ?></span>
    <?php endif; ?>
    </h2>

	<form id="wpsvpform-addmedia" method="post" enctype="multipart/form-data" action="<?php echo admin_url("admin.php?page=wpsvp_playlist_manager&action=add_media_form&playlist_id=".$playlist_id);?>&page_num=<?php echo($page_num); ?><?php if(isset($media_id))echo('&media_id='.$media_id);?>">

		<div class="wpsvp-admin wpsvp-bg">

		<div id="wpsvp-media-tabs">

		    <ul class="wpsvp-tab-header">
		        <li style = "display:none;" id="wpsvp-tab-media-main">Media</li>
		        <li style = "display:none;" id="wpsvp-tab-media-adverts">Adverts</li>
		        <li style = "display:none;" id="wpsvp-tab-media-annotations">Annotations</li>
		    </ul>

		    <div id="wpsvp-tab-media-main-content" class="wpsvp-tab-content">

				<table class="form-table">
					<tr valign="top">
						<th>Select media type</th>
						<td>
				            <select id="type" name="type" required <?php if(isset($media_type)){ echo 'disabled'; echo ' data-selected="'.$media_type.'"';} ?>>
				                <optgroup label="video">
		                            <option value="video">mp4 video</option>
		                            <option value="video_360">mp4 video 360</option>
		                            <option value="folder_video">Folder with mp4 video files</option>
		                        </optgroup>
		                        <optgroup label="Live streaming">
		                            <option value="hls">HLS Live Streaming</option>
                                    <option value="dash">MPEG DASH Live Streaming</option>
		                        </optgroup>
		                        <optgroup label="audio">
		                            <option value="audio">audio mp3 / wav</option>
		                            <option value="folder_audio">Folder with mp3 audio files</option>
		                        </optgroup>
		                        <optgroup label="image">
		                            <option value="image">image</option>
		                            <option value="image_360">image 360 panorama</option>
		                            <option value="folder_image">Folder with image files</option>
		                        </optgroup>
					            <optgroup label="youtube">
		                            <option value="youtube_single">youtube single video (normal or 360)</option>
		                            <option value="youtube_playlist">youtube playlist</option>
		                            <option value="youtube_channel">youtube channel</option>
                                    <option value="youtube_user">youtube channel by username</option>
		                            <option value="youtube_video_query">search youtube videos by keyword</option>
		                        </optgroup>
		                        <optgroup label="vimeo">
		                            <option value="vimeo_single">vimeo single video (normal or 360)</option>
                                    <option value="vimeo_channel">vimeo channel</option>
		                            <option value="vimeo_album">vimeo album</option>
                                    <option value="vimeo_user_album">vimeo album by username</option>
		                            <option value="vimeo_group">vimeo group</option>
		                            <option value="vimeo_video_query">search vimeo videos by keyword</option>
		                        </optgroup>
		                        <optgroup label="iframe">
		                            <option value="iframe">any custom http(s) url</option>
		                        </optgroup>
				            </select>
			            </td>
					</tr>
					<tr valign="top" id="path_field">
						<th>Path *</th>
						<td>
				            <input type="text" id="path" name="path" required pattern=".*\S+.*" value="<?php if(isset($path)) echo (htmlspecialchars($path)); ?>">

				            <p id="folder_info" class="info">Place your folder with files (read documentation beforehand how to setup folder files) in wordpress uploads directory 'uploads/wpsvp-file-dir' directory and enter folder name here.</p>

				            <p id="iframe_info" class="info">Add custom iframe inside the player. Provide iframe source url, for example, <br>Wistia video: <span class="info-highlight">https://fast.wistia.net/embed/iframe/lyci2n3zo6?autoplay=false</span> <br>Google Maps: <span class="info-highlight">https://maps.google.com/maps?q=university of san francisco&t=&z=13&ie=UTF8&iwloc=&output=embed</span></p>

				            <p id="hls_info" class="info">Enter m3u8 url. Example: <span class="info-highlight">https://bitmovin-a.akamaihd.net/content/sintel/hls/playlist.m3u8</span></p>

                            <p id="dash_info" class="info">Enter manifest url. Example: <span class="info-highlight">https://dash.akamaized.net/akamai/bbb_30fps/bbb_30fps.mpd</span></p>

				            <p id="yt_video_info" class="info">For example, video ID is blue part:<br> <span class="info-light">https://www.youtube.com/watch?v=</span><span class="info-highlight2">tb935IxGBt4</span></p>

				            <p id="yt_playlist_info" class="info">For example, playlist ID is blue part:<br> <span class="info-light">https://www.youtube.com/playlist?list=</span><span class="info-highlight2">PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI</span></p>

	                        <p id="yt_channel_info" class="info">For example, channel ID is blue part:<br> <span class="info-light">https://www.youtube.com/channel/</span><span class="info-highlight2">UCqhnX4jA0A5paNd1v-zEysw</span></p>

                            <p id="yt_user_info" class="info">For example, user ID is blue part:<br> <span class="info-light">https://www.youtube.com/user/</span><span class="info-highlight2">LoungeMusic100</span></p>

	                        <p id="yt_query_info" class="info">You can also use the Boolean NOT (-) and OR (|) operators to exclude videos or to find videos that are associated with one of several search terms. For example, to search for videos matching either "boating" or "sailing", set the q parameter value to boating|sailing. Similarly, to search for videos matching either "boating" or "sailing" but not "fishing", set the q parameter value to boating|sailing -fishing.</p>

	                        <p id="vim_video_info" class="info">For example, video ID is blue part:<br> <span class="info-light">https://vimeo.com/</span><span class="info-highlight2">279267531</span></p>

	                        <p id="vim_channel_info" class="info">For example, channel ID is blue part:<br> <span class="info-light">https://vimeo.com/channels/</span><span class="info-highlight2">jesc</span></p>

	                        <p id="vim_group_info" class="info">For example, groups ID is blue part:<br> <span class="info-light">https://vimeo.com/groups/</span><span class="info-highlight2">166603</span></p>

	                        <p id="vim_album_info" class="info">For example, album ID is blue part:<br> <span class="info-light">https://vimeo.com/album/</span><span class="info-highlight2">3391770</span></p>

			            </td>
					</tr>
                    <tr valign="top" id="mp4_field">
                        <th>MP4 url</th>
                        <td>
                            <input type="text" id="mp4" name="mp4" placeholder="" value="<?php if(isset($mp4)) echo (htmlspecialchars($mp4)); ?>">
                            <p class="info">You can add url to mp4 video as a backup for browsers that do not support live streaming. (ios mpeg-dash, ..?)</p>
                        </td>
                    </tr>
					<tr valign="top" id="user_id_field">
						<th>Vimeo username *</th>
						<td>
							<input type="text" id="user_id" name="user_id" placeholder="Enter vimeo username" value="<?php if(isset($data['user_id'])) echo (htmlspecialchars($data['user_id'])); ?>">
							<p class="info">For example, user ID is blue part:<br> <span class="info-light">https://vimeo.com/</span><span class="info-highlight2">cameranera</span></p>
						</td>
					</tr>
					<tr valign="top" id="limit_field">
						<th>Results limit</th>
						<td>
							<input type="number" name="limit" min="1" step="1" placeholder="Number of results to retrieve (default:all)" value="<?php if(isset($data['limit'])) echo ($data['limit']); ?>">
						</td>
					</tr>
	                <tr valign="top" id="multi_path_field">
						<th>Path *</th>
						<td id="multi_path_content">

                            <?php if(isset($multi_path_query_result)) : ?>
    							<?php foreach($multi_path_query_result as $item) : ?>

    							<div class="multi_path_section">
    								<input type="text" class="multi_path" name="multi_path[]" placeholder="" required pattern=".*\S+.*" value="<?php if(isset($item['path'])) echo (htmlspecialchars($item['path'])); ?>">
    					            <button class="multi_path_upload" name="multi_path_upload[]">Upload</button><br>
    					            
                                    <input style = "display:none;" type="text" class="quality_title" name="quality_title[]" placeholder="Menu title quality" value="aa"><br>
    					            <div style = "display:none;" class="quality_default_checkbox">
    						            <label><input type="radio" class="quality_default" name="quality_default[]" value="" <?php if(isset($item['def']) && $item['def'] == '1' || count($multi_path_query_result) == 1) echo('checked'); ?>>Make this quality default on start</label>
    					            </div>
    					            <button class="multi_path_field_remove">Remove quality</button>
    					        </div>

    					        <?php endforeach; ?>
                            <?php endif; ?>

					        <button style = "display: none;" type="button" id="multi_path_field_add">Add quality</button>

						</td>
					</tr>
					<tr valign="top" id="yt_sort_field">
                        <th>Sort order</th>
                        <td>
                            <select name="yt_sort">
                                <?php foreach ($yt_sort_arr as $key => $value) : ?>
                                    <option value="<?php echo($key); ?>" <?php if(isset($data['sort_type']) && $data['sort_type'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="info">Select sort order response.</p>
                        </td>
                    </tr>
                    <tr valign="top" id="vimeo_channel_sort_field">
                        <th>Sort order</th>
                        <td>
                            <select name="vimeo_channel_sort">
                                <?php foreach ($vimeo_channel_sort_arr as $key => $value) : ?>
                                    <option value="<?php echo($key); ?>" <?php if(isset($data['sort_type']) && $data['sort_type'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="info">Select sort order response.</p>
                        </td>
                    </tr>
                    <tr valign="top" id="vimeo_album_sort_field">
                        <th>Sort order</th>
                        <td>
                            <select name="vimeo_album_sort">
                                <?php foreach ($vimeo_album_sort_arr as $key => $value) : ?>
                                    <option value="<?php echo($key); ?>" <?php if(isset($data['sort_type']) && $data['sort_type'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="info">Select sort order response.</p>
                        </td>
                    </tr>
                    <tr valign="top" id="vimeo_group_sort_field">
                        <th>Sort order</th>
                        <td>
                            <select name="vimeo_group_sort">
                                <?php foreach ($vimeo_group_sort_arr as $key => $value) : ?>
                                    <option value="<?php echo($key); ?>" <?php if(isset($data['sort_type']) && $data['sort_type'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="info">Select sort order response.</p>
                        </td>
                    </tr>
                    <tr valign="top" id="vimeo_video_query_sort_field">
                        <th>Sort order</th>
                        <td>
                            <select name="vimeo_video_query_sort">
                                <?php foreach ($vimeo_video_query_sort_arr as $key => $value) : ?>
                                    <option value="<?php echo($key); ?>" <?php if(isset($data['sort_type']) && $data['sort_type'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="info">Select sort order response.</p>
                        </td>
                    </tr>
                    <tr valign="top" id="vimeo_sort_dir_field">
                        <th>Sort order direction</th>
                        <td>
                            <select name="vimeo_sort_dir">
                                <?php foreach ($vimeo_sort_dir_arr as $key => $value) : ?>
                                    <option value="<?php echo($key); ?>" <?php if(isset($data['sort_dir']) && $data['sort_dir'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="info">Select sort order direction.</p>
                        </td>
                    </tr>
                    <tr valign="top" id="load_more_field">
						<th>Enable Load more option</th>
						<td>
							<select name="load_more">
				                <option value="0" <?php if(isset($data['load_more']) && $data['load_more'] == "0") echo 'selected' ?>>no</option>
				                <option value="1" <?php if(isset($data['load_more']) && $data['load_more'] == "1") echo 'selected' ?>>yes</option>
				            </select>
				            <p class="info">Load more videos on total scroll in player when used with Navigation type Scroll or Buttons, or Playlist style Outer or Wall.
				            <br>Works with Youtube media (playlist, channel, video search) or Vimeo (album, group, channel, video search). 
				            <br>Works in conjuntion with Results limit option above (for example, set Results limit 10 which will show 10 videos in playlist on start, then on total scroll, it will load another 10, and so on.. 
				            <br>(max Results limit for this option when Vimeo is used is 100)</p>
						</td>
					</tr>
					<tr valign="top" id="noapi_field">
						<th>Use without api</th>
						<td>
							<select name="noapi">
				                <option value="0" <?php if(isset($data['noapi']) && $data['noapi'] == "0") echo 'selected' ?>>no</option>
				                <option value="1" <?php if(isset($data['noapi']) && $data['noapi'] == "1") echo 'selected' ?>>yes</option>
				            </select>
				            <p class="info">Select yes if you want to play Youtube or Vimeo single videos by providing video thumbnail, title and description yourself so it doesnt use api to retrieve them.</p>
						</td>
					</tr>
					<tr valign="top" id="is360_field">
						<th>Is video 360</th>
						<td>
							<select name="is360">
				                <option value="0" <?php if(isset($data['is360']) && $data['is360'] == "0") echo 'selected' ?>>no</option>
				                <option value="1" <?php if(isset($data['is360']) && $data['is360'] == "1") echo 'selected' ?>>yes</option>
				            </select>
				            <p class="info">Select yes if video is 360.</p>
						</td>
					</tr>
					<tr valign="top" id="yt_quality_field">
						<th>Suggested Youtube video quality</th>
						<td>
							<select id="yt_quality" name="yt_quality">
								<option value="">Select suggested video quality</option>
								<?php foreach ($yt_video_quality as $key => $value) : ?>
		                            <option value="<?php echo($key); ?>" <?php if(isset($suggested_quality) && $suggested_quality == $key) echo 'selected' ?>><?php echo($value); ?></option>
		                        <?php endforeach; ?>
	                        </select>
	                        <p class="info">Read More about suggested <a href="https://developers.google.com/youtube/iframe_api_reference#Playback_quality" target="_blank">playback quality</a></p>
						</td>
					</tr>
					<tr valign="top" id="poster_field">
						<th>Poster</th>
						<td>
                            <img id="poster_preview" class="wpsvp-img-preview" src="<?php echo (isset($data['poster']) ? htmlspecialchars($data['poster']) : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D'); ?>" alt="">
							<input type="text" id="poster" name="poster" placeholder="Enter poster path" value="<?php if(isset($data['poster'])) echo (htmlspecialchars($data['poster'])); ?>">
				            <button id="poster_upload">Upload</button>
                            <button id="poster_remove">Remove</button><br>
				            <p id="poster_audio_info">Poster is shown in video area while audio plays.</p>
						</td>
					</tr>
                    <tr valign="top" id="poster_frame_time_field">
                        <th>Video frame as poster</th>
                        <td>
                            <input type="number" step="0.1" id="poster_frame_time" name="poster_frame_time" placeholder="" value="<?php if(isset($data['poster_frame_time'])) echo ($data['poster_frame_time']); ?>">
                            <p class="info">Set any video frame time as poster. For example, set 2 to display frame at 2 seconds into the video as poster.<br>Requires autoPlay:false in Player manager settings. Do not set poster if you want this feature.</p>
                        </td>
                    </tr>
					<tr valign="top" id="thumb_field">
						<th>Thumbnail</th>
						<td>
                            <img id="thumb_preview" class="wpsvp-img-preview" src="<?php echo (isset($data['thumb']) ? htmlspecialchars($data['thumb']) : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D'); ?>" alt="">
							<input type="text" id="thumb" name="thumb" placeholder="Enter thumbnail path" value="<?php if(isset($data['thumb'])) echo (htmlspecialchars($data['thumb'])); ?>">
				            <button id="thumb_upload">Upload</button>
                            <button id="thumb_remove">Remove</button>
						</td>
					</tr>
                    <tr valign="top" id="thumbnail_alt_field">
                        <th>Thumbnail alt text</th>
                        <td>
                            <input type="text" id="alt_text" name="alt_text" placeholder="" value="<?php if(isset($data['alt_text'])) echo (htmlspecialchars($data['alt_text'])); ?>">
                            <p class="info">Set thubmnail alt text. Default is title.</p>
                        </td>
                    </tr>
                    <tr valign="top" id="hover_preview_field">
                        <th>Thumbnail hover preview</th>
                        <td>
                            <input type="text" id="hover_preview" name="hover_preview" placeholder="" value="<?php if(isset($data['hover_preview'])) echo ($data['hover_preview']); ?>">
                            <button id="hover_preview_upload">Upload</button>
                            <p class="info">Show preview when hovering over playlist item thumbnail. Requires gif file same size as thumbnail.</a></p>
                        </td>
                    </tr>
					<tr valign="top" id="title_field">
						<th>Title</th>
						<td>
							<textarea id="title" name="title" rows="3" placeholder="Enter title (HTML allowed)"><?php if(isset($data['title'])) echo (htmlspecialchars($data['title'])); ?></textarea>
						</td>
					</tr>
					<tr valign="top" id="description_field">
						<th>Description</th>
						<td>
							<textarea id="description" name="description" rows="3" placeholder="Enter description (HTML allowed)"><?php if(isset($data['description'])) echo (htmlspecialchars($data['description'])); ?></textarea>
						</td>
					</tr>
					<tr valign="top" id="width_field">
						<th>Video width</th>
						<td>
							<input type="number" name="width" min="0" placeholder="Enter video width" value="<?php if(isset($data['width'])) echo ($data['width']); ?>">
							<p class="info">Width and height are only required if you want to use aspect ratio option for Youtube or Vimeo videos (fit-outside or fill screen to remove black bars around the video if exist).<br>Tip: Enter width: 16, height: 9 to achieve 16/9 ratio. Or width: 4, height: 3 to achieve 4/3 ratio. Aspect ratio is set in Player manager section. Aspect ratio is only available with Youtube and Vimeo chromeless players!</p>
						</td>
					</tr>
					<tr valign="top" id="height_field">
						<th>Video height</th>
						<td>
							<input type="number" name="height" min="0" placeholder="Enter video height" value="<?php if(isset($data['height'])) echo ($data['height']); ?>">
						</td>
					</tr>
					<tr valign="top" id="download_field">
						<th>Download path</th>
						<td>
							<input type="text" id="download" name="download" placeholder="Enter download path" value="<?php if(isset($data['download'])) echo (htmlspecialchars($data['download'])); ?>">
				            <button id="download_upload">Upload</button>
						</td>
					</tr>
					<tr valign="top" id="share_field">
						<th>Share url</th>
						<td>
							<input type="text" name="share" placeholder="Enter share link" value="<?php if(isset($data['share'])) echo (htmlspecialchars($data['share'])); ?>">
						</td>
					</tr>
					<tr valign="top" id="start_field">
						<th>Start time</th>
						<td>
							<input type="number" name="start" min="0" step="1" placeholder="Enter start time in seconds" value="<?php if(isset($data['start'])) echo ($data['start']); ?>">
						</td>
					</tr>
					<tr valign="top" id="end_field">
						<th>End time</th>
						<td>
							<input type="number" name="end" min="0" step="1" placeholder="Enter end time in seconds" value="<?php if(isset($data['end'])) echo ($data['end']); ?>">
						</td>
					</tr>
                    <!-- Added by Boldman. -->
<!--                     <tr valign="top" id="playing_length_field">
                        <th>Playing length</th>
                        <td>
                            <input type="number" name="playing_length" min="0" step="1" placeholder="Enter length of playing in seconds" value="<?php //if(isset($data['playing_length'])) echo ($data['playing_length']); ?>">
                        </td>
                    </tr> -->
                    
<!--                     <tr valign="top">   
                        <th>Random Clip time</th>
                        <td>
                            <select id="random_clip_time" name="random_clip_time">
                                <option value="0" <?php //if(isset($data['random_clip_time']) && $data['random_clip_time'] == "0") echo 'selected' ?>>no</option>
                                <option value="1" <?php //if(isset($data['random_clip_time']) && $data['random_clip_time'] == "1") echo 'selected' ?>>yes</option>
                            </select>
                        </td>
                    </tr> -->

                    <tr valign="top" id="normal_play_mode_field">
                        <th>Normal Play mode</th>
                        <td>
                            <select name="normal_play_mode">
                                <option value="0" <?php if(isset($data['normal_play_mode']) && $data['normal_play_mode'] == "0") echo 'selected' ?>>no</option>
                                <option value="1" <?php if(isset($data['normal_play_mode']) && $data['normal_play_mode'] == "1") echo 'selected' ?>>yes</option>
                            </select>
                        </td>
                    </tr>
					
                    <tr valign="top" id="random_clip_time_field">
                        <th>Random Clip time</th>
						
						<?php 
							if($data['random_clip_time']){
								 
								$clip_time= unserialize($data['random_clip_time']);
								$c = count($clip_time);  
																 
								for( $i=0; $i<$c; $i++ ){
																	 
									echo '<td>
									<input type="number" name="random_clip_time[]" min="0.2" max="10800" step="0.01" placeholder="Enter Random Clip time" value="' . $clip_time[$i] . '">';
									
									if($i==0){
									echo '<a href="javascript:void(0);" class="add_randombutton"><img src="https://www.wizps.com/wp-content/uploads/2019/09/plus-icon.png" width="20px" height="auto">
									</a>';
									}else{
									echo '<a href="javascript:void(0);" class="remove_randombutton"><img src="https://www.wizps.com/wp-content/uploads/2019/09/remove.jpg" width="20px" height="auto"></a>';	
									echo '</td>';
									}
								} 
								
								
							}else{
								echo '<td>
                            <input type="number" name="random_clip_time[]" min="0.2" max="10800" step="0.01" placeholder="Enter Random Clip time" value="">
							<a href="javascript:void(0);" class="add_randombutton"><img src="https://www.wizps.com/wp-content/uploads/2019/09/plus-icon.png" width="20px" height="auto">
							</a>
						</td>';
							}
						?>
                        
						
                    </tr>
					 <tr valign="top" id="random_clip_time_field">
                        <th>Multiple Clip time</th>
                        <td>
                            <input type="checkbox" name="all_clip" id="all_clip" <?php if ($data['all_clip'] == 1) { echo "checked='checked'"; } ?> class="all_clip">
						</td>
                    </tr>

                    <!---->
					<tr valign="top" id="playback_rate_field">
						<th>Playback rate</th>
						<td>
							<input type="number" name="playback_rate" step="0.1" placeholder="Enter playback rate" value="<?php if(isset($data['playback_rate'])) echo ($data['playback_rate']); ?>">
							<p class="info">Read More about <a href="https://www.w3schools.com/tags/av_prop_playbackrate.asp" target="_blank">playback rate</a></p>
						</td>
					</tr>
					<tr valign="top" id="preview_seek_field">
						<th>Seekbar preview thumbnail</th>
						<td>
							<input type="text" id="preview_seek" name="preview_seek" placeholder="Enter vtt path" value="<?php if(isset($data['preview_seek'])) echo ($data['preview_seek']); ?>">
				            <button id="preview_seek_upload">Upload</button>
				            <p class="info">Enable thumbnail preview when seeking. Requires vtt file with time/image data.</a></p>
						</td>
					</tr>
					<tr valign="top" id="chapters_field">
						<th>Chapters</th>
						<td>
							<input type="text" id="chapters" name="chapters" placeholder="Enter vtt path" value="<?php if(isset($data['chapters'])) echo ($data['chapters']); ?>">
				            <button id="chapters_upload">Upload</button>
				            <p class="info">Add video chapters. Requires vtt file with chapter data.</a></p>
						</td>
					</tr>
					<tr valign="top" id="subtitle_field">
						<th>Subtitles</th>
						<td id="subtitle_content">

							<?php foreach($subtitle_query_result as $item) : ?>

							<div class="subtitle_section">
								<input type="text" class="subtitle_src" name="subtitle_src[]" placeholder="Enter subtitle source file in vtt/srt format" pattern=".*\S+.*" value="<?php if(isset($item['src'])) echo (htmlspecialchars($item['src'])); ?>">
					            <button class="subtitle_src_upload" name="subtitle_src_upload[]">Upload</button><br>
					            <input type="text" class="subtitle_label" name="subtitle_label[]" placeholder="Subtitle menu label" pattern=".*\S+.*" value="<?php if(isset($item['label'])) echo (htmlspecialchars($item['label'])); ?>"><br>
					            <div>
						            <label><input type="checkbox" class="subtitle_default" name="subtitle_default[]" value="" <?php if(isset($item['def']) && $item['def'] == '1') echo('checked'); ?>>Make this subtitle default on start</label>
					            </div>
					            <button class="subtitle_field_remove">Remove subtitle</button>
					        </div>

					        <?php endforeach; ?>

					        <button type="button" id="subtitle_field_add">Add subtitle</button><br>
					        <div style="clear:both"></div>
					        <p class="info">Add subtitle in srt / vtt format.</p>
						</td>
					</tr>
					<tr valign="top" id="duration_field">
						<th>Duration</th>
						<td>
							<input type="number" min="0" id="duration" name="duration" placeholder="Enter duration" value="<?php if(isset($data['duration'])) echo $data['duration']; ?>">
				            <p class="info">How long to show the image, in seconds.</p>
						</td>
					</tr>
					<tr valign="top">
						<th>End Url link</th>
						<td>
							<input type="text" id="end_link" name="end_link" placeholder="Enter url link" value="<?php if(isset($data['end_link'])) echo $data['end_link']; ?>">
							<p class="info">Url link to open when media is finished.</p>
						</td>
					</tr>
					<tr valign="top">	
						<th>End Url target</th>
						<td>
							<select id="end_target" name="end_target">
					            <option value="_blank" <?php if(isset($data['end_target']) && $data['end_target'] == "_blank") echo 'selected' ?>>_blank</option>
				                <option value="_parent" <?php if(isset($data['end_target']) && $data['end_target'] == "_parent") echo 'selected' ?>>_parent</option>
					        </select>
						</td>
					</tr>
					<tr valign="top">
						<th>Custom content</th>
						<td>
							<textarea id="custom_content" name="custom_content" rows="3"><?php if(isset($data['custom_content'])) echo (htmlspecialchars($data['custom_content'])); ?></textarea>
					        <p class="info">HTML entered here will be added inside playlist item.</p>
						</td>
					</tr>
                    <tr valign="top">
                        <th>Password protected content</th>
                        <td>
                            <input type="text" id="wpsvp_pwd" name="pwd" placeholder="" value="<?php if(isset($data['pwd'])) echo ($data['pwd']); ?>">
                            <p class="info">Enter password to view this media.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th>Tags</th>
                        <td>
                            <div id="wpsvp-tag-wrap"></div>
                            <input type="text" id="wpsvp_tag_input" list="wpsvp-tag-list">
                            <datalist id="wpsvp-tag-list">
                                <?php foreach($post_tag as $tag) : ?>
                                    <option value="<?php echo($tag->name);?>">
                                <?php endforeach; ?>
                            </datalist>
                            <button type="button" id="wpsvp_add_tag">Add</button><br>
                            <p class="info">Add tags for this media. Later in shortcode you can retrieve all media with certain tag(s).</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th>Category</th>
                        <td>
                            <div id="wpsvp-category-wrap"></div>
                            <input type="text" id="wpsvp_category_input" list="wpsvp-category-list">
                            <datalist id="wpsvp-category-list">
                                <?php foreach($post_category as $category) : ?>
                                    <option value="<?php echo($category->name);?>">
                                <?php endforeach; ?>
                            </datalist>
                            <button type="button" id="wpsvp_add_category">Add</button><br>
                            <p class="info">Attach category for this media. Later in shortcode you can retrieve all media that belong to certain category(-ies).</p>
                        </td>
                    </tr>

				</table>

			</div>

    		<div id="wpsvp-tab-media-adverts-content" class="wpsvp-tab-content">
    			<?php include('ad_section.php'); ?>
			</div>

    		<div id="wpsvp-tab-media-annotations-content" class="wpsvp-tab-content">
    			<?php include('annotation_section.php'); ?>
			</div>

		</div>

		</div>

		<p class="wpsvp-actions">			
			<input type="submit" name="<?php echo($submit_action); ?>" class="submit" style="display:none;">
			<?php wp_nonce_field('wpsvp_add_media_action', 'wpsvp_add_media_nonce_field'); ?>
			<input id="wpsvp-edit-media-submit"  type="button" class="button-primary" value="Save Changes" <?php disabled( !current_user_can(WPSVP_CAPABILITY) ); ?>>
            <a class='button-primary' href="<?php echo admin_url("admin.php?page=wpsvp_playlist_manager&action=edit_playlist&playlist_id=".$playlist_id); ?>&page_num=<?php echo($page_num); ?>">Back to edit Playlist</a>
		</p>

	</form>

</div>
<script>
jQuery(document).ready(function(){

		var maxField = 50; 

		var addButton = jQuery('.add_randombutton');  

		var wrapper = jQuery('#random_clip_time_field'); 	
		
		var y = 1;
     	
		jQuery(addButton).click(function(){
			
			if(y < maxField){
				y++;			
				var fieldHTML ='<td><input type="number" name="random_clip_time[]" min="0.2" max="10800" step="0.01" placeholder="Enter Random Clip time" value=""><a href="javascript:void(0);" class="remove_randombutton"><img src="https://www.wizps.com/wp-content/uploads/2019/09/remove.jpg" width="20px" height="auto"></a></td>';
				
				jQuery(wrapper).append(fieldHTML);         
			}     
				
		}); 
		jQuery(wrapper).on('click', '.remove_randombutton', function(e){  
			
			e.preventDefault();     
			
			jQuery(this).parent('td').remove(); 
			
			y--;    

		});
					
	});
</script>
<style>
.form-table td{display:block;}
</style>
