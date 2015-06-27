<?php

class Format {
    
    
    public static function Translit($string) {
    	$string = (string) $string;
    	$rus = array('а','б','в','г','д','е','ё','ж',  'з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ',   'ъ','ь','ы','э','ю','я');
    	$lat = array('a','b','v','g','d','e','yo','zh','z','i','i','k','l','m','n','o','p','r','s','t','u','f','h','tc','ch','sh','sch','','','i','e','yu','ya');
    	
    	$string = strip_tags($string);
    	$string = str_replace(array("\n", "\r"), " ", $string);
    	$string = preg_replace("/\s+/", ' ', $string);
    	$string = trim($string);
    	$string = mb_strtolower($string, 'UTF-8');
    	$string = str_replace($rus, $lat, $string);
    	//$string = strtr($string, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
    	$string = preg_replace("/[^0-9a-z-_ ]/i", "", $string);
    	$string = str_replace(" ", "_", $string);

    	return $string;
    }
    
    public static function Viewdate($date) {
        $dt = explode(" ", $date);
	$idate = explode("-", $dt[0]);
	$newdate = $idate[2].'/'.$idate[1].'/'.$idate[0];
	if($dt[1]!="") $newdate .= ', '.$dt[1];
	
	return $newdate;
    }
    
    
}

