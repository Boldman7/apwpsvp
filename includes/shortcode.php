<?php

//############################################//
/* main shortcode */
//############################################//

$wpsvp_inline_js = '';

function wpsvp_add_player($atts){

    static $wpsvp_unique_player_id = 0;

    //general settings
    global $wpdb;
    $wpdb->show_errors(); 
    $settings_table = $wpdb->prefix . "wpsvp_settings";
    $settings = $wpdb->get_row("SELECT * FROM {$settings_table} WHERE id = '0'", ARRAY_A);
    $js_to_footer = wpsvp_intToBool($settings["js_to_footer"]);

    //get player options
    include_once('player_options.php');
    $default_options = wpsvp_player_options();

    if(isset($atts['player_id'])){
        $player_id = $atts['player_id'];

        if(isset($atts['instance_id'])){
            $instance_id = $atts['instance_id'];
            $wrapper_id = 'wpsvp-wrapper'.$instance_id;
            $instance = 'wpsvp_player'.$instance_id;
        }else{
            $wrapper_id = 'wpsvp-wrapper'.$wpsvp_unique_player_id;
            $instance = 'wpsvp_player'.$wpsvp_unique_player_id;
        }

        //get player options
        $player_table = $wpdb->prefix . "wpsvp_players";
        $stmt = $wpdb->prepare("SELECT options FROM {$player_table} WHERE id = %d", $player_id);
        $result = $wpdb->get_row($stmt, ARRAY_A);
        $player_options = unserialize($result['options']);

        $options = $player_options + $default_options;

        if($result == NULL){
            exit("Invalid shortcode. Player ID '{$player_id}' does not exist!");
        }

    }else{
        $wrapper_id = 'wpsvp-wrapper'.$wpsvp_unique_player_id;
        $instance = 'wpsvp_player'.$wpsvp_unique_player_id;
        $options = $default_options;
    }

    //override some options
    if(is_array($atts) && count($atts) > 0){
        foreach($atts as $att => $item){
            if($att != 'player_id' && $att != 'playlist_id'){
                $options[wpsvp_underscoreToCamelCase($att)] = $item;
            }
        }
    }

    //custom css
    //captions
    if(isset($options["useCaptionCss"]) && $options["useCaptionCss"] == true){
        $inline_css = wpsvp_get_caption_css($wrapper_id, $options);

        wp_register_style('wpsvp-caption-style', false, array('wpsvp-style'));//hook to player main css
        wp_enqueue_style('wpsvp-caption-style');
        wp_add_inline_style('wpsvp-caption-style', $inline_css);
    }

    //output

    if(isset($atts['playlist_id'])){
        $playlist_id = $atts['playlist_id'];
        $playlist = wpsvp_get_playlist($wpsvp_unique_player_id, $playlist_id, $atts, $options);
    }else{
        $playlist_id = '0';
        $playlist = wpsvp_get_playlist2($wpsvp_unique_player_id, $atts);
    } 

    $js = '';
    if($js_to_footer == "true"){
        add_action('wp_print_footer_scripts', 'wpsvp_add_inline_js', 100);
        ob_start();
        wpsvp_get_constructor($wpsvp_unique_player_id, $settings, $options, $playlist_id, $instance, $wrapper_id);
        $GLOBALS['wpsvp_inline_js'] .= ob_get_contents();
        ob_clean();
        ob_end_clean();
    }else{
        $js = wpsvp_get_constructor($wpsvp_unique_player_id, $settings, $options, $playlist_id, $instance, $wrapper_id);
    }

    $html = wpsvp_get_html_markup($wrapper_id, $playlist_id, $options);
    $output = $js . $html . $playlist ;

    $wpsvp_unique_player_id++;

    return $output;

}

function wpsvp_get_caption_css($wrapper_id, $options){

    $markup = '#'.$wrapper_id.' .wpsvp-subtitle-holder-inner{
        background:'.$options['captionBackgroundColor'].' !important;
    }
    #'.$wrapper_id.' .wpsvp-subtitle{
        color: '.$options['captionTextColor'].' !important;
        background: '.$options['captionTextBackgroundColor'].' !important;';
        if($options['captionTextShadow'] != '')$markup .= 'text-shadow: '.$options['captionTextShadow'].' !important;
    }';

    return $markup; 

}

function wpsvp_add_inline_js(){
    echo $GLOBALS['wpsvp_inline_js'];
}

function wpsvp_get_constructor($wpsvp_unique_player_id, $settings, $options, $playlist_id, $instance, $wrapper_id) {

    $playlistPosition = $options["playlistPosition"];

    //breakpoints

    $breakPointArr = "''";
    if($playlistPosition == 'outer' || $playlistPosition == 'wall'){

        if(isset($options['bp_width'])){

            $bp_width = $options['bp_width'];
            $bp_column = $options['bp_column'];
            $bp_gutter = $options['bp_gutter'];

            $breakPointArr = '[';
            
            foreach ($bp_width as $id => $key) {
                if(!wpsvp_nullOrEmpty($key)){
                    $breakPointArr .= '{width:'.$bp_width[$id].', column:'.$bp_column[$id].', gutter:'.$bp_gutter[$id].'},';
                }
            }
            $breakPointArr = rtrim($breakPointArr,',');
            $breakPointArr .= ']';

        }else{

            $bpa = $options['breakPointArr'];
            $breakPointArr = '[';
            foreach ($bpa as $id => $key) {
                $breakPointArr .= '{width:'.$key['width'].', column:'.$key['column'].', gutter:'.$key['gutter'].'},';
            }
            $breakPointArr = rtrim($breakPointArr,',');
            $breakPointArr .= ']';

        }
    }

    

    //visibility

    if(isset($options['ev'])){
        $elementsVisibilityArr = '[';
        foreach ($options['ev'] as $arr) {
            if(count($arr) > 1 && isset($arr['width'])){//if there are elements set to hide 
                $width = $arr['width'];
                unset($arr['width']);
                $elements = json_encode(array_keys($arr));
                $elementsVisibilityArr .= '{width:'.$width.', elements:'.$elements.'}';
                $elementsVisibilityArr .= ',';
            }
        }
        $elementsVisibilityArr = rtrim(trim($elementsVisibilityArr), ',');//remove last comma
        $elementsVisibilityArr .= ']';
    }else{
        $elementsVisibilityArr = "''";
    }


    //options
    $useGa = wpsvp_intToBool($options["useGa"]);
    


    $no_conflict = wpsvp_intToBool($settings["no_conflict"]);

	$markup = '<script>
        if (!/loaded|interactive|complete/.test(document.readyState)) document.addEventListener("DOMContentLoaded",onLoad); else onLoad();  
    function onLoad() {    
        var wpsvpjq = jQuery;     
	    if('.$no_conflict.' == "true"){ wpsvpjq.noConflict();}
        var settings = {
            instanceName: "'.$instance.'",
            sourcePath: "'.plugins_url('/apwpsvp/source/').'",
            playlistList:"#wpsvp-playlist-list-'.$wpsvp_unique_player_id.'",
            activePlaylist: ".wpsvp-playlist-'.$playlist_id.'",
            activeItem: '.$options["activeItem"].',
            volume: '.$options["volume"].',
            autoPlay: '.wpsvp_intToBool($options["autoPlay"]).',
            forceMutedAutoplay: '.wpsvp_intToBool($options["forceMutedAutoplay"]).',
            preload: "'.$options["preload"].'",
            randomPlay: '.wpsvp_intToBool($options["randomPlay"]).',
            loopingOn: '.wpsvp_intToBool($options["loopingOn"]).',
            mediaEndAction: "'.$options["mediaEndAction"].'",
            aspectRatio: '.$options["aspectRatio"].',
            youtubeAppId: "'.$settings["youtube_id"].'",
            facebookAppId: "'.$settings["facebook_id"].'",
            youtubeNoCookie: '.wpsvp_intToBool($settings["youtube_no_cookie"]).',
            youtubePlayerColor: "'.$options["youtubePlayerColor"].'",
            vimeoPlayerColor: "'.$options["vimeoPlayerColor"].'",
			playlistOpened: '.wpsvp_intToBool($options["playlistOpened"]).',
            blockYoutubeEvents: '.wpsvp_intToBool($options["blockYoutubeEvents"]).',
            playlistScrollTheme: "'.$options["playlistScrollTheme"].'",
            rightClickContextMenu: "'.$options["rightClickContextMenu"].'",
            hidePlaylistOnFullscreenEnter: '.wpsvp_intToBool($options["hidePlaylistOnFullscreenEnter"]).',
            hideQualityMenuOnSingleQuality: '.wpsvp_intToBool($options["hideQualityMenuOnSingleQuality"]).',
            truncatePlaylistDescription: '.wpsvp_intToBool($options["truncatePlaylistDescription"]).',
            truncateWatch: '.wpsvp_intToBool($options["truncateWatch"]).',
            useKeyboardNavigationForPlayback: '.wpsvp_intToBool($options["useKeyboardNavigationForPlayback"]).',
            embedWidth: "'.$options["embedWidth"].'",
            embedHeight: "'.$options["embedHeight"].'",
            embedSrc: "'.$options["embedSrc"].'",
            sortableTracks: '.wpsvp_intToBool($options["sortableTracks"]).',
            togglePlaybackOnMultipleInstances: '.wpsvp_intToBool($options["togglePlaybackOnMultipleInstances"]).',
            clickOnBackgroundClosesLightbox: '.wpsvp_intToBool($options["clickOnBackgroundClosesLightbox"]).',
            playerRatio: "'.$options["playerRatio"].'",
            wrapperMaxWidth: "'.$options["wrapperMaxWidth"].'",
            playlistBottomHeight: '.$options["playlistBottomHeight"].',
            playlistSideWidth: '.$options["playlistSideWidth"].',
            wrapperLayout: "'.$options["wrapperLayout"].'",
            autoPlayAfterFirst: '.wpsvp_intToBool($options["autoPlayAfterFirst"]).',
            autoPlayInViewport: '.wpsvp_intToBool($options["autoPlayInViewport"]).',
            youtubePlayerType: "'.$options["youtubePlayerType"].'",
            forceYoutubeChromeless: '.wpsvp_intToBool($options["forceYoutubeChromeless"]).',
            vimeoPlayerType: "'.$options["vimeoPlayerType"].'",
            showInterfaceOnMediaStart: '.wpsvp_intToBool($options["showInterfaceOnMediaStart"]).',
            breakPointArr: '.$breakPointArr.',
            playlistItemContent: "'.$options['playlistItemContent'].'",
            logoPosition: "'.$options["logoPosition"].'",
            logoMargin: '.$options["logoMargin"].',
            lightboxMaxWidth: '.$options["lightboxMaxWidth"].',
            subtitleOffText: "'.$options["subtitleOffText"].'",
            elementsVisibilityArr: '.$elementsVisibilityArr.',
            playAdsOnlyOnce: '.wpsvp_intToBool($options["playAdsOnlyOnce"]).',
            showAnnotationsOnlyOnce: '.wpsvp_intToBool($options["showAnnotationsOnlyOnce"]).',
            rememberPlaybackPosition: '.wpsvp_intToBool($options["rememberPlaybackPosition"]).',
            playbackPositionKey: "'.$options["playbackPositionKey"].'",
            useMobileNativePlayer: '.wpsvp_intToBool($options["useMobileNativePlayer"]).',
            vai:{vk:"'.base64_encode($settings["vimeo_key"]).'",vs:"'.base64_encode($settings["vimeo_secret"]).'",vt:"'.base64_encode($settings["vimeo_token"]).'"},
            useGa: '.$useGa.',
            gaTrackingId: "'.$options["gaTrackingId"].'",
            useSwipeNavigation: '.wpsvp_intToBool($options["useSwipeNavigation"]).',
            limitDescriptionText: '.$options["limitDescriptionText"].',
            minimizeOnScroll: '.wpsvp_intToBool($options["minimizeOnScroll"]).',
            minimizeClass: "'.$options["minimizeClass"].'",
            dynamicSubtitleSize: '.wpsvp_intToBool($options["dynamicSubtitleSize"]).',
            showStreamVideoBitrateMenu: '.wpsvp_intToBool($options["showStreamVideoBitrateMenu"]).',
            showStreamAudioBitrateMenu: '.wpsvp_intToBool($options["showStreamAudioBitrateMenu"]).',
            seekTime: '.(!wpsvp_nullOrEmpty($options["seekTime"]) ? $options["seekTime"] : 10).',
            createAdMarkers: '.wpsvp_intToBool($options["createAdMarkers"]).',
            cacheTime: '.(!wpsvp_nullOrEmpty($options["cacheTime"]) ? $options["cacheTime"] : 0).',
            playlistStorageKey: "'.$options["playlistStorageKey"].'",
        };
        window.'.$instance.'=wpsvpjq("#'.$wrapper_id.'").on("playlistEndLoad", function(e, data){
            //called on playlist end load, returns (instance, instanceName)

            if(data.nextPageToken)wpsvpjq("#'.$wrapper_id.'").find(".wpsvp-load-more-btn").css("opacity",1);
            else wpsvpjq("#'.$wrapper_id.'").find(".wpsvp-load-more-btn").remove();

        }).on("mediaRequest", function(e, data){
            //called when new media has been requested, returns (instance, instanceName, counter)

            if(typeof ga !== "undefined" && '.$useGa.')ga("send", "event", "Modern video player", "Media Request", "Title: " + data.instance.getTitle(data.counter));

        }).on("mediaStart", function(e, data){
            //called on media start, returns (instance, instanceName, counter)

            if(typeof ga !== "undefined" && '.$useGa.')ga("send", "event", "Modern video player", "Media Start", "Title: " + data.instance.getTitle(data.counter));

        }).on("mediaPlay", function(e, data){
            //called on media play, returns (instance, instanceName, counter)

            if(typeof ga !== "undefined" && '.$useGa.')ga("send", "event", "Modern video player", "Media Play", "Title: " + data.instance.getTitle(data.counter));

        }).on("mediaPause", function(e, data){
            //called on media pause, returns (instance, instanceName, counter)
       
            if(typeof ga !== "undefined" && '.$useGa.')ga("send", "event", "Modern video player", "Media Pause", "Title: " + data.instance.getTitle(data.counter));

        }).on("mediaEnd", function(e, data){
            //called on media end, returns (instance, instanceName, counter)
            
            if(typeof ga !== "undefined" && '.$useGa.')ga("send", "event", "Modern video player", "Media End", "Title: " + data.instance.getTitle(data.counter));

        }).on("mediaDownload", function(e, data){
            //called on media download, returns (instance, instanceName, counter)
            
            if(typeof ga !== "undefined" && '.$useGa.')ga("send", "event", "Modern video player", "Media Download", "Title: " + data.instance.getTitle(data.counter));
            
        }).wpsvp(settings);'."\n";

        if($options["showLoadMore"]){
            $markup .= 'wpsvpjq("#'.$wrapper_id.'").find(".wpsvp-load-more-btn").on("click",function(){
                window.'.$instance.'.loadMore();
                wpsvpjq(this).css("opacity",0);
            });'."\n";
        }
        if($options["usePlaylistSelector"]){
            $markup .= 'wpsvpjq(".wpsvp-playlist-header[data-id='.$wrapper_id.'] span").on("click",function(){
                if(wpsvpjq(this).hasClass("wpsvp-active"))return false;
                var item = wpsvpjq(this), id = item.attr("data-id");
                wpsvpjq(".wpsvp-playlist-header[data-id='.$wrapper_id.'] span").removeClass("wpsvp-active");
                item.addClass("wpsvp-active");
                window.'.$instance.'.loadPlaylist("."+id);
            });'."\n";
        }

	$markup .= '};</script>'."\n";

    echo $markup;

}

function wpsvp_get_playlist($wpsvp_unique_player_id, $playlist_id, $atts, $options) {

	global $wpdb;
	$playlist_table = $wpdb->prefix . "wpsvp_playlists";
	$media_table = $wpdb->prefix . "wpsvp_media";
	$path_table = $wpdb->prefix . "wpsvp_path";
	$subtitle_table = $wpdb->prefix . "wpsvp_subtitle";
    $ad_table = $wpdb->prefix . "wpsvp_ad";
    $annotation_table = $wpdb->prefix . "wpsvp_annotation";
    $taxonomy_table = $wpdb->prefix . "wpsvp_taxonomy";

    $playlists_arr = array();
    if($options['usePlaylistSelector']){
        if(!empty($options['playlistSelectorPlaylists'])){
            $playlists_arr = explode(',', $options['playlistSelectorPlaylists']);
        }
    }else if(!empty($options['displayPlaylistInPage'])){//put playlists in page so we can load them with api
        if($options['displayPlaylistInPage'] == 'all'){//get all playlists

            $query = "SELECT id FROM {$playlist_table}";
            $stmt = $wpdb->get_results($query, ARRAY_A);
            if($wpdb->num_rows > 0){
                foreach ($stmt as $key) {
                    $playlists_arr[] = $key['id'];
                }
            }
        }else{
            $playlists_arr = explode(',', $options['displayPlaylistInPage']);//number array
        }
    }else{
        $playlists_arr[] = $playlist_id;
    }

    //check if playlist from shortcode is in there
    if(!in_array($playlist_id, $playlists_arr))$playlists_arr[] = $playlist_id;

    $markup = '<div id="wpsvp-playlist-list-'.$wpsvp_unique_player_id.'" style="display:none;">'.PHP_EOL;

    



    
    //check taxonomy
    $has_taxonomy;
    if(isset($atts['tag']) && !wpsvp_nullOrEmpty($atts['tag'])){
        $has_taxonomy = true;
        $no_whitespaces = preg_replace( '/\s*,\s*/', ',', filter_var( $atts['tag'], FILTER_SANITIZE_STRING ) ); 
        $tag = explode( ',', $no_whitespaces );
    }
    if(isset($atts['category']) && !wpsvp_nullOrEmpty($atts['category'])){
        $has_taxonomy = true;
        $no_whitespaces = preg_replace( '/\s*,\s*/', ',', filter_var( $atts['category'], FILTER_SANITIZE_STRING ) ); 
        $category = explode( ',', $no_whitespaces );
    }

	foreach($playlists_arr as $pl_id) {

        if(isset($has_taxonomy)){

            $medias = array();

            $match = 'any';
            if(isset($atts['match']))$match = $atts['match'];

            if(isset($atts['limit']))$taxonomy_limit = $atts['limit'];

            if(isset($tag) && isset($category)){

                $countTitles = count($tag);
                $arg = implode(',', array_fill(0, $countTitles, '%s'));

                $countTitles2 = count($category);
                $arg2 = implode(',', array_fill(0, $countTitles2, '%s'));

                $taxonomy_arg = array('%s','%s');
                $tax = array_merge($tag, $category);

                //match any or all 
                if($match == 'all'){

                    //get media ids 

                    $total = intval($countTitles+$countTitles2);

                    $query = "SELECT media_id
                    FROM {$taxonomy_table}
                    WHERE ( ( type='tag' AND title IN ($arg))
                       OR ( type='category' AND title IN ($arg2) )
                    )
                    GROUP BY media_id
                    HAVING count(DISTINCT title) = $total";

                    if(isset($taxonomy_limit))$query .= " LIMIT $taxonomy_limit";

                    $stmt = $wpdb->get_results($wpdb->prepare($query, $tax), ARRAY_A);
                    if($wpdb->num_rows > 0){

                        foreach ($stmt as $key) {
                            $ids[] = $key['media_id'];
                        }
                        $ids[] = $pl_id;
                        //get media

                        $in = implode(',', array_fill(0, count($stmt), '%d'));

                        $query = "SELECT * FROM {$media_table} WHERE id IN ($in) AND playlist_id=%d ORDER BY order_id";
                        $medias = $wpdb->get_results($wpdb->prepare($query, $ids), ARRAY_A);

                    }

                }
                else{//any

                    $tax[] = $pl_id;
                    
                    $query = "SELECT * FROM {$media_table}
                    WHERE id IN (
                        SELECT media_id FROM {$taxonomy_table} 
                        WHERE type='tag' AND title IN ($arg) 
                        OR type='category' AND title IN ($arg2)
                    )
                    AND playlist_id=%d
                    ORDER BY order_id";

                    if(isset($taxonomy_limit))$query .= " LIMIT $taxonomy_limit";

                    $medias = $wpdb->get_results($wpdb->prepare($query, $tax), ARRAY_A);

                }
            }
            else if(isset($tag)){

                $countTitles = count($tag);
                $arg = implode(',', array_fill(0, $countTitles, '%s'));

                //match any or all 
                if($match == 'all'){

                    //get media ids 

                    $query = "SELECT media_id
                    FROM {$taxonomy_table}
                    WHERE type='tag' AND title IN ($arg)
                    GROUP BY media_id
                    HAVING count(DISTINCT title) = $countTitles";

                    if(isset($taxonomy_limit))$query .= " LIMIT $taxonomy_limit";

                    $stmt = $wpdb->get_results($wpdb->prepare($query, $tag), ARRAY_A);
                    if($wpdb->num_rows > 0){

                        foreach ($stmt as $key) {
                            $ids[] = $key['media_id'];
                        }
                        $ids[] = $pl_id;

                        //get media

                        $in = implode(',', array_fill(0, count($stmt), '%d'));

                        $query = "SELECT * FROM {$media_table} WHERE id IN ($in) AND playlist_id=%d ORDER BY order_id";
                        $medias = $wpdb->get_results($wpdb->prepare($query, $ids), ARRAY_A);

                    }

                }
                else{//any

                    $tag[] = $pl_id;
                    
                    $query = "SELECT * FROM {$media_table}
                    WHERE id IN (
                        SELECT media_id FROM {$taxonomy_table} 
                        WHERE type='tag' AND title IN ($arg)
                    )
                    AND playlist_id=%d
                    ORDER BY order_id";

                    if(isset($taxonomy_limit))$query .= " LIMIT $taxonomy_limit";

                    $medias = $wpdb->get_results($wpdb->prepare($query, $tag), ARRAY_A);

                }
            }
            else if(isset($category)){

                $countTitles = count($category);
                $arg = implode(',', array_fill(0, $countTitles, '%s'));

                //match any or all 
                if($match == 'all'){

                    //get media ids 

                    $query = "SELECT media_id
                    FROM {$taxonomy_table}
                    WHERE type='category' AND title IN ($arg)
                    GROUP BY media_id
                    HAVING count(DISTINCT title) = $countTitles";

                    if(isset($taxonomy_limit))$query .= " LIMIT $taxonomy_limit";

                    $stmt = $wpdb->get_results($wpdb->prepare($query, $category), ARRAY_A);
                    if($wpdb->num_rows > 0){

                        foreach ($stmt as $key) {
                            $ids[] = $key['media_id'];
                        }
                        $ids[] = $pl_id;

                        //get media

                        $in = implode(',', array_fill(0, count($stmt), '%d'));

                        $query = "SELECT * FROM {$media_table} WHERE id IN ($in) AND playlist_id=%d ORDER BY order_id";
                        $medias = $wpdb->get_results($wpdb->prepare($query, $ids), ARRAY_A);

                    }

                }
                else{//any

                    $category[] = $pl_id;
                    
                    $query = "SELECT * FROM {$media_table}
                    WHERE id IN (
                        SELECT media_id FROM {$taxonomy_table} 
                        WHERE type='category' AND title IN ($arg)
                    )
                    AND playlist_id=%d
                    ORDER BY order_id";

                    if(isset($taxonomy_limit))$query .= " LIMIT $taxonomy_limit";

                    $medias = $wpdb->get_results($wpdb->prepare($query, $category), ARRAY_A);

                }
            }

        }else{

            $stmt = $wpdb->prepare("SELECT * FROM {$media_table} WHERE playlist_id = %d ORDER BY order_id", $pl_id);
            $medias = $wpdb->get_results($stmt, ARRAY_A);

        }

        $markup .= '<div class="wpsvp-playlist-'.$pl_id.'">'.PHP_EOL;

            //global playlist options

            $track = '<div class="wpsvp-global-playlist-data"';

            $stmt_pl = $wpdb->get_var($wpdb->prepare("SELECT options FROM {$playlist_table} WHERE id = %d", $pl_id));
                  
            $encrypt_media_paths = false;
            $global_ads = false;
            $global_annotations = false;

            if(!empty($stmt_pl)){

                $playlist_data = unserialize($stmt_pl);

                if(!empty($playlist_data['upnext'])){
                    $track .= ' data-upnext="'.$playlist_data['upnext'].'"';
                }
                if(!empty($playlist_data['upnext_time'])){
                    $track .= ' data-upnext-time="'.$playlist_data['upnext_time'].'"';
                }
                if(!empty($playlist_data['encrypt_media_paths'])){
                    $encrypt_media_paths = $playlist_data['encrypt_media_paths'];
                }
                if(!empty($playlist_data['pwd'])){
                    $track .= ' data-pwd="'.md5($playlist_data['pwd']).'"';
                }
                if(!empty($playlist_data['displayPosterOnMobile'])){
                    $track .= ' data-display-poster-on-mobile="1"';
                }

                $track .= '>';

                //ads

                if(empty($playlist_data['disable_adverts'])){

                    $global_ads = true;

                    $stmt = $wpdb->prepare("SELECT * FROM {$ad_table} WHERE playlist_id = %d", $pl_id);
                    $ad_data = $wpdb->get_results($stmt, ARRAY_A);
                    if($wpdb->num_rows > 0){
                        include('shortcode_ad_data.php');
                    }else{
                        $global_ads = false;
                    }
                }

                //annotations

                if(empty($playlist_data['disable_annotations'])){

                    $global_annotations = true;

                    $stmt = $wpdb->prepare("SELECT * FROM {$annotation_table} WHERE playlist_id = %d", $pl_id);
                    $annotation_data = $wpdb->get_results($stmt, ARRAY_A);
                    if($wpdb->num_rows > 0){
                        include('shortcode_annotation_data.php');
                    }else{
                        $global_annotations = false;
                    }
                }

                $track .= '</div>';//end wpsvp-global-playlist-data

                $markup .= $track.PHP_EOL;

            }

            //tracks

            foreach($medias as $media) {
                $markup .= wpsvp_shortcode_media($media, $encrypt_media_paths, $global_ads, $global_annotations);
            }

            $markup .= PHP_EOL;
                
        $markup .= '</div>'.PHP_EOL;//end wpsvp-playlist 

    }

    $markup .= '</div>';//end wpsvp playlist list

	return $markup;
	
}

function wpsvp_get_playlist2($wpsvp_unique_player_id, $media) {

    //playlist markup

    $markup = '<div id="wpsvp-playlist-list-'.$wpsvp_unique_player_id.'" style="display:none;">'.PHP_EOL;

    $markup .= '<div class="wpsvp-playlist-0">'.PHP_EOL;


    //check taxonomy
    $atts = $media;  
    $has_taxonomy;
    if(isset($media['tag']) && !wpsvp_nullOrEmpty($atts['tag'])){
        $has_taxonomy = true;
        $no_whitespaces = preg_replace( '/\s*,\s*/', ',', filter_var( $atts['tag'], FILTER_SANITIZE_STRING ) ); 
        $tag = explode( ',', $no_whitespaces );
    }
    if(isset($atts['category']) && !wpsvp_nullOrEmpty($atts['category'])){
        $has_taxonomy = true;
        $no_whitespaces = preg_replace( '/\s*,\s*/', ',', filter_var( $atts['category'], FILTER_SANITIZE_STRING ) ); 
        $category = explode( ',', $no_whitespaces );
    }

    if(isset($has_taxonomy)){

        global $wpdb;
        $media_table = $wpdb->prefix . "wpsvp_media";
        $taxonomy_table = $wpdb->prefix . "wpsvp_taxonomy";

        $match = 'any';
        if(isset($atts['match']))$match = $atts['match'];

        if(isset($atts['limit']))$taxonomy_limit = $atts['limit'];
        if(isset($media['type']))$type = $media['type'];

        $medias = array();

        if(isset($tag) && isset($category)){

            $countTitles = count($tag);
            $arg = implode(',', array_fill(0, $countTitles, '%s'));

            $countTitles2 = count($category);
            $arg2 = implode(',', array_fill(0, $countTitles2, '%s'));

            $taxonomy_arg = array('%s','%s');
            $tax = array_merge($tag, $category);

            //match any or all 
            if($match == 'all'){

                //get media ids 

                $total = intval($countTitles+$countTitles2);

                $query = "SELECT media_id
                FROM {$taxonomy_table}
                WHERE ( ( type='tag' AND title IN ($arg))
                   OR ( type='category' AND title IN ($arg2) )
                )
                GROUP BY media_id
                HAVING count(DISTINCT title) = $total";

                if(isset($taxonomy_limit))$query .= " LIMIT $taxonomy_limit";

                $stmt = $wpdb->get_results($wpdb->prepare($query, $tax), ARRAY_A);
                if($wpdb->num_rows > 0){

                    foreach ($stmt as $key) {
                        $ids[] = $key['media_id'];
                    }
                    //get media

                    $in = implode(',', array_fill(0, count($stmt), '%d'));

                    if(isset($type)){
                        $ids[] = $type;
                        $query = "SELECT * FROM {$media_table} WHERE id IN ($in) AND type=%s ORDER BY order_id";
                    }else{
                        $query = "SELECT * FROM {$media_table} WHERE id IN ($in) ORDER BY order_id";
                    }
                    
                    $stmt = $wpdb->get_results($wpdb->prepare($query, $ids), ARRAY_A);
                    foreach ($stmt as $m) {
                        $medias[] = $m;
                    }
                }

            }
            else{//any

                if(isset($type)){
                    
                    $query = "SELECT * FROM {$media_table}
                    WHERE id IN (
                        SELECT media_id FROM {$taxonomy_table} 
                        WHERE type='tag' AND title IN ($arg) 
                        OR type='category' AND title IN ($arg2)
                    )
                    AND type=%s
                    ORDER BY order_id";

                    $tax[] = $type;

                }else{

                    $query = "SELECT * FROM {$media_table}
                    WHERE id IN (
                        SELECT media_id FROM {$taxonomy_table} 
                        WHERE type='tag' AND title IN ($arg) 
                        OR type='category' AND title IN ($arg2)
                    )
                    ORDER BY order_id";

                }

                if(isset($taxonomy_limit))$query .= " LIMIT $taxonomy_limit";

                $stmt = $wpdb->get_results($wpdb->prepare($query, $tax), ARRAY_A);
                foreach ($stmt as $m) {
                    $medias[] = $m;
                }

            }
        }
        else if(isset($tag)){

            $countTitles = count($tag);
            $arg = implode(',', array_fill(0, $countTitles, '%s'));

            //match any or all 
            if($match == 'all'){

                //get media ids 

                $query = "SELECT media_id
                FROM {$taxonomy_table}
                WHERE type='tag' AND title IN ($arg)
                GROUP BY media_id
                HAVING count(DISTINCT title) = $countTitles";

                if(isset($taxonomy_limit))$query .= " LIMIT $taxonomy_limit";

                $stmt = $wpdb->get_results($wpdb->prepare($query, $tag), ARRAY_A);
                if($wpdb->num_rows > 0){

                    foreach ($stmt as $key) {
                        $ids[] = $key['media_id'];
                    }
                    //get media

                    $in = implode(',', array_fill(0, count($stmt), '%d'));

                    if(isset($type)){
                        $ids[] = $type;
                        $query = "SELECT * FROM {$media_table} WHERE id IN ($in) AND type=%s ORDER BY order_id";
                    }else{
                        $query = "SELECT * FROM {$media_table} WHERE id IN ($in) ORDER BY order_id";
                    }
                    
                    $stmt = $wpdb->get_results($wpdb->prepare($query, $ids), ARRAY_A);
                    foreach ($stmt as $m) {
                        $medias[] = $m;
                    }

                }

            }
            else{//any

                if(isset($type)){

                    $query = "SELECT * FROM {$media_table}
                    WHERE id IN (
                        SELECT media_id FROM {$taxonomy_table} 
                        WHERE type='tag' AND title IN ($arg)
                    )
                    AND type=%s
                    ORDER BY order_id";

                    $tag[] = $type;

                }else{

                    $query = "SELECT * FROM {$media_table}
                    WHERE id IN (
                        SELECT media_id FROM {$taxonomy_table} 
                        WHERE type='tag' AND title IN ($arg)
                    )
                    ORDER BY order_id";

                }
               
                if(isset($taxonomy_limit))$query .= " LIMIT $taxonomy_limit";

                $stmt = $wpdb->get_results($wpdb->prepare($query, $tag), ARRAY_A);
                foreach ($stmt as $m) {
                    $medias[] = $m;
                }

            }
        }
        else if(isset($category)){

            $countTitles = count($category);
            $arg = implode(',', array_fill(0, $countTitles, '%s'));

            //match any or all 
            if($match == 'all'){

                //get media ids 

                $query = "SELECT media_id
                FROM {$taxonomy_table}
                WHERE type='category' AND title IN ($arg)
                GROUP BY media_id
                HAVING count(DISTINCT title) = $countTitles";

                if(isset($taxonomy_limit))$query .= " LIMIT $taxonomy_limit";

                $stmt = $wpdb->get_results($wpdb->prepare($query, $category), ARRAY_A);
                if($wpdb->num_rows > 0){

                    foreach ($stmt as $key) {
                        $ids[] = $key['media_id'];
                    }

                    //get media

                    $in = implode(',', array_fill(0, count($stmt), '%d'));

                    if(isset($type)){
                        $ids[] = $type;
                        $query = "SELECT * FROM {$media_table} WHERE id IN ($in) AND type=%s ORDER BY order_id";
                    }else{
                        $query = "SELECT * FROM {$media_table} WHERE id IN ($in) ORDER BY order_id";
                    }

                    $stmt = $wpdb->get_results($wpdb->prepare($query, $ids), ARRAY_A);
                    foreach ($stmt as $m) {
                        $medias[] = $m;
                    }

                }

            }
            else{//any

                if(isset($type)){
                    
                    $query = "SELECT * FROM {$media_table}
                    WHERE id IN (
                        SELECT media_id FROM {$taxonomy_table} 
                        WHERE type='category' AND title IN ($arg)
                    )
                    AND type=%s
                    ORDER BY order_id";

                    $category[] = $type;

                }else{

                    $query = "SELECT * FROM {$media_table}
                    WHERE id IN (
                        SELECT media_id FROM {$taxonomy_table} 
                        WHERE type='category' AND title IN ($arg)
                    )
                    ORDER BY order_id";

                }

                if(isset($taxonomy_limit))$query .= " LIMIT $taxonomy_limit";

                $stmt = $wpdb->get_results($wpdb->prepare($query, $category), ARRAY_A);
                foreach ($stmt as $m) {
                    $medias[] = $m;
                }

            }
        }

        foreach($medias as $media) {
            $markup .= wpsvp_shortcode_media($media, false, false, false);
        }

    }
    else{//get tracks from direct shortcode

        //tracks

        if(isset($media['type']) && isset($media['path'])){

            $encrypt_media_paths = false;
            if(!empty($media["encrypt_media_paths"]))$encrypt_media_paths = true;

            $type = $media['type'];

            $track = '<div class="wpsvp-playlist-item" data-type="'.$type.'" ';

            //path
               
            if($type == "video" || $type == "video_360" || $type == "audio" || $type == "image" || $type == "image_360"){

                //sanitize the data and remove white spaces
                $no_whitespaces = preg_replace( '/\s*,\s*/', ',', filter_var( $media['path'], FILTER_SANITIZE_STRING ) ); 
                $path_array = explode( ',', $no_whitespaces );

                if(count($path_array)>1){//multiple qualities
                    $no_whitespaces = preg_replace( '/\s*,\s*/', ',', filter_var( $media['quality_title'], FILTER_SANITIZE_STRING ) ); 
                    $quality_title_array = explode( ',', $no_whitespaces );
                }else{
                    $quality_title_array = ['default'];//dont require quality on single quality
                }

                //We need to make sure that our two arrays are exactly the same lenght before we continue
                if(count($path_array) != count($quality_title_array))return "Shortcode PATH needs to contain the same amount of values as QUALITY_TITLE parameter!";

                $path = 'data-path=\'[';

                foreach($path_array as $k => $v){ 

                    if($type == "video" || $type == "video_360"){
                        $ext = "mp4";
                    }else if($type == "audio"){
                        $ext = pathinfo($v, PATHINFO_EXTENSION);
                        if(wpsvp_nullOrEmpty($ext))$ext = "mp3";
                    }else if($type == "image" || $type == "image_360"){
                        $ext = "image";
                    }

                    if($encrypt_media_paths)$p = WPSVP_BSF_MATCH.base64_encode($v);
                    else $p = $v;

                    $path .= '{"quality": "'.$quality_title_array[$k].'", "'.$ext.'": "'.$p.'"},';

                }

                $path = substr_replace($path, "", -1);//remove last comma
                $path .= ']\' ';

                if(!empty($media['quality'])){
                    $track .= 'data-quality="'.$media['quality'].'" ';
                }else{
                    $track .= 'data-quality="'.$quality_title_array[0].'" ';
                }

            }else{

                $prefix='';
                if($type == "folder_video" || $type == "folder_audio" || $type == "folder_image"){
                    $prefix = WPSVP_FILE_DIR;
                }

                $no_whitespaces = preg_replace( '/\s*,\s*/', ',', filter_var( $media['path'], FILTER_SANITIZE_STRING ) ); 

                if($encrypt_media_paths)$p = WPSVP_BSF_MATCH.base64_encode($prefix.$no_whitespaces);
                else $p = $prefix.$no_whitespaces;
                
                $path = 'data-path="'.$p.'" ';

                if(!empty($media['quality'])){
                    $track .= 'data-quality="'.$media['quality'].'" ';
                }
            }
            
            $track .= $path;

            if(!empty($media["mp4"])){
                $track .= 'data-mp4="'.$media["mp4"].'" ';
            }
            if(!empty($media["user_id"])){
                $track .= 'data-user-id="'.$media["user_id"].'" ';
            }
            if(!empty($media["noapi"])){
                $track .= 'data-noapi="1" ';
            }
            if(!empty($media["is360"])){
                $track .= 'data-is360="1" ';
            }
            if(!empty($media["thumb"])){
                $track .= 'data-thumb="'.$media["thumb"].'" ';
            }
            if(!empty($media["alt_text"])){
                $track .= 'data-alt="'.$media["alt_text"].'" ';
            }
            if(!empty($media["title"])){
                $track .= 'data-title="'.$media["title"].'" ';
            }
            if(!empty($media["description"])){
                $track .= 'data-description="'.$media["description"].'" ';
            }
            if(!empty($media["poster"])){
                $track .= 'data-poster="'.$media["poster"].'" ';
            }
            if(!empty($media["poster_frame_time"])){
                $track .= 'data-poster-frame-time="'.$media["poster_frame_time"].'" ';
            }
            if(!empty($media["download"])){
                $track .= 'data-download="'.$media["download"].'" ';
            }
            if(!empty($media["preview_seek"])){
                $track .= 'data-preview-seek="'.$media["preview_seek"].'" ';
            }
            if(!empty($media["hover_preview"])){
                $track .= 'data-hover-preview="'.$media["hover_preview"].'" ';
            }
            if(!empty($media["share"])){
                $track .= 'data-share="'.$media["share"].'" ';
            }
            if(!empty($media["limit"])){
                $track .= 'data-limit="'.$media["limit"].'" ';
            }
            if(!empty($media["start"])){
                $track .= 'data-start="'.$media["start"].'" ';
            }
            if(!empty($media["end"])){
                $track .= 'data-end="'.$media["end"].'" ';
            }
            //  Added by Boldman.
            // if(!empty($media["playing_length"])){
            //     $track .= 'data-playing-length="'.$media["playing_length"].'" ';
            // }

            /*  Added by Boldman*/

            if(!empty($media["normal_play_mode"])){
                $track .= 'data-normal-play-mode="'.$media["normal_play_mode"].'" ';
            }

            if(!empty($media["random_clip_time"])){
                $track .= 'data-random-clip-time="'.$media["random_clip_time"].'" ';
            }

            if(!empty($media["width"])){
                $track .= 'data-width="'.$media["width"].'" ';
            }
            if(!empty($media["height"])){
                $track .= 'data-height="'.$media["height"].'" ';
            }
            if(!empty($media["playback_rate"])){
                $track .= 'data-playback-rate="'.$media["playback_rate"].'" ';
            }
            if(!empty($media["user_id"])){
                $track .= 'data-user-id="'.$media["user_id"].'" ';
            }
            if(!empty($media["load_more"]) && $media["load_more"] == '1'){
                $track .= 'data-load-more="'.$media["load_more"].'" ';
            }
            if(!empty($media["duration"])){
                $track .= 'data-duration="'.$media["duration"].'" ';
            }
            if(!empty($media["chapters"])){
                $track .= 'data-chapters="'.$media["chapters"].'" ';
            }
            if(!empty($media["end_link"])){
                $track .= 'data-end-link="'.$media["end_link"].'" ';
                if(!empty($media["end_target"])){
                    $track .= 'data-end-target="'.$media["end_target"].'" ';
                }
            }
            if(!empty($media["sort_type"])){
                $track .= 'data-sort="'.$media["sort_type"].'" ';
                if(!empty($media["sort_dir"])){
                    $track .= 'data-sort-direction="'.$media["sort_dir"].'" ';
                }
            }
            if(!empty($media["pwd"])){
                $track .= 'data-pwd="'.md5($media["pwd"]).'" ';
            }

            $track .= '>';

            if($type == "video" || $type == "video_360" || $type == "hls" || $type == "dash" || $type == "audio" || $type == "image" || $type == "image_360" || ($type == "youtube_single" && isset($media["noapi"])) || ($type == "vimeo_single" && isset($media["noapi"]))){

                if(!empty($media["thumb"])){
                    $alt = isset($media["alt_text"])?$media["alt_text"]:'';
                    $track .= '<div class="wpsvp-playlist-thumb">
                        <img class="wpsvp-thumbimg" src="'.$media["thumb"].'" alt="'.$alt.'">
                    </div>';  
                }

                if(!empty($media["title"]) || !empty($media["description"])){
                    $track .= '<div class="wpsvp-playlist-info">';
                        if(!empty($media["title"]))$track .= '<span class="wpsvp-playlist-title">'.$media["title"].'</span>';
                        if(!empty($media["description"]))$track .= '<span class="wpsvp-playlist-description">'.$media["description"].'</span>';
                    $track .= '</div>';  
                }

            }

            $track .= '</div>';//end div
                
            $markup .= $track.PHP_EOL;

        }else{

            if(!isset($media['type']))return "Shortcode 'type' parameter missing!";
            if(!isset($media['path']))return "Shortcode 'path' parameter missing!";

        }
    }

    $markup .= '</div>'.PHP_EOL;//end wpsvp-playlist 

    $markup .= '</div>';//end wpsvp playlist list

    return $markup;
        
}

function wpsvp_shortcode_media($media, $encrypt_media_paths, $global_ads, $global_annotations){

    global $wpdb;
    $path_table = $wpdb->prefix . "wpsvp_path";
    $subtitle_table = $wpdb->prefix . "wpsvp_subtitle";
    $ad_table = $wpdb->prefix . "wpsvp_ad";
    $annotation_table = $wpdb->prefix . "wpsvp_annotation";

    

    $type = $media["type"];

    $track = '<div class="wpsvp-playlist-item" data-type="'.$type.'" ';

    //path
    $stmt2 = $wpdb->prepare("SELECT * FROM {$path_table} WHERE media_id = %d", $media["id"]);
    $paths = $wpdb->get_results($stmt2, ARRAY_A);

    if($wpdb->num_rows > 0){
        
        if($type == "video" || $type == "video_360" || $type == "audio" || $type == "image" || $type == "image_360"){

            $quality;

            $path = 'data-path=\'[';
            foreach($paths as $row){

                if($type == "video" || $type == "video_360"){
                    $ext = "mp4";
                }else if($type == "audio"){
                    $ext = pathinfo($row['path'], PATHINFO_EXTENSION);
                    if(wpsvp_nullOrEmpty($ext))$ext = "mp3";
                }else if($type == "image" || $type == "image_360"){
                    $ext = "image";
                }

                if($encrypt_media_paths)$p = WPSVP_BSF_MATCH.base64_encode($row['path']);
                else $p = $row['path'];

                $path .= '{"quality": "'.$row['quality_title'].'", "'.$ext.'": "'.$p.'"},';

                if(!empty($row["def"])){
                    $quality = $row["quality_title"];
                }
               
            }
            $path = substr_replace($path, "", -1);//remove last comma
            $path .= ']\' ';

            if(isset($quality)){
                $path .= 'data-quality="'.$quality.'" ';
            }else{
                $path .= 'data-quality="'.$row['quality_title'].'" ';
            }

        }else{

            $prefix='';
            if($type == "folder_video" || $type == "folder_audio" || $type == "folder_image"){
                $prefix = WPSVP_FILE_DIR;
            }

            foreach($paths as $row){//only one

                if($encrypt_media_paths)$p = WPSVP_BSF_MATCH.base64_encode($prefix.$row['path']);
                else $p = $prefix.$row['path'];

                $path = 'data-path="'.$p.'" ';

                if(!empty($row["quality_title"])){
                    $path .= 'data-quality="'.$row["quality_title"].'" ';
                }
                if(!empty($row["mp4"])){
                    $path .= 'data-mp4="'.$row["mp4"].'" ';
                }
            }

        }

        $track .= $path;
    }

    if(!empty($media["user_id"])){
        $track .= 'data-user-id="'.$media["user_id"].'" ';
    }
    if(!empty($media["noapi"])){
        $track .= 'data-noapi="1" ';
    }
    if(!empty($media["is360"])){
        $track .= 'data-is360="1" ';
    }
    if(!empty($media["thumb"])){
        $track .= 'data-thumb="'.$media["thumb"].'" ';
    }
    if(!empty($media["alt_text"])){
        $track .= 'data-alt="'.$media["alt_text"].'" ';
    }
    if(!empty($media["title"])){
        $track .= 'data-title="'.$media["title"].'" ';
    }
    if(!empty($media["description"])){
        $track .= 'data-description="'.$media["description"].'" ';
    }
    if(!empty($media["poster"])){
        $track .= 'data-poster="'.$media["poster"].'" ';
    }
    if(!empty($media["poster_frame_time"])){
        $track .= 'data-poster-frame-time="'.$media["poster_frame_time"].'" ';
    }
    if(!empty($media["download"])){
        $track .= 'data-download="'.$media["download"].'" ';
    }
    if(!empty($media["preview_seek"])){
        $track .= 'data-preview-seek="'.$media["preview_seek"].'" ';
    }
    if(!empty($media["hover_preview"])){
        $track .= 'data-hover-preview="'.$media["hover_preview"].'" ';
    }
    if(!empty($media["share"])){
        $track .= 'data-share="'.$media["share"].'" ';
    }
    if(!empty($media["limit"])){
        $track .= 'data-limit="'.$media["limit"].'" ';
    }
    if(!empty($media["start"])){
        $track .= 'data-start="'.$media["start"].'" ';
    }
    if(!empty($media["end"])){
        $track .= 'data-end="'.$media["end"].'" ';
    }
    //  Added by Boldman.
    // if(!empty($media["playing_length"])){
    //     $track .= 'data-playing-length="'.$media["playing_length"].'" ';
    // }
    /*  Added by Boldman*/

    if(!empty($media["normal_play_mode"])){
        $track .= 'data-normal-play-mode="'.$media["normal_play_mode"].'" ';
    }

    if(!empty($media["random_clip_time"])){
        $track .= 'data-random-clip-time="'.$media["random_clip_time"].'" ';
    }
    if(!empty($media["width"])){
        $track .= 'data-width="'.$media["width"].'" ';
    }
    if(!empty($media["height"])){
        $track .= 'data-height="'.$media["height"].'" ';
    }
    if(!empty($media["playback_rate"])){
        $track .= 'data-playback-rate="'.$media["playback_rate"].'" ';
    }
    if(!empty($media["user_id"])){
        $track .= 'data-user-id="'.$media["user_id"].'" ';
    }
    if(!empty($media["load_more"]) && $media["load_more"] == '1'){
        $track .= 'data-load-more="'.$media["load_more"].'" ';
    }
    if(!empty($media["duration"])){
        $track .= 'data-duration="'.$media["duration"].'" ';
    }
    if(!empty($media["chapters"])){
        $track .= 'data-chapters="'.$media["chapters"].'" ';
    }
    if(!empty($media["end_link"])){
        $track .= 'data-end-link="'.$media["end_link"].'" ';
        if(!empty($media["end_target"])){
            $track .= 'data-end-target="'.$media["end_target"].'" ';
        }
    }
    if(!empty($media["sort_type"])){
        $track .= 'data-sort="'.$media["sort_type"].'" ';
        if(!empty($media["sort_dir"])){
            $track .= 'data-sort-direction="'.$media["sort_dir"].'" ';
        }
    }
    if(!empty($media["pwd"])){
        $track .= 'data-pwd="'.md5($media["pwd"]).'" ';
    }

    $track .= '>';

    if($type == "video" || $type == "video_360" || $type == "hls" || $type == "dash" || $type == "audio" || $type == "image" || $type == "image_360" || ($type == "youtube_single" && isset($media["noapi"])) || ($type == "vimeo_single" && isset($media["noapi"]))){

        if(!empty($media["thumb"])){
            $alt = isset($media["alt_text"])?$media["alt_text"]:'';
            $track .= '<div class="wpsvp-playlist-thumb">
                <img class="wpsvp-thumbimg" src="'.$media["thumb"].'" alt="'.$alt.'">
            </div>';  
        }

        if(!empty($media["title"]) || !empty($media["description"])){
            $track .= '<div class="wpsvp-playlist-info">';
                if(!empty($media["title"]))$track .= '<span class="wpsvp-playlist-title">'.$media["title"].'</span>';
                if(!empty($media["description"]))$track .= '<span class="wpsvp-playlist-description">'.$media["description"].'</span>';
            $track .= '</div>';  
        }

    }

    //subtitles
    $stmt3 = $wpdb->prepare("SELECT * FROM {$subtitle_table} WHERE media_id = %d", $media["id"]);
    $subtitles = $wpdb->get_results($stmt3, ARRAY_A);
    if($wpdb->num_rows > 0){
        
        $subtitle = '<div class="wpsvp-subtitles">';
        foreach($subtitles as $row){

            if($encrypt_media_paths)$p = WPSVP_BSF_MATCH.base64_encode($row['src']);
            else $p = $row['src'];

            $subtitle .= '<div data-label="'.$row["label"].'" data-src="'.$p.'" ';

            if(!empty($row["def"])){
                $subtitle .= 'data-default';
            }

            $subtitle .= '></div>';
           
        }
        $subtitle .= '</div>';
        
        $track .= $subtitle;
    }

    //ads

    if(!$global_ads && empty($media["disable_adverts"])){

        $stmt = $wpdb->prepare("SELECT * FROM {$ad_table} WHERE media_id = %d", $media["id"]);
        $ad_data = $wpdb->get_results($stmt, ARRAY_A);
        if($wpdb->num_rows > 0){
            include('shortcode_ad_data.php');
        }
    }

    //annotations

    if(!$global_annotations && empty($media["disable_annotations"])){

        $stmt = $wpdb->prepare("SELECT * FROM {$annotation_table} WHERE media_id = %d", $media["id"]);
        $annotation_data = $wpdb->get_results($stmt, ARRAY_A);
        if($wpdb->num_rows > 0){
            include('shortcode_annotation_data.php');
        }
    }

    if(!empty($media["custom_content"])){
        $track .= $media["custom_content"];
    }
   
    $track .= '</div>';//end div

    return $track.PHP_EOL;

}




?>