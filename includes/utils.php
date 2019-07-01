<?php 

	function wpsvp_intToBool($value) {
	    return empty($value) ? 'false' : 'true';
	}
	function wpsvp_nullOrEmpty($v){
	    return (!isset($v) || trim($v)==='');
	}

	function wpsvp_compressCss($buffer){
		/* remove comments */
		$buffer = preg_replace("!/\*[^*]*\*+([^/][^*]*\*+)*/!", "", $buffer) ;
		/* remove tabs, spaces, newlines, etc. */
		$arr = array("\r\n", "\r", "\n", "\t", "  ", "    ", "    ");
		$rep = array("", "", "", "", " ", " ", " ");
		$buffer = str_replace($arr, $rep, $buffer);
		/* remove whitespaces around {}:, */
		$buffer = preg_replace("/\s*([\{\}:,])\s*/", "$1", $buffer);
		/* remove last ; */
		$buffer = str_replace(';}', "}", $buffer);
		
		return $buffer;
	}
	function wpsvp_underscoreToCamelCase($string, $capitalizeFirstCharacter = false){
	    $str = str_replace('_', '', ucwords($string, '_'));
	    if (!$capitalizeFirstCharacter) {
	        $str = lcfirst($str);
	    }
	    return $str;
	}
	function wpsvp_removeSlashes($string){
	    $string = implode("",explode("\\",$string));
	    return stripslashes(trim($string));
	}





?>