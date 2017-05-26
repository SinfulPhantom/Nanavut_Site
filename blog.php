<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>
</head>
<body>
    <div>
        <?php    
			$blogFile = fopen("blog.txt", 'r');
			
			while (!feof($blogFile))
			{
				echo '<div>';
					echo fgets '<h1>'.$_POST['title'].'</h1>';
					echo fgets '<p>by '.$_POST['name'].'on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
					echo fgets '<img src="'.$_POST['target_file'].'" />';
					echo fgets '<p>'.$_POST['text'].'</p>';
				echo '</div>';
			}
			$fclose($blogFile);
        ?>
    </div>
</body>
</html>