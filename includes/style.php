<div id="wpsvp-style-tabs">

    <ul class="wpsvp-tab-header">
        <li id="wpsvp-tab-layout">Layout</li>
        <li id="wpsvp-tab-size">Size</li>
        <li id="wpsvp-tab-icons">Elements</li>
        <li id="wpsvp-tab-ev">Breakpoints</li>
    </ul>

    <div id="wpsvp-tab-layout-content" class="wpsvp-tab-content">

    <?php if(isset($player_id)) : ?>
        <input type="hidden" name="player_id" value="<?php echo($player_id); ?>">
    <?php endif; ?>    

    <table class="form-table">
        
        <tr valign="top">
            <th>Enter player title</th>
            <td><input type="text" name="title" required maxlength="50" placeholder="Enter player title" value="<?php echo($title); ?>"></td>
        </tr>

        <tr valign="top">
            <th>Select playlist position</th>
            <td>
                <select id="playlistPosition" name="playlistPosition">
                    <?php foreach ($playlistPosition as $key => $value) : ?>
                        <option value="<?php echo($key); ?>" <?php if(isset($options['playlistPosition']) && $options['playlistPosition'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>

        <tr valign="top">
            <th></th>
            <td>
                <img id="playlist-position-img" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8/5+hHgAHggJ/PchI7wAAAABJRU5ErkJggg==" alt="playlist position"/>
                <p class="info playlist-position-info" id="vlb-info">Vertical playlist on the left, on narrow screens playlist goes below the player.</p>
                <p class="info playlist-position-info" id="vl-info">Vertical playlist on the left.</p>
                <p class="info playlist-position-info" id="vrb-info">Vertical playlist on the right, on narrow screens playlist goes below the player.</p>
                <p class="info playlist-position-info" id="vr-info">Vertical playlist on the right.</p>
                <p class="info playlist-position-info" id="vb-info">Vertical playlist below the player.</p>
                <p class="info playlist-position-info" id="ht-info">Horizontal playlist above the player.</p>
                <p class="info playlist-position-info" id="hb-info">Horizontal playlist below the player.</p>
                <p class="info playlist-position-info" id="outer-info">Grid playlist below the player.</p>
                <p class="info playlist-position-info" id="wall-info">Grid wall with player that opens as lightbox.</p>
                <p class="info playlist-position-info" id="no-playlist-info">Hide visible playlist and use just player.</p>
            </td>
        </tr>

        <tr valign="top" id="playlistStyle-field">
            <th>Select playlist items style</th>
            <td>
                <select id="playlistStyle" name="playlistStyle">
                    <?php foreach ($playlistStyle as $key => $value) : ?>
                        <option value="<?php echo($key); ?>" <?php if(isset($options['playlistStyle']) && $options['playlistStyle'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>

        <tr valign="top" id="playlistStyle-field2">
            <th></th>
            <td>
                <img id="playlist-style-img" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8/5+hHgAHggJ/PchI7wAAAABJRU5ErkJggg==" alt="playlist position"/>
                <p class="info playlist-style-info" id="desc-next-to-thumb-info">Thumbnail on the left, description on the right.</p>
                <p class="info playlist-style-info" id="desc-over-thumb-info">Description over thumbnail.</p>
            </td>
        </tr>

        <tr valign="top">
            <th>Select playlist info content</th>
            <td>
                <select id="playlistItemContent" name="playlistItemContent">
                    <?php foreach ($playlistItemContent as $key => $value) : ?>
                        <option value="<?php echo($key); ?>" <?php if(isset($options['playlistItemContent']) && $options['playlistItemContent'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>

        <tr valign="top" id="playlistThumbStyle_field">
            <th>Playlist thumbnail style</th>
            <td>
                <select name="playlistThumbStyle">
                    <?php foreach ($playlistThumbStyle as $key => $value) : ?>
                        <option value="<?php echo($key); ?>" <?php if(isset($options['playlistThumbStyle']) && $options['playlistThumbStyle'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                    <?php endforeach; ?>
                </select><br>
                <span class="info">Set square or rounded thumbnails.</span>
            </td>
        </tr>

        <tr valign="top" id="playlistGridStyle-field">
            <th>Select playlist items style</th>
            <td>
                <select id="playlistGridStyle" name="playlistGridStyle">
                    <?php foreach ($playlistGridStyle as $key => $value) : ?>
                        <option value="<?php echo($key); ?>" <?php if(isset($options['playlistGridStyle']) && $options['playlistGridStyle'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>

        <tr valign="top" id="playlistGridStyle-field2">
            <th></th>
            <td>
                <img id="playlist-grid-style-img" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8/5+hHgAHggJ/PchI7wAAAABJRU5ErkJggg==" alt="playlist position"/>
                <p class="info playlist-grid-style-info" id="grid-desc-over-thumb-info">Description over thumbnail.</p>
                <p class="info playlist-grid-style-info" id="grid-desc-below-thumb-info">Description below thumbnail.</p>
            </td>
        </tr>

        <tr valign="top" id="playlistInfoAnimation-field">
            <th>Select playlist info animation</th>
            <td>
                <select id="playlistInfoAnimation" name="playlistInfoAnimation">
                    <?php foreach ($playlistInfoAnimation as $key => $value) : ?>
                        <option value="<?php echo($key); ?>" <?php if(isset($options['playlistInfoAnimation']) && $options['playlistInfoAnimation'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="info">Playlist title and description hover animation.</p>
            </td>
        </tr>

        <tr valign="top" id="navigationType-field">
            <th>Select playlist navigation type</th>
            <td>
                <select id="navigationType" name="navigationType">
                    <?php foreach ($navigationType as $key => $value) : ?>
                        <option value="<?php echo($key); ?>" <?php if(isset($options['navigationType']) && $options['navigationType'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="info navigation-type-info" id="scroll-info">Navigation with scroll.</p>
                <p class="info navigation-type-info" id="buttons-info">Navigation with buttons.</p>
                <p class="info navigation-type-info" id="hover-info">Mouse move navigation (scroll thubms on mouse move position).</p>
            </td>
        </tr>

         <tr valign="top" id="navigationStyle-field">
            <th>Select navigation style</th>
            <td>
                <select id="navigationStyle" name="navigationStyle">
                    <?php foreach ($navigationStyle as $key => $value) : ?>
                        <option value="<?php echo($key); ?>" <?php if(isset($options['navigationStyle']) && $options['navigationStyle'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>

        <tr valign="top" id="playlistScrollTheme-field">
            <th>Select scroll theme</th>
            <td>
                <select name="playlistScrollTheme">
                    <?php foreach ($playlistScrollTheme as $key => $value) : ?>
                        <option value="<?php echo($key); ?>" <?php if(isset($options['playlistScrollTheme']) && $options['playlistScrollTheme'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                    <?php endforeach; ?>
                </select><br>
                <span class="info">View scroll examples <a href="http://manos.malihu.gr/repository/custom-scrollbar/demo/examples/scrollbar_themes_demo.html" target="_blank">here</a></span></span>
            </td>
        </tr>

        <tr valign="top">
            <th>Select player controls</th>
            <td>
                <select id="controlsType" name="controlsType">
                    <?php foreach ($controlsType as $key => $value) : ?>
                        <option value="<?php echo($key); ?>" <?php if(isset($options['controlsType']) && $options['controlsType'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>

        <tr valign="top">
            <th></th>
            <td>
                <img id="controls-type-img" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8/5+hHgAHggJ/PchI7wAAAABJRU5ErkJggg==" alt="playlist position"/>
                <p class="info controls-type-info" id="controls1-info">Controls 1 (bottom and top right).</p>
                <p class="info controls-type-info" id="controls2-info">Controls 2 (bottom).</p>
                <p class="info controls-type-info" id="none-info">No controls.</p>
            </td>
        </tr>
        
        <tr valign="top">
            <th>Select player skin</th>
            <td>
                <select id="playerSkin" name="playerSkin">
                <?php foreach ($playerSkin as $key => $value) : ?>
                        <option value="<?php echo($key); ?>" <?php if(isset($options['playerSkin']) && $options['playerSkin'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr valign="top" id="showLoadMore_field">
            <th>Show Load more button</th>
            <td>
                <select name="showLoadMore">
                    <option value="0" <?php if(isset($options['showLoadMore']) && $options['showLoadMore'] == "0") echo 'selected' ?>>no</option>
                    <option value="1" <?php if(isset($options['showLoadMore']) && $options['showLoadMore'] == "1") echo 'selected' ?>>yes</option>
                </select>
                <p class="info">Show "Load more" button below thumbnails.<br>To enable Load more functionality in player, go to Playlist Manager / Edit playlist / Edit media and check Load more option.<br>Works with Youtube or Vimeo media.</p>
            </td>
        </tr>
        <tr valign="top" id="usePlaylistBottomBar_field">
            <th>Use playlist bottom search bar</th>
            <td>
                <select name="usePlaylistBottomBar">
                    <option value="0" <?php if(isset($options['usePlaylistBottomBar']) && $options['usePlaylistBottomBar'] == "0") echo 'selected' ?>>no</option>
                    <option value="1" <?php if(isset($options['usePlaylistBottomBar']) && $options['usePlaylistBottomBar'] == "1") echo 'selected' ?>>yes</option>
                </select>
                <p class="info">Use playlist bottom bar with search field and random / loop / previous / next buttons</p>
            </td>
        </tr>
        <tr valign="top">
            <th>Select player shadow</th>
            <td>
                <select id="playerShadow" name="playerShadow">
                <?php foreach ($playerShadow as $key => $value) : ?>
                        <option value="<?php echo($key); ?>" <?php if(isset($options['playerShadow']) && $options['playerShadow'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="info">Select shadow effect below the player.</p>
            </td>
        </tr>
        <tr valign="top" id="minimizeOnScroll_field">
            <th>Minimize on page scroll</th>
            <td>
                <select name="minimizeOnScroll" id="minimizeOnScroll">
                    <option value="0" <?php if(isset($options['minimizeOnScroll']) && $options['minimizeOnScroll'] == "0") echo 'selected' ?>>no</option>
                    <option value="1" <?php if(isset($options['minimizeOnScroll']) && $options['minimizeOnScroll'] == "1") echo 'selected' ?>>yes</option>
                </select>
                <p class="info">Minimize player on page scroll when it gets out of visible area.<br>Works will all player layouts except Lightbox wall.</p>
            </td>
        </tr>
        <tr valign="top" id="minimizeOnScrollPosition_field">
            <th>Minimize on scroll position</th>
            <td>
                <select id="minimizeClass" name="minimizeClass">
                <?php foreach ($minimizeClass as $key => $value) : ?>
                        <option value="<?php echo($key); ?>" <?php if(isset($options['minimizeClass']) && $options['minimizeClass'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="info">Choose position to minimize the player to.</p>
            </td>
        </tr>

    </table>

    </div>

    <div id="wpsvp-tab-size-content" class="wpsvp-tab-content">

        <table class="form-table">
            
            <tr valign="top">
                <th>Player ratio</th>
                <td>
                    <input type="number" name="playerRatio" step="any" value="<?php echo($options['playerRatio']); ?>"><br>
                    <span class="info">Aspect ratio of video area. Set video area ratio to fit your videos, for example 1.333333 = 4/3. Default is 16/9 (1.777777)</span>
                </td>
            </tr>
            <tr valign="top" id="wrapperLayout_field">
                <th>Player fullscreen layout</th>
                <td>
                    <select name="wrapperLayout" id="wrapperLayout">
                        <option value="normal" <?php if(isset($options['wrapperLayout']) && $options['wrapperLayout'] == "normal") echo 'selected' ?>>no</option>
                        <option value="100%" <?php if(isset($options['wrapperLayout']) && $options['wrapperLayout'] == "100%") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Make player layout fixed to 100% of the screen width & height.</span>
                    </ul>
                </td>
            </tr>
            <tr valign="top" id="wrapperMaxWidth_field">
                <th>Player max width [px]</th>
                <td>
                    <input type="number" name="wrapperMaxWidth" id="wrapperMaxWidth" value="<?php echo($options['wrapperMaxWidth']); ?>"><br>
                    <span class="info" id="wrapperMaxWidth_info">Restrain player width (includes both player and playlist).</span>
                    <span class="info" id="wrapperMaxWidth_lightbox_info">Max width of the thumbnail grid.</span>
                </td>
            </tr>
            <tr valign="top" id="lightboxMaxWidth_field">
                <th>Lightbox max width [px]</th>
                <td>
                    <input type="number" name="lightboxMaxWidth" id="lightboxMaxWidth" value="<?php echo($options['lightboxMaxWidth']); ?>"><br>
                    <span class="info" id="wrapperMaxWidth_lightbox_info">Max width of the player in lightbox.</span>
                </td>
            </tr>
            <tr valign="top" id="playlistSideWidth_field">
                <th>Vertical playlist width [px]</th>
                <td>
                    <input type="number" name="playlistSideWidth" value="<?php echo($options['playlistSideWidth']); ?>"><br>
                    <span class="info">Width of the vertical playlist when its on the left or right side of the player.</span>
                </td>
            </tr>
            <tr valign="top" id="playlistBottomHeight_field">
                <th>Playlist bottom height [px]</th>
                <td>
                    <input type="number" name="playlistBottomHeight" value="<?php echo($options['playlistBottomHeight']); ?>"><br>
                    <span class="info">Height of the vertical playlist when its below the player.</span>
                </td>
            </tr>

            <tr valign="top" id="breakPoints_field">
                <th>Thumbnail grid breakpoints</th>
                <td>

                    <div class="wpsvp-br-table-section">
                    
                    <p>Breakpoints are calculated on wrapper width (width of the element which holds the player), not window width.</p>

                    <div id="wpsvp-br-table-wrap"></div>

                    <button type="button" id="breakPoint_add">Add breakpoint</button><br><br>

                    <table class="wpsvp-br-table-orig" style="display:none;">
                      <thead>
                        <tr>
                          <th align="left">Wrapper width</th>
                          <th align="left">Columns</th>
                          <th align="left">Spacing</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        <tr class="wpsvp-breakpoint">
                          <td><input class="bp-width" name="bp_width[]" type="number" min="0" value="" disabled/></td>
                          <td><input class="bp-column" name="bp_column[]" type="number" min="1" value="" disabled/></td>
                          <td><input class="bp-gutter" name="bp_gutter[]" type="number" min="0" value="" disabled/></td>
                          <td><button class="breakPoint_remove">Remove</button></td>
                        </tr>
                      </tbody>
                    </table>

                </td>
            </tr>

        </table>

    </div>

    <div id="wpsvp-tab-icons-content" class="wpsvp-tab-content">

        <p class="info">Choose which elements to display in the player. Icon markup (font-awesome 4 or svg). Font awesome icons have classes 'wpsvp-icon wpsvp-icon-' instead of 'fa fa-'</p>

        <table class="form-table">
            <h3>Header title</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="useHeaderTitle" id="useHeaderTitle">
                        <option value="0" <?php if(isset($options['useHeaderTitle']) && $options['useHeaderTitle'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useHeaderTitle']) && $options['useHeaderTitle'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Show media title header in top left of the player.</span>
                </td>
            </tr>
        </table>

        <table class="form-table">
            <h3>Big play button</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="useBigPlay" id="useBigPlay">
                        <option value="0" <?php if(isset($options['useBigPlay']) && $options['useBigPlay'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useBigPlay']) && $options['useBigPlay'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Show big play button in the center before media starts and when paused.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconBigPlay" value="<?php echo(esc_html($options['iconBigPlay'])); ?>">
                </td>
            </tr>
        </table>    

        <table class="form-table">
            <h3>Seekbar</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="useSeekbar" id="useSeekbar">
                        <option value="0" <?php if(isset($options['useSeekbar']) && $options['useSeekbar'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useSeekbar']) && $options['useSeekbar'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                </td>
            </tr>
        </table>   

        <table class="form-table">
            <h3>Play button</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="usePlayBtn" id="usePlayBtn">
                        <option value="0" <?php if(isset($options['usePlayBtn']) && $options['usePlayBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['usePlayBtn']) && $options['usePlayBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Use small play button.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Play icon</th>
                <td>
                   <input type="text" name="iconPlay" value="<?php echo(esc_html($options['iconPlay'])); ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>Pause icon</th>
                <td>
                    <input type="text" name="iconPause" value="<?php echo(esc_html($options['iconPause'])); ?>">
                </td>
            </tr>
        </table>      

        <table class="form-table">
            <h3>Next button</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="useNextBtn" id="useNextBtn">
                        <option value="0" <?php if(isset($options['useNextBtn']) && $options['useNextBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useNextBtn']) && $options['useNextBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconNext" value="<?php echo(esc_html($options['iconNext'])); ?>">
                </td>
            </tr>
        </table>    

        <table class="form-table">
            <h3>Previous button</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="usePreviousBtn" id="usePreviousBtn">
                        <option value="0" <?php if(isset($options['usePreviousBtn']) && $options['usePreviousBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['usePreviousBtn']) && $options['usePreviousBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconPrevious" value="<?php echo(esc_html($options['iconPrevious'])); ?>">
                </td>
            </tr>
        </table>    

        <table class="form-table">
            <h3>Rewind button (rewind to start)</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="useRewindBtn" id="useRewindBtn">
                        <option value="0" <?php if(isset($options['useRewindBtn']) && $options['useRewindBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useRewindBtn']) && $options['useRewindBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconRewind" value="<?php echo(esc_html($options['iconRewind'])); ?>">
                </td>
            </tr>
        </table>    

        <table class="form-table">
            <h3>Seek backward button (x seconds)</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="useSeekBackwardBtn" id="useSeekBackwardBtn">
                        <option value="0" <?php if(isset($options['useSeekBackwardBtn']) && $options['useSeekBackwardBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useSeekBackwardBtn']) && $options['useSeekBackwardBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconSeekBackward" value="<?php echo(esc_html($options['iconSeekBackward'])); ?>">
                </td>
            </tr>
        </table>    

        <table class="form-table">
            <h3>Seek forward button (x seconds)</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="useSeekForwardBtn" id="useSeekForwardBtn">
                        <option value="0" <?php if(isset($options['useSeekForwardBtn']) && $options['useSeekForwardBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useSeekForwardBtn']) && $options['useSeekForwardBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconSeekForward" value="<?php echo(esc_html($options['iconSeekForward'])); ?>">
                </td>
            </tr>
        </table>   

        <table class="form-table">
            <h3>Time (current and total)</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="useTime" id="useTime">
                        <option value="0" <?php if(isset($options['useTime']) && $options['useTime'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useTime']) && $options['useTime'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
        </table> 

        <table class="form-table">
            <h3>Quality button</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="useQualityBtn" id="useQualityBtn">
                        <option value="0" <?php if(isset($options['useQualityBtn']) && $options['useQualityBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useQualityBtn']) && $options['useQualityBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconQuality" value="<?php echo(esc_html($options['iconQuality'])); ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>Hide quality menu on single quality</th>
                <td>
                    <select name="hideQualityMenuOnSingleQuality">
                        <option value="0" <?php if(isset($options['hideQualityMenuOnSingleQuality']) && $options['hideQualityMenuOnSingleQuality'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['hideQualityMenuOnSingleQuality']) && $options['hideQualityMenuOnSingleQuality'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Hide quality button when only single quality is present.</span>
                </td>
            </tr>
        </table>   

        <table class="form-table">
            <h3>Playback rate button</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="usePlaybackRateBtn" id="usePlaybackRateBtn">
                        <option value="0" <?php if(isset($options['usePlaybackRateBtn']) && $options['usePlaybackRateBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['usePlaybackRateBtn']) && $options['usePlaybackRateBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconPlaybackRate" value="<?php echo(esc_html($options['iconPlaybackRate'])); ?>">
                </td>
            </tr>
        </table> 

        <table class="form-table">
            <h3>Volume button</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="useVolumeBtn" id="useVolumeBtn">
                        <option value="0" <?php if(isset($options['useVolumeBtn']) && $options['useVolumeBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useVolumeBtn']) && $options['useVolumeBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Volume up icon</th>
                <td><input type="text" name="iconVolumeUp" value="<?php echo(esc_html($options['iconVolumeUp'])); ?>"></td>
            </tr>
            <tr valign="top">
                <th>Volume down icon</th>
                <td><input type="text" name="iconVolumeDown" value="<?php echo(esc_html($options['iconVolumeDown'])); ?>"></td>
            </tr>
            <tr valign="top">
                <th>Volume off icon (muted)</th>
                <td><input type="text" name="iconVolumeOff" value="<?php echo(esc_html($options['iconVolumeOff'])); ?>"></td>
            </tr>
        </table> 

        <table class="form-table">
            <h3>Subtitle button</h3>
            <tr valign="top">
                <th>Enabled</th>
                <td>
                    <select name="useSubtitleBtn" id="useSubtitleBtn">
                        <option value="0" <?php if(isset($options['useSubtitleBtn']) && $options['useSubtitleBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useSubtitleBtn']) && $options['useSubtitleBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">This button is automatically hidden is there is no subtitle set on media.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconSubtitles" value="<?php echo(esc_html($options['iconSubtitles'])); ?>">
                </td>
            </tr>
        </table> 

        <table class="form-table">
            <h3>Download button</h3>
            <tr valign="top">
                <th>Enabled</th>    
                <td>
                    <select name="useDownloadBtn" id="useDownloadBtn">
                        <option value="0" <?php if(isset($options['useDownloadBtn']) && $options['useDownloadBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useDownloadBtn']) && $options['useDownloadBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">This button is automatically hidden is there is no download set on media.</span>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconDownloadToggle" value="<?php echo(esc_html($options['iconDownloadToggle'])); ?>">
                </td>
            </tr>
        </table> 

        <table class="form-table">
            <h3>Info button (description)</h3>
            <tr valign="top">
                <th>Enabled</th>          
                <td>
                    <select name="useInfoBtn" id="useInfoBtn">
                        <option value="0" <?php if(isset($options['useInfoBtn']) && $options['useInfoBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useInfoBtn']) && $options['useInfoBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconInfoToggle" value="<?php echo(esc_html($options['iconInfoToggle'])); ?>">
                </td>
            </tr>
        </table> 

        <table class="form-table">
            <h3>Embed button</h3>
            <tr valign="top">
                <th>Enabled</th>     
                <td>
                    <select name="useEmbedBtn" id="useEmbedBtn">
                        <option value="0" <?php if(isset($options['useEmbedBtn']) && $options['useEmbedBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useEmbedBtn']) && $options['useEmbedBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconEmbedToggle" value="<?php echo(esc_html($options['iconEmbedToggle'])); ?>">
                </td>
            </tr>
        </table>     

        <table class="form-table">
            <h3>Fullscreen button</h3>
            <tr valign="top">
                <th>Enabled</th>   
                <td>
                    <select name="useFullscreenBtn" id="useFullscreenBtn">
                        <option value="0" <?php if(isset($options['useFullscreenBtn']) && $options['useFullscreenBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useFullscreenBtn']) && $options['useFullscreenBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Fullscreen enter icon</th>
                <td><input type="text" name="iconFullscreenEnter" value="<?php echo(esc_html($options['iconFullscreenEnter'])); ?>"></td>
            </tr>
            <tr valign="top">
                <th>Fullscreen exit icon</th>
                <td><input type="text" name="iconFullscreenExit" value="<?php echo(esc_html($options['iconFullscreenExit'])); ?>"></td>
            </tr>
        </table>  

        <table class="form-table">
            <h3>Playlist toggle button (open / close playlist)</h3>
            <tr valign="top">
                <th>Enabled</th>         
                <td>
                    <select name="usePlaylistBtn" id="usePlaylistBtn">
                        <option value="0" <?php if(isset($options['usePlaylistBtn']) && $options['usePlaylistBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['usePlaylistBtn']) && $options['usePlaylistBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                    <span class="info">Use playlist open / close button.</span>
                </td>
            </tr>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconPlaylistToggle" value="<?php echo(esc_html($options['iconPlaylistToggle'])); ?>">
                </td>
            </tr>
        </table> 

        <table class="form-table">
            <h3>Picture in picture button</h3>
            <tr valign="top">
                <th>Enabled</th>         
                <td>
                    <select name="usePipBtn" id="usePipBtn">
                        <option value="0" <?php if(isset($options['usePipBtn']) && $options['usePipBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['usePipBtn']) && $options['usePipBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select><br>
                </td>
            </tr>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconPip" value="<?php echo(esc_html($options['iconPip'])); ?>">
                </td>
            </tr>
        </table>  

        <table class="form-table">
            <h3>Audio language button (live streaming)</h3>
            <tr valign="top">
                <th>Enabled</th>    
                <td>
                    <select name="useAudioLanguageBtn" id="useAudioLanguageBtn">
                        <option value="0" <?php if(isset($options['useAudioLanguageBtn']) && $options['useAudioLanguageBtn'] == "0") echo 'selected' ?>>no</option>
                        <option value="1" <?php if(isset($options['useAudioLanguageBtn']) && $options['useAudioLanguageBtn'] == "1") echo 'selected' ?>>yes</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>Icon</th>
                <td>
                   <input type="text" name="iconAudioLanguage" value="<?php echo(esc_html($options['iconAudioLanguage'])); ?>">
                </td>
            </tr>
        </table>  

        <table class="form-table">
            <h3>Misc</h3>
            <tr valign="top">
                <th>Close icon (info, embed, share)</th>
                <td><input type="text" name="iconClose" value="<?php echo(esc_html($options['iconClose'])); ?>"></td>
            </tr>
            <tr valign="top">
                <th>Settings icon (settings menu in controls style 2)</th>
                <td><input type="text" name="iconSettings" value="<?php echo(esc_html($options['iconSettings'])); ?>"></td>
            </tr>
        </table> 
            
        <table class="form-table">
            <h3>Button navigation</h3>
            <tr valign="top">
                <th>Playlist backward icon (navigation vertical)</th>
                <td><input type="text" name="iconNavigationVerticalBackward" value="<?php echo(esc_html($options['iconNavigationVerticalBackward'])); ?>"></td>
            </tr>
            <tr valign="top">
                <th>Playlist forward icon (navigation vertical)</th>
                <td><input type="text" name="iconNavigationVerticalForward" value="<?php echo(esc_html($options['iconNavigationVerticalForward'])); ?>"></td>
            </tr>
            <tr valign="top">
                <th>Playlist backward icon (navigation horizontal)</th>
                <td><input type="text" name="iconNavigationHorizontalBackward" value="<?php echo(esc_html($options['iconNavigationHorizontalBackward'])); ?>"></td>
            </tr>
            <tr valign="top">
                <th>Playlist forward icon (navigation horizontal)</th>
                <td><input type="text" name="iconNavigationHorizontalForward" value="<?php echo(esc_html($options['iconNavigationHorizontalForward'])); ?>"></td>
            </tr>
        </table> 

        <table class="form-table">
            <h3>Playlist bottom bar</h3>
            <tr valign="top">
                <th>Playlist shuffle icon</th>
                <td><input type="text" name="iconPlaylistShuffle" value="<?php echo(esc_html($options['iconPlaylistShuffle'])); ?>"></td>
            </tr>
            <tr valign="top">
                <th>Playlist loop icon</th>
                <td><input type="text" name="iconPlaylistLoop" value="<?php echo(esc_html($options['iconPlaylistLoop'])); ?>"></td>
            </tr>
            <tr valign="top">
                <th>Playlist previous icon</th>
                <td><input type="text" name="iconPlaylistPrevious" value="<?php echo(esc_html($options['iconPlaylistPrevious'])); ?>"></td>
            </tr>
            <tr valign="top">
                <th>Playlist next icon</th>
                <td><input type="text" name="iconPlaylistNext" value="<?php echo(esc_html($options['iconPlaylistNext'])); ?>"></td>
            </tr>
        </table> 

        <table class="form-table">
            <h3>Lightbox</h3>
            <tr valign="top">
                <th>Search icon (filter tracks)</th>
                <td><input type="text" name="iconSearch" value="<?php echo(esc_html($options['iconSearch'])); ?>"></td>
            </tr>
            <tr valign="top">
                <th>Icon lightbox close</th>
                <td><input type="text" name="iconLightboxClose" value="<?php echo(esc_html($options['iconLightboxClose'])); ?>"></td>
            </tr>
            <tr valign="top">
                <th>Icon lightbox previous</th>
                <td><input type="text" name="iconLightboxPrevious" value="<?php echo(esc_html($options['iconLightboxPrevious'])); ?>"></td>
            </tr>
            <tr valign="top">
                <th>Icon lightbox next</th>
                <td><input type="text" name="iconLightboxNext" value="<?php echo(esc_html($options['iconLightboxNext'])); ?>"></td>
            </tr>
        </table>


    </div>

    <div id="wpsvp-tab-ev-content" class="wpsvp-tab-content">

        <p class="info">Choose which elements to display on narrow screens.</p>

        <div id="wpsvp-ev-wrap"></div>

        <div class="option-tab ev-unit-wrap-orig" style="display:none;">
            <div class="option-toggle">
                <span class="option-title"></span>
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" ><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg>
            </div>
            <div class="option-content">
              
                <p class="info">Set breakpoint width [px]:</p>
            
                <input class="ev_width ev-elem" name="" data-cname="width" type="number" min="0" value="">
             
                <p class="info">Select elements to show when player is below that width:</p>

                <div class="ev-unit-list">

                    <label class="container">controls 
                      <input type="checkbox" class="ev_controls ev-elem" name="" data-cname="controls">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">next button
                      <input type="checkbox" class="ev_next ev-elem" name="" data-cname="next">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">previous button
                      <input type="checkbox" class="ev_previous ev-elem" name="" data-cname="previous">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">seek backward button
                      <input type="checkbox" class="ev_seek_backward ev-elem" name="" data-cname="seek_backward">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">seek forward button
                      <input type="checkbox" class="ev_seek_forward ev-elem" name="" data-cname="seek_forward">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">rewind button
                      <input type="checkbox" class="ev_rewind ev-elem" name="" data-cname="rewind">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">play btn
                      <input type="checkbox" class="ev_play ev-elem" name="" data-cname="play">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">seekbar
                      <input type="checkbox" class="ev_seekbar ev-elem" name="" data-cname="seekbar">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">time
                      <input type="checkbox" class="ev_time ev-elem" name="" data-cname="time">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">fullscreen button
                      <input type="checkbox" class="ev_fullscreen ev-elem" name="" data-cname="fullscreen">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">picture in picture button
                      <input type="checkbox" class="ev_pip ev-elem" name="" data-cname="pip">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">volume button
                      <input type="checkbox" class="ev_volume ev-elem" name="" data-cname="volume">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">playlist button
                      <input type="checkbox" class="ev_playlist ev-elem" name="" data-cname="playlist">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">download button
                      <input type="checkbox" class="ev_download ev-elem" name="" data-cname="download">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">share button
                      <input type="checkbox" class="ev_share ev-elem" name="" data-cname="share">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">info button
                      <input type="checkbox" class="ev_info ev-elem" name="" data-cname="info">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">embed button
                      <input type="checkbox" class="ev_embed ev-elem" name="" data-cname="embed">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">quality button
                      <input type="checkbox" class="ev_quality ev-elem" name="" data-cname="quality">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">subtitles (button and subtitles)
                      <input type="checkbox" class="ev_subtitles ev-elem" name="" data-cname="subtitles">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">annotations (annotations in player)
                      <input type="checkbox" class="ev_annotations ev-elem" name="" data-cname="annotations">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">playback rate button (speed)
                      <input type="checkbox" class="ev_playback_rate ev-elem" name="" data-cname="playback_rate">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">audio-language (for live streaming)
                      <input type="checkbox" class="ev_audio_language ev-elem" name="" data-cname="audio_language">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">up next thumbnail
                      <input type="checkbox" class="ev_upnext ev-elem" name="" data-cname="upnext">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">settings menu
                      <input type="checkbox" class="ev_settings ev-elem" name="" data-cname="settings">
                      <span class="checkmark"></span>
                    </label>
                    <label class="container">header title 
                      <input type="checkbox" class="ev_header_title ev-elem" name="" data-cname="header_title">
                      <span class="checkmark"></span>
                    </label>

                </div>

                <button type="button" class="ev_breakPoint_remove">Remove breakpoint</button>

            </div>

        </div>

        <button type="button" id="ev_breakPoint_add">Add breakpoint</button><br><br>

    </div>

</div>