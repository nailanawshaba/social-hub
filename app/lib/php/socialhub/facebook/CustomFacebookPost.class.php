<?php
require_once __DIR__ . '/../NiceDateTime.class.php';

class CustomFacebookPost {
	public $id;
	public $message;
	public $date;
	public $picture;
	public $link;
	public $name;
	public $caption;
	public $description;
	public $objectId;
	public $post_link;
	public $date_str;
	public $postClass = "CustomFacebookPost";
	
	function __construct($map) {
		$this->id = $map["id"];
		$this->message = $map["message"];
		$this->date = strtotime($map["created_time"]);
		$this->picture = $map["picture"];		
		$this->objectId = $map["object_id"];
		
		// Link Related fields
		$this->link = $map["link"];
		$this->name = $map["name"];
		$this->caption = $map["caption"];
		$this->description = $map["description"];

		$this->post_link = str_replace("_", "/posts/", $this->id);
		$this->date_str = NiceDateTime::format($map["created_time"]);
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getMessage(){
		return $this->message;
	}
	
	public function getDate(){
		return $this->date;
	}
	
	public function getPicture(){
		return $this->picture;
	}
	
	public function setPicture($picture){
		$this->picture = $picture;
	}
	
	public function getLink(){
		return $this->link;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getCaption(){
		return $this->caption;
	}
	
	public function getDescrition(){
		return $this->description;
	}
	
	public function getObjectId(){
		return $this->objectId;
	}
}
?>