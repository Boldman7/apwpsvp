<p class="info ad-info">Adverts can be video, audio, image file, Youtube single video or Vimeo single video with chromeless player. They can be added before main media starts, during main media play and after main media ends.<br>If global playlist adverts are enabled, they will be displayed instead of individual media adverts. Both global playlist adverts and media adverts can be turned on/off.</p> 

<table class="form-table">

	<tr valign="top">
		<th>Disable adverts</th>
		<td>
			<select class="disable_adverts" name="disable_adverts">
                <option value="0" <?php if($disable_adverts == "0") echo 'selected' ?>>no</option>
                <option value="1" <?php if($disable_adverts == "1") echo 'selected' ?>>yes</option>
            </select>
            <p class="info">Disable all adverts for this media.</p>
		</td>
	</tr>

</table>

<p class="info">Add preroll advert that will play before main media starts. Only one is allowed.</p>
<div class="wpsvp-preroll-content"></div>
<button type="button" class="preroll-source-add">Add preroll</button><br>

<p class="info">Add midroll advert that will play during main media. Unlimited number can be set.</p>
<div class="wpsvp-midroll-content"></div>
<button type="button" class="midroll-source-add">Add midroll</button><br>

<p class="info">Add endroll advert that will play after main media ends. Only one is allowed.</p>
<div class="wpsvp-endroll-content"></div>
<button type="button" class="endroll-source-add">Add endroll</button><br>

<div class="option-tab wpsvp-ad-source-orig" style="display:none;">

	<div class="option-toggle">
		<span class="option-title"></span>
        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" ><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg>
    </div>

    <div class="option-content">

    	<p class="info wpsvp-ri">* required fields</p>

    	<table class="form-table">

    		<tr valign="top">
            	<th>Active</th>
				<td>
                	<select class="ad_active ad_elem" name="" data-cname="active">
		                <option value="1">yes</option>
		                <option value="0">no</option>
		            </select>
		            <p class="info">Enable or disable this ad.</p>
	        	</td>
			</tr>  
            <tr valign="top">
            	<th>Select media type</th>
				<td>
                	<select class="ad_type ad_elem" name="" data-cname="type">
		                <optgroup label="video">
                            <option value="video">video mp4</option>
                            <option value="video_360">video 360</option>
                        </optgroup>
                        <optgroup label="audio">
                            <option value="audio">audio  mp3 / wav</option>
                        </optgroup>
                        <optgroup label="image">
                            <option value="image">image</option>
                            <option value="image_360">image 360 panorama</option>
                        </optgroup>
			            <optgroup label="youtube">
                            <option value="youtube_single">youtube single video</option>
                        </optgroup>
                        <optgroup label="vimeo">
                            <option value="vimeo_single">vimeo single video</option>
                        </optgroup>
		            </select>
	        	</td>
			</tr>    
            <tr valign="top">
				<th>Path *</th>
				<td>
					<img class="ad_path_preview wpsvp-img-preview" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D" alt="">
		            <input type="text" class="ad_path ad_elem" name="" data-cname="path" pattern=".*\S+.*" value="">
		            <button class="ad_path_upload">Upload</button><br>

		            <p class="info ad_video_info">Enter video url</p>
		            <p class="info ad_audio_info">Enter audio url</p>
		            <p class="info ad_image_info">Enter image url</p>
		            <p class="info ad_yt_single_info">Enter youtube video ID. For example, video ID is blue part:<br> <span class="info-light">https://www.youtube.com/watch?v=</span><span class="info-highlight2">tb935IxGBt4</span></p>
		            <p class="info ad_vim_single_info">Note: Vimeo player needs to be chromeless for adverts to work!<br>Enter vimeo video ID. For example, video ID is blue part:<br> <span class="info-light">https://vimeo.com/</span><span class="info-highlight2">279267531</span></p>

	            </td>
			</tr>
			<tr valign="top" class="ad_is360_field">
				<th>Is video 360</th>
				<td>
					<select class="ad_is360 ad_elem" name="" data-cname="is360">
		                <option value="0">no</option>
		                <option value="1">yes</option>
		            </select>
		            <p class="info">Select yes if video is 360.</p>
				</td>
			</tr>
			<tr valign="top" class="ad_yt_quality_field">
				<th>Suggested Youtube video quality</th>
				<td>
					<select class="ad_yt_quality ad_elem" name="" data-cname="yt_quality">
						<option value="">Select suggested video quality</option>
						<?php foreach ($yt_video_quality as $key => $value) : ?>
                            <option value="<?php echo($key); ?>"><?php echo($value); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p class="info">Read More about <a href="https://developers.google.com/youtube/iframe_api_reference#Playback_quality" target="_blank">playback quality</a></p>
				</td>
			</tr>
			<tr valign="top" class="ad_poster_field">
				<th>Poster</th>
				<td>
					<img class="ad_poster_preview wpsvp-img-preview" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D" alt="">
					<input type="text" class="ad_poster ad_elem" name="" data-cname="poster" placeholder="Enter poster path" value="">
		            <button class="ad_poster_upload">Upload</button><br>
		            <p class="info">Poster is shown in video area while audio plays.</p>
				</td>
			</tr>
			<tr valign="top" class="ad_duration_field">
				<th>Duration *</th>
				<td>
					<input type="number" min="0" class="ad_duration ad_elem" name="" data-cname="duration" placeholder="Enter duration" value="">
		            <p class="info">How long to show the image, in seconds. Rounded to full second.</p>
				</td>
			</tr>
			<tr valign="top" class="ad_begin_field">
				<th>Start time *</th>
				<td>
					<input type="number" min="0" class="ad_begin ad_elem" name="" data-cname="begin" placeholder="Enter start time" value="">
		            <p class="info">When to start mid roll, in seconds. Rounded to full second.</p>
				</td>
			</tr>
			<tr valign="top" class="ad_skip_enable_field">
				<th>Skip time</th>
				<td>
					<input type="number" min="0" class="ad_skip_enable ad_elem" name="" data-cname="skip_enable" placeholder="Enter skip time" value="">
		            <p class="info">When to show skip advert button, in seconds. Rounded to full second. Leave empty and no skip button will be shown.</p>
				</td>
			</tr>
			<tr valign="top">
				<th>Url link</th>
				<td>
					<input type="text" class="ad_link ad_elem" name="" data-cname="link" placeholder="Enter url link" value="">
					<p class="info">Url link to open when ad is paused.</p>
				</td>
			</tr>
			<tr valign="top">	
				<th>Url target</th>
				<td>
					<select class="ad_target ad_elem" name="" data-cname="target">
			            <option value="_blank">blank</option>
			            <option value="_parent">parent</option>
			        </select>
				</td>
			</tr>

		</table>

   		<button type="button" class="ad-source-remove">Remove</button>

   	</div>	

</div>
