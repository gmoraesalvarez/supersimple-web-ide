<?
	$pronto='';
	if (isset($_GET['doc']))
		{
			$doc = $_GET['doc'];
            $path = pathinfo($doc);
            $ext = $path['extension'];
            $name = $path['basename'];
        	$pronto = "<style>body{color:#eee8d5}</style>...|&check;|";
        	$text = $_POST['code1'];
        }
	if (isset($_POST['save']))
		{
			$doc = $_POST['save'];
            $path = pathinfo($doc);
            $ext = $path['extension'];
            $name = $path['basename'];
        	$pronto = '&check;';
        	//$text = rawurldecode($_POST['code1']).PHP_EOL;
        	$text = $_FILES['code1'];
        }
    if (isset($_POST['code1'])){
        //$pronto="got post.";
        //$filename = $doc;
        //$text = trim($_POST['code1']);
        //$text = $_POST['code1'];
        $filename = $doc;
		$fp = fopen ($filename, "w");
        if ($fp) {
        	$ip=$_SERVER['REMOTE_ADDR'];
        	fwrite ($fp, $text);
        	fclose ($fp);
        	//$pronto=$pronto_old;
        }
       	else {
        	    $pronto="Couldn't save. :/";
        } 
    }
    if (isset($_FILES['code1'])){
        //$pronto="got post.";
        //$filename = $doc;
        //$text = trim($_POST['code1']);
        //$text = $_POST['code1'];
        $filename = $doc;
		move_uploaded_file($_FILES['code1']['tmp_name'], $filename);
    }
	else {
        $pronto="Couldn't save. :/";
    }
    echo $pronto;
?>