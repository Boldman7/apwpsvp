jQuery(document).ready(function($) {



    //preset preview 
    $("#style-imports").change(function(){
        var t = $(this).val(), img = wpsvp_data.plugins_url + '/includes/data/demo/'+t+'.jpg';
        $('#wpsvp-sample-import').attr('src', img);
        //show shortcode
        $('.wpsvp-demo-sc').hide();
        $('#'+t).show();
    }).change();









	//############################################//
	/* player manager */
	//############################################//



    //filter players

    var playerItemList = $('#player-item-list');

    $('#filter-player').on('keyup.apfilter',function(){

        var value = $(this).val(), i, j = 0, title, len = playerItemList.children('.player-item').length;

        for(i = 0; i < len; i++){

            title = playerItemList.children('.player-item').eq(i).find('.player-title').val();

            if(title.indexOf(value) >- 1){
                playerItemList.children('.player-item').eq(i).show();
            }else{
                playerItemList.children('.player-item').eq(i).hide();
                j++;
            }
        }

    });

    //filter playlist

    var playlistItemList = $('#playlist-item-list');

    $('#filter-playlist').on('keyup.apfilter',function(){

        var value = $(this).val(), i, j = 0, title, len = playlistItemList.children('.playlist-item').length;

        for(i = 0; i < len; i++){

            title = playlistItemList.children('.playlist-item').eq(i).find('.playlist-title').val();

            if(title.indexOf(value) >- 1){
                playlistItemList.children('.playlist-item').eq(i).show();
            }else{
                playlistItemList.children('.playlist-item').eq(i).hide();
                j++;
            }
        }

    });









    var empty_src = 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D';

    var wpsvpform_addplayer = $('#wpsvpform-addplayer');

    //toggle password visibility
   /* var wpsvp_pwd = $('#wpsvp_pwd');
    $('#wpsvp_toggle_password').on('click',function(){
        if(wpsvp_pwd.attr('type') == 'password'){
            wpsvp_pwd.attr('type','text');
        } else {
            wpsvp_pwd.attr('type','password');
        }
    });
    var wpsvp_pwd_g = $('#wpsvp_pwd_g');
    $('#wpsvp_toggle_password_g').on('click',function(){
        if(wpsvp_pwd_g.attr('type') == 'password'){
            wpsvp_pwd_g.attr('type','text');
        } else {
            wpsvp_pwd_g.attr('type','password');
        }
    });*/


    var playlistGridStyleVal;
    $('#playlistGridStyle').on('change',function(){

        playlistGridStyleVal = $(this).val();

        var src = wpsvp_data.plugins_url + '/includes/data/playlist_grid_style/' + playlistGridStyleVal + '.png';
        $('#playlist-grid-style-img').attr('src',src);

        //info
        $('.playlist-grid-style-info').hide();
        $('#'+playlistGridStyleVal+'-info').show();

        if(playlistGridStyleVal == 'gdot'){
            $('#playlistInfoAnimation-field').show();
        }else{
            $('#playlistInfoAnimation-field').hide();
        }

    }).change();

    var playlistStyleVal;
    $('#playlistStyle').on('change',function(){

        playlistStyleVal = $(this).val();

        var src = wpsvp_data.plugins_url + '/includes/data/playlist_style/' + playlistStyleVal + '.png';
        $('#playlist-style-img').attr('src',src);

        //info
        $('.playlist-style-info').hide();
        $('#'+playlistStyleVal+'-info').show();

        if(playlistStyleVal == 'drot'){
            $('#playlistThumbStyle_field').show();
            $('#navigationStyle-field').hide();
        }else{
            $('#playlistThumbStyle_field').hide();
            if(navigationTypeVal == 'buttons'){
                $('#navigationStyle-field').show();
            }
        }

        if(playlistStyleVal == 'dot'){
            $('#playlistInfoAnimation-field').show();
        }else{
            $('#playlistInfoAnimation-field').hide();
        }

    }).change();

    var navigationStyle;
    $('#navigationStyle').on('change',function(){
        navigationStyle = $(this).val();

        $('.navigation-style-info').hide();
        $('#'+navigationStyle+'-info').show();

    }).change();

    $('#controlsType').on('change',function(){

        var value = $(this).val();

        var src = wpsvp_data.plugins_url + '/includes/data/controls/' + value + '.png';
        $('#controls-type-img').attr('src',src);

        //info
        $('.controls-type-info').hide();
        $('#'+value+'-info').show();

    }).change();

    var navigationTypeVal = '',
    navigationType = $('#navigationType').on('change',function(){

        navigationTypeVal = $(this).val();

        //info
        $('.navigation-type-info').hide();
        $('#'+navigationTypeVal+'-info').show();

        if(navigationTypeVal == 'scroll'){
            $('#playlistScrollTheme-field').show();
        }else{
            $('#playlistScrollTheme-field').hide();
        }

        if(navigationTypeVal == 'buttons' && playlistStyleVal == 'dot'){
            $('#navigationStyle-field').show();
        }else{
            $('#navigationStyle-field').hide();
        } 

    }).change();

    var playlistPosition;
    $('#playlistPosition').on('change',function(){
        playlistPosition = $(this).val();

        var src = wpsvp_data.plugins_url + '/includes/data/playlist_position/' + playlistPosition + '.png';
        $('#playlist-position-img').attr('src',src);

        //hide all

        $('#playlistStyle-field').hide();
        $('#playlistStyle-field2').hide();
        $('#playlistGridStyle-field').hide();
        $('#playlistGridStyle-field2').hide();
        $('#playlistScrollTheme-field').hide();
        $('#navigationType-field').hide();
        $('#navigationStyle-field').hide();
        $('#showLoadMore_field').hide();
        $('#wrapperLayout_field').hide();
        $('#playlistSideWidth_field').hide();
        $('#playlistBottomHeight_field').hide();
        $('#breakPoints_field').hide();
        $('#sortableTracks_field').hide();
        $('#playlistOpened_field').hide();
        $('#hidePlaylistOnFullscreenEnter_field').hide();
        $('#playlistThumbStyle_field').hide();
        $('#lightboxMaxWidth_field').hide();
        $('#wrapperMaxWidth_info').hide();
        $('#wrapperMaxWidth_lightbox_info').hide();
        $('#minimizeOnScroll_field').hide();
        $('#minimizeOnScrollPosition_field').hide();
        $('#usePlaylistBottomBar_field').hide();

        //show individual

        if(playlistPosition == 'no-playlist'){
          
            $('#wrapperLayout_field').show();
            $('#wrapperMaxWidth_info').show();

        }else if(playlistPosition == 'outer' || playlistPosition == 'wall'){

            $('#playlistGridStyle-field').show();
            $('#playlistGridStyle-field2').show();
            $('#showLoadMore_field').show();
            $('#breakPoints_field').show();

            if(playlistPosition == 'outer'){
                $('#playlistOpened_field').show();
                $('#wrapperMaxWidth_info').show();
            }
            else if(playlistPosition == 'wall'){
                $('#lightboxMaxWidth_field').show();
                $('#wrapperMaxWidth_lightbox_info').show();
            }

            if(playlistGridStyleVal == 'gdot'){
                $('#playlistInfoAnimation-field').show();
            }else{
                $('#playlistInfoAnimation-field').hide();
            }
            
        }else{

            $('#playlistStyle-field').show();
            $('#playlistStyle-field2').show();
            if(navigationTypeVal == 'scroll')$('#playlistScrollTheme-field').show();
            $('#navigationType-field').show();
            $('#wrapperLayout_field').show();
            $('#sortableTracks_field').show();
            $('#playlistOpened_field').show();
            $('#hidePlaylistOnFullscreenEnter_field').show();
            if(playlistStyleVal == 'drot')$('#playlistThumbStyle_field').show();
            $('#wrapperMaxWidth_info').show();

            if(playlistPosition == 'vlb' || playlistPosition == 'vrb'){
                $('#playlistSideWidth_field').show();
                $('#playlistBottomHeight_field').show();
                $('#usePlaylistBottomBar_field').show();
            }
            else if(playlistPosition == 'vb'){
                $('#playlistBottomHeight_field').show();
            }
            else if(playlistPosition == 'ht' || playlistPosition == 'hb'){
                if(playlistStyleVal == 'dot'){
                    $('#navigationStyle-field').show();
                }
            }

            if(playlistStyleVal == 'dot'){
                $('#playlistInfoAnimation-field').show();
            }else{
                $('#playlistInfoAnimation-field').hide();
            }

        }

        if(playlistPosition != 'wall'){
            $('#minimizeOnScroll_field').show();
            $('#minimizeOnScrollPosition_field').show();
        }

      

        //info
        $('.playlist-position-info').hide();
        $('#'+playlistPosition+'-info').show();

    }).change();



    //fullscreen layout

    var wrapperMaxWidth = $('#wrapperMaxWidth'),
    wrapperMaxWidth_field = $('#wrapperMaxWidth_field');
    
    //if we change player to 100% fixed size
    $('#wrapperLayout').on('change',function(){
        var value = $(this).val();

        if(value == 'normal'){
            wrapperMaxWidth.prop('disabled', false);
            wrapperMaxWidth_field.show();
        }else{
            wrapperMaxWidth.prop('disabled', true);
            wrapperMaxWidth_field.hide();
        }

    }).change();

    $('#minimizeOnScroll').on('change',function(){
        var value = $(this).val();

        if(value == '1'){
            $('#minimizeOnScrollPosition_field').show();
        }else{
            $('#minimizeOnScrollPosition_field').hide();
        }

    }).change();


    



    //colors 

    $(".wpsvp-checkbox").spectrum({
    	color: $(this).val(),
        showAlpha: true,
        chooseText: "Update",
        showInitial: true,
        showInput: true,
        preferredFormat: "hex",
        change: function(color) {
			$(this).val(color.toRgbString());
		}
    });

    //accordion

    wpsvpform_addplayer.on('click', '.option-toggle', function(e){
    	var parent = $(this).parent();
    	if(parent.hasClass('option-closed')){
    		parent.removeClass('option-closed');
    	}else{
    		parent.addClass('option-closed');
    	}
    });

    $('.wpsvp-shortcode-manager-wrap').on('click', '.option-toggle', function(e){
        var parent = $(this).parent();
        if(parent.hasClass('option-closed')){
            parent.removeClass('option-closed');
        }else{
            parent.addClass('option-closed');
        }
    });

    //tabs

    //style

    var style_tabs = $('#wpsvp-style-tabs');

    style_tabs.find('.wpsvp-tab-header li').click(function(){
        var tab = $(this), id = tab.attr('id');

        if(!tab.hasClass('wpsvp-tab-active')){ 
            style_tabs.find('.wpsvp-tab-header li').removeClass('wpsvp-tab-active');  
            tab.addClass('wpsvp-tab-active');
            style_tabs.find('.wpsvp-tab-content').hide();

            $('#'+ id + '-content').show();
        }
    });

    style_tabs.find('.wpsvp-tab-header li').eq(0).addClass('wpsvp-tab-active');
    style_tabs.find('.wpsvp-tab-content').eq(0).show();


    //general

    var general_tabs = $('#wpsvp-general-tabs');

    general_tabs.find('.wpsvp-tab-header li').click(function(){
        var tab = $(this), id = tab.attr('id');

        if(!tab.hasClass('wpsvp-tab-active')){ 
            general_tabs.find('.wpsvp-tab-header li').removeClass('wpsvp-tab-active');  
            tab.addClass('wpsvp-tab-active');
            general_tabs.find('.wpsvp-tab-content').hide();

            $('#'+ id + '-content').show();
        }
    });

    general_tabs.find('.wpsvp-tab-header li').eq(0).addClass('wpsvp-tab-active');
    general_tabs.find('.wpsvp-tab-content').eq(0).show();

    //media

    var media_tabs = $('#wpsvp-media-tabs');

    media_tabs.find('.wpsvp-tab-header li').click(function(){
        var tab = $(this), id = tab.attr('id');

        if(!tab.hasClass('wpsvp-tab-active')){ 
            media_tabs.find('.wpsvp-tab-header li').removeClass('wpsvp-tab-active');  
            tab.addClass('wpsvp-tab-active');
            media_tabs.find('.wpsvp-tab-content').hide();

            $('#'+ id + '-content').show();
        }
    });

    media_tabs.find('.wpsvp-tab-header li').eq(0).addClass('wpsvp-tab-active');
    media_tabs.find('.wpsvp-tab-content').eq(0).show();

    //playlist

    var playlist_tabs = $('#wpsvp-playlist-tabs');

    playlist_tabs.find('.wpsvp-tab-header li').click(function(){
        var tab = $(this), id = tab.attr('id');

        if(!tab.hasClass('wpsvp-tab-active')){ 
            playlist_tabs.find('.wpsvp-tab-header li').removeClass('wpsvp-tab-active');  
            tab.addClass('wpsvp-tab-active');
            playlist_tabs.find('.wpsvp-tab-content').hide();

            $('#'+ id + '-content').show();
        }
    });

    playlist_tabs.find('.wpsvp-tab-header li').eq(0).addClass('wpsvp-tab-active');
    playlist_tabs.find('.wpsvp-tab-content').eq(0).show();




    //ad content

    var tab_ad_content;

    if($('#wpsvp-tab-media-adverts-content').length){
        tab_ad_content = $('#wpsvp-tab-media-adverts-content');
    }else if($('#wpsvp-tab-playlist-adverts-content').length){
        tab_ad_content = $('#wpsvp-tab-playlist-adverts-content');
    }

    if(tab_ad_content){

        var preroll_content = tab_ad_content.find('.wpsvp-preroll-content'),
        midroll_content = tab_ad_content.find('.wpsvp-midroll-content').sortable({
            handle: ".option-toggle",
            update: function(event, ui) {
                adjustAdMid();
            }
        }),
        endroll_content = tab_ad_content.find('.wpsvp-endroll-content');

        //toggle fields in ads

        tab_ad_content.on('change', '.ad_type', function(){

            var item = $(this), parent = item.closest('.wpsvp-ad-source');

            var type = item.val();

            parent.find('.ad_path').attr('value','');
            parent.find('.ad_path_upload').attr('data-type', type).hide();
            parent.find('.ad_begin').attr('value','');
            parent.find('.ad_skip_enable').attr('value','');
            parent.find('.ad_link').attr('value','');
            parent.find('.ad_poster_preview').attr('src',empty_src);
            parent.find('.ad_path_preview').attr('src',empty_src);

            if(type == 'video' || type == 'video_360'){
                parent.find('.ad_video_info').show();
                parent.find('.ad_path_upload').show();
            }else{
                parent.find('.ad_video_info').hide();
            }
            if(type == 'audio'){
                parent.find('.ad_poster_field').attr('value','').show();
                parent.find('.ad_audio_info').show();
                parent.find('.ad_path_upload').show();
            }else{
                parent.find('.ad_poster_field').hide();
                parent.find('.ad_audio_info').hide();
            }
            if(type == 'image' || type == 'image_360'){
                parent.find('.ad_duration_field').attr('value','').show();
                parent.find('.ad_duration').prop({required: true});
                parent.find('.ad_image_info').show();
                parent.find('.ad_path_upload').show();
            }else{
                parent.find('.ad_duration_field').hide();
                parent.find('.ad_duration').prop({required: false});
                parent.find('.ad_image_info').hide();
            }
            if(type == 'youtube_single'){
                parent.find('.ad_is360_field').show();
                parent.find('.ad_yt_single_info').show();
                parent.find('.ad_yt_quality_field').show();
            }else{
                parent.find('.ad_is360_field').hide();
                parent.find('.ad_yt_single_info').hide();
                parent.find('.ad_yt_quality_field').hide();
            }
            if(type == 'vimeo_single'){
                parent.find('.ad_is360_field').show();
                parent.find('.ad_vim_single_info').show();
            }else{
                parent.find('.ad_is360_field').hide();
                parent.find('.ad_vim_single_info').hide();
            }

        })
        .on('click', '.ad_path_upload, .ad_poster_upload', function(e){
            e.preventDefault();

            var upload_btn = $(this), library, source, custom_uploader, came_from;

            if(upload_btn.hasClass('ad_path_upload')){
                source = upload_btn.parent().find('.ad_path');
            }else{//ad_poster_upload
                source = upload_btn.parent().find('.ad_poster');
            }

            //dont reuse if we cant change library (when we change type)

            if($(e.currentTarget).hasClass('ad_poster_upload')){
                library = "image";
                came_from = 'audio';
            }else{

                var type = $(e.currentTarget).attr('data-type');
                console.log(type)
                if(type == 'video' || type == 'video_360'){
                    library = "video/mp4";
                }else if(type == 'audio'){
                    library = "audio/mpeg,audio/wav";
                }else if(type == 'image' || type == 'image_360'){
                    library = "image";
                    came_from = 'image';
                }
            }
            
            custom_uploader = wp.media({
            library:{
                    type: library
                }
            })
            .on("select", function(){
                var attachment = custom_uploader.state().get("selection").first().toJSON();
                $(source).val(attachment.url);

                if(came_from == 'audio'){
                    upload_btn.parent().find('.ad_poster_preview').attr('src',attachment.url);
                }else if(came_from == 'image'){
                    upload_btn.parent().find('.ad_path_preview').attr('src',attachment.url);
                }
            })
            .open();
            
        })
        .on('keyup', '.ad_begin', function(e){//start time / title for midroll
            var input = $(this), val = input.val();
            if(val != ''){
                input.closest('.wpsvp-ad-source').find('.option-title').html('MIDROLL: start seconds ' + val.toString());
            }else{
                input.closest('.wpsvp-ad-source').find('.option-title').html('MIDROLL');
            }
        }); 

        var preroll_source_add = tab_ad_content.find('.preroll-source-add').on('click',function(e){
            addAdSource('ad-pre');
            adjustAdPre();
        }); 
        var midroll_source_add = tab_ad_content.find('.midroll-source-add').on('click',function(e){
            addAdSource('ad-mid');
            adjustAdMid();
        });  
        var endroll_source_add = tab_ad_content.find('.endroll-source-add').on('click',function(e){
            addAdSource('ad-end');
            adjustAdEnd();
        });   

    }    
    
    if(typeof adData_arr !== 'undefined'){

        var i, len = adData_arr.length;

        if(len > 0){//load ad sources from db
            for(i=0;i<len;i++){
                addAdSource(adData_arr[i].ad_type, adData_arr[i], true);
            }
            adjustAdPre();
            adjustAdMid();
            adjustAdEnd();
        }
    }
    else if(typeof adDataGlobal_arr !== 'undefined'){

        var i, len = adDataGlobal_arr.length;

        if(len > 0){//load ad sources from db
            for(i=0;i<len;i++){
                addAdSource(adDataGlobal_arr[i].ad_type, adDataGlobal_arr[i], true);
            }
            adjustAdPre();
            adjustAdMid();
            adjustAdEnd();
        }
    }

    function adjustAdPre(){

        preroll_content.find('.wpsvp-ad-source .ad_elem').each(function(){

            var elem = $(this), i = 0, prefix = 'ad_pre';
            var name = elem.attr('data-cname'), nn = prefix+'['+i+']['+name+']';
            elem.attr('name', nn);

        });

    }

    function adjustAdMid(){

        var i = 0, prefix = 'ad_mid';

        midroll_content.find('.wpsvp-ad-source').each(function(){
            var bp = $(this);

            bp.find('.ad_elem').each(function(){
                var elem = $(this);
                var name = elem.attr('data-cname'), nn = prefix+'['+i+']['+name+']';
                elem.attr('name', nn);
            });

            i++;
        });

    }

    function adjustAdEnd(){

        endroll_content.find('.wpsvp-ad-source .ad_elem').each(function(){

            var elem = $(this), i = 0, prefix = 'ad_end';
            var name = elem.attr('data-cname'), nn = prefix+'['+i+']['+name+']';
            elem.attr('name', nn);

        });
    }

    function addAdSource(ad_type, item, closed){
        //console.log(at, item)

        var destination;

        if(ad_type == 'ad-pre'){
            destination = preroll_content;
        }
        else if(ad_type == 'ad-mid'){
            destination = midroll_content;
        }
        else if(ad_type == 'ad-end'){
            destination = endroll_content;
        }

        var bp = tab_ad_content.find('.wpsvp-ad-source-orig').clone().removeClass('wpsvp-ad-source-orig').addClass('wpsvp-ad-source').show().appendTo(destination);

        if(closed)bp.addClass('option-closed');//close accordions on start

        bp.find('.ad_path').prop({required: true});

        if(ad_type == 'ad-pre'){

            if(typeof item !== 'undefined'){

                bp.find('.ad_active').find('option[value="'+item.active+'"]').attr("selected", 'selected').change();
                bp.find('.ad_type').find('option[value="'+item.type+'"]').attr("selected", 'selected').change();
                bp.find('.ad_path').attr('value', item.path);
                if(item.type == 'image')bp.find('.ad_path_preview').attr('src', item.path);
                bp.find('.ad_poster').attr('value', item.poster);
                if(item.poster)bp.find('.ad_poster_preview').attr('src',item.poster);
                bp.find('.ad_is360').find('option[value="'+item.is360+'"]').attr("selected", 'selected').change();
                bp.find('.ad_yt_quality').find('option[value="'+item.yt_quality+'"]').attr("selected", 'selected').change();
                bp.find('.ad_duration').attr('value', item.duration);
                bp.find('.ad_skip_enable').attr('value', item.skip_enable);
                bp.find('.ad_link').attr('value', item.link);
                bp.find('.ad_target').find('option[value="'+item.target+'"]').attr("selected", 'selected').change();

            }else{

                bp.find('.ad_type').change();

            }

            bp.find('.ad_begin_field').hide();

            bp.find('.option-title').html('PREROLL');

            preroll_source_add.hide();

            //remove ad button
            bp.find('.ad-source-remove').on('click',function(e){
                var result = confirm("Are you sure to delete advert?");
                if(result){
                    $(this).closest('.wpsvp-ad-source').remove();
                    preroll_source_add.show();
                }
            });       

        }
        else if(ad_type == 'ad-mid'){

            bp.find('.ad_begin').prop({required: true});

            if(typeof item !== 'undefined'){

                bp.find('.ad_active').find('option[value="'+item.active+'"]').attr("selected", 'selected').change();
                bp.find('.ad_type').find('option[value="'+item.type+'"]').attr("selected", 'selected').change();
                bp.find('.ad_path').attr('value', item.path);
                if(item.type == 'image')bp.find('.ad_path_preview').attr('src', item.path);
                bp.find('.ad_poster').attr('value', item.poster);
                if(item.poster)bp.find('.ad_poster_preview').attr('src',item.poster);
                bp.find('.ad_is360').find('option[value="'+item.is360+'"]').attr("selected", 'selected').change();
                bp.find('.ad_yt_quality').find('option[value="'+item.yt_quality+'"]').attr("selected", 'selected').change();
                bp.find('.ad_duration').attr('value', item.duration);
                bp.find('.ad_skip_enable').attr('value', item.skip_enable);
                bp.find('.ad_begin').attr('value', item.begin);
                bp.find('.ad_link').attr('value', item.link);
                bp.find('.ad_target').find('option[value="'+item.target+'"]').attr("selected", 'selected').change();

                bp.find('.option-title').html('MIDROLL: start seconds ' + item.begin.toString());
               
            }else{

                bp.find('.ad_type').change();

                bp.find('.option-title').html('MIDROLL');

            }

            //remove ad button
            bp.find('.ad-source-remove').on('click',function(e){
                var result = confirm("Are you sure to delete advert?");
                if(result){
                    $(this).closest('.wpsvp-ad-source').remove();
                    adjustAdMid();
                }
            });       
        }
        else if(ad_type == 'ad-end'){

            if(typeof item !== 'undefined'){

                bp.find('.ad_active').find('option[value="'+item.active+'"]').attr("selected", 'selected').change();
                bp.find('.ad_type').find('option[value="'+item.type+'"]').attr("selected", 'selected').change();
                bp.find('.ad_path').attr('value', item.path);
                if(item.type == 'image')bp.find('.ad_path_preview').attr('src', item.path);
                bp.find('.ad_poster').attr('value', item.poster);
                if(item.poster)bp.find('.ad_poster_preview').attr('src',item.poster);
                bp.find('.ad_is360').find('option[value="'+item.is360+'"]').attr("selected", 'selected').change();
                bp.find('.ad_yt_quality').find('option[value="'+item.yt_quality+'"]').attr("selected", 'selected').change();
                bp.find('.ad_duration').attr('value', item.duration);
                bp.find('.ad_skip_enable').attr('value', item.skip_enable);
                bp.find('.ad_link').attr('value', item.link);
                bp.find('.ad_target').find('option[value="'+item.target+'"]').attr("selected", 'selected').change();
               
            }else{

                bp.find('.ad_type').change();

            }

            bp.find('.ad_begin_field').hide();

            bp.find('.option-title').html('ENDROLL');

            endroll_source_add.hide();

            //remove ad button
            bp.find('.ad-source-remove').on('click',function(e){
                var result = confirm("Are you sure to delete advert?");
                if(result){
                    $(this).closest('.wpsvp-ad-source').remove();
                    endroll_source_add.show();
                }
            });       

        }
    }



    //annotation content

    var tab_annotation_content, annotation_type;

    if($('#wpsvp-tab-media-annotations-content').length){
        tab_annotation_content = $('#wpsvp-tab-media-annotations-content');
    }else if($('#wpsvp-tab-playlist-annotations-content').length){
        tab_annotation_content = $('#wpsvp-tab-playlist-annotations-content');
    }

    if(tab_annotation_content){

        var annotation_content = tab_annotation_content.find('.wpsvp-annotation-content').sortable({
            handle: ".option-toggle-wrap",
            update: function(event, ui) {
                adjustAnnotation();
            }
        });

        //toggle fields in annotation

        tab_annotation_content.on('change', '.annotation_type', function(){

            var item = $(this), parent = item.closest('.wpsvp-annotation-source');

            annotation_type = item.val();

            parent.find('.annotation_path_field').hide();
            parent.find('.annotation_path').attr('value','').prop({required: false}).hide();
            parent.find('.annotation_path_preview').attr('src',empty_src);
            parent.find('.annotation_path_html').text('').prop({required: false}).hide();
            parent.find('.annotation_path_upload').hide();

            parent.find('.adsense_code_field').hide();
            parent.find('.adsense_client_field').hide();
            parent.find('.adsense_slot_field').hide();
            parent.find('.annotation_width_field').hide();
            parent.find('.annotation_height_field').hide();

            parent.find('.annotation_adsense_code').text('').prop({required: false});
            parent.find('.annotation_adsense_client').attr('value','').prop({required: false});
            parent.find('.annotation_adsense_slot').attr('value','').prop({required: false});
            parent.find('.annotation_width').attr('value','').prop({required: false});
            parent.find('.annotation_height').attr('value','').prop({required: false});

            parent.find('.annotation_show_time').attr('value','');
            parent.find('.annotation_end_time').attr('value','');
            parent.find('.annotation_opacity').attr('value','');
            parent.find('.annotation_link').attr('value','');
            parent.find('.annotation_adit_class').attr('value','');
            parent.find('.annotation_css').text('');

            parent.find('.annotation_image_info').hide();
            parent.find('.annotation_iframe_info').hide();
            parent.find('.annotation_html_info').hide();
            parent.find('.annotation_adsense_detail_info').hide();
            
            if(annotation_type == 'image'){
                parent.find('.annotation_path').prop({required: true}).show();
                parent.find('.annotation_path_upload').show();
                parent.find('.annotation_image_info').show();
                parent.find('.annotation_path_field').show();
            }
            else if(annotation_type == 'iframe'){
                parent.find('.annotation_path').prop({required: true}).show();
                parent.find('.annotation_iframe_info').show();
                parent.find('.annotation_path_field').show();
            }
            else if(annotation_type == 'html'){
                parent.find('.annotation_path_html').prop({required: true}).show();
                parent.find('.annotation_html_info').show();
                parent.find('.annotation_path_field').show();
            }
            else if(annotation_type == 'adsense-detail'){
                parent.find('.adsense_client_field').show();
                parent.find('.adsense_slot_field').show();
                parent.find('.annotation_width_field').show();
                parent.find('.annotation_height_field').show();
                parent.find('.annotation_adsense_client').prop({required: true});
                parent.find('.annotation_adsense_slot').prop({required: true});
                parent.find('.annotation_width').prop({required: true});
                parent.find('.annotation_height').prop({required: true});
                parent.find('.annotation_adsense_detail_info').show();
            }
            else if(annotation_type == 'adsense-code'){
                parent.find('.adsense_code_field').show();
                parent.find('.annotation_adsense_code').prop({required: true});
            }

        })
        .on('click', '.annotation_path_upload', function(e){
            e.preventDefault();

            var upload_btn = $(this), library, source, custom_uploader;

            source = upload_btn.parent().find('.annotation_path');
            library = "image";
            
            custom_uploader = wp.media({
            library:{
                    type: library
                }
            })
            .on("select", function(){
                var attachment = custom_uploader.state().get("selection").first().toJSON();
                $(source).val(attachment.url);

                upload_btn.parent().find('.annotation_path_preview').attr('src',attachment.url);
            })
            .open();
            
        })
        .on('keyup', '.annotation_show_time', function(e){//start time / title for annotation
            var input = $(this), val = input.val(), time = '0';
            if(val && val != ''){
                time = val.toString();
            }
            input.closest('.wpsvp-annotation-source').find('.option-title').html('start seconds: ' + time);
        }); 

        tab_annotation_content.find('.annotation-add').on('click',function(e){
            annotation_type = 'image';
            addAnnotationSource();
            adjustAnnotation();
        }); 

    }    
    
    if(typeof annotationData_arr !== 'undefined'){

        var i, len = annotationData_arr.length;

        if(len > 0){//load ad sources from db
            for(i=0;i<len;i++){
                addAnnotationSource(annotationData_arr[i], true);
            }
            adjustAnnotation();
        }
    }
    else if(typeof annotationDataGlobal_arr !== 'undefined'){

        var i, len = annotationDataGlobal_arr.length;

        if(len > 0){//load ad sources from db
            for(i=0;i<len;i++){
                addAnnotationSource(annotationDataGlobal_arr[i], true);
            }
            adjustAnnotation();
        }
    }

    function adjustAnnotation(){

        var i = 0, prefix = 'annotation';

        annotation_content.find('.wpsvp-annotation-source').each(function(){
            var bp = $(this);

            bp.find('.annotation_elem').each(function(){
                var elem = $(this);
                var name = elem.attr('data-cname'), nn = prefix+'['+i+']['+name+']';
                elem.attr('name', nn);
            });

            i++;
        });

    }

    function addAnnotationSource(item, closed){
        //console.log(item, annotation_type)

        var bp = tab_annotation_content.find('.wpsvp-annotation-source-orig').clone().removeClass('wpsvp-annotation-source-orig').addClass('wpsvp-annotation-source').show().appendTo(annotation_content);

        if(closed)bp.addClass('option-closed');//close accordions on start

        if(typeof item !== 'undefined'){

            bp.find('.annotation_active').find('option[value="'+item.active+'"]').attr("selected", 'selected').change();
            bp.find('.annotation_type').find('option[value="'+item.type+'"]').attr("selected", 'selected').change();
            bp.find('.annotation_adit_class').attr('value', item.adit_class);
            bp.find('.annotation_show_time').attr('value', item.show_time);
            bp.find('.annotation_end_time').attr('value', item.hide_time);
            bp.find('.annotation_opacity').attr('value', item.opacity);
            bp.find('.annotation_link').attr('value', item.link);
            bp.find('.annotation_target').find('option[value="'+item.target+'"]').attr("selected", 'selected').change();
            bp.find('.annotation_close_btn').find('option[value="'+item.close_btn+'"]').attr("selected", 'selected').change();
            bp.find('.annotation_close_btn_position').find('option[value="'+item.close_btn_position+'"]').attr("selected", 'selected').change();
            bp.find('.annotation_position').find('option[value="'+item.position+'"]').attr("selected", 'selected').change();
            if(item.css)bp.find('.annotation_css').text(item.css);
            bp.find('.annotation_margin_top').attr('value', item.margin_top);
            bp.find('.annotation_margin_right').attr('value', item.margin_right);
            bp.find('.annotation_margin_bottom').attr('value', item.margin_bottom);
            bp.find('.annotation_margin_left').attr('value', item.margin_left);
            if(item.css)bp.find('.annotation_css').text(item.css);

            if(annotation_type == 'image' || annotation_type == 'iframe'){
                bp.find('.annotation_path').attr('value', item.path);
                if(annotation_type == 'image')bp.find('.annotation_path_preview').attr('src', item.path);
            }
            else if(annotation_type == 'html'){
                bp.find('.annotation_path_html').text(item.path);
            }
            else if(annotation_type == 'adsense-detail'){
                bp.find('.annotation_adsense_client').attr('value', item.adsense_client);
                bp.find('.annotation_adsense_slot').attr('value', item.adsense_slot);
                bp.find('.annotation_width').attr('value', item.width);
                bp.find('.annotation_height').attr('value', item.height);
            }
            else if(annotation_type == 'adsense-code'){
                bp.find('.annotation_adsense_code').text(item.adsense_code);
            }


            var time = '0';
            if(item.show_time)time = item.show_time;
            bp.find('.option-title').html('start seconds: ' + time);

        }else{

            bp.find('.annotation_type').change();

        }

        //remove button
        bp.find('.annotation-source-remove').on('click',function(e){
            var result = confirm("Are you sure to delete annotation?");
            if(result){
                $(this).closest('.wpsvp-annotation-source').remove();
                adjustAnnotation();
            }
        });     

    }





    //playlist selector

    var pl_select_wrap = $('#pl-select-wrap').sortable();

    pl_select_wrap.on('click', '.pl-list-item', function(){
        var item = $(this);

        if(item.hasClass('pl-list-selected')){
            item.removeClass('pl-list-selected');
        }else{
            item.addClass('pl-list-selected');
        }
    });


    $('#pl-select-delete').on('click', function(){

        if(playlistReload) return;

        var selected = pl_select_wrap.find('li.pl-list-selected');

        if(selected.length == 0) {
            alert("No playlists selected!");
            return false;
        }

        var result = confirm("Are you sure to delete selected playlists?");
        if(result){
            selected.remove();
        }
    });

    var playlistReload,
    playlistSelectorPlaylists = $('#playlistSelectorPlaylists');

    var pl_select_reload = $('#pl-select-reload').on('click', function(){

        if(playlistReload) return;
        
        var result = confirm("Are you sure to reload all playlists?");
        if(result){
            getPlaylists('');
        }
    });

    function getPlaylists(val){

        if(playlistReload) return;
        playlistReload = true;

        var postData = [
            {name: 'action', value: 'wpsvp_load_playlists'},
            {name: 'playlist_id', value: val},
        ];

        $.ajax({
            url: wpsvp_data.ajax_url,
            type: 'post',
            data: postData,
            dataType: 'json',   
        }).done(function(response){

            pl_select_wrap.empty();

            //console.log(response)
            var i, len = response.length;
            for(i = 0; i < len; i++){
                pl_select_wrap.append($('<li class="pl-list-item" data-playlist-id="'+response[i].id+'"><span>'+response[i].title+'</span></li>'));
            }

            playlistReload = false;

        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText, textStatus, errorThrown);
            playlistReload = false;
        });  
    }

    //******* form submit

    var editPlayerSubmit;
    $('#wpsvp-save-player-options-submit').on('click', function (){

        if(editPlayerSubmit)return false;//prevent double submit
        editPlayerSubmit = true;
        
        //selected playlists

        var s = '';
        pl_select_wrap.find('li').each(function(){   
            s+=$(this).attr('data-playlist-id')+',';
        });
        if(s.length)s = s.substr(0,s.length-1);//remove last comma

        playlistSelectorPlaylists.val(s);


        //focus title
        var input = $('#wpsvp-tab-layout-content').find('input[name=title]')
        if(input.val() == ""){
            input.addClass('aprf');
            $('#wpsvp-tab-layout').click();

            //accordion expand with title
            wpsvpform_addplayer.find('.option-tab.wpsvp-player-style').removeClass('option-closed');
            $('html,body').animate({scrollTop: style_tabs.offset().top});

            editPlayerSubmit = false;
            alert('Please fill required fields in red!');
            return false;
        }


        //general settings
        $('#wpsvp-tab-playback-content').find('input[required]').each(function(){
            var input = $(this);
            if(input.val() == ""){
                input.addClass('aprf');
                required = true;
            }
        });
        if(required){
            $('#wpsvp-tab-playback').click();

            //accordion expand with playback
            wpsvpform_addplayer.find('.option-tab.wpsvp-player-general').removeClass('option-closed');
            $('html,body').animate({scrollTop: style_tabs.offset().top});

            editPlayerSubmit = false;
            alert('Please fill required fields in red!');
            return false;
        }


        //br points
        var breakPoints_field = $('#breakPoints_field');
        
        var required;
        breakPoints_field.find('input[required]').each(function(){

            var input = $(this);
            if(input.val() == ""){
                input.addClass('aprf');
                required = true;
            }
        });

        if(required){
            $('#wpsvp-tab-sizing').click();

            //accordion expand with br
            wpsvpform_addplayer.find('.option-tab.wpsvp-player-style').removeClass('option-closed');
            $('html,body').animate({scrollTop: breakPoints_field.offset().top});

            editPlayerSubmit = false;
            alert('Please fill required fields in red!');
            return false;
        }
        

        //ev accordions expand
        var required, first_input;
        ev_wrap.find('.ev_width').each(function(){

            var input = $(this);
            if(input.val() == ""){
                input.addClass('aprf');
                input.closest('.option-tab.ev-unit-wrap').removeClass('option-closed');//expand ev
                if(!first_input){
                    first_input = input;
                }
                required = true;
            }
        });

        if(required){
            //accordion expand with ev
            var ps = wpsvpform_addplayer.find('.option-tab.wpsvp-player-style');
            ps.removeClass('option-closed');
            
            $('html,body').animate({scrollTop: ps.offset().top});

            $('#wpsvp-tab-ev').click();

            editPlayerSubmit = false;
            alert('Please fill required fields in red!');
            return false;
        }


        $('#wpsvpform-addplayer .submit').click();
        editPlayerSubmit = false;

        //return false;
    });
 


    getPlaylists(playlistSelectorPlaylists.val());

    






    //############################################//
	// ajax */
	//############################################//

    //edit player / playlist title

	$('.title-editable').on('blur', function(){

        var input = $(this), title = input.val();
        if(title == ''){
            input.val(input.attr('data-title'));
            alert('Title cannot be empty!');
            return false;
        }

        if(input.attr('data-player-id') !== undefined){
        	var postData = [
	            {name: 'action', value: 'wpsvp_edit_player_title'},
	            {name: 'title', value: title},
	            {name: 'id', value: input.attr('data-player-id')}
	        ];
        }else if(input.attr('data-playlist-id') !== undefined){
        	var postData = [
	            {name: 'action', value: 'wpsvp_edit_playlist_title'},
	            {name: 'title', value: title},
	            {name: 'id', value: input.attr('data-playlist-id')}
	        ];
        }

        $.ajax({
            url: wpsvp_data.ajax_url,
            type: 'post',
            data: postData,
            dataType: 'json',   
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown);
        });    

    });

    /*
	sortable media order
    */

    function sortNumber(a,b) {
        return a - b;
    }

    var mediaTable = $('#media-table');
    mediaTable.find('tbody').sortable({ 
        handle: ".msort",
        helper: fixWidthHelper,

		update: function(event, ui) {
	        var media_id_arr = [], order_id_arr = [];
	        mediaTable.find('.msort').each(function(){
	        	media_id_arr.push(parseInt($(this).attr('data-media-id'),10));
	            order_id_arr.push(parseInt($(this).attr('data-order-id'),10));
            });

            order_id_arr.sort(sortNumber);//sort order id's from lowest on curr page

	        var postData = [
	            {name: 'action', value: 'wpsvp_update_media_order'},
	            {name: 'media_id_arr', value: media_id_arr},
	            {name: 'order_id_arr', value: order_id_arr},
	            {name: 'playlist_id', value: mediaTable.attr('data-playlist-id')}
	        ];

	        $.ajax({
	            url: wpsvp_data.ajax_url,
	            type: 'post',
	            data: postData,
	            dataType: 'json',   
	        }).fail(function(jqXHR, textStatus, errorThrown) {
	            console.log(jqXHR, textStatus, errorThrown);
	        });    
			
		}
	});

    function fixWidthHelper(e, ui) {//fir right shift on drag
        ui.children().each(function() {
            $(this).width($(this).width());
        });
        return ui;
    }

    

    //filter media

    var mediaItemList = $('#media-item-list');

    $('#filter-media').on('keyup.apfilter',function(){

        var value = $(this).val(), i, j = 0, title, len = mediaItemList.children('.media-item').length;

        for(i = 0; i < len; i++){

            title = mediaItemList.children('.media-item').eq(i).find('.media-title').html();

            if(title.indexOf(value) >- 1){
                mediaItemList.children('.media-item').eq(i).show();
            }else{
                mediaItemList.children('.media-item').eq(i).hide();
                j++;
            }
        }

    });
    

    //select all
    mediaTable.on('click', '.wpsvp-media-all', function(){
        if($(this).is(':checked')){
            mediaItemList.find('.wpsvp-media-indiv').prop('checked', true);
        }else{
            mediaItemList.find('.wpsvp-media-indiv').prop('checked', false);
        }
    });


    //delete selected
    $('#delete-selected').on('click', function(){
        if(mediaItemList.find('.wpsvp-media-indiv').length == 0)return false;//no media

        var selected = mediaItemList.find('.wpsvp-media-indiv:checked');

        if(selected.length == 0) {
            alert("No media selected!");
            return false;
        }

        var result = confirm("Are you sure to delete selected media?");
        if(result){

            var arr = [];

            selected.each(function(){
                arr.push(parseInt($(this).attr('data-media-id'),10));
            });
            
            var postData = [
                {name: 'action', value: 'wpsvp_delete_media'},
                {name: 'media_id', value: arr},
            ];

            $.ajax({
                url: wpsvp_data.ajax_url,
                type: 'post',
                data: postData,
                dataType: 'json',   
            }).done(function(response){

                //console.log(response)
                if(response > 0){
                    selected.closest('.media-item').remove();
                    $('.wpsvp-media-all').prop('checked', false);
                    alert('Success!');
                }else{
                    alert('Error occured!');
                }

            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText, textStatus, errorThrown);
            });  
        }
    });

    var curr_playlist_id = mediaTable.attr('data-playlist-id'),
    action_do,
    playlistSelectorWrap = $('#playlist-selector-wrap'),
    playlist_selector = $('#playlist_selector')

    //copy selected
    $('#copy-selected').on('click', function(){
        if(mediaItemList.find('.wpsvp-media-indiv').length == 0)return false;//no media

        var selected = mediaItemList.find('.wpsvp-media-indiv:checked');

        if(selected.length == 0) {
            alert("No media selected!");
            return false;
        }
        action_do = 'copy';

        playlistSelectorWrap.find('option[value='+curr_playlist_id+']').show();
        playlist_selector.prop('selectedIndex',0);
        playlistSelectorWrap.css('display','block');
           
    });

    //move selected
    $('#move-selected').on('click', function(){
        if(mediaItemList.find('.wpsvp-media-indiv').length == 0)return false;//no media

        var selected = mediaItemList.find('.wpsvp-media-indiv:checked');

        if(selected.length == 0) {
            alert("No media selected!");
            return false;
        }
        action_do = 'move';

        playlistSelectorWrap.find('option[value='+curr_playlist_id+']').prop('selected', false).hide();//cant move to same playlist
        playlist_selector.prop('selectedIndex',0);
        playlistSelectorWrap.css('display','block');
           
    });

    $('#selected-ok').on('click', function(){

        var result = confirm("Are you sure to "+action_do+" selected media?");
        if(result){

            var arr = [];

            var selected = mediaItemList.find('.wpsvp-media-indiv:checked');

            selected.each(function(){
                arr.push(parseInt($(this).attr('data-media-id'),10));
            });
            
            var action = action_do == 'copy' ? 'wpsvp_copy_media' : 'wpsvp_move_media';
            var postData = [
                {name: 'action', value: action},
                {name: 'destination_playlist_id', value: playlist_selector.find('option:selected').attr('value')},
                {name: 'media_id', value: arr},
            ];

            $.ajax({
                url: wpsvp_data.ajax_url,
                type: 'post',
                data: postData,
                dataType: 'json',   
            }).done(function(response){

                //console.log(response)
                if(response > 0){
                    if(action_do == 'move'){
                        selected.closest('.media-item').remove();
                        $('.wpsvp-media-all').prop('checked', false);
                    }
                    alert('Success!');
                }else{
                    alert('Error occured!');
                }

            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText, textStatus, errorThrown);
            });  
        }

    });

    $('#selected-cancel').on('click', function(){
        playlistSelectorWrap.css('display','none');
    });



 

   



    //############################################//
	/* playlist manager */
	//############################################//

    //edit / add media submit

    var editMediaSubmit;
    $('#wpsvp-edit-media-submit').on('click', function (){

        if(editMediaSubmit)return false;//prevent double submit
        editMediaSubmit = true;

        $('#type').prop('disabled', false);//Disabled form inputs do not appear in the request

        multi_path_content.find('.quality_default').each(function(){//detect default quality in form post
            var item = $(this), label = item.closest('.multi_path_section').find('.quality_title').val();
            item.val(label);
        });

        subtitle_content.find('.subtitle_default').each(function(){//detect default subtitle in form post
            var item = $(this), label = item.closest('.subtitle_section').find('.subtitle_label').val();
            item.val(label);
        });

        //check required
        var parent, tab;
        media_tabs.find('.wpsvp-tab-content').each(function(){
            tab = $(this);
            tab.find('input[required]').each(function(){
                var input = $(this);
                if(input.val() == ""){
                    input.addClass('aprf');
                    if(!parent){
                        parent = tab.attr('id');
                        parent = parent.substr(0,parent.length - 8);//remove -content
                    }

                    if(parent == 'wpsvp-tab-media-adverts'){//expand ad accordions
                        input.closest('.option-tab.wpsvp-ad-source').removeClass('option-closed');
                    }
                    if(parent == 'wpsvp-tab-media-annotations'){//expand annotation accordions
                        input.closest('.option-tab.wpsvp-annotation-source').removeClass('option-closed');
                    }

                }else{
                    input.removeClass('aprf');
                }
            });
        });

        if(parent){
            $('#'+parent).click();
            editMediaSubmit = false;
            alert('Please fill required fields in red!');
            return false;
        }
        else{

            $('#wpsvpform-addmedia .submit').click();
            editMediaSubmit = false;

        }
      
    });

	var wpsvpform_addmedia = $('#wpsvpform-addmedia').on('click', '.option-toggle', function(e){
        var parent = $(this).parent();
        if(parent.hasClass('option-closed')){
            parent.removeClass('option-closed');
        }else{
            parent.addClass('option-closed');
        }
    });




    //save playlist options submit

    var playlistOptionSaveSubmit;
    $('#wpsvp-playlist-options-save-submit').on('click', function (){

        if(playlistOptionSaveSubmit)return false;//prevent double submit
        playlistOptionSaveSubmit = true;

        //check required
        var parent, tab;
        playlist_tabs.find('.wpsvp-tab-content').each(function(){
            tab = $(this);
            tab.find('input[required]').each(function(){
                var input = $(this);
                if(input.val() == ""){
                    input.addClass('aprf');
                    if(!parent){
                        parent = tab.attr('id');
                        parent = parent.substr(0,parent.length - 8);//remove -content
                    }

                    if(parent == 'wpsvp-tab-playlist-adverts'){//expand ad accordions
                        input.closest('.option-tab.wpsvp-ad-source').removeClass('option-closed');
                    }
                    if(parent == 'wpsvp-tab-playlist-annotations'){//expand annotation accordions
                        input.closest('.option-tab.wpsvp-annotation-source').removeClass('option-closed');
                    }

                }else{
                    input.removeClass('aprf');
                }
            });
        });

        if(parent){
            $('#'+parent).click();
            playlistOptionSaveSubmit = false;
            alert('Please fill required fields in red!');
            return false;
        }
        else{

            $('#wpsvpform-save-playlist-options .submit').click();
            playlistOptionSaveSubmit = false;

        }
      
    });

    //ad accordions expand

    playlist_tabs.on('click', '.option-toggle', function(e){
        var parent = $(this).parent();
        if(parent.hasClass('option-closed')){
            parent.removeClass('option-closed');
        }else{
            parent.addClass('option-closed');
        }
    });




    

	//multi quality

	var multi_path_content = $('#multi_path_content');

	$('#multi_path_field_add').on('click', function(e){
    	var content = multi_path_content.find('.multi_path_section').eq(0).clone();

    	content.find('.multi_path').val('');//clear fields
        content.find('.quality_title').val('');
        content.find('.quality_default').prop('checked', false);

        content.insertBefore($(this)).find('.multi_path_field_remove').show().on('click', function (){
            $(this).parent().remove();
        });
    });

    var multi_path_field = $('#multi_path_field').on('click', '.multi_path_upload', function(e){
        e.preventDefault();

        var upload_btn = $(this), library, source, custom_uploader;

        source = upload_btn.parent().find('.multi_path');

        //dont resue if we cant change library (when we change type)

        if(media_type == 'video'){
            library = "video/mp4";
        }else if(media_type == 'audio'){
            library = "audio/mpeg,audio/wav";
        }else if(media_type == 'image'){
            library = "image";
        }

        custom_uploader = wp.media({
        library:{
                type: library
            }
        })

        custom_uploader.on("select", function(){
            var attachment = custom_uploader.state().get("selection").first().toJSON();
            $(source).val(attachment.url);
        })
        .open();

    });

	//show remove quality buttons if data available

    multi_path_content.find('.multi_path_field_remove').slice(1).each(function(){
        $(this).show().off().on('click', function (){
            $(this).parent().remove();
        });
    });





	//subtitle

	var subtitle_content = $('#subtitle_content');

	$('#subtitle_field_add').on('click', function(e){

    	if(subtitle_content.find('.subtitle_section').eq(0).is(':visible')){//show first, clone others
            var content = subtitle_content.find('.subtitle_section').eq(0).clone();
        }else{
            var content = subtitle_content.find('.subtitle_section').eq(0).show();
        }

    	content.find('.subtitle_src').val('').prop('required', true);//clear fields
        content.find('.subtitle_label').val('').prop('required', true);
        content.find('.subtitle_default').prop('checked', false);

        content.insertBefore($(this)).find('.subtitle_field_remove').off().on('click', function (e){
        	e.preventDefault();
        	
        	if(subtitle_content.find('.subtitle_section').length > 1){//hide first, remove others
	            $(this).parent().remove();
	        }else{
	            $(this).parent().hide();

	            subtitle_content.find('.subtitle_label, .subtitle_src').each(function(){
	                $(this).prop('required', false).val('');
	            });
	        }

        });
    });

    var subtitle_field = $('#subtitle_field').on('click', '.subtitle_src_upload', function(e){
        e.preventDefault();

        var upload_btn = $(this), library, source, custom_uploader;

        source = upload_btn.parent().find('.subtitle_src');

        if(subtitle_field.data('custom-uploader')){//reuse

            custom_uploader = subtitle_field.data('custom-uploader').uploader;

        }else{

            library = "*";

            custom_uploader = wp.media({
            library:{
                    type: library
                }
            })

            subtitle_field.data('custom-uploader', {uploader: custom_uploader});
        }

        custom_uploader.off("select").on("select", function(){
            var attachment = custom_uploader.state().get("selection").first().toJSON();
            $(source).val(attachment.url);
        })
        .open();

    });

 	subtitle_content.on('click', '.subtitle_default', function(){//radio and checkbox
        $(this).on('change',function(){
            if($(this).is(':checked')){
                subtitle_content.find('.subtitle_default').prop('checked', false);
                $(this).prop('checked', true);
            }
        });
    });

	//show subtitles if data available

    if(subtitle_content.find('.subtitle_src').eq(0).val() != ''){
    	subtitle_content.find('.subtitle_section').show();

    	//remove buttons

    	subtitle_content.find('.subtitle_field_remove').off().on('click', function (e){
	    	e.preventDefault();
	    	
	    	if(subtitle_content.find('.subtitle_section').length > 1){//hide first, remove others
	            $(this).parent().remove();
	        }else{
	            $(this).parent().hide();

	            subtitle_content.find('.subtitle_label, .subtitle_src').each(function(){
	                $(this).prop('required', false).val('');
	            });
	        }

	    });
    }






    //break points

    var wpsvp_br_table_wrap = $('#wpsvp-br-table-wrap').on('click', '.breakPoint_remove', function(e){
        $(this).closest('.wpsvp-br-table').remove();
    });

    wpsvp_br_table_wrap.sortable();

    if(typeof wpsvp_breakPoint_arr !== 'undefined'){

        var i, len = wpsvp_breakPoint_arr.length;
        for(i=0;i<len;i++){
            addBreakPoint(wpsvp_breakPoint_arr[i]);
        }
    }

    //add new break point

    $('#breakPoint_add').on('click', function(e){
        addBreakPoint();
    });   

    function addBreakPoint(item){

        var bp = $('.wpsvp-br-table-orig').clone().removeClass('wpsvp-br-table-orig').addClass('wpsvp-br-table').show().appendTo(wpsvp_br_table_wrap);

        if(typeof item !== 'undefined'){

            bp.find('.bp-width').prop({required: true, disabled: false}).val(item.width);
            bp.find('.bp-column').prop({required: true, disabled: false}).val(item.column);
            bp.find('.bp-gutter').prop({required: true, disabled: false}).val(item.gutter);

        }else{

            bp.find('.bp-width').prop({required: true, disabled: false});
            bp.find('.bp-column').prop({required: true, disabled: false});
            bp.find('.bp-gutter').prop({required: true, disabled: false});  
        }

    }




    //elements visibility

    var ev_wrap = $('#wpsvp-ev-wrap').on('click', '.ev_breakPoint_remove', function(e){
        $(this).closest('.ev-unit-wrap').remove();
        adjustEvPoint();
    });

    if(typeof wpsvp_elementsVisibility_arr !== 'undefined'){

        var i, len = wpsvp_elementsVisibility_arr.length;
        for(i=0;i<len;i++){
            addEvPoint(wpsvp_elementsVisibility_arr[i], true);
        }

        adjustEvPoint();
    }

    //sortable 

    ev_wrap.sortable({ 
        handle: ".option-toggle",
        update: function(event, ui) {
            adjustEvPoint();
        }
    });

    function adjustEvPoint(){
        var i = 0;

        ev_wrap.find('.ev-unit-wrap').each(function(){
            var bp = $(this);

            bp.find('.ev-elem').each(function(){
                var elem = $(this);
                var name = elem.attr('data-cname'), nn = 'ev'+'['+i+']['+name+']';
                elem.attr('name', nn);
            });

            i++;
        })
    }

    //add new ev

    $('#ev_breakPoint_add').on('click', function(e){
        addEvPoint();
        adjustEvPoint();
    }); 

    function addEvPoint(item, closed){

        var bp = $('.ev-unit-wrap-orig').clone().removeClass('ev-unit-wrap-orig').addClass('ev-unit-wrap').show().appendTo(ev_wrap);

        if(closed)bp.addClass('option-closed');//close accordions on start

        if(typeof item !== 'undefined'){

            bp.find('.ev_width').prop({required: true, disabled: false}).val(item.width).on('keyup',function(e){
                bp.find('.option-title').html($(this).val());
            });
            bp.find('.option-title').html(item.width);

            bp.find('.ev_header_title').prop({checked: item.header_title == 'on'});
            bp.find('.ev_controls').prop({checked: item.controls == 'on'});
            bp.find('.ev_seekbar').prop({checked: item.seekbar == 'on'});
            bp.find('.ev_play').prop({checked: item.play == 'on'});
            bp.find('.ev_time').prop({checked: item.time == 'on'});
            bp.find('.ev_download').prop({checked: item.download == 'on'});
            bp.find('.ev_share').prop({checked: item.share == 'on'});
            bp.find('.ev_info').prop({checked: item.info == 'on'});
            bp.find('.ev_embed').prop({checked: item.embed == 'on'});
            bp.find('.ev_next').prop({checked: item.next == 'on'});
            bp.find('.ev_previous').prop({checked: item.previous == 'on'});
            bp.find('.ev_seek_backward').prop({checked: item.seek_backward == 'on'});
            bp.find('.ev_seek_forward').prop({checked: item.seek_forward == 'on'});
            bp.find('.ev_rewind').prop({checked: item.rewind == 'on'});
            bp.find('.ev_fullscreen').prop({checked: item.fullscreen == 'on'});
            bp.find('.ev_pip').prop({checked: item.pip == 'on'});
            bp.find('.ev_volume').prop({checked: item.volume == 'on'});
            bp.find('.ev_playlist').prop({checked: item.playlist == 'on'});
            bp.find('.ev_quality').prop({checked: item.quality == 'on'});
            bp.find('.ev_subtitles').prop({checked: item.subtitles == 'on'});
            bp.find('.ev_annotations').prop({checked: item.annotations == 'on'});
            bp.find('.ev_playback_rate').prop({checked: item.playback_rate == 'on'});
            bp.find('.ev_audio_language').prop({checked: item.audio_language == 'on'});
            bp.find('.ev_upnext').prop({checked: item.upnext == 'on'});
            bp.find('.ev_settings').prop({checked: item.settings == 'on'});

        }else{

            bp.find('.ev_width').prop({required: true, disabled: false}).on('keyup',function(e){
                bp.find('.option-title').html($(this).val());
            });
            bp.find('.ev_header_title').prop({disabled: false});
            bp.find('.ev_controls').prop({disabled: false});
            bp.find('.ev_seekbar').prop({disabled: false});
            bp.find('.ev_play').prop({disabled: false});
            bp.find('.ev_time').prop({disabled: false});
            bp.find('.ev_download').prop({disabled: false});
            bp.find('.ev_share').prop({disabled: false});
            bp.find('.ev_info').prop({disabled: false});
            bp.find('.ev_embed').prop({disabled: false});
            bp.find('.ev_next').prop({disabled: false});
            bp.find('.ev_previous').prop({disabled: false});
            bp.find('.ev_seek_backward').prop({disabled: false});
            bp.find('.ev_seek_forward').prop({disabled: false});
            bp.find('.ev_rewind').prop({disabled: false});
            bp.find('.ev_fullscreen').prop({disabled: false});
            bp.find('.ev_pip').prop({disabled: false});
            bp.find('.ev_volume').prop({disabled: false});
            bp.find('.ev_playlist').prop({disabled: false});
            bp.find('.ev_quality').prop({disabled: false});
            bp.find('.ev_subtitles').prop({disabled: false});
            bp.find('.ev_annotations').prop({disabled: false});
            bp.find('.ev_playback_rate').prop({disabled: false});
            bp.find('.ev_audio_language').prop({disabled: false});
            bp.find('.ev_upnext').prop({disabled: false});
            bp.find('.ev_settings').prop({disabled: false});

        }
    }





    //playlist

    var media_type,
    path_field = $('#path_field'),
    path = $('#path'),
    mp4_field = $('#mp4_field'),
    title_field = $('#title_field'),
    description_field = $('#description_field'),
    thumb_field = $('#thumb_field'),
    thumb_alt_field = $('#thumb_alt_field'),
    thumb = $('#thumb').on('keyup',function(){
        if($(this).val() == ''){
            thumb_preview.attr('src',empty_src);
            thumb_remove.hide();
        }
    }),
    thumb_upload = $('#thumb_upload'),
    thumb_preview = $('#thumb_preview'),
    poster_field = $('#poster_field'),
    poster = $('#poster').on('keyup',function(){
        if($(this).val() == ''){
            poster_preview.attr('src',empty_src);
            poster_remove.hide();
        }
    }),
    poster_upload = $('#poster_upload'),
    poster_preview = $('#poster_preview'),
    poster_frame_time_field = $('#poster_frame_time_field'),
    poster_audio_info = $('#poster_audio_info'),
    download_field = $('#download_field'),
    download_upload = $('#download_upload'),
    preview_seek_upload = $('#preview_seek_upload'),
    preview_seek_field = $('#preview_seek_field'),
    hover_preview_upload = $('#hover_preview_upload'),
    hover_preview_field = $('#hover_preview_field'),
    chapters_upload = $('#chapters_upload'), 
    chapters_field = $('#chapters_field'),
    share_field = $('#share_field'),
    limit_field = $('#limit_field'),
    start_field = $('#start_field'),
    end_field = $('#end_field'),

    /*  Added by Boldman*/
    random_clip_time_field = $('#random_clip_time_field'),
    normal_play_mode_field = $('#normal_play_mode_field'),

    /*  Added by Boldman.*/
    // playing_length_field = $('#playing_length_field'),

    playback_rate_field = $('#playback_rate_field'),
    width_field = $('#width_field'),
    height_field = $('#height_field'),
    yt_quality_field = $('#yt_quality_field'),
    noapi_field = $('#noapi_field'),
    noapi = noapi_field.find('select[name=noapi]').on('change',function(){

        if(media_type.indexOf('youtube') != -1){

            if($(this).val() == '1'){
                is360_field.show();
            }else{
                is360_field.hide();
            }

        }
    }),
    is360_field = $('#is360_field'),
    load_more_field = $('#load_more_field'),
    user_id_field = $('#user_id_field'),
    user_id = $('#user_id'),
    upnext_field = $('#upnext_field'),
    upnext_time_field = $('#upnext_time_field'),
    duration_field = $('#duration_field'),

    folder_info = $('#folder_info'),
    iframe_info = $('#iframe_info'),
    hls_info = $('#hls_info'),
    dash_info = $('#dash_info'),
    yt_video_info = $('#yt_video_info'),
    yt_playlist_info = $('#yt_playlist_info'),
    yt_channel_info = $('#yt_channel_info'),
    yt_user_info = $('#yt_user_info'),
    yt_query_info = $('#yt_query_info'),
    vim_video_info = $('#vim_video_info'),
    vim_channel_info = $('#vim_channel_info'),
    vim_group_info = $('#vim_group_info'),
    vim_album_info = $('#vim_album_info'),

    yt_sort_field = $('#yt_sort_field'),
    vimeo_channel_sort_field = $('#vimeo_channel_sort_field'),
    vimeo_album_sort_field = $('#vimeo_album_sort_field'),
    vimeo_group_sort_field = $('#vimeo_group_sort_field'),
    vimeo_video_query_sort = $('#vimeo_video_query_sort_field'),
    vimeo_sort_dir_field = $('#vimeo_sort_dir_field')

    

    var thumb_remove = wpsvpform_addmedia.find("#thumb_remove").on('click', function(e){
        e.preventDefault();
        thumb_preview.attr('src',empty_src);
        thumb.val('');
        thumb_remove.hide();
    });
    if(thumb.val() != ''){
        thumb_remove.show();
    }else{
        thumb_remove.hide();
    }

    var poster_remove = wpsvpform_addmedia.find("#poster_remove").on('click', function(e){
        e.preventDefault();
        poster_preview.attr('src',empty_src);
        poster.val('');
        poster_remove.hide();
    });
    if(poster.val() != ''){
        poster_remove.show();
    }else{
        poster_remove.hide();
    }



    //tag
    var wpsvp_tag_wrap = $('#wpsvp-tag-wrap').on('click','.wpsvp-tag-item', function(){
        var tag_item = $(this), val = tag_item.attr('data-value');
        wpsvp_tag_wrap.find('.wpsvp-tag[value="'+val+'"]').remove();//remove hidden post value
        tag_item.remove();
    });
    var wpsvp_tag_input = $('#wpsvp_tag_input');

    if(typeof media_tag_arr !== 'undefined'){
        var i, len = media_tag_arr.length;
        if(len > 0){
            for(i=0;i<len;i++){
                addTag(media_tag_arr[i]);
            }
        }
    }

    $('#wpsvp_add_tag').on('click',function(){
        var tag = wpsvp_tag_input.val();
        if(isEmpty(tag)) return false;

        addTag($.trim(tag));
        wpsvp_tag_input.val('');
    });

    function addTag(tag){
        $('<span class="wpsvp-tag-item" title="Remove" data-value="'+tag+'">'+tag+'</span>').appendTo(wpsvp_tag_wrap);
        $('<input type="hidden" class="wpsvp-tag" name="tag[]" value="'+tag+'">').appendTo(wpsvp_tag_wrap);
    }

    

    //category
    var wpsvp_category_wrap = $('#wpsvp-category-wrap').on('click','.wpsvp-category-item', function(){

        $(this).remove();
    });
    var wpsvp_category_input = $('#wpsvp_category_input');

    if(typeof media_category_arr !== 'undefined'){
        var i, len = media_category_arr.length;
        if(len > 0){
            for(i=0;i<len;i++){
                addCategory(media_category_arr[i]);
            }
        }
    }

    $('#wpsvp_add_category').on('click',function(){
        var category = wpsvp_category_input.val();
        if(isEmpty(category)) return false;

        addCategory($.trim(category));
        wpsvp_category_input.val('');
    });
    function addCategory(category){
        $('<span class="wpsvp-category-item" title="Remove" data-value="'+category+'">'+category+'</span>').appendTo(wpsvp_category_wrap);
        $('<input type="hidden" class="wpsvp-category" name="category[]" value="'+category+'">').appendTo(wpsvp_category_wrap);
    }



    var inited, 
    type_selector = $('#type').on('change',function(){

        media_type = $(this).val();

        //hide
        path_field.hide();
        mp4_field.hide();
        path.prop('required', false).val('');

        multi_path_field.hide().find('.multi_path, .quality_title').prop('required', false);
        if(inited){
            multi_path_content.find('.multi_path_section').slice(1).remove();
        }
        title_field.hide();
        description_field.hide();
        thumb_field.hide();
        thumb_alt_field.hide();
        poster_field.hide();
        poster_frame_time_field.hide();
        poster_audio_info.hide();
        download_field.hide();
        share_field.hide();
        limit_field.hide();
        if(inited){
            subtitle_content.find('.subtitle_section').hide().slice(1).remove();
    		subtitle_content.find('.subtitle_label, .subtitle_src').each(function(){
                $(this).prop('required', false).val('');
            });
        }
        width_field.hide();
    	height_field.hide();
    	yt_quality_field.hide();
        noapi_field.hide();
        is360_field.hide();
        load_more_field.hide();
    	playback_rate_field.hide();
        subtitle_field.hide();
        preview_seek_field.hide();
        hover_preview_field.hide();
        chapters_field.hide();
    	start_field.hide();
        end_field.hide();
        /*  Added by Boldman*/
        normal_play_mode_field.hide();
        random_clip_time_field.hide();
        // playing_length_field.hide();
        upnext_field.hide();
        upnext_time_field.hide();
        duration_field.hide();

        user_id_field.hide();
        user_id.prop('required', false).val('');
      


        //info
        folder_info.hide();
        iframe_info.hide();
        hls_info.hide();
        dash_info.hide();
        yt_video_info.hide();
        yt_playlist_info.hide();
        yt_channel_info.hide();
        yt_user_info.hide();
        yt_query_info.hide();
        vim_video_info.hide();
        vim_channel_info.hide();
        vim_group_info.hide();
        vim_album_info.hide();

        //sort
        yt_sort_field.hide();
        vimeo_channel_sort_field.hide();
        vimeo_album_sort_field.hide();
        vimeo_group_sort_field.hide();
        vimeo_video_query_sort.hide();
        vimeo_sort_dir_field.hide();




        if(wpsvpform_addmedia.length)wpsvpform_addmedia[0].reset();
        $(this).val(media_type);//reset on type change so we dont get not used vars for different media in db table


        if(media_type == 'video' || media_type == 'video_360'){

	        multi_path_field.show().find('.multi_path, .quality_title').prop('required', true);
	        multi_path_field.find('.multi_path').attr("placeholder", "Enter video url");

	        title_field.show();
	        description_field.show();
	        thumb_field.show();
            thumb_alt_field.show();
	        poster_field.show();
            poster_frame_time_field.show();
	        share_field.show();
        	download_field.show();
	        playback_rate_field.show();
            start_field.show();
            end_field.show();
            /*  Added by Boldman*/
            normal_play_mode_field.show();
            random_clip_time_field.show();
            /*  Added by Boldman*/
            // playing_length_field.show();

            subtitle_field.show();
            chapters_field.show();
            upnext_field.show();
            upnext_time_field.show();
            hover_preview_field.show();

        }else if(media_type == 'hls'){

            path_field.show();
            path.prop('required', true).attr("placeholder", "Enter m3u8 url");

            mp4_field.show();
            title_field.show();
            description_field.show();
            thumb_field.show();
            thumb_alt_field.show();
            poster_field.show();
            share_field.show();
            download_field.show();
            playback_rate_field.show();
            //preview_seek_field.show();
            //chapters_field.show();
            upnext_field.show();
            upnext_time_field.show();
            hover_preview_field.show();

            hls_info.show(); 

        }else if(media_type == 'dash'){

            path_field.show();
            path.prop('required', true).attr("placeholder", "Enter manifest url");

            mp4_field.show();
            title_field.show();
            description_field.show();
            thumb_field.show();
            thumb_alt_field.show();
            poster_field.show();
            share_field.show();
            download_field.show();
            playback_rate_field.show();
            //preview_seek_field.show();
            //chapters_field.show();
            upnext_field.show();
            upnext_time_field.show();
            hover_preview_field.show();

            dash_info.show(); 

        }else if(media_type == 'audio'){

	        multi_path_field.show().find('.multi_path, .quality_title').prop('required', true);
	        multi_path_field.find('.multi_path').attr("placeholder", "Enter audio url");

	        title_field.show();
	        description_field.show();
	        thumb_field.show();
            thumb_alt_field.show();
	        poster_field.show();
	        share_field.show();
        	download_field.show();
	        playback_rate_field.show();
            start_field.show();
            end_field.show();
            /*  Added by Boldman*/
            normal_play_mode_field.show();
            random_clip_time_field.show();
            /*  Added by Boldman*/
            // playing_length_field.show();
            subtitle_field.show();
            chapters_field.show();
            upnext_field.show();
            upnext_time_field.show();
            hover_preview_field.show();

            poster_audio_info.show();

	    }else if(media_type == 'folder_video' || media_type == 'folder_audio'){

	        path_field.show();
	        path.prop('required', true).attr("placeholder", "Enter Folder name");

	        limit_field.show();
	        share_field.show();
        	download_field.show();
	        playback_rate_field.show();
            start_field.show();
            end_field.show();
            /*  Added by Boldman*/
            normal_play_mode_field.show();
            random_clip_time_field.show();
            /*  Added by Boldman*/
            // playing_length_field.show();
            subtitle_field.show();
            upnext_field.show();
            upnext_time_field.show();

	        folder_info.show();

	    }else if(media_type == 'image' || media_type == 'image_360'){

	        multi_path_field.show().find('.multi_path, .quality_title').prop('required', true);
	        multi_path_field.find('.multi_path').attr("placeholder", "Enter image url");

	        title_field.show();
	        description_field.show();
	        thumb_field.show();
            thumb_alt_field.show();
	        share_field.show();
        	download_field.show();
            duration_field.show();
            hover_preview_field.show();

	    }else if(media_type == 'folder_image'){

	        path_field.show();
	        path.prop('required', true).attr("placeholder", "Enter Folder name");

	        limit_field.show();
	        folder_info.show();
	        share_field.show();
        	download_field.show();

	    }else if(media_type == 'youtube_single'){

	        path_field.show();
	        path.prop('required', true).attr("placeholder", "Enter Video ID");

	        title_field.show();
	        description_field.show();
	        thumb_field.show();
            thumb_alt_field.show();
            poster_field.show();
	        width_field.show();
    		height_field.show();
    		yt_quality_field.show();
            noapi_field.show();
            noapi.change();
            share_field.show();
        	download_field.show();
    		playback_rate_field.show();
            start_field.show();
            end_field.show();
            /*  Added by Boldman*/
            normal_play_mode_field.show();
            random_clip_time_field.show();
            /*  Added by Boldman*/
            // playing_length_field.show();
            subtitle_field.show();
            preview_seek_field.show();
            chapters_field.show();
            upnext_field.show();
            upnext_time_field.show();
            hover_preview_field.show();

            yt_video_info.show();

        }else if(media_type == 'youtube_playlist'){

	        path_field.show();
	        path.prop('required', true).attr("placeholder", "Enter Playlist ID");

	        limit_field.show();
	        width_field.show();
    		height_field.show();
    		yt_quality_field.show();
    		playback_rate_field.show();
            subtitle_field.show();
            load_more_field.show();
            upnext_field.show();
            upnext_time_field.show();

            yt_playlist_info.show();
	        
	    }else if(media_type == 'youtube_video_query'){

	        path_field.show();
	        path.prop('required', true).attr("placeholder", "Enter Search query");

	        limit_field.show();
	        width_field.show();
    		height_field.show();
    		yt_quality_field.show();
    		share_field.show();
        	download_field.show();
    		playback_rate_field.show();
            start_field.show();
            end_field.show();
            /*  Added by Boldman*/
            normal_play_mode_field.show();
            random_clip_time_field.show();
            /*  Added by Boldman*/
            // playing_length_field.show();
            subtitle_field.show();
            load_more_field.show();
            upnext_field.show();
            upnext_time_field.show();

            yt_query_info.show();
            yt_sort_field.show();
	        
	    }else if(media_type == 'youtube_channel'){

	        path_field.show();
	        path.prop('required', true).attr("placeholder", "Enter Channel ID");

	        limit_field.show();
	        width_field.show();
    		height_field.show();
    		yt_quality_field.show();
    		share_field.show();
        	download_field.show();
    		playback_rate_field.show();
            start_field.show();
            end_field.show();
            /*  Added by Boldman*/
            normal_play_mode_field.show();
            random_clip_time_field.show();
            // playing_length_field.show();

            subtitle_field.show();
            load_more_field.show();
            upnext_field.show();
            upnext_time_field.show();

            yt_channel_info.show();

        }else if(media_type == 'youtube_user'){

            path_field.show();
            path.prop('required', true).attr("placeholder", "Enter User ID");

            limit_field.show();
            width_field.show();
            height_field.show();
            yt_quality_field.show();
            share_field.show();
            download_field.show();
            playback_rate_field.show();
            start_field.show();
            end_field.show();
            /*  Added by Boldman*/
            normal_play_mode_field.show();
            random_clip_time_field.show();
            /*  Added by Boldman*/
            // playing_length_field.show();
            subtitle_field.show();
            load_more_field.show();
            upnext_field.show();
            upnext_time_field.show();

            yt_user_info.show();

        }else if(media_type == 'vimeo_single'){

	        path_field.show();
	        path.prop('required', true).attr("placeholder", "Enter Video ID");

	        title_field.show();
	        description_field.show();
	        thumb_field.show();
            thumb_alt_field.show();
            poster_field.show();
            noapi_field.show();
    		playback_rate_field.show();
            start_field.show();
            end_field.show();
            /*  Added by Boldman*/
            normal_play_mode_field.show();
            random_clip_time_field.show();
            /*  Added by Boldman*/
            // playing_length_field.show();
            width_field.show();
            height_field.show();
            is360_field.show();
            hover_preview_field.show();

            vim_video_info.show();

        }else if(media_type == 'vimeo_group'){

	        path_field.show();
	        path.prop('required', true).attr("placeholder", "Enter group ID");

	        limit_field.show();
    		playback_rate_field.show();
    		start_field.show();
            end_field.show();
            /*  Added by Boldman*/
            normal_play_mode_field.show();
            random_clip_time_field.show();
            /*  Added by Boldman*/
            // playing_length_field.show();
            load_more_field.show();
            width_field.show();
            height_field.show();

            vim_group_info.show();

            vimeo_group_sort_field.show();
            vimeo_sort_dir_field.show();
	        
	    }else if(media_type == 'vimeo_channel'){

	        path_field.show();
	        path.prop('required', true).attr("placeholder", "Enter channel ID");

	        limit_field.show();
    		playback_rate_field.show();
    		start_field.show();
            end_field.show();
            /*  Added by Boldman*/
            normal_play_mode_field.show();
            random_clip_time_field.show();
            /*  Added by Boldman*/
            // playing_length_field.show();
            load_more_field.show();
            width_field.show();
            height_field.show();

            vim_channel_info.show();

            vimeo_channel_sort_field.show();
            vimeo_sort_dir_field.show();
	        
	    }else if(media_type == 'vimeo_user_album'){

	    	user_id_field.show();
            user_id.prop('required', true);
	        path_field.show();
	        path.prop('required', true).attr("placeholder", "Enter album ID");

	        limit_field.show();
    		playback_rate_field.show();
    		start_field.show();
            end_field.show();
            /*  Added by Boldman*/
            normal_play_mode_field.show();
            random_clip_time_field.show();
            /*  Added by Boldman*/
            // playing_length_field.show();
            load_more_field.show();
            width_field.show();
            height_field.show();

            vim_album_info.show();

            vimeo_album_sort_field.show();
            vimeo_sort_dir_field.show();

        }else if(media_type == 'vimeo_album'){

            path_field.show();
            path.prop('required', true).attr("placeholder", "Enter album ID");

            limit_field.show();
            playback_rate_field.show();
            start_field.show();
            end_field.show();
            /*  Added by Boldman*/
            // playing_length_field.show();
            /*  Added by Boldman*/
            normal_play_mode_field.show();
            random_clip_time_field.show();
            load_more_field.show();
            width_field.show();
            height_field.show();

            vim_album_info.show();

            vimeo_album_sort_field.show();
            vimeo_sort_dir_field.show();

        }else if(media_type == 'vimeo_video_query'){

            path_field.show();
            path.attr("placeholder", "Enter Search query");

            limit_field.show();
            playback_rate_field.show();
            load_more_field.show();
            width_field.show();
            height_field.show();

            vimeo_video_query_sort.show();
            vimeo_sort_dir_field.show();

        }else if(media_type == 'iframe'){

	        path_field.show();
	        path.prop('required', true).attr("placeholder", "Enter iframe source");

	        iframe_info.show();

	        title_field.show();
	        description_field.show();
	        thumb_field.show();
            thumb_alt_field.show();
            hover_preview_field.show();

        }

        inited = true;

    });

	//select option

 	if(type_selector.attr('data-selected')) type_selector.val(type_selector.attr('data-selected'));
    type_selector.change();



    //############################################//
    /* uploaders */
    //############################################//
	
    var uploadManagerArr = [
    	{btn: wpsvpform_addmedia.find("#poster_upload"), manager:null},
		{btn: wpsvpform_addmedia.find("#thumb_upload"), manager:null},
		{btn: wpsvpform_addmedia.find("#download_upload"), manager:null},
        {btn: wpsvpform_addmedia.find("#preview_seek_upload"), manager:null},
        {btn: wpsvpform_addmedia.find("#hover_preview_upload"), manager:null},
        {btn: wpsvpform_addmedia.find("#chapters_upload"), manager:null},

        {btn: wpsvpform_addplayer.find("#logo_path_upload"), manager:null},
        {btn: wpsvpform_addplayer.find("#vrInfo_upload"), manager:null},
	];
	setUploadManager(uploadManagerArr);

	function setUploadManager(arr){
		var i, len = arr.length, item;
		for(i=0;i<len;i++){
			item = arr[i].btn.attr('data-id',i);
		
			item.on('click',function(e){
				e.preventDefault();
 			
				var library, source, id = $(this).attr("id"), data_id = parseInt($(this).attr("data-id"),10), custom_uploader;

	            if(uploadManagerArr[data_id].manager){//reuse
	                uploadManagerArr[data_id].manager.open();
	                return;
	            }

                if(id == 'thumb_upload'){
				
					library = "image";
					source = '#thumb';

				}else if(id == 'poster_upload'){
				
					library = "image";
					source = '#poster';
				
				}else if(id == 'download_upload'){

                    library = "";//allow anything
					source = '#download';
				
                }else if(id == 'preview_seek_upload'){

                    library = "";
                    source = '#preview_seek';

                }else if(id == 'hover_preview_upload'){

                    library = "image/gif";
                    source = '#hover_preview';

                }else if(id == 'chapters_upload'){

                    library = "";
                    source = '#chapters';

				}else if(id == 'logo_path_upload'){
                
                    library = "image";
                    source = '#logoPath';

                }else if(id == 'vrInfo_upload'){
                
                    library = "image";
                    source = '#vrInfo';

                }

				custom_uploader = wp.media({
					library:{
						type: library
					}
				})
				.on("select", function(){
					attachment = custom_uploader.state().get("selection").first().toJSON();
					$(source).val(attachment.url);

                    if(source == '#thumb'){
                        thumb_preview.attr('src', attachment.url);
                        thumb_remove.show();
                    }else if(source == '#poster'){
                        poster_preview.attr('src', attachment.url);
                        poster_remove.show();
                    }

				})
				.open();

				uploadManagerArr[data_id].manager = custom_uploader;//save for reuse

			});
		}	
	}

    





	//input restrictions
	var option_content = $('.option-content');
	option_content.find(".check_key").on("keyup", checkKey);
	option_content.find(".check_key2").on("keyup", checkKey2);
	option_content.find(".check_key3").on("keyup", checkKey3);
	option_content.find(".check_key4").on("keyup", checkKey4);
	option_content.find(".check_key5").on("keyup", checkKey5);

	function checkKey() {
		this.value = this.value.replace(/[^0-9]/g, "");
	}
	function checkKey2() {
		this.value = this.value.replace(/[^0-9-]/g, "");
	}
	function checkKey3() {
		this.value = this.value.replace(/[^0-9.]/g, "");
	}
	function checkKey4() {
		this.value = this.value.replace(/[^0-9a-zA-Z_]/g, "");
	}
	function checkKey5() {
		this.value = this.value.replace(/[^0-9px%]/g, "");
	}	

    function isEmpty(str){
        return str.replace(/^\s+|\s+$/g, '').length == 0;
    }
	


//Random Clip time
	/* $('#shortcode_playlist').on('change',function(){
		
		var playlist_id = $('#shortcode_playlist').val();
		$.ajax({    
			type: "POST",
			url: wpsvp_data.plugins_url + '/includes/data_display.php',             
			data: { id: playlist_id},
			success: function(response){                    
				var obj = jQuery.parseJSON( response );
				$('#shortcode_clip_time').empty();
				var len = obj.length;
				for (i = 0; i < len; i++){ 
					$('#shortcode_clip_time').append($('<option>', { 
							value: obj[i],
							text : obj[i] 
					}));
				
				}
			}

		});
	}).change(); */



	//shortcode #shortcode_player, #shortcode_playlist, 
	$('#shortcode_player, #shortcode_playlist' ).on('change',function(){

		var player_id = $('#shortcode_player').val();
		
		var playlist_id = $('#shortcode_playlist').val();
		
		if(!player_id){
			$('#shortcode_generator').text('Please create a player first!\n');
		}else if(!playlist_id){
			$('#shortcode_generator').text('Please create a playlist first!\n');
		}else{
			
			$.ajax({    
				type: "POST",
				url: wpsvp_data.plugins_url + '/includes/data_display.php',             
				data: { id: playlist_id},
				success: function(response){
					$('#shortcode_generator').empty();                    
					var obj = jQuery.parseJSON( response );
					var len = obj.length;
					for (i = 0; i < len; i++){ 
					
					var shortcode = '[apwpsvp player_id="'+player_id+'" playlist_id="'+playlist_id+'" clip_time="'+obj[i]+'"]';
						$('#shortcode_generator').append( shortcode );
						$('#shortcode_generator').append( "<!--nextpage-->");
					}
				}

			});
			
			var shortcode2 = 'echo do_shortcode(\'[apwpsvp player_id="'+player_id+'" playlist_id="'+playlist_id+'"]\')';
            $('#shortcode_generator2').text(shortcode2);

		}

	}).change();






    //export playlist

    $('.wpsvp-table').on('click','.wpsvp-export-playlist-btn', function(){

        var playlist_id = $(this).attr('data-playlist-id'),
        playlist_title = $(this).closest('.wpsvp-playlist-row').find('.title-editable').val();

        playlist_title = playlist_title.replace(/\W/g, '');//safe chars

        var postData = [
            {name: 'action', value: 'wpsvp_export_playlist'},
            {name: 'playlist_id', value: playlist_id},
            {name: 'playlist_title', value: playlist_title}
        ];

        $.ajax({
            url: wpsvp_data.ajax_url,
            type: 'post',
            data: postData,
            dataType: 'json',
        }).done(function(response){

            //console.log(response)
            if(response.zip) {
                location.href = response.zip;
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText, textStatus, errorThrown);
        }); 

    });






    //import playlist

    var import_playlist_loader = $('#wpsvp-import-playlist-loader'),
    import_playlist_btn = $('#wpsvp-import-playlist').click(function(){
        $('#wpsvp-file-input').trigger('click'); 
        return false;
    }); 
    var local_import = '';
    import_playlist_local_btn = $('#wpsvp-import-playlist-local').click(function(){
        local_import = 'LOCAL';
        $('#wpsvp-file-input').trigger('click'); 
        return false;
    }); 

    $('#wpsvp-file-input').on('change', prepareUpload);

    function prepareUpload(event) { 

        import_playlist_btn.css('display','none');
        import_playlist_loader.css('display','inline-block');

        var file = event.target.files;
        var data = new FormData();
        var nonce = $('#wpsvp-import-playlist-form').find("#_wpnonce").val();
        $.each(file, function(key, value){
            data.append("wpsvp_file_upload", value);
        });
        data.append("action", "wpsvp_import_playlist");
        data.append("nonce", nonce );
        data.append("local", local_import );

        document.getElementById("wpsvp-file-input").value = "";

        $.ajax({
            url: wpsvp_data.ajax_url,
            type: 'post',
            data: data,
            dataType: 'json',
            processData: false, 
            contentType: false, 
        }).done(function(response){

            //console.log(response)
            if(response){
                if(response.response == 'SUCCESS')window.location.reload(false); 
            }
            import_playlist_btn.css('display','inline-block');
            import_playlist_loader.css('display','none');

        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText, textStatus, errorThrown);
            import_playlist_btn.css('display','inline-block');
            import_playlist_loader.css('display','none');

            alert("Error importing, please check browser console for messages!");
        }); 
	}
});

