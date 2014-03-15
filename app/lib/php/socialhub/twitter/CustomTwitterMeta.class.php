<?php
require_once __DIR__ . '/../../twitter-php-sdk/TwitterClient.php';
require_once 'CustomTwitterPost.class.php';

class CustomTwitterMeta {
	private $twitter;
	public $next;
	public $posts = array();
	
	public function __construct($maxId='') {
		$keysFile = parse_ini_file(__DIR__ ."/../keys.ini");
		
		$this->twitter = new TwitterClient($keysFile["consumerKey"], $keysFile["consumerSecret"], $keysFile["oauthToken"], $keysFile["oauthTokenSecret"]);		
		$options = $this->createOptions($keysFile, $maxId);
		$this->fillMeta($options);
	}

	private function fillMeta($options){
		
		$res = $this->twitter->get('statuses/user_timeline.json', $options);
		foreach ($res as $post){
			$p = new CustomTwitterPost($post);
			$this->posts[] = $p;
			$this->next = $p->id;
		}
	}
	
	private function createOptions($keysFile, $maxId){
		$options = array('screen_name'=>$keysFile["screenName"], 'count'=>12, 'trim_user' => true);	
		if (is_numeric($maxId)) {
			$options["max_id"] = (int)$maxId -1; 
		}

		return $options;
	}
}
?>