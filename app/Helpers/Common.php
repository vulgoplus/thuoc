<?php 
	
namespace App\Helpers;

/**
* 
*/
class Common
{
	
	public static function createAlias($string){
		if(!$string) return false;
		$utf8 = array(
		        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		        'd'=>'đ|Đ',
		        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		        'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
		        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		        'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
		        );
		foreach($utf8 as $ascii=>$uni) $string = preg_replace("/($uni)/i",$ascii,$string);
		$string = Common::utf8Url($string);
		return $string;
	}
	 
	public static function utf8Url($string){        
	    $string = strtolower($string);
	    $string = str_replace( "ß", "ss", $string);
	    $string = str_replace( "%", "", $string);
	    $string = preg_replace("/[^_a-zA-Z0-9 -]/", "",$string);
	    $string = str_replace(array('%20', ' '), '-', $string);
	    $string = str_replace("----","-",$string);
	    $string = str_replace("---","-",$string);
	    $string = str_replace("--","-",$string);
	    return $string;
	} 

	public static function createSumary($text, $length){
		$text = preg_replace("/<img[^>]+\>/i", " (image) ", $text);
		$text = strip_tags($text);
		$text = str_replace('<br/>', ' ', $text);
		$text = str_replace('<br>', ' ', $text);
		$text = str_limit($text, $limit = $length, $end = '...');
		return $text;
	}

	public static function newOrder(){
		if(session('newOrder')){
			return session('newOrder');
		}else{
			return 0;
		}
	}
}
?>