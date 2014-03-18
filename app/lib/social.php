<?php
	require_once __DIR__ . "/php/socialhub/CustomPostsFactory.class.php";
	$nextFacebook = $_POST['nextFacebook'];
	$nextTwitter = $_POST["nextTwitter"];
	$postFactory = CustomPostsFactory::getSocialHub(array("Facebook", "Twitter"), array($nextFacebook,$nextTwitter));

	echo json_encode($postFactory);
 ?>