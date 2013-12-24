<?php
    if (isset($_GET['dir'])){$dir = $_GET['dir'];}  else {$dir='../'; }
    if ($dir=='..') {$dir='../';}
    if ($dir=='.') {$dir='../';}
    if ($dir=='./') {$dir='../';}
    if (isset($_GET['n'])){$new = $_GET['n'];}  else {$new='nil'; }
    if (isset($_POST['new_file']) or isset($_POST['new_dir']) ){
        if ($new=='1') { file_put_contents($dir.'/'.$_POST['new_file'], '/* supersimple-web-ide */'); }
        if ($new=='2') { mkdir($dir.'/'.$_POST['new_dir']);}
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
		<title>supersimple-web-ide</title>
        <link rel="stylesheet" href="pastas.css">
	</head>
	<body>
       <div id="pastas">
            <form enctype="multipart/form-data" action="uploader.php?dir=<?php echo $dir ?>" method="POST">
                <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                Upload: <input name="uploadedfile" type="file" />
                <input type="submit" value="Upload File" />
            </form>     
            <p>Pastas em <?php echo $dir.'<br>';?>
            <form action="index.php?n=2&dir=<? echo $dir ?>" method="POST">
                <input type="text" value="new_folder" name="new_dir"></input>
                <input type="submit" value="create">
            </form> 
            </p>
            <a class="dir" href="index.php?dir=<? echo dirname($dir) ?>/">voltar</a>
            <?php
                foreach($dirs as $key => $value){
                echo '<a class="dir" href="index.php?dir='.$value.'/">'.basename($value).'</a>';}
            ?>
        </div>
		<div id="arquivos">
            <p>Arquivos&nbsp;
            <form action="index.php?n=1&dir=<? echo $dir ?>" method="POST">
                <input type="text" value="new_file.php" name="new_file"></input>
                <input type="submit" value="create">
            </form> 
            </p>
			<?php
			foreach($files1 as $key => $value){
                echo $alink.$value.'">'.basename($value).'</a> &nbsp';}
			?>
		</div>		
  </body>
</html>
