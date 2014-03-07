<?php
require_once __DIR__ . '/facebook/CustomFacebookMeta.class.php';
require_once __DIR__ . '/twitter/CustomTwitterMeta.class.php';
require_once 'CustomPostsMixMeta.class.php';

class CustomPostsFactory {
	const FACEBOOK_HUB = "Facebook";
	const TWITTER_HUB = "Twitter";
	
	public static function getSocialHub($hubArray, $queryArray){
		$hubMetaArray = array();
		
		for ($i = 0; $i < count($hubArray); $i++){
			switch ($hubArray[$i]){
				case self::FACEBOOK_HUB:
					$hubMetaArray[] = new CustomFacebookMeta($queryArray[$i]);
					break;
				case self::TWITTER_HUB:
					$hubMetaArray[] = new CustomTwitterMeta($queryArray[$i]);
					break;
			}
		}
		
		if (count($hubMetaArray)>0){
			return new CustomPostsMixMeta($hubMetaArray);
		}
		
	}
}
?>