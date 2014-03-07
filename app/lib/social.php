<?php
	require_once __DIR__ . "/php/socialhub/CustomPostsFactory.class.php";

	$postFactory = CustomPostsFactory::getSocialHub(array("Facebook", "Twitter"), array("",""));

	echo json_encode($postFactory);
 ?>