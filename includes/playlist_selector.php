<?php 

$playlistSelectorStyle = array(
    'list' => 'list',
    'select' => 'select'
);
 
?>

<table class="form-table">

    <p class="info">Show playlist selector above the player with ability to load new playlist on runtime.</p>

    <tr valign="top">
        <th>Use playlist selector</th>
        <td>
            <select name="usePlaylistSelector">
                <option value="0" <?php if(isset($options['usePlaylistSelector']) && $options['usePlaylistSelector'] == "0") echo 'selected' ?>>no</option>
                <option value="1" <?php if(isset($options['usePlaylistSelector']) && $options['usePlaylistSelector'] == "1") echo 'selected' ?>>yes</option>
            </select>
        </td>
    </tr>

    <tr valign="top">
        <th>Playlist selector style</th>
        <td>
            <select name="playlistSelectorStyle">
                <?php foreach ($playlistSelectorStyle as $key => $value) : ?>
                    <option value="<?php echo($key); ?>" <?php if(isset($options['playlistSelectorStyle']) && $options['playlistSelectorStyle'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                <?php endforeach; ?>
            </select><br>
        </td>
    </tr>

    <tr valign="top">
        <th>Choose playlists to be shown in selector</th>
        <td>
            <button type="button" id="pl-select-delete">Delete selected</button>
            <button type="button" id="pl-select-reload">Reload playlists</button>
            <input type="hidden" id="playlistSelectorPlaylists" name="playlistSelectorPlaylists" value="<?php echo($options['playlistSelectorPlaylists'])?>">
            <ul id="pl-select-wrap"></ul>
        </td>
    </tr>

</table>

