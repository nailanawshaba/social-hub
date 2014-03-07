<?php
require_once __DIR__ . '/facebook/CustomFacebookMeta.class.php';
require_once __DIR__ . '/twitter/CustomTwitterPost.class.php';
require_once __DIR__ . '/facebook/CustomFacebookPost.class.php';

class CustomPostsMixMeta {
	public $posts = array();
	public $nextFacebook;
	public $nextTwitter;
	private $maxPosts = 12;
	
	public function __construct($metas) {
		foreach ($metas as $meta){
			$this->posts = array_merge($this->posts, $meta->posts);
		}		
		
		usort($this->posts, array("CustomPostsMixMeta", "cmp"));
		
		$i = 0;
		foreach ($this->posts as $post){
			$i++;
			if ($post instanceof CustomTwitterPost){
				$this->nextTwitter = $post->id;				
			}else if ($post instanceof CustomFacebookPost){
				$this->nextFacebook = $post->date;
			}
			
			if ($i == $this->maxPosts - 1) break;
		}
		
		$this->posts = array_slice($this->posts, 0, $i);
	}
	
	static function cmp($a, $b){
		return strcmp($b->date, $a->date);
	}
}
?>