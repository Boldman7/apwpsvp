<?php 

$playlistScrollTheme = array(
    'light' => 'light',
    'dark' => 'dark',
    'minimal' => 'minimal',
    'minimal-dark' => 'minimal-dark',
    'light-2' => 'light-2',
    'dark-2' => 'dark-2',
    'light-3' => 'light-3',
    'dark-3' => 'dark-3',
    'light-thick' => 'light-thick',
    'dark-thick' => 'dark-thick',
    'light-thin' => 'light-thin',
    'dark-thin' => 'dark-thin',
    'inset' => 'inset',
    'inset-dark' => 'inset-dark',
    'inset-2' => 'inset-2',
    'inset-2-dark' => 'inset-2-dark',
    'inset-3' => 'inset-3',
    'inset-3-dark' => 'inset-3-dark',
    'rounded' => 'rounded',
    'rounded-dark' => 'rounded-dark',
    'rounded-dots' => 'rounded-dots',
    'rounded-dots-dark' => 'rounded-dots-dark',
    '3d' => '3d',
    '3d-dark' => '3d-dark',
    '3d-thick' => '3d-thick',
    '3d-thick-dark' => '3d-thick-dark'
);

$playlistPosition = array(    
    'vrb' => 'Vertical right and bottom',
    'vlb' => 'Vertical left and bottom',
    'ht' => 'Horizontal top',
    'hb' => 'Horizontal bottom',
    'vb' => 'Vertical bottom',
    'outer' => 'Outer (endless scroll)',
    'wall' => 'Lightbox wall',
    'no-playlist' => 'No playlist (use just player)'
);
$navigationType = array(    
    'scroll' => 'Scroll',
    'buttons' => 'Buttons',
    'hover' => 'Mouse move',
);
$navigationStyle = array(    
    'normal' => 'No spacing around thumbnails',
    'spaced' => 'Spacing around thumbnails'
);
$controlsType = array(    
    'controls1' => 'Controls style 1 (bottom and top right, vertical volume)',
    'controls1b' => 'Controls style 1 (bottom and top right, horizontal volume)',
    'controls2' => 'Controls style 2 (bottom)',
    'none' => 'No controls (hide controls)',
);
$playlistStyle = array(    
    'drot' => 'Description right of thumbnail',
    'dot' => 'Description over thumbnail',
);
$playlistGridStyle = array(    
    'gdot' => 'Description over thumbnail',
    'gdbt' => 'Description below thumbnail',
);
$playlistThumbStyle = array(
    'square' => 'square',
    'round' => 'round'
);
$playlistItemContent = array(   
    'title,description' => 'title, description', 
    'title' => 'title',
    'description' => 'description',
    'title,date' => 'title, date',
    'title,date,description' => 'title, date, description',
);
$playlistInfoAnimation = array(    
    'pia1' => 'Description animation 1 (slide from left)',
    'pia2' => 'Description animation 2 (slide from bottom)',
    'pia3' => 'Description animation 3 (opacity)',
    'pia4' => 'Description animation 4 (slide from bottom both info and thumbnail)',
);
$playerSkin = array(    
    'dark-flat' => 'Dark theme',
    'light-flat' => 'Light theme',
    'gray-flat' => 'Gray theme',
    'transparent-flat' => 'Transparent theme',
);
$playerShadow = array(   
    '' => 'No shadow', 
    'shadow-effect1' => 'Shadow effect 1',
    'shadow-effect2' => 'Shadow effect 2',
    'shadow-effect3' => 'Shadow effect 3',
    'shadow-effect4' => 'Shadow effect 4',
    'shadow-effect5' => 'Shadow effect 5',
    'shadow-effect6' => 'Shadow effect 6',
);
$minimizeClass = array(    
    'wpsvp-minimize-bl' => 'Bottom left',
    'wpsvp-minimize-br' => 'Bottom right',
);


include_once('player_options.php');
$default_options = wpsvp_player_options();

if(isset($_GET['player_id'])){

    $player_id = $_GET['player_id'];

    $stmt = $wpdb->prepare("SELECT * FROM {$player_table} WHERE id = %d", $player_id);
    $result = $wpdb->get_row($stmt, ARRAY_A);
    if($result){
    	$player_options = unserialize($result['options']);
        $options = $player_options + $default_options;
        $title = $result['title'];
    }



    //breakpoints
    $wpsvp_breakPoint_arr = array();

    if(isset($options['bp_width']) && isset($options['bp_column']) && isset($options['bp_gutter'])){

        $bp_width = $options['bp_width'];
        $bp_column = $options['bp_column'];
        $bp_gutter = $options['bp_gutter'];
        
        foreach ($bp_width as $id => $key) {
            if(!wpsvp_nullOrEmpty($key)){
                $wpsvp_breakPoint_arr[] = array(
                    'width'  => $bp_width[$id],
                    'column' => $bp_column[$id],
                    'gutter'  => $bp_gutter[$id],
                );
            }
        }
    }

    //visiblity
    $wpsvp_elementsVisibility_arr = array();

    if(isset($options['ev'])){
        foreach ($options['ev'] as $arr) {
            $wpsvp_elementsVisibility_arr[] = $arr;
        }
    }

    $sectionTitle = 'Edit Player';

}else{

    $title = 'New player';

    //player options
    $options = $default_options;

    //breakpoints
    $wpsvp_breakPoint_arr = $options['breakPointArr'];

    //visiblity
    $wpsvp_elementsVisibility_arr = $options['elementsVisibilityArr'];

    $sectionTitle = 'Add Player';
}

?>

<script type="text/javascript">
    var wpsvp_breakPoint_arr = <?php echo(json_encode($wpsvp_breakPoint_arr, JSON_HEX_TAG)); ?>;
    var wpsvp_elementsVisibility_arr = <?php echo(json_encode($wpsvp_elementsVisibility_arr, JSON_HEX_TAG)); ?>;
</script>

<div class='wrap' align="center">

	<a class='button-primary' href="<?php echo admin_url("admin.php?page=wpsvp_player_manager"); ?>">Back to Player manager</a>

	<div><h2 align="center"><?php echo($sectionTitle); ?> <span style="color:#FF6600; font-weight:bold;"><?php if(isset($player_id))echo($title . ' - ID - ' . $player_id); ?></span></h2>
    </div>
	<form id="wpsvpform-addplayer" method="post" action="<?php echo admin_url("admin.php?page=wpsvp_player_manager"); ?>">

		<div class="wpsvp-admin">

            <div class="option-tab wpsvp-player-style">
                <div class="option-toggle">
                    <span class="option-title">Player style</span>
                </div>
                <div class="option-content">
                    <?php require_once(dirname(__FILE__)."/style.php"); ?>
                </div>
            </div>

            <div class="option-tab-divider"></div>

            <div class="option-tab wpsvp-player-general">
    		    <div class="option-toggle">
    		        <span class="option-title">General settings</span>
    		    </div>
    		    <div class="option-content">
            		<?php require_once(dirname(__FILE__)."/general.php"); ?>
          	    </div>
            </div>

            <div class="option-tab-divider"></div>
            
            <div class="option-tab">
                <div class="option-toggle">
                    <span class="option-title">Playlist selector</span>
                </div>
                <div class="option-content">
                    <?php require_once(dirname(__FILE__)."/playlist_selector.php"); ?>
                </div>
            </div>

            <div class="option-tab-divider"></div>

            <div style="display: none;" class="option-tab">
                <div class="option-toggle">
                    <span class="option-title">Translation</span>
                </div>
                <div class="option-content">
                    <?php require_once(dirname(__FILE__)."/translation.php"); ?>
                </div>
            </div>

        </div>

        <p class="wpsvp-actions"> 
            <input type="submit" name="save_options" class="submit" style="display:none;">
    		<?php wp_nonce_field('wpsvp_edit_player_action', 'wpsvp_edit_player_nonce_field'); ?>
            <button id="wpsvp-save-player-options-submit" type="button" name="save_options" class="button-primary" <?php disabled( !current_user_can(WPSVP_CAPABILITY) ); ?>>Save Changes</button> 
            <a class='button-primary' href="<?php echo admin_url("admin.php?page=wpsvp_player_manager"); ?>">Back to Player manager</a>
        </p>

	</form>

</div>

