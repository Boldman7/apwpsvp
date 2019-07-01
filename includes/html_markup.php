<?php

	function wpsvp_get_html_markup($wrapperId, $playlist_id, $options){

		$playerSkin = ' wpsvp-skin-'.$options["playerSkin"];

		$playlistPosition = $options["playlistPosition"];

		if($playlistPosition == 'outer' || $playlistPosition == 'wall')$playlistStyle = $options["playlistGridStyle"];
		else $playlistStyle = $options["playlistStyle"];

		$playlistInfoAnimation = '';
		if($playlistStyle == 'dot' || $playlistStyle == 'gdot'){
			if(!empty($options["playlistInfoAnimation"]))$playlistInfoAnimation = ' wpsvp-'.$options["playlistInfoAnimation"];
		}

		if($playlistPosition == 'no-playlist' || $playlistPosition == 'wall'){
			$options['usePlaylistBtn'] = false;
		}
		
		$navigationType = '';
    	if($playlistPosition != 'no-playlist' && $playlistPosition != 'outer' && $playlistPosition != 'wall')$navigationType = ' wpsvp-nt-'.$options["navigationType"];

    	$navigationStyle = '';
    	if($options["navigationStyle"] == 'spaced')$navigationStyle = ' wpsvp-ns-spaced';

    	$wrapperLayout = '';
	    if($options["wrapperLayout"] == '100%'){
	    	if($playlistPosition == 'vlb' || $playlistPosition == 'vrb' || $playlistPosition == 'vb' || $playlistPosition == 'ht' || $playlistPosition == 'hb' || $playlistPosition == 'no-playlist')$wrapperLayout = ' wpsvp-layout-100';
	    }

	    $playlistThumbStyle = '';
	    if($playlistStyle == 'drot')$playlistThumbStyle = ' wpsvp-thumb-'.$options['playlistThumbStyle'];
	    
	    $playerShadow = !empty($options['playerShadow']) ? ' wpsvp-'.$options['playerShadow'] : '';

	    if($options["controlsType"] == 'controls1'){
	    	$options["controlsTypeVolume"] = 'v';//vertical volume
	    }else if($options["controlsType"] == 'controls1b'){
	    	$options["controlsType"] = 'controls1';
	    	$options["controlsTypeVolume"] = 'h';//horizontal volume
	    }else{
	    	unset($options["controlsTypeVolume"]);
	    }


	    //start markup

	    $markup = '';

    	//playlist selector
	    if($options['usePlaylistSelector']){

	    	if(!empty($options['playlistSelectorPlaylists'])){

	            $pids = $options['playlistSelectorPlaylists'];
	            //check if playlist from shortcode is in there
	            if(strpos($pids, $playlist_id) === false)$pids .= ','.$playlist_id;
	            $playlistSelectorStyle = $options['playlistSelectorStyle'];

	            global $wpdb;
	            $playlist_table = $wpdb->prefix . "wpsvp_playlists";
	            $pls = $wpdb->get_results("SELECT id, title FROM {$playlist_table} WHERE id IN ($pids) ORDER BY title ASC", ARRAY_A);

	            $markup .= '<div class="wpsvp-playlist-header'.$playerSkin.'" data-id="'.$wrapperId.'">';

	            if($playlistSelectorStyle == "list"){
		            foreach ($pls as $pl) {
		            	$ps_class = '';
		            	if($playlist_id == $pl['id'])$ps_class = ' wpsvp-active';//active playlist
		                $markup .= '<span class="wpsvp-select-item'.$ps_class.'" data-id="wpsvp-playlist-'.$pl['id'].'">'.$pl['title'].'</span>';
		            }
				}else if($playlistSelectorStyle == "select"){
					$markup .= '<select class="wpsvp-playlist-select">
								<option disabled="disabled">'.$options['selectPlaylistText'].'</option>';
						foreach ($pls as $pl) {
			            	if($playlist_id == $pl['id']){
			            		$markup .= '<option data-id="wpsvp-playlist-'.$pl['id'].'" selected="selected">'.$pl['title'].'</option>';
			            	}else{
				                $markup .= '<option data-id="wpsvp-playlist-'.$pl['id'].'">'.$pl['title'].'</option>';
				            }
			            }
					$markup .= '</select>';
				}	

	            $markup .= '</div>'."\n";

	        }

	    }//end playlist selector

	    //start markup
	    $markup .= '<div id="'.$wrapperId.'" class="wpsvp-'.$playlistPosition.$wrapperLayout.$playerSkin.' wpsvp-ps-'.$playlistStyle.$playlistInfoAnimation.$navigationType.$navigationStyle.$playerShadow.'">';

			if($playlistPosition == 'wall'){

				$markup .= '<div class="wpsvp-lightbox-wrap">
				            <div class="wpsvp-lightbox">
				            <div class="wpsvp-lightbox-inner">
				            <div class="wpsvp-lightbox-content wpsvp-lightbox-style-'.$options['lightboxStyle'].'">
				            <div class="wpsvp-lightbox-content-inner">';

			}

			$markup .= '<div class="wpsvp-player-holder">

	            <div class="wpsvp-media-holder">

	                <div class="wpsvp-youtube-holder"></div>
                    <div class="wpsvp-vimeo-holder-default"></div>
                    <div class="wpsvp-vimeo-holder-chromeless"></div>
                    <div class="wpsvp-audio-holder"></div>
                    <div class="wpsvp-video-holder"></div>
                    <div class="wpsvp-image-holder"></div>
                    <div class="wpsvp-iframe-holder"></div>
                    <div class="wpsvp-subtitle-holder"><div class="wpsvp-subtitle-holder-inner"></div></div>
                	<div class="wpsvp-annotation-holder"></div>';

	                if(!empty($options["vrInfo"]))$markup .= '<img class="wpsvp-vr-info" src="'.$options["vrInfo"].'" alt="">';

	                $markup .= '<div class="wpsvp-upnext-wrap">
	                    <div class="wpsvp-upnext-inner">
	                        <div class="wpsvp-upnext-thumb"></div>
	                        <div class="wpsvp-upnext-info">
	                            <div class="wpsvp-upnext-header">'.esc_html($options["upNextText"]).'</div>
	                            <div class="wpsvp-upnext-title"></div>
	                        </div>
	                        <div class="wpsvp-upnext-close wpsvp-contr-btn" data-tooltip="'.esc_attr($options['tooltipUpNextClose']).'"><i class="wpsvp-icon wpsvp-icon-close" aria-hidden="true"></i></div>
	                    </div>
	                </div>

	                <div class="wpsvp-ad-skip-btn">
                        <div class="wpsvp-ad-skip-msg"><div class="wpsvp-ad-skip-msg-text">'.esc_html($options['adSkipWaitText']).'</div></div>
                        <div class="wpsvp-ad-skip-msg-end">'.esc_html($options['adSkipReadyText']).'</div>
                        <div class="wpsvp-ad-skip-thumb"></div>
                    </div>

                    <div class="wpsvp-ad-seekbar">
                        <div class="wpsvp-ad-info">
                            <div class="wpsvp-ad-info-title">'.esc_html($options['adTitleText']).'</div>
                            <div class="wpsvp-ad-info-time"></div>
                        </div>
                        <div class="wpsvp-ad-progress-bg">
                            <div class="wpsvp-ad-load-level"></div>
                            <div class="wpsvp-ad-progress-level"></div>
                        </div>
                    </div>';

	                // if($options["usePlayerLoader"])$markup .= '<div class="wpsvp-player-loader"></div>';

	                if($options["useHeaderTitle"])$markup .= '<div class="wpsvp-player-header-title wpsvp-player-interface"></div>';

	                $markup .= '<div class="wpsvp-chapter-title"></div>';

	                if($options["useBigPlay"])$markup .= '<div class="wpsvp-big-play">'.$options["iconBigPlay"].'</div>';

		            if($options['useInfoBtn']){
			            $markup .= '<div class="wpsvp-info-holder">
			            	<div class="wpsvp-info-holder-inner">
			                    <div class="wpsvp-info-data">
			                        <div class="wpsvp-info-close wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipInfoClose"]).'">'.$options['iconClose'].'</div>
			                        <div class="wpsvp-info-inner">
				                        <div class="wpsvp-player-title"></div>
				                        <div class="wpsvp-player-desc"></div>
			                        </div>
		                    </div>
		                    </div>
		                </div>'; 
		            }

		            if($options["useShareBtn"]){
	                	$markup .= '<div class="wpsvp-share-holder">
	                		<div class="wpsvp-share-holder-inner">
		                	<div class="wpsvp-share-data">
		                        <div class="wpsvp-share-close wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipShareClose"]).'">'.$options['iconClose'].'</div>
		                        <div class="wpsvp-share-inner">';
			                        if($options["useShareTumblr"])$markup .= '<div class="wpsvp-share-item wpsvp-contr-btn" data-type="tumblr" data-tooltip="'.esc_attr($options["tooltipTumblr"]).'">'.$options['iconShareTumblr'].'</div>';

			                        if($options["useShareTwitter"])$markup .= '<div class="wpsvp-share-item wpsvp-contr-btn" data-type="twitter" data-tooltip="'.esc_attr($options["tooltipTwitter"]).'">'.$options['iconShareTwitter'].'</div>';

			                        if($options["useShareFacebook"])$markup .= '<div class="wpsvp-share-item wpsvp-contr-btn" data-type="facebook" data-tooltip="'.esc_attr($options["tooltipFacebook"]).'">'.$options['iconShareFacebook'].'</div>';

			                        if($options["useShareGooglePlus"])$markup .= '<div class="wpsvp-share-item wpsvp-contr-btn" data-type="googleplus" data-tooltip="'.esc_attr($options["tooltipGoogleplus"]).'">'.$options['iconShareGooglePlus'].'</div>';

			                        if($options["useShareWhatsApp"])$markup .= '<div class="wpsvp-share-item wpsvp-contr-btn" data-type="whatsapp" data-tooltip="'.esc_attr($options['tooltipWhatsApp']).'">'.$options['iconShareWhatsApp'].'</div>';

			                        if($options["useShareReddit"])$markup .= '<div class="wpsvp-share-item wpsvp-contr-btn" data-type="reddit" data-tooltip="'.esc_attr($options["tooltipReddit"]).'">'.$options['iconShareReddit'].'</div>';

			                        if($options["useShareDigg"])$markup .= '<div class="wpsvp-share-item wpsvp-contr-btn" data-type="digg" data-tooltip="'.esc_attr($options["tooltipDigg"]).'">'.$options['iconShareDigg'].'</div>';

			                        if($options["useShareLinkedIn"])$markup .= '<div class="wpsvp-share-item wpsvp-contr-btn" data-type="linkedin" data-tooltip="'.esc_attr($options["tooltipLinkedIn"]).'">'.$options['iconShareLinkedin'].'</div>';

			                        if($options["useSharePinterest"])$markup .= '<div class="wpsvp-share-item wpsvp-contr-btn" data-type="pinterest" data-tooltip="'.esc_attr($options["tooltipPinterest"]).'">'.$options['iconSharePinterest'].'</div>';

	                    $markup .= '</div></div></div></div>';//end wpsvp-share-holder 
	                }

	                if($options['useEmbedBtn']){
	                	$markup .= '<div class="wpsvp-embed-holder">
	                		<div class="wpsvp-embed-holder-inner">
			                    <div class="wpsvp-embed-data-wrap">
			                        <div class="wpsvp-embed-close wpsvp-contr-btn" data-tooltip="'.esc_attr($options['tooltipEmbedClose']).'">'.$options['iconClose'].'</div>
			                        <div class="wpsvp-embed-inner">
				                        <div class="wpsvp-embed-title">'.esc_html($options["embedCodeText"]).'</div>
				                        <div class="wpsvp-embed-data">
				                            <div class="wpsvp-embed-code"></div>
				                            <div class="wpsvp-embed-copy" title="'.esc_attr($options["copyCodeTitle"]).'" data-copy-text="'.esc_attr($options["copyCodeText"]).'" data-copied-text="'.esc_attr($options["copiedCodeText"]).'">'.esc_html($options["copyCodeText"]).'</div>
				                        </div>
				                        <div class="wpsvp-embed-title">'.esc_html($options["directLinkText"]).'</div>
				                        <div class="wpsvp-embed-data">
				                            <div class="wpsvp-link-code"></div>
				                            <div class="wpsvp-link-copy" title="'.esc_attr($options["copyCodeTitle"]).'" data-copy-text="'.esc_attr($options["copyCodeText"]).'" data-copied-text="'.esc_attr($options["copiedCodeText"]).'">'.esc_html($options["copyCodeText"]).'</div>
				                        </div>
				                    </div>    
			                    </div> 
		                    </div>    
		                </div>';//end wpsvp-embed-holder
		            }

		            $markup .= '<div class="wpsvp-pwd-holder">
		            	<div class="wpsvp-pwd-holder-inner">
		                    <div class="wpsvp-pwd-data-wrap">
		                        <div class="wpsvp-pwd-title">'.esc_html($options['privateContentTitle']).'</div>
		                        <div class="wpsvp-pwd-data">
		                            <div class="wpsvp-pwd-field-wrap"><input type="password" class="wpsvp-pwd-field"></div>
		                            <div class="wpsvp-pwd-confirm">'.esc_html($options['privateContentConfirm']).'</div>
		                        </div>
		                        <div class="wpsvp-pwd-info">'.esc_html($options['privateContentInfo']).'</div>
		                        <div class="wpsvp-pwd-error">'.esc_html($options['privateContentPasswordError']).'</div>
		                    </div>
	                    </div>
	                </div>';//end wpsvp-pwd-holder

	            $markup .= '</div>';/* end wpsvp-media-holder */

	            //logo
                if(!empty($options["logoPath"])){

                	if(empty($options["logoUrl"])){
                		$markup .= '<span class="wpsvp-logo"><img src="'.$options["logoPath"].'" alt="logo"></span>';
                	}else{
                		$markup .= '<a class="wpsvp-logo" href="'.$options["logoUrl"].'" target="'.$options["logoTarget"].'"><img src="'.$options["logoPath"].'" alt="logo"></a>';
                	}

	            }

	            //controls
	            if($options["controlsType"] == 'controls1'){

		            $markup .= '<div class="wpsvp-player-controls-bottom wpsvp-player-interface">
                				<div class="wpsvp-player-controls1">

	                    <div class="wpsvp-player-controls1-left">';

	                        if($options['usePreviousBtn'])$markup .= '<div class="wpsvp-previous-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options['tooltipPrevious']).'">'.$options['iconPrevious'].'</div>';

	                        if($options['usePlayBtn'])$markup .= '<div class="wpsvp-playback-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options['tooltipPlayback']).'">
	                            <div class="wpsvp-btn wpsvp-btn-play">'.$options['iconPlay'].'</div>
	                            <div class="wpsvp-btn wpsvp-btn-pause">'.$options['iconPause'].'</div>
	                        </div>';

	                        if($options['useNextBtn'])$markup .= '<div class="wpsvp-next-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipNext"]).'">'.$options['iconNext'].'</div>';

	                        if($options['useRewindBtn'])$markup .= '<div class="wpsvp-rewind-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipRewind"]).'">'.$options['iconRewind'].'</div>';

	                        if($options['useSeekBackwardBtn'])$markup .= '<div class="wpsvp-seek-backward wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipSeekBackward"]).'">'.$options['iconSeekBackward'].'</div>';

	                        if($options['useSeekForwardBtn'])$markup .= '<div class="wpsvp-seek-forward wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipSeekForward"]).'">'.$options['iconSeekForward'].'</div>';

	                        if($options['useTime'])$markup .= '<div class="wpsvp-media-time-current"></div>';

	                    $markup .= '</div>'; 

	                    if($options["useSeekbar"])$markup .= '<div class="wpsvp-seekbar-wrap">
	                        <div class="wpsvp-seekbar">
	                            <div class="wpsvp-progress-bg">
	                                <div class="wpsvp-load-level"></div>
	                                <div class="wpsvp-progress-level"></div>
	                            </div>
	                        </div>
	                    </div>';
	   
	                    $markup .= '<div class="wpsvp-player-controls1-right">';

	                    	if($options['useTime'])$markup .= '<div class="wpsvp-media-time-total"></div>';

	                        if($options['useQualityBtn'])$markup .= '<div class="wpsvp-quality-toggle wpsvp-contr-btn">
	                        	<div class="wpsvp-icon-wrap" data-tooltip="'.esc_attr($options["tooltipQuality"]).'">'.$options['iconQuality'].'</div>
	                            <div class="wpsvp-quality-menu-holder">
	                                <ul class="wpsvp-quality-menu"></ul>
	                            </div>
	                        </div>';

	                        if($options['useAudioLanguageBtn'])$markup .= '<div class="wpsvp-audio-language-toggle wpsvp-contr-btn">
	                        	<div class="wpsvp-icon-wrap" data-tooltip="'.esc_attr($options["tooltipAudioLanguage"]).'">'.$options['iconAudioLanguage'].'</div>
	                            <div class="wpsvp-audio-language-menu-holder">
	                                <ul class="wpsvp-audio-language-menu"></ul>
	                            </div>
	                        </div>';

	                        if($options['usePlaybackRateBtn'])$markup .= '<div class="wpsvp-playback-rate-toggle wpsvp-contr-btn">
	                        	<div class="wpsvp-icon-wrap" data-tooltip="'.esc_attr($options["tooltipPlaybackRate"]).'">'.$options['iconPlaybackRate'].'</div>
	                            <div class="wpsvp-playback-rate-menu-holder">
	                                <ul class="wpsvp-playback-rate-menu">

	                                	<!-- added by HappyStar0619. 2019.05.04 -->

	                                    <li class="wpsvp-menu-item" data-value="16">16x</li>
	                                    <li class="wpsvp-menu-item" data-value="8">8x</li>
	                                    <li class="wpsvp-menu-item" data-value="7">7x</li>
	                                    <li class="wpsvp-menu-item" data-value="6">6x</li>
	                                    <li class="wpsvp-menu-item" data-value="5">5x</li>
	                                    <li class="wpsvp-menu-item" data-value="4">4x</li>
	                                    <li class="wpsvp-menu-item" data-value="3">3x</li>
	                                    <li class="wpsvp-menu-item" data-value="2">2x</li>
	                                    <li class="wpsvp-menu-item" data-value="1.5">1.5x</li>
	                                    <li class="wpsvp-menu-item" data-value="1">Normal</li>
	                                    <li class="wpsvp-menu-item" data-value="0.5">1/2x</li>
	                                    <li class="wpsvp-menu-item" data-value="0.25">1/4x</li>
	                                    <li class="wpsvp-menu-item" data-value="0.125">1/8x</li>
	                                </ul>
	                            </div>
	                        </div>';

	                        if($options['useSubtitleBtn'])$markup .= '<div class="wpsvp-subtitle-toggle wpsvp-contr-btn">
	                        	<div class="wpsvp-icon-wrap" data-tooltip="'.esc_attr($options["tooltipSubtitles"]).'">'.$options['iconSubtitles'].'</div>
	                            <div class="wpsvp-subtitle-menu-holder">
	                                <ul class="wpsvp-subtitle-menu"></ul>
	                            </div>
	                        </div>';

	                        if($options['usePipBtn'])$markup .= '<div class="wpsvp-pip-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipPip"]).'">'.$options['iconPip'].'</div>';

	                        if($options['useVolumeBtn']){

	                        	if($options["controlsTypeVolume"] == 'v'){

			                        $markup .= '<div class="wpsvp-volume-wrapper wpsvp-contr-btn">
			                            <div class="wpsvp-volume-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipVolume"]).'">
			                        		<div class="wpsvp-btn wpsvp-btn-volume-up">'.$options['iconVolumeUp'].'</div>
			                                <div class="wpsvp-btn wpsvp-btn-volume-down">'.$options['iconVolumeDown'].'</div>
			                                <div class="wpsvp-btn wpsvp-btn-volume-off">'.$options['iconVolumeOff'].'</div>
			                            </div>
			                            <div class="wpsvp-volume-seekbar">
			                                <div class="wpsvp-volume-bg"></div>
			                                <div class="wpsvp-volume-level"></div>
			                            </div> 
			                        </div>';  

			                    }else{//horizontal

			                    	$markup .= '<div class="wpsvp-volume-wrapper wpsvp-volume-horizontal">
			                            <div class="wpsvp-volume-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipVolume"]).'">
			                        		<div class="wpsvp-btn wpsvp-btn-volume-up">'.$options['iconVolumeUp'].'</div>
			                                <div class="wpsvp-btn wpsvp-btn-volume-down">'.$options['iconVolumeDown'].'</div>
			                                <div class="wpsvp-btn wpsvp-btn-volume-off">'.$options['iconVolumeOff'].'</div>
			                            </div>
			                            <div class="wpsvp-volume-seekbar wpsvp-volume-horizontal">
			                                <div class="wpsvp-volume-bg"></div>
			                                <div class="wpsvp-volume-level"></div>
			                            </div> 
			                        </div>'; 

			                    }

			                }

	                        if($options['useFullscreenBtn'])$markup .= '<div class="wpsvp-fullscreen-toggle wpsvp-contr-btn">
	                        	<div class="wpsvp-btn wpsvp-btn-fullscreen" data-tooltip="'.esc_attr($options["tooltipFullscreenEnter"]).'">'.$options['iconFullscreenEnter'].'</div>
	                        	<div class="wpsvp-btn wpsvp-btn-normal" data-tooltip="'.esc_attr($options["tooltipFullscreenExit"]).'">'.$options['iconFullscreenExit'].'</div>
	                        </div>';

	                    $markup .= '</div>   
	                   
	                </div></div>';// end wpsvp-player-controls1 

	            }
	            if($options["controlsType"] == 'controls1'){    

	                $markup .= '<div class="wpsvp-player-controls-top wpsvp-player-interface">';

	                    if($options['usePlaylistBtn'])$markup .= '<div class="wpsvp-playlist-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipPlaylist"]).'" data-tooltip-position="left">'.$options['iconPlaylistToggle'].'</div>';

	                    if($options['useInfoBtn'])$markup .= '<div class="wpsvp-info-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipInfo"]).'" data-tooltip-position="left">'.$options['iconInfoToggle'].'</div>';

	                    if($options["useShareBtn"])$markup .= '<div class="wpsvp-share-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipShare"]).'" data-tooltip-position="left">'.$options['iconShareToggle'].'</div>';

	                    if($options['useEmbedBtn'])$markup .= '<div class="wpsvp-embed-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options['tooltipEmbed']).'" data-tooltip-position="left">'.$options['iconEmbedToggle'].'</div>';

	                    if($options['useDownloadBtn'])$markup .= '<div class="wpsvp-download-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipDownload"]).'" data-tooltip-position="left"><a href="#">'.$options['iconDownloadToggle'].'</a></div>';

	                $markup .= '</div>';//end wpsvp-player-controls-top

	            }
	            else if($options["controlsType"] == 'controls2'){

		            $markup .= '<div class="wpsvp-player-controls-bottom wpsvp-player-interface">

		            	<div class="wpsvp-player-controls2">';

		            	if($options["useSeekbar"])$markup .= '<div class="wpsvp-seekbar-wrap">
	                        <div class="wpsvp-seekbar">
	                            <div class="wpsvp-progress-bg">
	                                <div class="wpsvp-load-level"></div>
	                                <div class="wpsvp-progress-level"></div>
	                            </div>
	                        </div>
	                    </div>';

	                    $markup .= '<div class="wpsvp-player-controls2-left">';

	                        if($options['usePreviousBtn'])$markup .= '<div class="wpsvp-previous-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options['tooltipPrevious']).'">'.$options['iconPrevious'].'</div>';

	                        if($options['usePlayBtn'])$markup .= '<div class="wpsvp-playback-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options['tooltipPlayback']).'">
	                            <div class="wpsvp-btn wpsvp-btn-play">'.$options['iconPlay'].'</div>
	                            <div class="wpsvp-btn wpsvp-btn-pause">'.$options['iconPause'].'</div>
	                        </div>';

	                        if($options['useNextBtn'])$markup .= '<div class="wpsvp-next-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipNext"]).'">'.$options['iconNext'].'</div>';

	                        if($options['useRewindBtn'])$markup .= '<div class="wpsvp-rewind-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipRewind"]).'">'.$options['iconRewind'].'</div>';

	                        if($options['useSeekBackwardBtn'])$markup .= '<div class="wpsvp-seek-backward wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipSeekBackward"]).'">'.$options['iconSeekBackward'].'</div>';
	                        
	                        if($options['useSeekForwardBtn'])$markup .= '<div class="wpsvp-seek-forward wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipSeekForward"]).'">'.$options['iconSeekForward'].'</div>';

	                        if($options['useTime'])$markup .= '<div class="wpsvp-media-time-current"></div>
				                        <div class="wpsvp-media-time-separator">&nbsp;&#47;&nbsp;</div>
				                        <div class="wpsvp-media-time-total"></div>';

	                    $markup .= '</div>'; 
	   
	                    $markup .= '<div class="wpsvp-player-controls2-right">';

	                    	if($options['useVolumeBtn'])$markup .= '<div class="wpsvp-volume-wrapper wpsvp-contr-btn">
	                            <div class="wpsvp-volume-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipVolume"]).'">
	                        		<div class="wpsvp-btn wpsvp-btn-volume-up">'.$options['iconVolumeUp'].'</div>
	                                <div class="wpsvp-btn wpsvp-btn-volume-down">'.$options['iconVolumeDown'].'</div>
	                                <div class="wpsvp-btn wpsvp-btn-volume-off">'.$options['iconVolumeOff'].'</div>
	                            </div>
	                            <div class="wpsvp-volume-seekbar wpsvp-volume-horizontal">
	                                <div class="wpsvp-volume-bg"></div>
	                                <div class="wpsvp-volume-level"><div class="wpsvp-volume-drag"></div></div>
	                            </div> 
	                        </div>';  

	                        if($options['useInfoBtn'])$markup .= '<div class="wpsvp-info-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipInfo"]).'">'.$options['iconInfoToggle'].'</div>';

		                    if($options["useShareBtn"]){
		                    	$markup .= '<div class="wpsvp-share-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipShare"]).'">'.$options['iconShareToggle'].'</div>';
			                }

		                    if($options['useEmbedBtn'])$markup .= '<div class="wpsvp-embed-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options['tooltipEmbed']).'">'.$options['iconEmbedToggle'].'</div>';

		                    if($options['useDownloadBtn'])$markup .= '<div class="wpsvp-download-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipDownload"]).'"><a href="#">'.$options['iconDownloadToggle'].'</a></div>';

		                    if($options['usePipBtn'])$markup .= '<div class="wpsvp-pip-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipPip"]).'">'.$options['iconPip'].'</div>';

		                    //settings menu
		                    if($options['usePlaybackRateBtn'] || $options['useSubtitleBtn'] || $options['useQualityBtn'] || $options['useAudioLanguageBtn']){
	                    	
			                    $markup .= '<div class="wpsvp-settings-wrap wpsvp-contr-btn">
		                            <div class="wpsvp-settings-toggle" data-tooltip="'.esc_attr($options["tooltipSettings"]).'">'.$options['iconSettings'].'</div>
		                            <div class="wpsvp-settings-holder">
		                                <div class="wpsvp-settings-holder-inner">
		                                    <div class="wpsvp-settings-home">
		                                        <ul>';
		                                            if($options['usePlaybackRateBtn'])$markup .= '<li class="wpsvp-menu-item" data-target="wpsvp-playback-rate-menu"><span class="wpsvp-settings-menu-item-title">'.$options["tooltipPlaybackRate"].'</span><span class="wpsvp-settings-menu-item-value wpsvp-playback-rate-menu-value"></span></li>';
		                                            if($options['useSubtitleBtn'])$markup .= '<li class="wpsvp-menu-item wpsvp-subtitle-settings-menu wpsvp-force-hide" data-target="wpsvp-subtitle-menu"><span class="wpsvp-settings-menu-item-title">'.$options["tooltipSubtitles"].'</span><span class="wpsvp-settings-menu-item-value wpsvp-subtitle-menu-value"></span></li>';
		                                            if($options['useQualityBtn'])$markup .= '<li class="wpsvp-menu-item wpsvp-quality-settings-menu wpsvp-force-hide" data-target="wpsvp-quality-menu"><span class="wpsvp-settings-menu-item-title">'.$options["tooltipQuality"].'</span><span class="wpsvp-settings-menu-item-value wpsvp-quality-menu-value"></span></li>';
		                                            if($options['useAudioLanguageBtn'])$markup .= '<li class="wpsvp-menu-item wpsvp-audio-language-settings-menu wpsvp-force-hide" data-target="wpsvp-audio-language-menu"><span class="wpsvp-settings-menu-item-title">'.$options["tooltipAudioLanguage"].'</span><span class="wpsvp-settings-menu-item-value wpsvp-audio-language-menu-value"></span></li>';
		                                        $markup .= '</ul>
		                                    </div>';//end wpsvp-settings-home
		                                    if($options['usePlaybackRateBtn'])$markup .= '<div class="wpsvp-playback-rate-menu-holder wpsvp-settings-menu">
		                                        <div class="wpsvp-menu-header">
		                                            <span>'.$options["tooltipPlaybackRate"].'</span>
		                                        </div>
		                                        <ul class="wpsvp-playback-rate-menu">

				                                	<!-- added by HappyStar0619. 2019.05.04 -->

				                                    <li class="wpsvp-menu-item" data-value="16">16x</li>
				                                    <li class="wpsvp-menu-item" data-value="8">8x</li>
				                                    <li class="wpsvp-menu-item" data-value="7">7x</li>
				                                    <li class="wpsvp-menu-item" data-value="6">6x</li>
				                                    <li class="wpsvp-menu-item" data-value="5">5x</li>
				                                    <li class="wpsvp-menu-item" data-value="4">4x</li>
				                                    <li class="wpsvp-menu-item" data-value="3">3x</li>
				                                    <li class="wpsvp-menu-item" data-value="2">2x</li>
				                                    <li class="wpsvp-menu-item" data-value="1.5">1.5x</li>
				                                    <li class="wpsvp-menu-item" data-value="1">Normal</li>
				                                    <li class="wpsvp-menu-item" data-value="0.5">1/2x</li>
				                                    <li class="wpsvp-menu-item" data-value="0.25">1/4x</li>
				                                    <li class="wpsvp-menu-item" data-value="0.125">1/8x</li>

		                                        </ul>
		                                    </div>';
		                                    if($options['useSubtitleBtn'])$markup .= '<div class="wpsvp-subtitle-menu-holder wpsvp-settings-menu">
		                                        <div class="wpsvp-menu-header">
		                                            <span>'.$options["tooltipSubtitles"].'</span>
		                                        </div>
		                                        <ul class="wpsvp-subtitle-menu"></ul>
		                                    </div>';
		                                    if($options['useQualityBtn'])$markup .= '<div class="wpsvp-quality-menu-holder wpsvp-settings-menu">
		                                        <div class="wpsvp-menu-header">
		                                            <span>'.$options["tooltipQuality"].'</span>
		                                        </div>
		                                        <ul class="wpsvp-quality-menu"></ul>
		                                    </div>';
		                                    if($options['useAudioLanguageBtn'])$markup .= '<div class="wpsvp-audio-language-menu-holder wpsvp-settings-menu">
		                                        <div class="wpsvp-menu-header">
		                                            <span>'.$options["tooltipAudioLanguage"].'</span>
		                                        </div>
		                                        <ul class="wpsvp-audio-language-menu"></ul>
		                                    </div>';
		                                $markup .= '</div><!-- end wpsvp-settings-holder-inner -->
		                            </div>
		                        </div>';

		                    }//end settings menu

	                        if($options['useFullscreenBtn'])$markup .= '<div class="wpsvp-fullscreen-toggle wpsvp-contr-btn">
	                        	<div class="wpsvp-btn wpsvp-btn-fullscreen" data-tooltip="'.esc_attr($options["tooltipFullscreenEnter"]).'">'.$options['iconFullscreenEnter'].'</div>
	                        	<div class="wpsvp-btn wpsvp-btn-normal" data-tooltip="'.esc_attr($options["tooltipFullscreenExit"]).'">'.$options['iconFullscreenExit'].'</div>
	                        </div>';

	                        if($options['usePlaylistBtn'])$markup .= '<div class="wpsvp-playlist-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipPlaylist"]).'">'.$options['iconPlaylistToggle'].'</div>';

	                $markup .= '</div></div></div><!-- end wpsvp-player-controls2 -->';

	            }

	            //context menu
	            if($options["rightClickContextMenu"] == 'custom'){

	            	$markup .= '<div class="wpsvp-context-menu">
		                <ul>
		                    <li class="wpsvp-context-playback">
		                        <span class="wpsvp-context-playback-play">'.esc_html($options["customContextMenuPlayText"]).'</span>
		                        <span class="wpsvp-context-playback-pause">'.esc_html($options["customContextMenuPauseText"]).'</span>
		                    </li>
		                    <li class="wpsvp-context-volume">
		                        <span class="wpsvp-context-volume-mute">'.esc_html($options["customContextMenuMuteText"]).'</span>
		                        <span class="wpsvp-context-volume-unmute">'.esc_html($options["customContextMenuUnMuteText"]).'</span>
		                    </li>
		                    <li class="wpsvp-context-fullscreen">
		                        <span class="wpsvp-context-fullscreen-enter">'.esc_html($options["customContextMenuEnterFullscreenText"]).'</span>
		                        <span class="wpsvp-context-fullscreen-exit">'.esc_html($options["customContextMenuExitFullscreenText"]).'</span>
		                    </li>';
		                    if(!empty($options['customContextMenuLink'])){
		                    	$markup .= '<li class="wpsvp-context-link"><span><a href="'.$options["customContextMenuLink"].'" target="'.$options["customContextMenuLinkTarget"].'">'.esc_html($options["customContextMenuLinkTitle"]).'</a></span></li>';
		                    }
		                $markup .= '</ul>   
		            </div>';//end wpsvp-context-menu 

	            }

	            //seekbar preview seek
	            $markup .= '<div class="wpsvp-preview-seek-wrap">
	                <div class="wpsvp-preview-seek-inner"></div>
	                <div class="wpsvp-preview-seek-time"><div class="wpsvp-preview-seek-time-current">0:00</div></div>
	            </div>

	            </div><!-- end wpsvp-player-holder -->';// end wpsvp-player-holder 

	            if($playlistPosition == 'wall'){

		            $markup .= '</div><!-- end wpsvp-lightbox-content-inner -->
					            <div class="wpsvp-lightbox-close" title="'.esc_attr($options["tooltipLightboxClose"]).'">'.$options['iconLightboxClose'].'</div>
					            <div class="wpsvp-lightbox-prev" title="'.esc_attr($options["tooltipLightboxPrevious"]).'">'.$options['iconLightboxPrevious'].'</div>
					            <div class="wpsvp-lightbox-next" title="'.esc_attr($options["tooltipLightboxNext"]).'">'.$options['iconLightboxNext'].'</div>
					            </div></div></div></div><!-- end wpsvp-lightbox-wrap -->';	

	            }

	            $bottomBarClass = '';
	            if(($playlistPosition == 'vlb' || $playlistPosition == 'vrb') && $options['usePlaylistBottomBar'])$bottomBarClass = ' wpsvp-playlist-tab';

	            $markup .= '<div class="wpsvp-playlist-holder">
	                <div class="wpsvp-playlist-inner">
	                    <div class="wpsvp-playlist-content'.$bottomBarClass.'"></div>
	                </div>';//end wpsvp-playlist-inner

                    if($options["navigationType"] == 'buttons'){//navigation buttons

	                	if($playlistPosition == 'ht' || $playlistPosition == 'hb'){//horizontal playlist

	                		$markup .= '<div class="wpsvp-nav-backward">'.$options['iconNavigationHorizontalBackward'].'</div>   
	                					<div class="wpsvp-nav-forward">'.$options['iconNavigationHorizontalForward'].'</div>';

	                	}else{//vertical playlist

		                	$markup .= '<div class="wpsvp-nav-backward">'.$options['iconNavigationVerticalBackward'].'</div>   
	                					<div class="wpsvp-nav-forward">'.$options['iconNavigationVerticalForward'].'</div>';

	               		}

                	} 

                	if($playlistPosition == 'outer' || $playlistPosition == 'wall'){
		            	if($options["showLoadMore"]){
			            	$markup .= '<div id="wpsvp-load-more-toggle" class="wpsvp-load-more-btn">'.esc_html($options["loadMoreBtnText"]).'</div>';
			            }
		            }

                	if($options["usePlaylistLoader"])$markup .= '<div class="wpsvp-playlist-loader"></div>';

                	//search filter
                	if($playlistPosition == 'wall'){
	                	$markup .= '<div class="wpsvp-search-wrap">
		                    <div class="wpsvp-lightbox-filter-wrap">
		                        <input class="wpsvp-lightbox-filter wpsvp-search-field" type="text" placeholder="'.esc_html($options["searchText"]).'">
		                    </div>
		                    <div class="wpsvp-search-toggle">'.$options['iconSearch'].'</div>
		                </div>';
		            }
		            //playlist bottom bar
		            else if(($playlistPosition == 'vlb' || $playlistPosition == 'vrb') && $options['usePlaylistBottomBar']){

			            $markup .= '<div class="wpsvp-playlist-filter-msg"><span>'.esc_html($options["nothingFoundText"]).'</span></div>

		                <div class="wpsvp-playlist-bar">

		                    <div class="wpsvp-playlist-filter-wrap"><input class="wpsvp-playlist-filter wpsvp-search-field" type="text" placeholder="'.esc_html($options["searchText"]).'"></div>

		                    <div class="wpsvp-playlist-bar-btns">

		                        <div class="wpsvp-shuffle-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipPlaylistShuffle"]).'">'.$options['iconPlaylistShuffle'].'</div>
		                        <div class="wpsvp-loop-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipPlaylistLoop"]).'">'.$options['iconPlaylistLoop'].'</div>
		                        <div class="wpsvp-next-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipPlaylistPrevious"]).'">'.$options['iconPlaylistPrevious'].'</div>
		                        <div class="wpsvp-previous-toggle wpsvp-contr-btn" data-tooltip="'.esc_attr($options["tooltipPlaylistNext"]).'">'.$options['iconPlaylistNext'].'</div>

		                    </div>    

		                </div>';

		            }

	            $markup .= '</div><!-- end wpsvp-playlist-holder -->

	            <div class="wpsvp-tooltip"></div>';  

        	$markup .= '</div><!-- end wpsvp-wrapper -->';

	    return $markup; 

	}

?>