<?php
    session_start();
    $url='./admin';
    if (isset($_POST['pass'])){
        $hash = file_get_contents('admin/z.xyz');
        if (password_verify($_POST['pass'],$hash) && ($_POST['user'] == 'natw')){
            $_SESSION['nat']='on';
        }
    }
    if ($_SESSION['nat'] != 'on') {header( "Location: $url" );}

    if (isset($_GET['dir'])){$dir = $_GET['dir'];}  else {$dir='../'; }
    if ($dir=='..') {$dir='../';}
    if ($dir=='.') {$dir='../';}
    if ($dir=='./') {$dir='../';}
    if (isset($_GET['n'])){$new = $_GET['n'];}  else {$new='nil'; }
    if (isset($_POST['new_file']) or isset($_POST['new_dir']) ){
        if ($new=='1') { file_put_contents($dir.'/'.$_POST['new_file'], '/* supersimple-web-ide */'); }
        if ($new=='2') { mkdir($dir.'/'.$_POST['new_dir']);}
        }
    $files1 = glob($dir . '*.{css,php,htm,html,js,txt,cfg}', GLOB_BRACE);
	$dirs = glob($dir . '*', GLOB_ONLYDIR);
    $alink = '<a class="file" target="_blank" href="monaco.php?doc=';
    
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
		<a style="float:left;min-height:16px;min-width:100px;border:#555 solid 1px;" href="up.php?dir=<? echo $dir ?>"><p>manage files</p></a>     
           
       <div id="pastas">
		    <p>folders in <?php echo $dir.'<br>';?></p>
		   <a class="dir" href="index.php?dir=<? echo dirname($dir) ?>/" style="font-size:32px;">↲</a>
            <?php
                foreach($dirs as $key => $value){
                echo '<a class="dir" href="index.php?dir='.$value.'/">'.basename($value).'</a>'."\n";}
            ?>
        </div>
		<div id="arquivos">
            <p>files</p>
			<?php
			foreach($files1 as $key => $value){
                echo $alink.$value.'">'.basename($value).'</a>'."\n";}
			?>
		</div>		
  </body>
</html>