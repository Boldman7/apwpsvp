<?php 
$section = '<div class="wpsvp-ad-section">'.PHP_EOL;

foreach($ad_data as $row){

    if(empty($row["active"]))continue;

    $type = $row["type"];

    $item = '<div class="wpsvp-ad wpsvp-'.$row["ad_type"].'" data-type="'.$type.'" ';

    if($type == "video" || $type == "video_360" || $type == "audio" || $type == "image" || $type == "image_360"){

        $quality;

        $ad_path = 'data-path=\'[';

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

        $ad_path .= '{"quality": "default", "'.$ext.'": "'.$p.'"},';
      
        $ad_path = substr_replace($ad_path, "", -1);//remove last comma
        $ad_path .= ']\' ';

    }else{//youtube, vimeo single

        $ad_path = 'data-path="'.$row['path'].'" ';

        if(!empty($row["yt_quality"])){
            $ad_path .= 'data-quality="'.$row["yt_quality"].'" ';
        }

    }
    
    $item .= $ad_path;

    if(!empty($row["is360"])){
        $item .= 'data-is360="1" ';
    }
    if(!empty($row["duration"])){
        $item .= 'data-duration="'.$row["duration"].'" ';
    }
    if(!empty($row["poster"])){
        $item .= 'data-poster="'.$row["poster"].'" ';
    }
    if(!empty($row["skip_enable"])){
        $item .= 'data-skip-enable="'.$row["skip_enable"].'" ';
    }
    if(isset($row["begin"])){
        $item .= 'data-begin="'.$row["begin"].'" ';
    }
    if(!empty($row["link"])){
        $item .= 'data-link="'.$row["link"].'" ';
        if(!empty($row["target"])){
            $item .= 'data-target="'.$row["target"].'" ';
        }
    }

    $item .= '></div>';

    $section .= $item.PHP_EOL;
       
}
$section .= '</div>'.PHP_EOL;

$track .= $section;
?>