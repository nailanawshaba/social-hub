<?php
require_once __DIR__ . '/../../facebook-php-sdk/src/facebook.php';
require_once 'CustomFacebookPost.class.php';

class CustomFacebookMeta {
	private $facebook;
	
	public $limit = 12;
	public $posts = array();
	public $next;
	public $previous;
	
	public function __construct($until="") {
		$keysFile = parse_ini_file(__DIR__ ."/../keys.ini");
		
		$this->facebook = new Facebook(array(
			'appId'  => $keysFile["appIdKey"],
			'secret' => $keysFile["appSecret"],
		));
		$query = $this->createQuery($keysFile["facebookPageName"], $until);
		$this->fillMeta($query);
	}
	
	private function fillMeta($query){
		$value = $this->facebook->api($query, 'get');
		
		$this->next = $this->getUntil($value["paging"]["next"]);
		$this->previous = $this->getUntil($value["paging"]["previous"]);
		
		foreach ($value["data"] as $post){
			$this->posts[] = $this->createFacebookPost($post);
		}
	}
	
	private function createQuery($pageName, $until){
		if (is_numeric($until)) {
			$until--;
			return "/". $pageName ."/posts?fields=&limit=". $this->limit . "&until=". $until;
		} else {
			return "/". $pageName ."/posts?fields=&limit=12";
		}
	}
	
	private function getUntil($value){
		preg_match("/until=(\d+)/", $value, $res);
		
		return isset($res[1]) ? $res[1] : "";
	}
	
	private function createFacebookPost($post){
		$facebookPost = new CustomFacebookPost($post);
		$facebookPost->setPicture($this->getImageFromMeta($facebookPost));
		return $facebookPost;
	}
	
	private function getImageFromMeta($post){
		if ($post->getObjectId()!=null){
			return $this->getOriginalPictureFromObjectId($post->getObjectId());
		} else if ($post->getLink() != null){			
			libxml_use_internal_errors(true); // Yeah if you are so worried about using @ with warnings
			$html = file_get_contents($post->getLink());
			if ($html === false) return;
			$doc = new DomDocument();
			$doc->loadHTML($html);
			$xpath = new DOMXPath($doc);
			$query = '//*/meta[starts-with(@property, \'og:image\')]';
			$metas = $xpath->query($query);
			if (count($metas)>0 && $metas->item(0)){
				return $metas->item(0)->getAttribute('content');
			}else return;
		}
	}
	
	private function getOriginalPictureFromObjectId($objectId){
		$value = $this->facebook->api($objectId, 'get');
		return $value["source"];
	}
}
?>