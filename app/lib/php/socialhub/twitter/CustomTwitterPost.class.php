<?php
require_once __DIR__ . '/../NiceDateTime.class.php';

class CustomTwitterPost {
	public $id;
	public $text;
	public $date;
	public $owner;
	public $date_str;
	public $postClass = "CustomTwitterPost";
	
	public function __construct($map) {
		$this->id = $map["id_str"];
		$this->owner = $this->getOwner($map);
		$this->text = $map["text"];
		$this->date = strtotime($map["created_at"]);
		
		$this->date_str = NiceDateTime::format($map["created_at"]);
	}
	
	public function getText(){
		return $this->text;
	}
	
	public function getCreatedAt(){
		return $this->date;
	}
	
	private function getOwner($tweet){
		if (isset($tweet["retweeted_status"])){
			return $tweet["retweeted_status"]["user"]["id_str"];
		} else
			return $tweet["user"]["id_str"];
	}
}
?>