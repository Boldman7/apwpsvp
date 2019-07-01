<?php

$type = $_REQUEST['type'];
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : null;
$perPage = isset($_REQUEST['perPage']) ? $_REQUEST['perPage'] : null;
$path = isset($_REQUEST['path']) ? $_REQUEST['path'] : null;
$user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'date';
$sortDirection = isset($_REQUEST['sortDirection']) ? $_REQUEST['sortDirection'] : 'asc';
$vimeo_key = base64_decode($_REQUEST['vai']['vk']);
$vimeo_secret = base64_decode($_REQUEST['vai']['vs']);
$vimeo_token = base64_decode($_REQUEST['vai']['vt']);

require("autoload.php");
use Vimeo\Vimeo;
$vimeo = new Vimeo($vimeo_key, $vimeo_secret, $vimeo_token);


if($type == 'video_comments'){

	$video_id = $_REQUEST['video_id'];

	//https://developer.vimeo.com/api/playground/videos/{video_id}/comments
	
	$result = $vimeo->request("/videos/$video_id/comments", array(
								'page'=> $page,
								'per_page' => $perPage,
								'fields' => 'text,created_on,user.name,user.link,user.account,user.pictures.sizes',
								'direction' => $sortDirection							
								));

}else if($type == 'next_page'){//resume

	$result = $vimeo->request($path);

}else if($type == 'vimeo_channel'){

	//Get a list of videos in a Channel - https://developer.vimeo.com/api/playground/channels/{channel_id}/videos
	$result = $vimeo->request("/channels/$path/videos", array(
													'page'=> $page,
													'per_page' => $perPage,
													'fields' => 'uri,name,description,link,duration,release_time,privacy,pictures.sizes,stats.plays,metadata.connections.comments.total,metadata.connections.likes.total,categories.uri,categories.name,categories.top_level,user.uri,user.name,user.link,user.pictures.sizes,user.account,download.link',
													'sort' => $sort,
													'direction' => $sortDirection,								
													'filter' => 'embeddable',
													'filter_embeddable' => 'true'
													));

}else if($type == 'vimeo_group'){														
													
	//Get a list of videos in a Group - https://developer.vimeo.com/api/playground/groups/{group_id}/videos
	$result = $vimeo->request("/groups/$path/videos", array(
													'page'=> $page,
													'per_page' => $perPage,
													'fields' => 'uri,name,description,link,duration,release_time,privacy,pictures.sizes,stats.plays,metadata.connections.comments.total,metadata.connections.likes.total,categories.uri,categories.name,categories.top_level,user.uri,user.name,user.link,user.pictures.sizes,user.account,download.link',
													'sort' => $sort,
													'direction' => $sortDirection,						
													'filter' => 'embeddable',
													'filter_embeddable' => 'true'
													));
		
}else if($type == 'vimeo_user_album'){	
		
	//Get the list of videos in an Album - https://developer.vimeo.com/api/playground/users/{user_id}/albums/{album_id}/videos
	$result = $vimeo->request("/users/$user_id/albums/$path/videos", array(
													'page'=> $page,
													'per_page' => $perPage,
													'fields' => 'uri,name,description,link,duration,release_time,privacy,pictures.sizes,stats.plays,metadata.connections.comments.total,metadata.connections.likes.total,categories.uri,categories.name,categories.top_level,user.uri,user.name,user.link,user.pictures.sizes,user.account,download.link',
													'sort' => $sort,
													'direction' => $sortDirection,							
													'filter' => 'embeddable',
													'filter_embeddable' => 'true'
													));
									
}else if($type == 'vimeo_video_query'){	
												
	//Search for videos - https://developer.vimeo.com/api/playground/videos
	$result = $vimeo->request("/videos", array(
													'page'=> $page,
													'per_page' => $perPage,
													'fields' => 'uri,name,description,link,duration,release_time,privacy,pictures.sizes,stats.plays,metadata.connections.comments.total,metadata.connections.likes.total,categories.uri,categories.name,categories.top_level,user.uri,user.name,user.link,user.pictures.sizes,user.account,download.link',
													'sort' => $sort,
													'direction' => $sortDirection,										
													'query' => $path,
													'filter' => 'content_rating',
													'filter_content_rating' => ['language','drugs','violence','nudity','safe','unrated'],
													));
													
}else if($type == 'vimeo_single'){	

	//Get a video - https://developer.vimeo.com/api/playground/videos/{video_id}
	$result = $vimeo->request("/videos/$path", array(
													'fields' => 'uri,name,description,link,duration,release_time,privacy,pictures.sizes,stats.plays,metadata.connections.comments.total,metadata.connections.likes.total,categories.uri,categories.name,categories.top_level,user.uri,user.name,user.link,user.pictures.sizes,user.account,download.link',
													));
}

echo json_encode($result);


?>