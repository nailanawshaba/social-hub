<?php
require_once __DIR__ . '/../../twitter-php-sdk/TwitterClient.php';
require_once 'CustomTwitterPost.class.php';

class CustomTwitterMeta {
	private $consumerKey = "YOUR_CONSUMER_KEY";
    private $consumerSecret = "YOUR_CONSUMER_SECRET";
    private $oauthToken = "YOUR_OAUTH_TOKEN";
    private $oauthTokenSecret = "YOUR_OAUTH_TOKEN_SECRET";

	private $twitter;
	private $options = array('screen_name'=>'YOUR_SCREEN_NAME', 'count'=>12, 'trim_user' => true);
	public $next;
	public $posts = array();
	
	public function __construct($maxId='') {
		$this->twitter = new TwitterClient($this->consumerKey, $this->consumerSecret, $this->oauthToken, $this->oauthTokenSecret);		
		$this->fillMeta($maxId);
	}

	private function fillMeta($maxId){
		$this->createQuery($maxId);
		$res = $this->twitter->get('statuses/user_timeline.json', $this->options);
		foreach ($res as $post){
			$p = new CustomTwitterPost($post);
			$this->posts[] = $p;
			$this->next = $p->id;
		}
	}
	
	private function createQuery($maxId){
		if (is_numeric($maxId)) {
			$this->options["max_id"] = $maxId -1; 
		}
	}
}
?>