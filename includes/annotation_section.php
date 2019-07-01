<p class="info ad-info">Annotations can be image, iframe, adsense or any HTML placed over video area during playback. Start and end time when annotations will be displayed can be defined.<br>If global playlist annotations are enabled, they will be displayed instead of individual media annotations. Both global playlist annotations and media annotations can be turned on/off.</p> 

<table class="form-table">

	<tr valign="top">
		<th>Disable annotations</th>
		<td>
			<select class="disable_annotations" name="disable_annotations">
                <option value="0" <?php if($disable_annotations == "0") echo 'selected' ?>>no</option>
                <option value="1" <?php if($disable_annotations == "1") echo 'selected' ?>>yes</option>
            </select>
            <p class="info">Disable all annotations for this media.</p>
		</td>
	</tr>

</table>

<div class="wpsvp-annotation-content"></div>
<button type="button" class="annotation-add">Add annotation</button><br>

<div class="option-tab wpsvp-annotation-source-orig" style="display:none;">

	<div class="option-toggle">
		<div class="wpsvp-checkbox"></div>
		<div class="option-toggle-wrap">	
			<span class="option-title"></span>
	        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" ><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg>
	    </div>
    </div>

    <div class="option-content">

    	<p class="info wpsvp-ri">* required fields</p>

    	<table class="form-table">

            <tr valign="top">
            	<th>Active</th>
				<td>
                	<select class="annotation_active annotation_elem" name="" data-cname="active">
		                <option value="1">yes</option>
		                <option value="0">no</option>
		            </select>
		            <p class="info">Enable or disable this annotation.</p>
	        	</td>
			</tr>  
			<tr valign="top">
            	<th>Annotation type</th>
				<td>
                	<select class="annotation_type annotation_elem" name="" data-cname="type">
                        <option value="image">image</option>
                        <option value="iframe">iframe</option>
                        <option value="html">HTML</option>
                        <option value="adsense-detail">AdSense details</option>
                        <option value="adsense-code">AdSense full code</option>
		            </select>
		            <p class="info annotation_adsense_detail_info">Enter AdSense details (client, slot, width and height)</p>
	        	</td>
			</tr>    
            <tr valign="top" class="annotation_path_field">
				<th>Content *</th>
				<td>
					<img class="annotation_path_preview wpsvp-img-preview" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D" alt="">
					<input type="text" class="annotation_path annotation_elem" name="" data-cname="path" value="">
					<textarea class="annotation_path_html annotation_elem" name="" data-cname="path_html" rows="5"></textarea>
		            <button class="annotation_path_upload">Upload</button><br>

		            <p class="info annotation_image_info">Enter image url</p>
		            <p class="info annotation_iframe_info">Enter iframe src attribute</p>
		            <p class="info annotation_html_info">Enter HTML which will be placed inside annotation. <br><a href="https://validator.w3.org/#validate_by_input" target="_blank">Validate your HTML</a> to make sure it doesnt break the page markup. 
		            <br>Do not place javascript code here.</p>
	            </td>
			</tr>
			<tr valign="top" class="adsense_code_field">
				<th>AdSense full code *</th>
				<td>
					<textarea class="annotation_adsense_code annotation_elem" name="" data-cname="adsense_code" rows="5"></textarea>
		            <p class="info annotation_adsense_code_info">Enter AdSense full code (<strong>only ins tag</strong>), do not enter script tag here. If you have AdSense CSS, enter it below in CSS styling field. Useful if your ad is responsive.</p>
	            </td>
			</tr>  
			<tr valign="top" class="adsense_client_field">
				<th>AdSense client *</th>
				<td>
					<input type="text" class="annotation_adsense_client annotation_elem" name="" data-cname="adsense_client" value="" placeholder="Enter AdSense client">
	            </td>
			</tr>
			<tr valign="top" class="adsense_slot_field">
				<th>AdSense slot *</th>
				<td>
					<input type="text" class="annotation_adsense_slot annotation_elem" name="" data-cname="adsense_slot" value="" placeholder="Enter AdSense slot">
	            </td>
			</tr>
			<tr valign="top" class="annotation_width_field">
				<th>AdSense width *</th>
				<td>
					<input type="number" min="0" class="annotation_width annotation_elem" name="" data-cname="width" placeholder="Enter AdSense width" value="">
				</td>
			</tr>
			<tr valign="top" class="annotation_height_field">
				<th>AdSense height *</th>
				<td>
					<input type="number" min="0" class="annotation_height annotation_elem" name="" data-cname="height" placeholder="Enter AdSense height" value="">
				</td>
			</tr>
			<tr valign="top">
				<th>Start time</th>
				<td>
					<input type="number" min="0" class="annotation_show_time annotation_elem" name="" data-cname="show_time" placeholder="Enter start time" value="">
		            <p class="info">When to show annotation, in seconds. Rounded to full second. If not defined, it will be shown from the start.</p>
				</td>
			</tr>
			<tr valign="top">
				<th>End time</th>
				<td>
					<input type="number" min="0" class="annotation_end_time annotation_elem" name="" data-cname="hide_time" placeholder="Enter end time" value="">
		            <p class="info">When to hide annotation, in seconds. Rounded to full second. If not defined, it will be shown till the end.</p>
				</td>
			</tr>
			<tr valign="top">
				<th>Annotation opacity</th>
				<td>
					<input type="number" min="0" max="1" step="0.1" class="annotation_opacity annotation_elem" name="" data-cname="opacity" placeholder="Enter opacity" value="">
		            <p class="info">Annotation default opacity when inactive (no mouse hover). You can set lower opacity to make annotation partialy transparent when inactive (for example 0.7), then on hover, default opacity is set to 1.</p>
				</td>
			</tr>
			<tr valign="top">
				<th>Url link</th>
				<td>
					<input type="text" class="annotation_link annotation_elem" name="" data-cname="link" placeholder="Enter url link" value="">
					<p class="info">Url link to open when annotation is clicked. This will wrap whole annotation in href tag.</p>
				</td>
			</tr>
			<tr valign="top">	
				<th>Url target</th>
				<td>
					<select class="annotation_target annotation_elem" name="" data-cname="target">
			            <option value="_blank">blank</option>
			            <option value="_parent">parent</option>
			        </select>
				</td>
			</tr>
			<tr valign="top">
            	<th>Annotation position</th>
				<td>
                	<select class="annotation_position annotation_elem" name="" data-cname="position">
                		<option value="default">not defined</option>
                        <option value="tl">top left</option>
                        <option value="tr">top right</option>
                        <option value="bl">bottom left</option>
                        <option value="br">bottom right</option>
                        <option value="center">center</option>
		            </select>
		            <p class="info">Choose annotation position in the player or leave as not defined.<br>Other way to set annotation position is to attach a CSS class to annotation and use custom CSS for positioning.</p>
	        	</td>
			</tr> 
			<tr valign="top">
            	<th>Annotation margins</th>
				<td>
                	<input type="number" min="0" class="annotation_margin_top annotation_elem" name="" data-cname="margin_top" placeholder="top margin" value=""><br>
                	<input type="number" min="0" class="annotation_margin_right annotation_elem" name="" data-cname="margin_right" placeholder="right margin" value=""><br>
                	<input type="number" min="0" class="annotation_margin_bottom annotation_elem" name="" data-cname="margin_bottom" placeholder="bottom margin" value=""><br>
                	<input type="number" min="0" class="annotation_margin_left annotation_elem" name="" data-cname="margin_left" placeholder="left margin" value="">
		            <p class="info">Choose margins around annotation (top, right, bottom, left).<br>Works only if Annotation position is defined.</p>
	        	</td>
			</tr> 
			<tr valign="top">
            	<th>Use close button</th>
				<td>
                	<select class="annotation_close_btn annotation_elem" name="" data-cname="close_btn">
                		<option value="0">no</option>
		                <option value="1">yes</option>
		            </select>
		            <p class="info">Use annotation close button. Without close button annotation cannot be closed.</p>
	        	</td>
			</tr>  
			<tr valign="top">
            	<th>Close button position</th>
				<td>
                	<select class="annotation_close_btn_position annotation_elem" name="" data-cname="close_btn_position">
                        <option value="tl">top left</option>
                        <option value="tr">top right</option>
                        <option value="bl">bottom left</option>
                        <option value="br">bottom right</option>
		            </select>
		            <p class="info">Choose annotation close button position.</p>
	        	</td>
			</tr>     
			<tr valign="top">
				<th>Classes</th>
				<td>
		            <input type="text" class="annotation_adit_class annotation_elem" name="" data-cname="adit_class" value="">
		            <p class="info">Enter additional classes which will be attached to annotation (separated by space).</p>
	            </td>
			</tr>
			<tr valign="top">
				<th>CSS styling</th>
				<td>
					<textarea class="annotation_css annotation_elem" name="" data-cname="css" rows="5"></textarea>
		            <p class="info">Enter custom CSS for annotation. Minify the CSS if you have lots of it.</p>
	            </td>
			</tr>  

		</table>

   		<button type="button" class="annotation-source-remove">Remove</button>

   	</div>	

</div>
