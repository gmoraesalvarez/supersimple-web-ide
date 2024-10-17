<?php
    if (isset($_GET['dir'])){$dir = $_GET['dir'];}  else {$dir='../'; }
    if ($dir=='..') {$dir='../';}
    if ($dir=='.') {$dir='../';}
    if ($dir=='./') {$dir='../';}
    if (isset($_GET['del'])){
		$del = $_GET['del'];
		unlink($dir.$del);
		}  else {$del='nil'; }
	if (isset($_GET['ren'])){
		$ren = $_GET['ren'];
        $nname = $_POST['nname'];
		rename($dir.$ren,$dir.$nname);
		}  else {$ren='nil'; }
	if (isset($_GET['n'])){$new = $_GET['n'];}  else {$new='nil'; }
    if (isset($_POST['new_file']) or isset($_POST['new_dir']) ){
        if ($new=='1') { file_put_contents($dir.'/'.$_POST['new_file'], '/* supersimple-web-ide */'); }
        if ($new=='2') { mkdir($dir.'/'.$_POST['new_dir']);}
        }
    $files1 = glob($dir . '*.{*}', GLOB_BRACE);
	$dirs = glob($dir . '*', GLOB_ONLYDIR);
    $alink = '<div><a class="lfile" target="_blank" href="edit.php?doc=';
    
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
		<a href="index.php?dir=<? echo $dir ?>" style="min-height:16px;font-size:32px;border:#555 solid 1px;">&ldsh;</a>
		
		<div id="painel">
		<form class="painel" enctype="multipart/form-data" action="uploader.php?dir=<?php echo $dir ?>" method="POST">
            <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
            Upload: <input name="uploadedfile" type="file" />
            <input type="submit" value="Upload File" />
        </form>

		<form class="painel" action="index.php?n=2&dir=<? echo $dir ?>" method="POST">
                <input type="text" value="new_folder" name="new_dir">
                <input type="submit" value="create">
            </form> 

		<form class="painel" action="index.php?n=1&dir=<? echo $dir ?>" method="POST">
                <input type="text" value="new_file.php" name="new_file">
                <input type="submit" value="create">
           </form>
		</div>
		<div id="pastas">
		    <p><?php echo $dir.'<br>';?></p>
            <?php
                foreach($dirs as $key => $value){
					echo '<div><a class="ldir" href="index.php?dir='.$value.'/"><p>'.basename($value).'</p></a><a class="act" href="up.php?dir='.$dir.'&del='.basename($value).'" style="font-size:32px;color:#f53">&times;</a>';
                    echo '<form action="up.php?dir='.$dir.'&ren='.basename($value).'" method="post"><input name="nname" value=""><input type="submit" class="act" ';
                    echo 'style="display:none" value="&reg;"></form></div>';}
            ?>
        </div>
		<div id="arquivos">
			<?php
				foreach($files1 as $key => $value){
					echo $alink.$value.'"><p>'.basename($value).'</p></a><a class="act" href="up.php?dir='.$dir.'&del='.basename($value).'" style="font-size:32px;color:#f53">&times;</a>';
                    echo '<form action="up.php?dir='.$dir.'&ren='.basename($value).'" method="post"><input name="nname" value=""><input type="submit" class="act" ';
                    echo 'style="display:none" value="&reg;"></form></div>';}
			?>
		</div>		

	</body>