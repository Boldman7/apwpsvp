<?php 

$examples = array(

	'vlb-drot-dark-scroll' => 'Playlist vertical left / bottom, description right of thumbnail, scroll navigation, dark skin',
	'vlb-dot-light-buttons' => 'Playlist vertical left / bottom, description over thumbnail, button navigation, light skin',
    'vrb-drot-dark-scroll' => 'Playlist vertical right / bottom, description right of thumbnail, scroll navigation, dark skin, controls type 2',
    'vrb-drot-gray-scroll' => 'Playlist vertical right / bottom, description right of thumbnail, scroll navigation, gray skin, controls type 2',
    'vrb-drot-transparent-scroll' => 'Playlist vertical right / bottom, description right of thumbnail, scroll navigation, transparent skin',

    'vrb-drot-transparent-buttons' => 'Playlist vertical right / bottom, description right of thumbnail, buttons navigation, transparent skin, controls type 3',
    'vrb-drot-light-buttons' => 'Playlist vertical right / bottom, description right of thumbnail, buttons navigation, light skin, controls type 3, playlist hidden on start',

    'ht-drot-dark-scroll' => 'Playlist horizontal top, description right of thumbnail, scroll navigation, dark skin',
    'ht-dot-light-buttons' => 'Playlist horizontal top, description over thumbnail, button navigation, light skin',

    'hb-dot-dark-buttons-spaced' => 'Playlist horizontal bottom, description over thumbnail, button navigation spaced, dark skin',
    'hb-dot-dark-hover' => 'Playlist horizontal bottom, description over thumbnail, mouse move navigation, dark skin',
    'hb-dot-dark-scroll' => 'Playlist horizontal bottom, description over thumbnail, scroll navigation, dark skin',
    'hb-dot-yt-default-scroll' => 'Playlist horizontal bottom, description over thumbnail, scroll navigation, dark skin, youtube default player',
    'hb-drot-gray-scroll' => 'Playlist horizontal bottom, description right of thumbnail, scroll navigation, dark skin',

    'vb-drot-light-scroll' => 'Playlist vertical bottom, description right of thumbnail, scroll navigation, light skin',

    'outer-gdbt-dark' => 'Outer playlist below player, description below thumbnail, dark skin, load more button',
    'outer-gdot-light' => 'Outer playlist below player, description over thumbnail, light skin, load more button',

    'wall-gdot-dark-load-more' => 'Playlist grid with lightbox, description over thumbnail, dark skin, load more button',
    'wall-gdbt-gray-load-more' => 'Playlist grid with lightbox, description below thumbnail, light skin, load more button',

    'no-playlist-dark' =>' No playlist (just player), dark skin',
);

?>

<div class="wrap">

	<h2>Quick Import examples</h2>

	<p>Here are some demo examples on different player styles. For more details on shortcodes, check <a href='<?php echo admin_url("admin.php?page=wpsvp_shortcodes"); ?>'>Shortcode</a> section.</p>

	<p><strong><a href='<?php echo admin_url("admin.php?page=wpsvp_settings"); ?>'>Dont forget to set Youtube API key in General Settings for Youtube videos!</a></strong></p>

	<select id="style-imports">
		<?php foreach ($examples as $key => $value) : ?>
            <option value="<?php echo($key); ?>"><?php echo($value);?></option>
		<?php endforeach; ?>	
	</select>

	<img id="wpsvp-sample-import" src="" alt=""/>

	<p><strong>Shortcode:</strong></p>

	<textarea class="wpsvp-demo-sc" id="vlb-drot-dark-scroll" style="width: 70%;" rows="3">[apwpsvp playlist_position="vlb" playlist_style="drot" navigation_type="scroll" player_skin="dark-flat" player_shadow="shadow-effect3" type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="vlb-dot-light-buttons" style="width: 70%;" rows="3">[apwpsvp playlist_position="vlb" playlist_style="dot" navigation_type="buttons" playlist_info_animation="pia1" player_skin="light-flat" player_shadow="shadow-effect3" type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="vrb-drot-dark-scroll" style="width: 70%;" rows="3">[apwpsvp playlist_position="vrb" playlist_style="drot" navigation_type="scroll" player_skin="dark-flat" controls_type="controls2" player_shadow="shadow-effect3" type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="vrb-drot-gray-scroll" style="width: 70%;" rows="3">[apwpsvp playlist_position="vrb" playlist_style="drot" navigation_type="scroll" player_skin="gray-flat" controls_type="controls2" player_shadow="shadow-effect3" type="youtube_playlist" path="PLijk13kqreIe83BAajgYNGpsx57keRRNz" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="vrb-drot-transparent-scroll" style="width: 70%;" rows="3">[apwpsvp playlist_position="vrb" playlist_style="drot" navigation_type="scroll" player_skin="transparent-flat" type="youtube_playlist" path="PLj57uJBedZRmmFXLtKiUryejLEgnXWz96" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="vrb-drot-transparent-buttons" style="width: 70%;" rows="3">[apwpsvp playlist_position="vrb" playlist_style="drot" navigation_type="buttons" player_skin="transparent-flat" controls_type="controls1b" type="youtube_playlist" path="PLj57uJBedZRmmFXLtKiUryejLEgnXWz96" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="vrb-drot-light-buttons" style="width: 70%;" rows="3">[apwpsvp playlist_position="vrb" playlist_style="drot" navigation_type="buttons" player_skin="light-flat" controls_type="controls1b" playlist_opened="0"  type="youtube_playlist" path="PLj57uJBedZRmmFXLtKiUryejLEgnXWz96" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="ht-drot-dark-scroll" style="width: 70%;" rows="3">[apwpsvp playlist_position="ht" playlist_style="drot" navigation_type="scroll" player_skin="dark-flat" type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="ht-dot-light-buttons" style="width: 70%;" rows="3">[apwpsvp playlist_position="ht" playlist_style="dot" navigation_type="buttons" player_skin="light-flat" playlist_info_animation="pia3" type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="hb-dot-dark-buttons-spaced" style="width: 70%;" rows="3">[apwpsvp playlist_position="hb" playlist_style="dot" navigation_type="buttons" navigation_style="spaced" player_skin="dark-flat" playlist_info_animation="pia1" contorls_type="controls2" type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="hb-dot-dark-hover" style="width: 70%;" rows="3">[apwpsvp playlist_position="hb" playlist_style="dot" navigation_type="hover" player_skin="dark-flat" playlist_info_animation="pia4" type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="hb-dot-dark-scroll" style="width: 70%;" rows="3">[apwpsvp playlist_position="hb" playlist_style="dot" navigation_type="scroll" player_skin="dark-flat" playlist_info_animation="pia1" type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="hb-dot-yt-default-scroll" style="width: 70%;" rows="3">[apwpsvp playlist_position="hb" playlist_style="dot" navigation_type="scroll" player_skin="dark-flat" playlist_info_animation="pia2" youtube_player_type="default" type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="hb-drot-gray-scroll" style="width: 70%;" rows="3">[apwpsvp playlist_position="hb" playlist_style="drot" navigation_type="scroll" player_skin="gray-flat" controls_type="controls2" type="youtube_playlist" path="PLijk13kqreIe83BAajgYNGpsx57keRRNz" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="vb-drot-light-scroll" style="width: 70%;" rows="3">[apwpsvp playlist_position="vb" playlist_style="drot" navigation_type="scroll" player_skin="light-flat" type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="outer-gdbt-dark" style="width: 70%;" rows="3">[apwpsvp playlist_position="outer" playlist_grid_style="gdbt" player_skin="dark-flat" load_more="1" show_load_more="1" type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="outer-gdot-light" style="width: 70%;" rows="3">[apwpsvp playlist_position="outer" playlist_grid_style="gdot" player_skin="light-flat" contorls_type="controls2" playlist_info_animation="pia3" load_more="1" show_load_more="1" type="youtube_playlist" path="PLEFAC5D656286E89B" limit="10"]</textarea>

	<textarea class="wpsvp-demo-sc" id="wall-gdot-dark-load-more" style="width: 70%;" rows="3">[apwpsvp playlist_position="wall" playlist_grid_style="gdot" player_skin="dark-flat" playlist_info_animation="pia4" load_more="1" show_load_more="1" active_item="-1" type="youtube_playlist" path="PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI" limit="9"]</textarea>

	<textarea class="wpsvp-demo-sc" id="wall-gdbt-gray-load-more" style="width: 70%;" rows="3">[apwpsvp playlist_position="wall" playlist_grid_style="gdbt" player_skin="gray-flat" load_more="1" show_load_more="1" active_item="-1" type="youtube_playlist" path="PLijk13kqreIe83BAajgYNGpsx57keRRNz" limit="9"]</textarea>

	<textarea class="wpsvp-demo-sc" id="no-playlist-dark" style="width: 70%;" rows="3">[apwpsvp playlist_position="no-playlist" player_skin="dark-flat" controls_type="controls2" type="youtube_single" path="pSOoXLRBDuk" noapi="1"]</textarea>

</div>