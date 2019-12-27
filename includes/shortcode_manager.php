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

	<h2>Shortcodes</h2>

	<div class="wpsvp-admin wpsvp-shortcode-manager-wrap">

	<div class="option-tab">
	    <div class="option-toggle">
	        <span class="option-title">Main Shortcodes</span>
	    </div>

	    <div class="option-content">

	    	<p>Select player and playlist you have already created, and copy shortcode into a page or post.</p>

    		<table class='wpsvp-table wp-list-table widefat'>
				<tbody>

					<tr valign="top">
						<th style="width:15%">Select player</th>
						<td>
				            <select id="shortcode_player">
								<?php foreach($players as $player) : ?>
					                <option value="<?php echo($player['id']); ?>"><?php echo($player['title']); echo(' - ID #' . $player['id']); ?></option>
								<?php endforeach; ?>	
							</select>
			            </td>
					</tr>

					<tr valign="top">
						<th style="width:15%">Select playlist</th>
						<td>
				            <select id="shortcode_playlist">
								<?php foreach($playlists as $playlist) : ?>
					                <option value="<?php echo($playlist['id']); ?>"><?php echo($playlist['title']); echo(' - ID #' . $playlist['id']); ?></option>
								<?php endforeach; ?>	
							</select>
			            </td>
					</tr>
					<tr valign="top">
						<th style="width:15%">Shortcode</th>
						
						<td>
						
				           <textarea id="shortcode_generator" rows="3" style="width: 500px;"></textarea>
			            </td>
					</tr>

					<tr valign="top" style = "display:none;" >
						<th style="width:15%">Shortcode for PHP page</th>
						<td>
				            <textarea id="shortcode_generator2" rows="3" style="width: 500px;"></textarea>
			            </td>
					</tr>
				
				</tbody>		 

			</table>

		</div>
    </div>

    <div class="option-tab-divider"></div>

	<div class="option-tab" style="display: none;">
		<div class="option-toggle">
	        <span class="option-title">Custom shortcodes</span>
	    </div>
	    <div class="option-content">	

			<p>You can use auxiliary shortcodes (without creating player and playlist beforehand) in the following form:</p>

			<p>Playlist shortcodes:</p>

			<table class='wpsvp-table wp-list-table widefat'>
    			<thead>
			        <tr>
			            <th>Parameter</th>
			            <th>Required</th>
			            <th>Value</th>
			        </tr>
			    </thead>
				<tbody>
					<tr>
						<td>type</td>
						<td>yes</td>
						<td>
				            video, video_360, folder_video, hls, dash, audio, folder_audio, image, image_360, folder_image, youtube_single, youtube_playlist, youtube_channel, youtube_user, youtube_video_query, vimeo_single, vimeo_user_album, vimeo_album, vimeo_channel, vimeo_group, vimeo_video_query, iframe
			            </td>
					</tr>
					<tr id="path">
						<td>path</td>
						<td>yes</td>
						<td>
							path to media (video, audio or image),<br><br> 

							for Youtube or Vimeo only ID part is required, so for example: 
							<br>Youtube single video ID is "tb935IxGBt4"
							<br>Youtube playlist ID is "PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI"
							<br>Youtube channel ID is "UCqhnX4jA0A5paNd1v-zEysw" (for youtube_channel)
							<br>Youtube user ID is "FatalefashionIII" (for youtube_user)
							<br>Youtube video query is any search keyword<br>
							
							<br>Vimeo single video ID is "279267531"
							<br>Vimeo channel ID is "jesc"
							<br>Vimeo album ID is "3391770", user ID = "cameranera" (for vimeo_user_album)
							<br>Vimeo album ID is "3391770" (for vimeo_album)
							<br>Vimeo group ID is "166603"
							<br>Vimeo video query is any search keyword<br>

							<br>Iframe example (Wista video): https://fast.wistia.net/embed/iframe/lyci2n3zo6?autoplay=true
			            </td>
					</tr>
					<tr>
						<td>mp4</td>
						<td></td>
						<td>
				            Add url to mp4 video as a backup for browsers that do not support live streaming. (ios mpeg-dash, other..?)
			            </td>
					</tr>
					<tr>
						<td>quality_title</td>
						<td></td>
						<td>
				            For self hosted media. Menu title quality for each <a href="#path">path</a> provided (for example: "SD", "HD"). Not required for only single "path".
			            </td>
					</tr>
					<tr>
						<td>quality</td>
						<td></td>
						<td>
				            For self hosted media default quality to load on start if you have multiple <a href="#path">path</a> provided (one value from quality_title).

				            <br><br>For Youtube this is suggested quality: <a href="https://developers.google.com/youtube/iframe_api_reference#Playback_quality" target="_blank">https://developers.google.com/youtube/iframe_api_reference#Playback_quality</a>
			            </td>
					</tr>
					<tr>
						<td>user_id</td>
						<td>yes for vimeo_user_album</td>
						<td>
				            Vimeo user ID 
			            </td>
					</tr>
					<tr id="limit">
						<td>limit</td>
						<td></td>
						<td>
				            Number of results to retrieve (default all)
			            </td>
					</tr>
					<tr>
						<td>sort_type</td>
						<td></td>
						<td>
				            Youtube video query (youtube_video_query) sort method. The default value is relevance.<br>
				            <a href="https://developers.google.com/youtube/v3/docs/search/list#order" target="_blank">https://developers.google.com/youtube/v3/docs/search/list#order</a><br><br>

				            For Vimeo, check sort methods here: <a href="https://developer.vimeo.com/api/playground/" target="_blank">https://developer.vimeo.com/api/playground/</a>
			            </td>
					</tr>
					<tr>
						<td>sort_dir</td>
						<td></td>
						<td>
				            Vimeo API sort direction (asc / desc)
			            </td>
					</tr>
					<tr>
						<td>noapi</td>
						<td></td>
						<td>
				            Add Youtube or Vimeo single video directly to playlist without processing it with API (and set your own custom thumbnail, title and description). (0=false / 1=true)</td>
			            </td>
					</tr>
					<tr>
						<td>is360</td>
						<td></td>
						<td>
				            Set this if Youtube or Vimeo video is 360. (0=false / 1=true)</td>
			            </td>
					</tr>
					<tr>
						<td>load_more</td>
						<td></td>
						<td>
				            Load more videos on total scroll when used with <a href="#navigation_type">navigation_type</a> scroll or buttons.
				            <br>Works with Youtube media (playlist, channel, video search) or Vimeo (album, group, channel, video search). 
				            <br>Works in conjuntion with <a href="#limit">limit</a> option (for example, set limit="10" which will show 10 videos in playlist on start, then on total scroll, it will load another 10, and so on.. 
				            <br>(max limit for this option when Vimeo is used is 100).
			            </td>
					</tr>
					<tr>
						<td>show_load_more</td>
						<td></td>
						<td>
				            Used with <a href="#playlist_position">playlist_position</a> "outer" and "wall", show load more button below playlist. (0=false / 1=true)
			            </td>
					</tr>
					<tr>
						<td>poster</td>
						<td></td>
						<td>
				            Video or audio poster for self hosted media.
			            </td>
					</tr>
					<tr>
		            <td>poster_frame_time</td>
			            <td>seconds</td>
			            <td>set any frame as poster for self hosted video. For example, set 2 to display frame at 2 seconds into the video as poster. Requires autoPlay:false in settings. Do not set data-poster if you want this feature.  
			            </td>
			        </tr>
					<tr>
						<td>thumb</td>
						<td></td>
						<td>
				            Thumbnail url for playlist.
			            </td>
					</tr>
					<tr>
						<td>alt_text</td>
						<td></td>
						<td>
				            Thumbnail alt text, default is title.
			            </td>
					</tr>
					<tr>
						<td>hover_preview</td>
						<td></td>
						<td>
				            Show live preview when hovering over playlist item thumbnail. Requires gif image (same size as thumbnail).
			            </td>
					</tr>
					<tr>
						<td>title</td>
						<td></td>
						<td>
				            Media title 
			            </td>
					</tr>
					<tr>
						<td>description</td>
						<td></td>
						<td>
				            Media description
			            </td>
					</tr>
					<tr>
						<td>start</td>
						<td></td>
						<td>
				            Media start seconds
			            </td>
					</tr>
					<tr>
						<td>end</td>
						<td></td>
						<td>
				            Media end seconds
			            </td>
					</tr>
					<!-- Added by Boldman-->
<!-- 					<tr>
						<td>playing_length</td>
						<td></td>
						<td>
				            Media Playing length
			            </td>
					</tr> -->
					<tr>
			            <td>width / height</td>
			            <td></td>
			            <td>If you want to get rid of black bars (which sometimes appear above / below of the video) for Youtube or Vimeo video (using fit-outside with <a href="#aspect_ratio">aspect_ratio</a> 2), its necessary to supply video dimensions. For example data-width="640" data-height="360". Tip: use data-width="16" data-height="9" to achieve 16/9 video ratio. Only for Youtube or Vimeo chromeless player.</td>
			        </tr>
					<tr>
						<td>playback_rate</td>
						<td></td>
						<td>
				            Media playback speed: <a href="http://www.w3schools.com/tags/av_prop_playbackrate.asp" target="_blank">http://www.w3schools.com/tags/av_prop_playbackrate.asp</a>
			            </td>
					</tr>
					<tr>
						<td>end_link</td>
						<td></td>
						<td>
				            Url link to open on media end (when media finishes).
			            </td>
					</tr>
					<tr>
						<td>end_target</td>
						<td></td>
						<td>
				            Url link target (_blank, _parent..)
			            </td>
					</tr>
					<tr>
						<td>share</td>
						<td></td>
						<td>
				            Custom share url link
			            </td>
					</tr>
					<tr>
						<td>download</td>
						<td></td>
						<td>
				            Custom download path
			            </td>
					</tr>
					<tr>
			            <td>duration</td>
			            <td></td>
			            <td>How long to show the image type, in seconds.</td>
			        </tr>
			        <tr>
			            <td>pwd</td>
			            <td></td>
			            <td>Set password to view media (with md5 hash)</td>
			        </tr>
			        <tr>
			            <td>encrypt_media_paths</td>
			            <td></td>
			            <td>Hide media and subtitle urls from page source with encryption (0=false / 1=true)</td>
			        </tr>
			        <tr>
			            <td>tag</td>
			            <td></td>
			            <td>Retrieve all media with certain tag(s).</td>
			        </tr>
			        <tr>
			            <td>category</td>
			            <td></td>
			            <td>Retrieve all media that belong to certain category(-ies).</td>
			        </tr>
			        <tr>
			            <td>match</td>
			            <td></td>
			            <td>Match any (default) or all tags / categories. any / all. </td>
			        </tr>
					
				</tbody>		 
			</table>

			<p><strong>Shortcode examples:</strong></p>

			<p>Load single <span class="wpsvp-em">mp4 video:</span></p>

			<textarea style="width: 70%;">[apwpsvp type="video" path="PATH_TO_MP4_VIDEO" poster="POSTER_URL" thumb="THUMB_URL" title="TITLE_HERE" description="DESCRIPTION_HERE"]</textarea>

			<p>Load single <span class="wpsvp-em">mp4 video, encrypt url from page source, autoplay, hide playlist:</span></p>

			<textarea style="width: 70%;">[apwpsvp type="video" path="PATH_TO_MP4_VIDEO" auto_play="1" encrypt_media_paths="1" playlist_position="no-playlist"]</textarea>

			<p>Load single <span class="wpsvp-em">mp4 video</span> with multiple qualities:</p>

			<textarea style="width: 70%;">[apwpsvp type="video" path="PATH_TO_MP4_VIDEO_QUALITY1,PATH_TO_MP4_VIDEO_QUALITY2" quality_title="720p,1080p" poster="POSTER_URL" thumb="THUMB_URL" title="TITLE_HERE" description="DESCRIPTION_HERE"]</textarea>

			<p>Load <span class="wpsvp-em">video folder</span> with mp4 files:</p>

			<textarea style="width: 70%;">[apwpsvp type="folder_video" path="PATH_TO_FOLDER_WITH_FILES_IN_WP_UPLOADS_DIRECTORY"]</textarea>

			<p>Load single <span class="wpsvp-em">360 virtual reality mp4 video:</span></p>

			<textarea style="width: 70%;">[apwpsvp type="video_360" path="PATH_TO_MP4_VIDEO" poster="POSTER_URL" thumb="THUMB_URL" title="TITLE_HERE" description="DESCRIPTION_HERE"]</textarea>

			<p>Load <span class="wpsvp-em">HLS</span> playlist:</p>

			<textarea style="width: 70%;">[apwpsvp type="hls" path="URL_TO_M3U8" mp4="OPTIONAL_MP4_BACKUP_URL_FOR_BROWSERS_THAT_DO_NO_SUPPORT_HLS"]</textarea>

			<p>Load <span class="wpsvp-em">MPEG DASH</span> playlist:</p>

			<textarea style="width: 70%;">[apwpsvp type="dash" path="URL_TO_MPEG_DASH" mp4="OPTIONAL_MP4_BACKUP_URL_FOR_BROWSERS_THAT_DO_NO_SUPPORT_DASH"]</textarea>

			<br><br><br>



			<p>Load single <span class="wpsvp-em">mp3 audio:</span></p>

			<textarea style="width: 70%;">[apwpsvp type="audio" path="PATH_TO_MP3_AUDIO" poster="POSTER_URL" thumb="THUMB_URL" title="TITLE_HERE" description="DESCRIPTION_HERE"]</textarea>

			<p>Load <span class="wpsvp-em">audio folder</span> with mp3 files:</p>

			<textarea style="width: 70%;">[apwpsvp type="folder_audio" path="PATH_TO_FOLDER_WITH_FILES_IN_WP_UPLOADS_DIRECTORY"]</textarea>

			<br><br><br>



			<p>Load single <span class="wpsvp-em">image:</span></p>

			<textarea style="width: 70%;">[apwpsvp type="image" path="PATH_TO_IMAGE" thumb="THUMB_URL" title="TITLE_HERE" description="DESCRIPTION_HERE"]</textarea>

			<p>Load <span class="wpsvp-em">image folder</span> with images files:</p>

			<textarea style="width: 70%;">[apwpsvp type="folder_image" path="PATH_TO_FOLDER_WITH_FILES_IN_WP_UPLOADS_DIRECTORY"]</textarea>

			<p>Load single <span class="wpsvp-em">360 image panorama:</span></p>

			<textarea style="width: 70%;">[apwpsvp type="image_360" path="PATH_TO_IMAGE" thumb="THUMB_URL" title="TITLE_HERE" description="DESCRIPTION_HERE"]</textarea>

			<br><br><br>



			<p>Load <span class="wpsvp-em">Youtube single video</span> without API (provide your own video thumbnail, title and description):</p>

			<textarea style="width: 70%;">[apwpsvp type="youtube_single" path="pSOoXLRBDuk" thumb="THUMB_URL" title="TITLE_HERE" description="DESCRIPTION_HERE" noapi="1"]</textarea>	

			<p>Load <span class="wpsvp-em">Youtube single video:</span></p>

			<p><strong><a href='<?php echo admin_url("admin.php?page=wpsvp_settings"); ?>'>Dont forget to set Youtube API key in General Settings for Youtube videos!</a></strong></p>

			<textarea style="width: 70%;">[apwpsvp type="youtube_single" path="pSOoXLRBDuk"]</textarea>

			<p>Load <span class="wpsvp-em">Youtube single video list: (multiple videos spearated by comma)</span></p>

			<textarea style="width: 70%;">[apwpsvp type="youtube_single_list" path="5zYArkwq2PQ,M4z90wlwYs8,89s2DVcsoyk"]</textarea>

			<p>Load <span class="wpsvp-em">Youtube playlist</span>, limit to 10 results:</p>

			<textarea style="width: 70%;">[apwpsvp type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10"]</textarea>

			<p>Load <span class="wpsvp-em">Youtube channel</span> with load more option:</p>

			<textarea style="width: 70%;">[apwpsvp type="youtube_channel" path="UCDiNZYo9afpJ49zrNUhA5PA" limit="10" load_more="1"]</textarea>

			<p>Load <span class="wpsvp-em">Youtube user</span> with load more option:</p>

			<textarea style="width: 70%;">[apwpsvp type="youtube_user" path="FatalefashionIII" limit="10" load_more="1"]</textarea>

			<p><span class="wpsvp-em">Search Youtube videos</span> by keyword (search for "sailing" videos):</p>

			<textarea style="width: 70%;">[apwpsvp type="youtube_video_query" path="sailing" limit="10" sort_type="relevance"]</textarea>

			<br><br><br>



			<p>Load <span class="wpsvp-em">Vimeo single video</span> without API (provide your own video thumbnail, title and description):</p>

			<textarea style="width: 70%;">[apwpsvp type="vimeo_single" path="76979871" thumb="THUMB_URL" title="TITLE_HERE" description="DESCRIPTION_HERE" noapi="1"]</textarea>	

			<p>Load <span class="wpsvp-em">Vimeo single video:</span></p>

			<p><strong><a href='<?php echo admin_url("admin.php?page=wpsvp_settings"); ?>'>Dont forget to set Vimeo API access data in General Settings for Vimeo videos!</a></strong></p>

			<textarea style="width: 70%;">[apwpsvp type="vimeo_single" path="pSOoXLRBDuk"]</textarea>

			<p>Load <span class="wpsvp-em">Vimeo single video</span> with chromeless player:</p>

			<textarea style="width: 70%;">[apwpsvp type="vimeo_single" path="58933055" vimeo_player_type="chromeless"]</textarea>

			<p>Load <span class="wpsvp-em">Vimeo group</span>, limit to 10 results:</p>

			<textarea style="width: 70%;">[apwpsvp type="vimeo_group" path="166603" limit="10" sort_type="date"]</textarea>

			<p>Load <span class="wpsvp-em">Vimeo channel</span> with load more option:</p>

			<textarea style="width: 70%;">[apwpsvp type="vimeo_channel" path="jesc" limit="10" sort_type="date" load_more="1"]</textarea>

			<p>Load <span class="wpsvp-em">Vimeo user album:</span></p>

			<textarea style="width: 70%;">[apwpsvp type="vimeo_user_album" path="3391770" user_id="cameranera" limit="10" sort_type="date" sort_direction="asc"]</textarea>

			<p>Load <span class="wpsvp-em">Vimeo album:</span></p>

			<textarea style="width: 70%;">[apwpsvp type="vimeo_album" path="3391770" limit="10" sort_type="date" sort_direction="asc"]</textarea>

			<p><span class="wpsvp-em">Search Vimeo videos</span> by keyword (search for "sailing" videos):</p>

			<textarea style="width: 70%;">[apwpsvp type="vimeo_video_query" path="sailing" limit="10" sort_type="relevant"]</textarea>

			<br><br><br>



			<p>Load <span class="wpsvp-em">iframe</span> Daily Motion video, hide playlist:</p>

			<textarea style="width: 70%;">[apwpsvp type="iframe" path="https://www.dailymotion.com/embed/video/x2hixvz?autoplay=true&related=0" playlist_position="no-playlist"]</textarea>

			<p>Load <span class="wpsvp-em">iframe</span> Wistia video:</p>

			<textarea style="width: 70%;">[apwpsvp type="iframe" path="https://fast.wistia.net/embed/iframe/lyci2n3zo6?autoplay=true" thumb="THUMB_URL" title="TITLE_HERE" description="DESCRIPTION_HERE"]</textarea>

			<p>Load <span class="wpsvp-em">iframe</span> Google maps:</p>

			<textarea style="width: 70%;">[apwpsvp type="iframe" path="https://maps.google.com/maps?q=university of san francisco&t=&z=13&ie=UTF8&iwloc=&output=embed" thumb="THUMB_URL" title="TITLE_HERE" description="DESCRIPTION_HERE"]</textarea>

			<br><br><br>



			<p><strong>Shortcode examples taxonomy:</strong></p>

			<p>Load <span class="wpsvp-em">mp4 videos</span> with certain tags, match any tag, limit to 10 results:</p>

			<textarea style="width: 70%;">[apwpsvp type="video" tag="fashion,music" match="any" limit="10"]</textarea>

			<p>Load <span class="wpsvp-em">Youtube single videos</span> that belong to certain categories, match all categories:</p>

			<textarea style="width: 70%;">[apwpsvp type="youtube_single" category="sport,football,rubgy" match="all" limit="10"]</textarea>

			<p>Load <span class="wpsvp-em">any media type</span> that belong to certain tags and categories:</p>

			<textarea style="width: 70%;">[apwpsvp tag="fashion,music" category="sport,football,rubgy" limit="10"]</textarea>

			<p>Load <span class="wpsvp-em">media from playlist</span> with certain tags:</p>

			<textarea style="width: 70%;">[apwpsvp playlist_id="PLAYLIST_ID_HERE" tag="fashion,music"]</textarea>

			<p>Load <span class="wpsvp-em">media from playlist</span> with certain tags and categories:</p>

			<textarea style="width: 70%;">[apwpsvp playlist_id="PLAYLIST_ID_HERE" tag="fashion,music" category="sport,football,rubgy" limit="10"]</textarea>

			<br><br><br>




			<p>Place shortcode directly in <span class="wpsvp-em">PHP page:</span></p>

			<textarea style="width: 70%;">echo do_shortcode('[apwpsvp type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10"]');</textarea>

			<br><br><br><br><br>


			<p>Player shortcodes:</p>

    		<table class='wpsvp-table wp-list-table widefat'>
    			<thead>
			        <tr>
			            <th>Parameter</th>
			            <th>Value</th>
			        </tr>
			    </thead>
				<tbody>
					<tr id="playlist_position">
						<td>playlist_position</td>
						<td>vrb (Vertical right and bottom)<br>
						    vlb (Vertical left and bottom)<br>
						    vb (Vertical bottom)<br>
						    hb (Horizontal bottom)<br>
						    outer (Outer, endless scroll)<br>
						    wall (Lightbox wall)<br>
						    no-playlist (No playlist, use just player)
						</td>
					</tr>
					<tr id="navigation_type">
						<td>navigation_type</td>
						<td>
				            scroll<br>
						    buttons<br>
						    hover (Mouse move)
			            </td>
					</tr>
					<tr>
						<td>playlist_scroll_theme</td>
						<td>light, dark, minimal, minimal-dark, light-2, dark-2, light-3, dark-3, light-thick, dark-thick, light-thin, dark-thin, inset, inset-dark, inset-2, inset-2-dark, inset-3, inset-3-dark, rounded, rounded-dark, rounded-dots, rounded-dots-dark, 3d, 3d-dark, 3d-thick, 3d-thick-dark
						</td>
					</tr>
					<tr>
						<td>controls_type</td>
						<td>
				            controls1 (controls bottom and top right, vertical volume)<br>
				            controls1b (controls bottom and top right, horizontal volume)<br>
				            controls2 (controls bottom)<br>
    						none (No controls)
			            </td>
					</tr>
					<tr>
			            <td>playlist_item_content</td>
			            <td>Content to show in playlist items. Default is: 'title,description' (Possible values are 'title,date,description'. Order can be changed)</td>
			        </tr>
					<tr id="playlist_style">
						<td>playlist_style</td>
						<td>
				            drot (Description right of thumbnail)<br>
    						dot (Description over thumbnail)
			            </td>
					</tr>
					<tr id="playlist_grid_style">
						<td>playlist_grid_style</td>
						<td>
							<span class="wpsvp-em">(only with <a href="#playlist_position">playlist_position</a> "outer" or "wall")</span><br>
				            gdot (Description over thumbnail)<br>
    						gdbt (Description below thumbnail)
			            </td>
					</tr>
					<tr>
			            <td>playlist_info_animation</td>
			            <td><span class="wpsvp-em">(only with <a href="#playlist_style">playlist_style</a> "dot" or <a href="#playlist_grid_style">playlist_grid_style</a> "gdot")</span><br>
			            	Playlist info animation on mouse over:<br>
			            	pia1 - slide from left<br>
							pia2 - slide from bottom<br>
							pia3 - opacity<br>
							pia4 - slide from bottom both info and thumbnail
			            </td>
			        </tr>
					<tr>
						<td>navigation_style</td>
						<td>
							<span class="wpsvp-em">(only with <a href="#playlist_position">playlist_position</a> "hb" and <a href="#playlist_style">playlist_style</a> "dot")</span><br>
				            normal (No spacing around thumbnails)<br>
    						spaced (Spacing around thumbnails)
			            </td>
					</tr>
					<tr>
						<td>use_playlist_bottom_bar</td>
						<td>
							<span class="wpsvp-em">(only with <a href="#playlist_position">playlist_position</a> "vlb" or "vrb")</span><br>
				            <td>Use playlist bottom bar with search field and random / loop / previous / next buttons. (0=false / 1=true)
			            </td>
					</tr>
					<tr>
						<td>playlist_thumb_style</td>
						<td>
				            square (square thumbnails)<br>
    						round (round thumbnails)
			            </td>
					</tr>
					<tr>
						<td>player_skin</td>
						<td>
				            dark-flat<br>
   							light-flat<br>
   							gray-flat<br>
   							transparent-flat
			            </td>
					</tr>
					<tr>
						<td>player_shadow</td>
						<td>
						    shadow-effect1, shadow-effect2, shadow-effect3, shadow-effect4, shadow-effect5, shadow-effect6
			            </td>
					</tr>
					<tr>
						<td>player_ratio</td>
						<td>Aspect ratio of video area. Set video area ratio to fit your videos, for example 1.333333 = 4/3. Default is 16/9 (1.777777)
			            </td>
					</tr>

					<tr>
						<td>active_item</td>
						<td>Active media to start with on player load (-1 = none, 0 = first, 1 = second...).
						<br>For <a href="#playlist_position">playlist_position</a> "wall", its usefull to set this to -1, so lightbox wont open automatically on start with first video selected.
			            </td>
					</tr>
					<tr>
						<td>volume</td>
						<td>Player volume (0-1)
			            </td>
					</tr>
					<tr>
						<td>auto_play</td>
						<td>autoplay (defaults to false on mobile) (0=false / 1=true)
			            </td>
					</tr>
					<tr>
						<td>auto_play_after_first</td>
						<td>Auto play media after first media has been manually started. Useful if you want to start autoplaying after first media has been manually started. (0=false / 1=true)
			            </td>
					</tr>
					<tr>
						<td>force_muted_autoplay</td>
						<td>Force muted autoplay for video. (auto play on mobile)
			            </td>
					</tr>
					<tr>
						<td>random_play</td>
						<td>Randomize playlist (0=false / 1=true)
			            </td>
					</tr>
					<tr>
						<td>looping_on</td>
						<td>Loop playlist on playlist end (last item in playlist) (0=false / 1=true)
			            </td>
					</tr>
					<tr>
						<td>media_end_action</td>
						<td>next / loop / rewind
			            </td>
					</tr>
					<tr>
						<td>aspect_ratio</td>
						<td>Set how media displays in player. Applicable for video, images, Youtube or Vimeo chromeless players (requires custom width and height set on videos). Possible values: 0 = original, 1 = fit-inside, 2 = fit-outside
			            </td>
					</tr>
					<tr>
						<td>playlist_opened</td>
						<td>Playlist opened on start (0=false / 1=true)
			            </td>
					</tr>
					<tr>
						<td>hide_playlist_on_fullscreen_enter</td>
						<td>Hide playlist on fullscreen enter (0=false / 1=true)
			            </td>
					</tr>
					<tr>
						<td>truncate_playlist_description</td>
						<td>Shorten playlist item description text and apply three dots (...) on the end. (0=false / 1=true)
			            </td>
					</tr>
					<tr>
						<td>truncate_watch</td>
						<td>If truncate_playlist_description is true, keep watching text on window resize and resize if necessary. (0=false / 1=true)
			            </td>
					</tr>
					<tr>
						<td>right_click_context_menu</td>
            			<td>Right click context menu (browser / custom / disabled). Use browser default, custom or disable right click (disable works for self hosted media and Youtube and Vimeo chromeless players).</td>
					</tr>
					<tr>
						<td>custom_context_menu_link</td>
            			<td>Additional url link in custom context menu.</td>
					</tr>
					<tr>
						<td>custom_context_menu_link_target</td>
            			<td>Additional url link target in custom context menu.</td>
					</tr>
					<tr>
						<td>custom_context_menu_link_title</td>
            			<td>Additional url link title in custom context menu.</td>
					</tr>
					<tr>
						<td>use_keyboard_navigation_for_playback</td>
						<td>Use keyboard navigation for playback (left arrow = seek backward, right arrow = seek forward, page up = previous media, page down = next media, spacebar = pause, m = toggle mute). (0=false / 1=true)</td>
					</tr>
					<tr>
						<td>use_swipe_navigation</td>
						<td>Use swipe navigation on touch sensitive devices to move to next or previous media. <br>Note: Works with self hosted audio, video or images, Youtube or Vimeo chromeless players. It does not work with 360 images or videos! (0=false / 1=true)</td>
					</tr>
					<tr>
						<td>sortable_tracks</td>
						<td>Sortable playlist tracks by dragging action. (0=false / 1=true)</td>
					</tr>
					<tr>
						<td>toggle_playback_on_multiple_instances</td>
						<td>Pause one player if other is playing with multiple instances in same page. (0=false / 1=true)</td>
					</tr>
					<tr>
						<td>show_interface_on_media_start</td>
						<td>Show player controls when media starts. (0=false / 1=true)</td>
					</tr>
					<tr>
						<td>play_ads_only_once</td>
						<td>Play ads only once per main media. (0=false / 1=true)</td>
					</tr>
					<tr>
						<td>show_annotations_only_once</td>
						<td>Show annotations only once per main media. (0=false / 1=true)</td>
					</tr>
					<tr>
						<td>youtube_player_type</td>
						<td>Youtube player type. chromeless / default</td>
					</tr>
					<tr>
						<td>force_youtube_chromeless</td>
						<td>Hide Youtube title, info, related videos. Note: this will enlarge Youtube video which means loosing part of the video screen.</td>
					</tr>
					<tr>
						<td>vimeo_player_type</td>
						<td>Vimeo player type. Chromeless is only available for videos hosted by a Plus account or higher! If you set chromeless type and video is not hosted by plus account or higher, default vimeo player will be used in that case.  Its not possible to have chromeless player with <strong>noapi</strong> feature! chromeless / default</td>
					</tr>
					<tr>
						<td>use_mobile_native_player</td>
						<td>Use mobile native player on IOS. Note: if true, this will loose ability to play in browser and have any of the custom elements above the media like subtitles, annotations... etc (0=false / 1=true)</td>
					</tr>
					<tr>
						<td>dynamic_subtitle_size</td>
						<td>Change subtitle size based on player width.</td>
					</tr>
					<tr>
						<td>remember_playback_position</td>
						<td>Remember playback position on new page load (volume, active item, current time).</td>
					</tr>
					<tr>
						<td>playback_position_key</td>
						<td>Unique string identifier for Remember playback position feature (local storage). String (no spacing or special characters). Has to be unique per player.</td>
					</tr>
					<tr>
						<td>cache_time</td>
						<td>Store playlist in browser to limit api requests for Youtube, Vimeo and other services. For example, if you load a Youtube playlist or a Vimeo channel, and set this value to 3600 seconds (1 hour), everytime the page is reloaded within that time, playlist will be loaded from cache.</td>
					</tr>
					<tr>
						<td>playlist_storage_key</td>
            			<td>Unique string identifier for Store playlist in browser feature (local storage). String (no spacing or special characters). Has to be unique per player.</td>
					</tr>
       				<tr>
						<td>use_ga</td>
						<td>Use Google Analytics. (0=false / 1=true)</td>
					</tr>
					<tr>
						<td>ga_tracking_id</td>
						<td>Google Analytics tracking ID. Get tracking ID <a href="https://support.google.com/analytics/answer/1008080" target="_blank">here</a></td>
					</tr>
			        <tr>
			            <td>limit_description_text</td>
			            <td>Limit number of characters in large description text. Enter number, for example 100 (or 0 for no limit).</td>
			        </tr> 
			        <tr>
			            <td>display_playlist_in_page</td>
			            <td>Display playlists in page so they can be loaded with api on runtime using LoadPlaylist method. (string: "all" (display all playlists) or number list of playlist_ID separated by comma, example: "5,22,34")</td>
			        </tr> 
			        <tr>
						<td>minimize_on_scroll</td>
						<td>Minimize on page scroll when player gets out of visible area. (0=false / 1=true)</td>
					</tr>
			        <tr>
						<td>minimize_class</td>
						<td>Add class which will be attached to player on minimize (wpsvp-minimize-bl / wpsvp-minimize-br - classes come from css)
			            </td>
					</tr>

				</tbody>		 
			</table>
			<br>

			<p><strong>Shortcode examples:</strong></p>

			<p>Load <span class="wpsvp-em">Youtube single video</span> without API and hide playlist:</p>

			<textarea style="width: 70%;">[apwpsvp type="youtube_single" path="pSOoXLRBDuk" noapi="1" playlist_position="no-playlist"]</textarea>

			<p>Load <span class="wpsvp-em">Youtube single video</span>, set suggested quality, set video start and end time, set thumbnail alt text, set playback rate, set url link which will open on video end, set video download path, set video password:</p>

			<textarea style="width: 70%;">[apwpsvp type="youtube_single" path="pSOoXLRBDuk" quality="hd1080" start="10" end="20" alt_text="foo" playback_rate="2" end_link="http:www.google.com" end_target="_blank" download="PATH_TO_VIDEO_FOR_DOWNLOAD" pwd="1234abcd"]</textarea>

			<p>Load <span class="wpsvp-em">Youtube playlist</span>, limit to 10 results, set start video, force muted auto play, set player skin, hide interface (controls) on video start, shadow effect below player, closed playlist on start:</p>

			<textarea style="width: 70%;">[apwpsvp type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10" active_item="2" force_muted_autoplay="1" player_skin="light-flat" show_interface_on_media_start="0" player_shadow="shadow-effect1" playlist_opened="0"]</textarea>

			<p>Load <span class="wpsvp-em">Youtube playlist</span>, limit to 10 results, set player skin, set player controls, set playlist position, set navigation type, set playlist style, set playlist info animation, set custom context menu, hide playlist on fullscreen enter, store playlist in browser for 1 hour to limit api requests:</p>

			<textarea style="width: 70%;">[apwpsvp type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10" player_skin="transparent-flat" controls_type="controls2" playlist_position="hb" navigation_type="buttons" playlist_style="dot" playlist_info_animation="pia3" right_click_context_menu="custom" custom_context_menu_link="http://www.google.com" custom_context_menu_link_target="_blank" custom_context_menu_link_title="Your Company Name" hide_playlist_on_fullscreen_enter="1" cache_time="3600"]</textarea>

			<p>Load <span class="wpsvp-em">Youtube playlist</span>, limit to 10 results, playlist position horizontal bottom, navigation type buttons, playlist style description over thumbnail, navigation style spaced, youtube default player:</p>

			<textarea style="width: 70%;">[apwpsvp type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10" playlist_position="hb" navigation_type="buttons" playlist_style="dot" playlist_info_animation="pia1" navigation_style="spaced" youtube_player_type="default"]</textarea>

			<p>Load <span class="wpsvp-em">Vimeo channel</span>, limit to 10 results, playlist position outer, playlist grid style description over thumbnail:</p>

			<textarea style="width: 70%;">[apwpsvp type="vimeo_channel" path="jesc" limit="10" sort_type="date" playlist_position="outer" playlist_grid_style="gdot" playlist_info_animation="pia2"]</textarea>

			<p>Load <span class="wpsvp-em">Vimeo channel</span>, limit to 10 results, playlist position outer, playlist grid style description below thumbnail, vimeo chromeless player, store playlist in browser for 1 hour to limit api requests:</p>

			<textarea style="width: 70%;">[apwpsvp type="vimeo_channel" path="jesc" limit="10" sort_type="date" playlist_position="outer" playlist_grid_style="gdbt" vimeo_player_type="chromeless", cache_time="3600"]</textarea>

			<p>Load <span class="wpsvp-em">Youtube playlist</span>, limit to 10 results, playlist position wall with lightbox, playlist style description over thumbnail, enable and show load more button</p>

			<textarea style="width: 70%;">[apwpsvp type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10" playlist_position="wall" playlist_grid_style="gdot" playlist_info_animation="pia4" load_more="1" show_load_more="1" active_item="-1"]</textarea>






		</div>	
	</div>

	<div class="option-tab-divider" style = "display:none;"  ></div>

	<div class="option-tab" style = "display:none;" >
		<div class="option-toggle">
	        <span class="option-title">API methods</span>
	    </div>
	    <div class="option-content">

	    	<p>API methods available, append PLAYER_ID (wpsvp_playerID, for example wpsvp_player5).<br><br>

    		<table class='wpsvp-table wpsvp-table-api wp-list-table widefat'>
				<tbody>

					<tr>
						<th style="width:15%">Play current media</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.playMedia();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Pause current media</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.pauseMedia();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Toggle playback (pause/play)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.togglePlayback();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Play next media</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.nextMedia();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Play previous media</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.previousMedia();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Set volume (0-1)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.setVolume();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Toggle mute</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.toggleMute();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Set random playlist playback (true/false/toggle)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.toggleRandom();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Set playlist loop (when playlist reaches end) (true/false/toggle)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.toggleLoop();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Toggle description panel (true/false/toggle)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.toggleInfo();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Toggle share panel (true/false/toggle)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.toggleShare();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Toggle playlist (true/false/toggle)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.togglePlaylist();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Toggle fullscreen</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.toggleFullscreen();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Set playback rate</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.setPlaybackRate();">
			            </td>
			            <td>
				            Valid for media type: video, audio, youtube, vimeo.
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Set playback quality (string)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.setPlaybackQuality();">
			            </td>
			            <td>
				            For self hosted media (video, audio, image) this is 'Menu title quality' specified with path in Add media section.<br>
				            For Youtube <a href="https://developers.google.com/youtube/iframe_api_reference#Playback_quality" target="_blank">playback quality</a>
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Set subtitle (string)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.setSubtitle();">
			            </td>
			            <td>
				            This is 'Subtitle menu label' specified with subtitle in Add media section.<br>
				            Empty call to setSubtitle will turn subtitle off.
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Seek (seconds)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.seek();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Seek backward (10 seconds default or any value)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.seekBackward();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Seek forward (10 seconds default or any value)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.seekForward();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Load media (number starting from 0, or by title)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.loadMedia();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Load playlist (append playlist ID)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.loadPlaylist('.wpsvp-playlist-PLAYLIST_ID');">
			            </td>
					</tr>

					<tr>
						<th style="width:15%">add track(s) to playlist</th>
						<td>
						<textarea rows="10" style="width: 700px;">
//add self hosted media

var track = {
    type: 'video', 
    path: [
        {quality: 'sd', ext: 'mp4', src: 'PATH_TO_MP4_VIDEO'},
        {quality: 'hd', ext: 'mp4', src: 'PATH_TO_MP4_VIDEO_HD'}
    ],
    poster: 'PATH_TO_POSTER',
    thumb: 'PATH_TO_THUMB',
    title: 'Video title goes here',
    description: 'Custom description here'
}

//(format, track, play_it, position)

wpsvp_playerID.addTrack('data', track, false, 0); //add track, position 0
wpsvp_playerID.addTrack('data', track, true, 2); //add track, play it, position 2
wpsvp_playerID.addTrack('data', track, true); //add track, play it, position end

----------------------------------

//add youtube single video

var track = {
    type: 'youtube_single', 
    path: '5zYArkwq2PQ'
}

wpsvp_playerID.addTrack('data', track, false, 0); //add track, position 0

----------------------------------

//add vimeo channel

var track = {
    type: 'vimeo_channel', 
    path: 'jesc',
    limit: 10
}

wpsvp_playerID.addTrack('data', track, false, 0); //add track, position 0

						</textarea>
			            </td>
					</tr>

					<tr>
						<th style="width:15%">Remove track from playlist (number starting from 0, or by title)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.removeTrack();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Destroy current playing media</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.destroyMedia();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Destroy current playlist</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.destroyPlaylist();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Set autoplay (true/false)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.setAutoPlay();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Get playlist length</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.getPlaylistLength();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Get setup done (player inited, ready to use api)</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.getSetupDone();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Get media playing</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.getMediaPlaying();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Open lightbox</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.openLightbox();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Close lightbox</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.closeLightbox();">
			            </td>
					</tr>
					<tr>
						<th style="width:15%">Skip advert</th>
						<td>
				            <input type="text" style="width: 400px;" value="wpsvp_playerID.adSkip();">
			            </td>
					</tr>

				</tbody>		 
			</table>

			<p>How to add api method in wordpress post from Text editor:</p>

			<textarea rows="7" style="width: 700px;">
<a onclick="playMedia();return false;" href="#">play Media</a>
<script>	
function playMedia(){   
    if(wpsvp_playerID)map_playerID.playMedia(); return false;  
};
</script>
			</textarea>

  	    </div>
    </div>

    <div class="option-tab-divider" style = "display:none;" ></div>

	<div class="option-tab" style = "display:none;" >
		<div class="option-toggle">
	        <span class="option-title">Events</span>
	    </div>
	    <div class="option-content">

	    	<p>Event callbacks available, append PLAYER_ID (wpsvp_playerID, for example wpsvp_player5).<br><br>

	    	<p><strong>Note:</strong> some events are already defined inside shortcode.php page so you can insert your code there.</p>

	    	<p>Main media events:</p>

    		<table class='wpsvp-table wpsvp-table-api wp-list-table widefat'>
				<tbody>
					
					<tr>
						<th style="width:15%" valign="top">Setup done</th>
						<td>
						<textarea rows="5" style="width: 700px;">
wpsvp_playerID.on("setupDone", function(e, data){
    //called when plugin has been instantiated and is ready to use api, returns (instance, instanceName)
    //console.log(data.instance, data.instanceName);
});
						</textarea>
			            </td>
					</tr>
					<tr>
						<th style="width:15%" valign="top">Media request</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("mediaRequest", function(e, data){
    //called when new media has been requested, returns (instance, instanceName, counter)
});
						</textarea>
			            </td>
					</tr>
					<tr>
						<th style="width:15%" valign="top">Media start</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("mediaStart", function(e, data){
    //called on media start, returns (instance, instanceName, counter)
});
						</textarea>
			            </td>
					</tr>

					<tr>
						<th style="width:15%" valign="top">Media play</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("mediaPlay", function(e, data){
    //called on media play, returns (instance, instanceName, counter)
});
						</textarea>
			            </td>
					</tr>
					<tr>
						<th style="width:15%" valign="top">Media pause</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("mediaPause", function(e, data){
    //called on media pause, returns (instance, instanceName, counter)
});
						</textarea>
			            </td>
					</tr>
					<tr>
						<th style="width:15%" valign="top">Media end</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("mediaEnd", function(e, data){
    //called on media end, returns (instance, instanceName, counter)
});
						</textarea>
			            </td>
					</tr>

					<tr>
						<th style="width:15%" valign="top">Playlist start load</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("playlistStartLoad", function(e, data){
    //called on playlist start load, returns (instance, instanceName)
});
						</textarea>
			            </td>
					</tr>
					<tr>
						<th style="width:15%" valign="top">Playlist end load</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("playlistEndLoad", function(e, data){
    //called on playlist end load, returns (instance, instanceName)
});
						</textarea>
			            </td>
					</tr>
					<tr>
						<th style="width:15%" valign="top">Click playlist item</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("clickPlaylistItem", function(e, data){
    //called on playlist item click, returns (instance, instanceName, counter)
});
						</textarea>
			            </td>
					</tr>

					<tr>
						<th style="width:15%" valign="top">Playlist item disabled</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("playlistItemDisabled", function(e, data){
    //called on playlist item disable, returns (instance, instanceName, item)
});
						</textarea>
			            </td>
					</tr>
					<tr>
						<th style="width:15%" valign="top">Playlist item enabled</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("playlistItemEnabled", function(e, data){
    //called on playlist item enable, returns (instance, instanceName, item)
});
						</textarea>
			            </td>
					</tr>
					<tr>
						<th style="width:15%" valign="top">Volume change</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("volumeChange", function(e, data){
    //called on volume change, returns (instance, instanceName, volume)
});
						</textarea>
			            </td>
					</tr>

					<tr>
						<th style="width:15%" valign="top">Fullscreen before enter</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("fullscreenBeforeEnter", function(e, data){
    //called before fullscreen enter, returns (instance, instanceName)
});
						</textarea>
			            </td>
					</tr>
					<tr>
						<th style="width:15%" valign="top">Fullscreen enter</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("fullscreenEnter", function(e, data){
    //called on fullscreen enter, returns (instance, instanceName)
});
						</textarea>
			            </td>
					</tr>
					<tr>
						<th style="width:15%" valign="top">Fullscreen exit</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("fullscreenExit", function(e, data){
    //called on fullscreen exit, returns (instance, instanceName)
});
						</textarea>
			            </td>
					</tr>
					<tr>
						<th style="width:15%" valign="top">Media download</th>
						<td>
						<textarea rows="5" style="width: 700px;">
wpsvp_playerID.on("mediaDownload", function(e, data){
    //called on media download, returns (instance, instanceName, counter)
    //only with google analytics active!
});
						</textarea>
			            </td>
					</tr>



				</tbody>		 
			</table>

			<br><br><br>

			<p>Advert events (called when advert is playing):</p>

    		<table class='wpsvp-table wpsvp-table-api wp-list-table widefat'>
				<tbody>
					
					<tr>
						<th style="width:15%" valign="top">Advert request</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("adRequest", function(e, data){
    //called when new ad has been requested, returns (instance, instanceName, counter)
});
						</textarea>
			            </td>
					</tr>
					<tr>
						<th style="width:15%" valign="top">Advert start</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("adStart", function(e, data){
    //called on ad start, returns (instance, instanceName, counter)
});
						</textarea>
			            </td>
					</tr>

					<tr>
						<th style="width:15%" valign="top">Advert play</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("adPlay", function(e, data){
    //called on ad play, returns (instance, instanceName, counter)
});
						</textarea>
			            </td>
					</tr>
					<tr>
						<th style="width:15%" valign="top">Advert pause</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("adPause", function(e, data){
    //called on ad pause, returns (instance, instanceName, counter)
});
						</textarea>
			            </td>
					</tr>
					<tr>
						<th style="width:15%" valign="top">Advert end</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("adEnd", function(e, data){
    //called on ad end, returns (instance, instanceName, counter)
});
						</textarea>
			            </td>
					</tr>

					<tr>
						<th style="width:15%" valign="top">Advert skip</th>
						<td>
						<textarea rows="4" style="width: 700px;">
wpsvp_playerID.on("adSkip", function(e, data){
    //called when ad is skipped, returns (instance, instanceName, adId)
});
						</textarea>
			            </td>
					</tr>
				
				</tbody>		 
			</table>

			<p>How to add event callback in wordpress post from Text editor:</p>

			<textarea rows="10" style="width: 700px;">
<script>	
function addMvpEvents(){
    if (!window.wpsvp_playerID){
        setTimeout(addMvpEvents, 100);
    }else{
        window.wpsvp_playerID.on("mediaPlay", function(e, data){
        	//called on media play, returns (instance, instanceName, counter)
    	});
    }
}
addMvpEvents();
</script>
			</textarea>

  	    </div>
    </div>

    <div class="option-tab-divider" style = "display:none;" ></div>

	<div class="option-tab" style = "display:none;" >
		<div class="option-toggle">
	        <span class="option-title">URL Parameters</span>
	    </div>
	    <div class="option-content">

	    	<p>URL Parameters available, that can be appended as query string.</p>

    		<table class='wpsvp-table wpsvp-table-api wp-list-table widefat'>
				<tbody>

					<tr>
						<td>media_id</td>
						<td>Active media to start with on player load (-1 = none, 0 = first, 1 = second...)<br>
						For example: www.your-domain.com/some-page?media_id=3 (load 4th video)
			            </td>
					</tr>
					<tr>
						<td>t</td>
						<td>Time in seconds to start playback<br>
						For example: www.your-domain.com/some-page?t=22 (start playing video at 22 seconds)
			            </td>
					</tr>

				</tbody>		 
			</table>

  	    </div>
    </div>

</div>

