<?php 

$mediaEndAction = array(
    'next' => 'next',
    'loop' => 'loop',
    'rewind' => 'rewind'
);

$preload = array(
    'auto' => 'auto',
    'metadata' => 'metadata',
    'none' => 'none'
);

$aspectRatio = array(
    '1' => 'fit inside',
    '2' => 'fit outside (fill whole screen)',
    '0' => 'original (no size change)',
);

$target = array(
    '_blank' => '_blank',
    '_self' => '_self',
    '_parent' => '_parent'
);

$playerType = array(
    'chromeless' => 'chromeless',
    'default' => 'default'
);

$youtubePlayerColor = array(
    'red' => 'red',
    'white' => 'white'
);

$logoPosition = array(
    'tl' => 'top left',
    'tr' => 'top right',
    'bl' => 'bottom left',
    'br' => 'bottom right'
);

$lightboxStyle = array(
    'frameless' => 'frameless',
    'border' => 'border'
);

$rightClickContextMenu = array(    
    'browser' => 'browser',
    'custom' => 'custom',
    'disabled' => 'disabled'
);


?>

<div id="wpsvp-general-tabs">

    <ul class="wpsvp-tab-header">
        <li style="display: none;" id="wpsvp-tab-playback">Playback</li>
        <li style="display: none;" id="wpsvp-tab-general">General</li>
        <li style="display: none;" id="wpsvp-tab-playlist">Playlist</li>
        <li style="display: none;" id="wpsvp-tab-lightbox">Lightbox</li>
        <li style="display: none;" id="wpsvp-tab-caption">Captions</li>
        <li style="display: none;" id="wpsvp-tab-youtube">Youtube Player</li>
        <li style="display: none;" id="wpsvp-tab-vimeo">Vimeo Player</li>
        <li style="display: none;" id="wpsvp-tab-stream">Live streaming</li>
        <li style="display: none;" id="wpsvp-tab-logo">Logo</li>
        <li style="display: none;" id="wpsvp-tab-contextmenu">Context menu</li>
        <li style="display: none;" id="wpsvp-tab-share">Social sharing</li>
        <li style="display: none;" id="wpsvp-tab-embed">Embed</li>
        <li style="display: none;" id="wpsvp-tab-ga">Google Analytics</li>
    </ul>

    <div id="wpsvp-tab-playback-content" class="wpsvp-tab-content">

        <table class="form-table">

            <input type="hidden" name="instanceName" value="<?php echo($options['instanceName']); ?>">

            <tr valign="top">
                <th>Active media on player start</th>
                <td>
                    <input type="text" name="activeItem" value="<?php echo($options['activeItem']); ?>" required><br>
                    <span class="info">Enter number, counting starts from zero (-1 = no media loaded, 0 = first media, 1 = second media etc..)</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Default volume</th>
                <td>
                    <input type="text" name="volume" value="<?php echo($options['volume']); ?>" required><br>
                    <span class="info">Enter number between 0 and 1.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Auto play</th>
                <td>
                    <select name="autoPlay">
                        <option value="0" <?php if(isset($options['autoPlay']) && $options['autoPlay'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['autoPlay']) && $options['autoPlay'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Auto play media. Defaults to false on mobile.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Auto play after first</th>
                <td>
                    <select name="autoPlayAfterFirst">
                        <option value="0" <?php if(isset($options['autoPlayAfterFirst']) && $options['autoPlayAfterFirst'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['autoPlayAfterFirst']) && $options['autoPlayAfterFirst'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Auto play media after first media has been manually started. Useful if you want to start autoplaying after first media has been manually started.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Auto play in viewport</th>
                <td>
                    <select name="autoPlayInViewport">
                        <option value="0" <?php if(isset($options['autoPlayInViewport']) && $options['autoPlayInViewport'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['autoPlayInViewport']) && $options['autoPlayInViewport'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Start playing media when player is visible on the page. Disabled on mobile.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Force muted video auto play</th>
                <td>
                    <select name="forceMutedAutoplay">
                        <option value="0" <?php if(isset($options['forceMutedAutoplay']) && $options['forceMutedAutoplay'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['forceMutedAutoplay']) && $options['forceMutedAutoplay'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Force muted autoplay for video. This can overcome some browser recent changes (like Chrome) which prevents autoplay. Will auto mute the video which is required for this feature to work.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Preload media attribute</th>
                <td>
                    <select name="preload">
                        <?php foreach ($preload as $key => $value) : ?>
                            <option value="<?php echo($key); ?>" <?php if(isset($options['preload']) && $options['preload'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Random play</th>
                <td>
                    <select name="randomPlay">
                        <option value="0" <?php if(isset($options['randomPlay']) && $options['randomPlay'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['randomPlay']) && $options['randomPlay'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Randomize playlist playback.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Loop playlist on playlist end</th>
                <td>
                <select name="loopingOn">
                    <option value="0" <?php if(isset($options['loopingOn']) && $options['loopingOn'] == "0") echo 'selected' ?>>no</option>
                    <option value="1" <?php if(isset($options['loopingOn']) && $options['loopingOn'] == "1") echo 'selected' ?>>yes</option>
                </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Media end action</th>
                <td>
                    <select name="mediaEndAction">
                        <?php foreach ($mediaEndAction as $key => $value) : ?>
                            <option value="<?php echo($key); ?>" <?php if(isset($options['mediaEndAction']) && $options['mediaEndAction'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <span class="info">Action to apply when each media finishes playing.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Seek time</th>
                <td>
                    <input type="number" min="0" name="seekTime" value="<?php echo($options['seekTime']); ?>"><br>
                    <span class="info">Seek time value for seek backward / seek forward commands</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Create advert markers in seekbar</th>
                <td>
                    <select class="createAdMarkers" name="createAdMarkers">
                        <option value="0" <?php if(isset($options['createAdMarkers']) && $options['createAdMarkers'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['createAdMarkers']) && $options['createAdMarkers'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                    <p class="info">Create markers for the mid-roll adverts in seekbar.</p>
                </td>
            </tr>
            <tr valign="top">
                <th>Play adverts only once per media</th>
                <td>
                    <select class="playAdsOnlyOnce" name="playAdsOnlyOnce">
                        <option value="0" <?php if(isset($options['playAdsOnlyOnce']) && $options['playAdsOnlyOnce'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['playAdsOnlyOnce']) && $options['playAdsOnlyOnce'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                    <p class="info">If user seeks back in time, adverts that were already shown will not be shown again.</p>
                </td>
            </tr>
            <tr valign="top">
                <th>Show annotations only once per media</th>
                <td>
                    <select class="showAnnotationsOnlyOnce" name="showAnnotationsOnlyOnce">
                        <option value="0" <?php if(isset($options['showAnnotationsOnlyOnce']) && $options['showAnnotationsOnlyOnce'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['showAnnotationsOnlyOnce']) && $options['showAnnotationsOnlyOnce'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                    <p class="info">If user seeks back in time, annotations that were closed will not be shown again.</p>
                </td>
            </tr>
            <tr valign="top">
                <th>Remember playback position</th>
                <td>
                    <select class="rememberPlaybackPosition" name="rememberPlaybackPosition">
                        <option value="0" <?php if(isset($options['rememberPlaybackPosition']) && $options['rememberPlaybackPosition'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['rememberPlaybackPosition']) && $options['rememberPlaybackPosition'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                    <p class="info">Remember playback position on new page load (volume, active item, current time).</p>
                </td>
            </tr>
            <tr valign="top">
                <th>Remember playback position key</th>
                <td>
                    <input type="text" class="playbackPositionKey" name="playbackPositionKey" value="<?php echo($options['playbackPositionKey']); ?>">
                    <br><span class="info">Unique string identifier for Remember playback position feature (no spacing or special characters). Has to be unique per player.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Store playlist in browser</th>
                <td>
                    <input type="number" min="0" step="1" class="cacheTime" name="cacheTime" placeholder="Enter seconds" value="<?php echo($options['cacheTime']); ?>">
                    <br><span class="info">Store playlist in browser to limit API requests for Youtube, Vimeo and other services. For example, if you load a Youtube playlist or a Vimeo channel, and set this value to 3600 seconds (1 hour), everytime the page is reloaded within that time, playlist will be loaded from cache. To disable loading from cache, set this value to 0 and playlist will be loaded using API again.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Store playlist in browser key</th>
                <td>
                    <input type="text" class="playlistStorageKey" name="playlistStorageKey" value="<?php echo($options['playlistStorageKey']); ?>">
                    <br><span class="info">Unique string identifier for Store playlist in browser feature (no spacing or special characters). Has to be unique per player.</span>
                </td>
            </tr>

        </table>

    </div>

    <div id="wpsvp-tab-general-content" class="wpsvp-tab-content">

        <table class="form-table">

            <tr valign="top">
                <th>Media aspect ratio</th>
                <td>
                    <select name="aspectRatio">
                        <?php foreach ($aspectRatio as $key => $value) : ?>
                            <option value="<?php echo($key); ?>" <?php if(isset($options['aspectRatio']) && $options['aspectRatio'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <span class="info">Set default media resize option inside player (valid for self hosted media).<br>Fit inside will always show whole video, but may leave blank spaces above and below, or left and right of the video, depending on the resolution.<br>Fit outside will always cover the whole screen with video, leaving no blank lines, but may cut part of the video above and below, or left and right of the it, depending on the resolution.<br>If you want to use this function with Youtube or Vimeo chromeless videos, you will need to set Youtube or Vimeo video width and height inside Playlist Manager when adding videos to playlist.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Use swipe navigation</th>
                <td> 
                    <select name="useSwipeNavigation">
                        <option value="0" <?php if(isset($options['useSwipeNavigation']) && $options['useSwipeNavigation'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useSwipeNavigation']) && $options['useSwipeNavigation'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Use swipe navigation on touch sensitive devices to move to next or previous media. <br>Note: Works with self hosted audio, video or images, Youtube or Vimeo chromeless players. It does not work with 360 images or videos!</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Show interface on media start</th>
                <td>
                    <select name="showInterfaceOnMediaStart">
                        <option value="0" <?php if(isset($options['showInterfaceOnMediaStart']) && $options['showInterfaceOnMediaStart'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['showInterfaceOnMediaStart']) && $options['showInterfaceOnMediaStart'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Show player controls when media starts.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Use keyboard navigation for playback</th>
                <td>
                    <select name="useKeyboardNavigationForPlayback">
                        <option value="0" <?php if(isset($options['useKeyboardNavigationForPlayback']) && $options['useKeyboardNavigationForPlayback'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useKeyboardNavigationForPlayback']) && $options['useKeyboardNavigationForPlayback'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">left arrow = seek backward, right arrow = seek forward, page up = previous media, page down = next media, space = toggle playback, m = toggle mute</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Toggle playback between multiple instances</th>
                <td>
                    <select name="togglePlaybackOnMultipleInstances">
                        <option value="0" <?php if(isset($options['togglePlaybackOnMultipleInstances']) && $options['togglePlaybackOnMultipleInstances'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['togglePlaybackOnMultipleInstances']) && $options['togglePlaybackOnMultipleInstances'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Pause playback if other instance playback is started in the same page.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>360 image/video indicator</th>
                <td>
                    <input type="text" id="vrInfo" name="vrInfo" value="<?php echo($options['vrInfo']); ?>">
                    <button id="vrInfo_upload">Upload</button>
                    <br><span class="info">Image which is shown over the player when 360 image or video starts to remind user this is 360 media. Valid for self hosted media.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Use IOS native player</th>
                <td>
                    <select name="useMobileNativePlayer">
                        <option value="0" <?php if(isset($options['useMobileNativePlayer']) && $options['useMobileNativePlayer'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useMobileNativePlayer']) && $options['useMobileNativePlayer'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Use native player on IOS. If true, this will loose ability to play directly in browser and have any of the custom elements above the video like subtitles, annotations... etc</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Use preloader above the player</th>
                <td>
                    <select name="usePlayerLoader">
                        <option value="0" <?php if(isset($options['usePlayerLoader']) && $options['usePlayerLoader'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['usePlayerLoader']) && $options['usePlayerLoader'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Use preloader above the playlist</th>
                <td>
                    <select name="usePlaylistLoader">
                        <option value="0" <?php if(isset($options['usePlaylistLoader']) && $options['usePlaylistLoader'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['usePlaylistLoader']) && $options['usePlaylistLoader'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            
        </table>

    </div>

    <div id="wpsvp-tab-lightbox-content" class="wpsvp-tab-content">

        <table class="form-table">

            <tr valign="top">
                <th>Click on background closes lightbox</th>
                <td>
                    <select name="clickOnBackgroundClosesLightbox">
                        <option value="0" <?php if(isset($options['clickOnBackgroundClosesLightbox']) && $options['clickOnBackgroundClosesLightbox'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['clickOnBackgroundClosesLightbox']) && $options['clickOnBackgroundClosesLightbox'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">When player is opened in lightbox, click on background around the player closes ligthbox.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Lightbox style</th>
                <td>
                    <select name="lightboxStyle">
                        <?php foreach ($lightboxStyle as $key => $value) : ?>
                            <option value="<?php echo($key); ?>" <?php if(isset($options['lightboxStyle']) && $options['lightboxStyle'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <span class="info">Choose border or not around lightbox.</span>
                </td>
            </tr>

        </table>

    </div>

    <div id="wpsvp-tab-caption-content" class="wpsvp-tab-content">

        <table class="form-table">

            <tr valign="top">
                <th>Captions dynamic font size</th>
                <td>
                    <select name="dynamicSubtitleSize">
                        <option value="0" <?php if(isset($options['dynamicSubtitleSize']) && $options['dynamicSubtitleSize'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['dynamicSubtitleSize']) && $options['dynamicSubtitleSize'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Change caption font size based on player width.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Apply caption custom caption css settings:</th>
                <td>
                    <select name="useCaptionCss">
                        <option value="0" <?php if(isset($options['useCaptionCss']) && $options['useCaptionCss'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useCaptionCss']) && $options['useCaptionCss'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Captions text color</th>
                <td>
                    <input name="captionTextColor" class="wpsvp-checkbox" value="<?php echo($options['captionTextColor']); ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>Captions text shadow</th>
                <td>
                    <input type="text" name="captionTextShadow" value="<?php echo($options['captionTextShadow']); ?>"><br>
                    <span class="info">Enter captions css text shadow or leave empty for none.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Captions text background color</th>
                <td>
                    <input name="captionTextBackgroundColor" class="wpsvp-checkbox" value="<?php echo($options['captionTextBackgroundColor']); ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>Captions background color</th>
                <td>
                    <input name="captionBackgroundColor" class="wpsvp-checkbox" value="<?php echo($options['captionBackgroundColor']); ?>">
                </td>
            </tr>

        </table>

    </div>

    <div id="wpsvp-tab-playlist-content" class="wpsvp-tab-content">

        <table class="form-table">

            <tr valign="top" id="playlistOpened_field">
                <th>Playlist opened</th>
                <td>
                    <select name="playlistOpened">
                        <option value="0" <?php if(isset($options['playlistOpened']) && $options['playlistOpened'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['playlistOpened']) && $options['playlistOpened'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Playlist opened on start.</span>
                </td>
            </tr>
            <tr valign="top" id="hidePlaylistOnFullscreenEnter_field">
                <th>Hide playlist on fullscreen enter</th>
                <td>
                    <select name="hidePlaylistOnFullscreenEnter">
                        <option value="0" <?php if(isset($options['hidePlaylistOnFullscreenEnter']) && $options['hidePlaylistOnFullscreenEnter'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['hidePlaylistOnFullscreenEnter']) && $options['hidePlaylistOnFullscreenEnter'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Hide playlist (if opened) when player enters fullscreen.</span>
                </td>
            </tr>
            <tr valign="top" id="sortableTracks_field">
                <th>Sortable playlist items</th>
                <td>
                    <select name="sortableTracks">
                        <option value="0" <?php if(isset($options['sortableTracks']) && $options['sortableTracks'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['sortableTracks']) && $options['sortableTracks'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Sortable playlist items with dragging. Defaults to false on mobile.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Truncate playlist description</th>
                <td>
                    <select name="truncatePlaylistDescription">
                        <option value="0" <?php if(isset($options['truncatePlaylistDescription']) && $options['truncatePlaylistDescription'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['truncatePlaylistDescription']) && $options['truncatePlaylistDescription'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Shorten playlist item description text and apply (...) on the end.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Truncate playlist description on window resize</th>
                <td>
                    <select name="truncateWatch">
                        <option value="0" <?php if(isset($options['truncateWatch']) && $options['truncateWatch'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['truncateWatch']) && $options['truncateWatch'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Set Truncate playlist description to be active on window resize, if your playlist items are responsive in size.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Limit description text</th>
                <td>
                    <input type="number" name="limitDescriptionText" placeholder="" value="<?php echo($options['limitDescriptionText']); ?>">
                    <p class="info">Limit number of characters in description text. Set zero (0) for no limit.</p>
                </td>
            </tr>

        </table>

    </div>

    <div id="wpsvp-tab-youtube-content" class="wpsvp-tab-content">

        <table class="form-table">
           
            <tr valign="top">
                <th>Youtube player type</th>
                <td>
                    <select name="youtubePlayerType">
                        <?php foreach ($playerType as $key => $value) : ?>
                            <option value="<?php echo($key); ?>" <?php if(isset($options['youtubePlayerType']) && $options['youtubePlayerType'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <span class="info">Youtube player type. Chromeless has custom controls.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Try to hide Youtube logo and show info</th>
                <td>
                    <select name="forceYoutubeChromeless">
                        <option value="0" <?php if(isset($options['forceYoutubeChromeless']) && $options['forceYoutubeChromeless'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['forceYoutubeChromeless']) && $options['forceYoutubeChromeless'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">This will enlarge Youtube video which means loosing part of the video screen. If its causing problems (like video not positioned correctly inside the player), just turn it off.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Youtube player color</th>
                <td>
                    <select name="youtubePlayerColor">
                        <?php foreach ($youtubePlayerColor as $key => $value) : ?>
                            <option value="<?php echo($key); ?>" <?php if(isset($options['youtubePlayerColor']) && $options['youtubePlayerColor'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <span class="info">This parameter specifies the color that will be used in the player's video progress bar to highlight the amount of the video that the viewer has already seen. (only for Youtube default player)</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Block Youtube iframe</th>
                <td>
                    <select name="blockYoutubeEvents">
                        <option value="0" <?php if(isset($options['blockYoutubeEvents']) && $options['blockYoutubeEvents'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['blockYoutubeEvents']) && $options['blockYoutubeEvents'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Place transparent div over youtube iframe to disable right click over the player (only for Youtube chromeless player).</span>
                </td>
            </tr>
           
        </table>

    </div>

    <div id="wpsvp-tab-vimeo-content" class="wpsvp-tab-content">

        <table class="form-table">
          
            <tr valign="top">
                <th>Vimeo player type</th>
                <td>
                    <select name="vimeoPlayerType">
                        <?php foreach ($playerType as $key => $value) : ?>
                            <option value="<?php echo($key); ?>" <?php if(isset($options['vimeoPlayerType']) && $options['vimeoPlayerType'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <span class="info">Vimeo player type. Chromeless is only available for videos hosted by a Plus account or higher!</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Vimeo player color</th>
                <td>
                    <input name="vimeoPlayerColor" class="wpsvp-checkbox" value="<?php echo($options['vimeoPlayerColor']); ?>"><br>
                    <span class="info">Specify the color of the video controls.</span>
                </td>
            </tr>
           
        </table>

    </div>

    <div id="wpsvp-tab-stream-content" class="wpsvp-tab-content">

        <p>Here are settings for live streaming in the player (hls, dash)</p>

        <table class="form-table">
          
            <tr valign="top">
                <th>Show stream video bitrate menu</th>
                <td>
                    <select name="showStreamVideoBitrateMenu">
                        <option value="0" <?php if(isset($options['showStreamVideoBitrateMenu']) && $options['showStreamVideoBitrateMenu'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['showStreamVideoBitrateMenu']) && $options['showStreamVideoBitrateMenu'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Show video bitrate menu for live streaming.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Show stream audio bitrate menu</th>
                <td>
                    <select name="showStreamAudioBitrateMenu">
                        <option value="0" <?php if(isset($options['showStreamAudioBitrateMenu']) && $options['showStreamAudioBitrateMenu'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['showStreamAudioBitrateMenu']) && $options['showStreamAudioBitrateMenu'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Show audio bitrate menu for live streaming.</span>
                </td>
            </tr>
           
        </table>

    </div>

    <div id="wpsvp-tab-logo-content" class="wpsvp-tab-content">

        <table class="form-table">

            <tr valign="top">
                <th>Player logo image path</th>
                <td>
                    <input type="text" id="logoPath" name="logoPath" value="<?php echo($options['logoPath']); ?>">
                    <button id="logo_path_upload">Upload</button>
                </td>
            </tr>
            <tr valign="top">
                <th>Logo url</th>
                <td>
                    <input type="text" name="logoUrl" value="<?php echo($options['logoUrl']); ?>"><br>
                    <span class="info">Make logo clickable by providing url link.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Logo url target</th>
                <td>
                    <select name="logoTarget">
                        <?php foreach ($target as $key => $value) : ?>
                            <option value="<?php echo($key); ?>" <?php if(isset($options['target']) && $options['target'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Logo position</th>
                <td>
                    <select name="logoPosition">
                        <?php foreach ($logoPosition as $key => $value) : ?>
                            <option value="<?php echo($key); ?>" <?php if(isset($options['logoPosition']) && $options['logoPosition'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                        <?php endforeach; ?>
                    </select><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Logo margin</th>
                <td>
                    <input type="number" min="0" name="logoMargin" placeholder="" value="<?php echo($options['logoMargin']); ?>"><br>
                </td>
            </tr>

        </table>

    </div>

    <div id="wpsvp-tab-contextmenu-content" class="wpsvp-tab-content">

        <table class="form-table">

            <tr valign="top">
                <th>Right click context menu</th>
                <td>
                    <select name="rightClickContextMenu">
                        <?php foreach ($rightClickContextMenu as $key => $value) : ?>
                            <option value="<?php echo($key); ?>" <?php if(isset($options['rightClickContextMenu']) && $options['rightClickContextMenu'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <span class="info">Use browser default context menu, custom or disable right click (disabled works for self hosted media and Youtube and Vimeo chromeless players).</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Custom context menu Url link</th>
                <td>
                    <input type="text" id="customContextMenuLink" name="customContextMenuLink" value="<?php echo($options['customContextMenuLink']); ?>">
                    <br><span class="info">Set url link which will appear in context menu.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Custom context menu Url link target</th>
                <td>
                    <select name="customContextMenuLinkTarget">
                        <?php foreach ($target as $key => $value) : ?>
                            <option value="<?php echo($key); ?>" <?php if(isset($options['customContextMenuLinkTarget']) && $options['customContextMenuLinkTarget'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br><span class="info">Set url link target.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Custom context menu Url title</th>
                <td>
                    <input type="text" id="customContextMenuLinkTitle" name="customContextMenuLinkTitle" value="<?php echo($options['customContextMenuLinkTitle']); ?>">
                    <br><span class="info">Set url link title.</span>
                </td>
            </tr>

        </table>

    </div>

    <div id="wpsvp-tab-share-content" class="wpsvp-tab-content">

        <table class="form-table">
            <h3>Social sharing</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="useShareBtn" id="useShareBtn">
                        <option value="0" <?php if(isset($options['useShareBtn']) && $options['useShareBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useShareBtn']) && $options['useShareBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconShareToggle" value="<?php echo(esc_html($options['iconShareToggle'])); ?>">
                </td>
            </tr>
        </table> 

        <table class="form-table">
            <h3>Facebook share</h3>
            <tr valign="top">
                <th>Enabled</th>     
                <td>
                    <select name="useShareFacebook">
                        <option value="0" <?php if(isset($options['useShareFacebook']) && $options['useShareFacebook'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useShareFacebook']) && $options['useShareFacebook'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconShareFacebook" value="<?php echo(esc_html($options['iconShareFacebook'])); ?>">
                </td>
            </tr>
        </table>  

        <table class="form-table">
            <h3>Twitter share</h3>
            <tr valign="top">
                <th>Enabled</th>     
                <td>
                    <select name="useShareTwitter">
                        <option value="0" <?php if(isset($options['useShareTwitter']) && $options['useShareTwitter'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useShareTwitter']) && $options['useShareTwitter'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconShareTwitter" value="<?php echo(esc_html($options['iconShareTwitter'])); ?>">
                </td>
            </tr>
        </table>  

        <table class="form-table">
            <h3>Tumblr share</h3>
            <tr valign="top">
                <th>Enabled</th>     
                <td>
                    <select name="useShareTumblr">
                        <option value="0" <?php if(isset($options['useShareTumblr']) && $options['useShareTumblr'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useShareTumblr']) && $options['useShareTumblr'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconShareTumblr" value="<?php echo(esc_html($options['iconShareTumblr'])); ?>">
                </td>
            </tr>
        </table> 

        <table class="form-table">
            <h3>Google Plus share</h3>
            <tr valign="top">
                <th>Enabled</th>     
                <td>
                    <select name="useShareGooglePlus">
                        <option value="0" <?php if(isset($options['useShareGooglePlus']) && $options['useShareGooglePlus'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useShareGooglePlus']) && $options['useShareGooglePlus'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconShareGooglePlus" value="<?php echo(esc_html($options['iconShareGooglePlus'])); ?>">
                </td>
            </tr>
        </table>   

        <table class="form-table">
            <h3>WhatsApp share</h3>
            <tr valign="top">
                <th>Enabled</th>     
                <td>
                    <select name="useShareWhatsApp">
                        <option value="0" <?php if(isset($options['useShareWhatsApp']) && $options['useShareWhatsApp'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useShareWhatsApp']) && $options['useShareWhatsApp'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconShareWhatsApp" value="<?php echo(esc_html($options['iconShareWhatsApp'])); ?>">
                </td>
            </tr>
        </table> 

        <table class="form-table">
            <h3>Reddit share</h3>
            <tr valign="top">
                <th>Enabled</th>     
                <td>
                    <select name="useShareReddit">
                        <option value="0" <?php if(isset($options['useShareReddit']) && $options['useShareReddit'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useShareReddit']) && $options['useShareReddit'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconShareReddit" value="<?php echo(esc_html($options['iconShareReddit'])); ?>">
                </td>
            </tr>
        </table>   

        <table class="form-table">
            <h3>Digg share</h3>
            <tr valign="top">
                <th>Enabled</th>     
                <td>
                    <select name="useShareDigg">
                        <option value="0" <?php if(isset($options['useShareDigg']) && $options['useShareDigg'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useShareDigg']) && $options['useShareDigg'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconShareDigg" value="<?php echo(esc_html($options['iconShareDigg'])); ?>">
                </td>
            </tr>
        </table> 

        <table class="form-table">
            <h3>LinkedIn share</h3>
            <tr valign="top">
                <th>Enabled</th>     
                <td>
                    <select name="useShareLinkedIn">
                        <option value="0" <?php if(isset($options['useShareLinkedIn']) && $options['useShareLinkedIn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useShareLinkedIn']) && $options['useShareLinkedIn'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconShareLinkedin" value="<?php echo(esc_html($options['iconShareLinkedin'])); ?>">
                </td>
            </tr>
        </table> 

        <table class="form-table">
            <h3>Pinterest share</h3>
            <tr valign="top">
                <th>Enabled</th>     
                <td>
                    <select name="useSharePinterest">
                        <option value="0" <?php if(isset($options['useSharePinterest']) && $options['useSharePinterest'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useSharePinterest']) && $options['useSharePinterest'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconSharePinterest" value="<?php echo(esc_html($options['iconSharePinterest'])); ?>">
                </td>
            </tr>
        </table>            

    </div>

    <div id="wpsvp-tab-embed-content" class="wpsvp-tab-content">

        <table class="form-table">

            <tr valign="top">
                <th>Embed code iframe width [px or %]</th>
                <td>
                    <input type="text" class="check_key5" name="embedWidth" pattern="[^\s]+" value="<?php echo($options['embedWidth']); ?>"><br>
                    <span class="info">Enter '1000px' or '100%' for example.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Embed code iframe height [px or %]</th>
                <td>
                    <input type="text" class="check_key5" name="embedHeight" pattern="[^\s]+" value="<?php echo($options['embedHeight']); ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>Embed code iframe source</th>
                <td>
                    <input type="text" name="embedSrc" value="<?php echo($options['embedSrc']); ?>"><br>
                    <span class="info">Embed different url than the page url itself.</span>
                </td>
            </tr>
           
        </table>

    </div>

    <div id="wpsvp-tab-ga-content" class="wpsvp-tab-content">

        <table class="form-table">
            
            <tr valign="top">
                <th>Use Google Analytics</th>
                <td>
                    <select name="useGa" id="useGa">
                        <option value="0" <?php if(isset($options['useGa']) && $options['useGa'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useGa']) && $options['useGa'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Google Analytics tracking ID</th>
                <td>
                    <input type="text" name="gaTrackingId" value="<?php echo($options['gaTrackingId']); ?>"><br>
                    <span class="info">Get tracking ID <a href="https://support.google.com/analytics/answer/1008080" target="_blank">here</a></span></span>
                </td>
            </tr>
           
        </table>

    </div>
            
</div>