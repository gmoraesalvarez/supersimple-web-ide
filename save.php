<style>body{margin:0;color:#eee8d5;line-height:12px;font-family:sans-serif}</style>
<?php
 if (isset($_GET['doc']))
		{
			$doc = $_GET['doc'];
            $path = pathinfo($doc);
            $ext = $path['extension'];
            $name = $path['basename'];
        }
$pronto='';
    if (isset($_POST['code1'])){
        $pronto="got post.";
        $filename = $doc;
        $text = trim($_POST['code1']);
	$fp = fopen ($filename, "w");
        if ($fp) {
            $ip=$_SERVER['REMOTE_ADDR'];
            fwrite ($fp, $text);
            fclose ($fp);
           	$pronto="<br>...|&check;|";
            }
        else {
            $pronto="Couldn't save. :/";
            }   
        }
    echo $pronto;
?>
