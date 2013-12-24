<?php
    if (isset($_GET['dir']))
		{
			$dir = $_GET['dir'];
        }
    else {
        $dir='../';
        }
    $files1 = glob($dir . '*.{css,php,htm,html,js,txt}', GLOB_BRACE);
	$dirs = glob($dir . '*', GLOB_ONLYDIR);
    $alink = '<a class="file" target="_blank" href="edit.php?doc=';
?>

<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>moraesalvarez.com/ide</title>
        <link rel="stylesheet" href="pastas.css">
	</head>
	<body>
       <div id="pastas">
            <form enctype="multipart/form-data"
            action="uploader.php?dir=<?php echo $dir ?>" method="POST">
                <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                Upload: <input name="uploadedfile" type="file" />
                <input type="submit" value="Upload File" />
            </form>          
            <p>Pastas em <?php echo $dir.'<br><br>';?></p>
            <a class="dir" href="index.php?dir=../">voltar</a>
            <?php
                foreach($dirs as $key => $value){
                echo '<a class="dir" href="index.php?dir='.$value.'/">
                '.basename($value).'</a>';}
            ?>
        </div>
		<div id="arquivos">
            <p>Arquivos</p>
			<?php
			foreach($files1 as $key => $value){
                echo $alink.$value.'">'.basename($value).'</a> &nbsp';}
			?>
		</div>
		
		
  </body>
</html>
