<?php

$name = $_POST['firstName'];
$title = $_POST['title'];
$text = $_POST['blog_text'];
$image = $_POST['image'];

$blogFile = fopen("blog", 'w');
fwrite($blogFile, $name . "\n");
fwrite($blogfile, $title . "\n");
fwrite($blogfile, $text . "\n");
fwrite($blogFile, $targetFile);
fclose($blogFile);

if (count($_FILES)) {
	$target_dir = "images/";
	$target_file = $target_dir.basename($_FILES["image"]["name"]);
	
	//Temporary file is moved to permanent file.
	$res = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
	
	if (!$res) {
		print("<h1>Problem uploading ".$target_file."</h1>");
	} else {
		print("<h1>.$target_file."."Uploaded Successfully</h1>");
	}
}
?>