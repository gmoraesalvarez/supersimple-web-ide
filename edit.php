<?php 
    $doc='nil';
    $fsize=11;
    if (isset($_GET['f'])){
        $fsize=$_GET['f'];
        }
    if (isset($_GET['doc']))
		{
			$doc = $_GET['doc'];
            $path = pathinfo($doc);
            $ext = $path['extension'];
            $name = $path['basename'];
			if ($ext=='html') {$ext='php';}
			if ($ext=='js') {$ext='javascript';}
        }
    
    if ($doc != 'nil') { $text = file_get_contents($doc); $text = str_replace('/','\/',$text); }
?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title><? echo $name ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="cm.css">
		<link rel=stylesheet href="../doc/docs.css">
<link rel="stylesheet" href="theme/3024-day.css">
<link rel="stylesheet" href="theme/3024-night.css">
<link rel="stylesheet" href="theme/ambiance.css">
<link rel="stylesheet" href="theme/base16-dark.css">
<link rel="stylesheet" href="theme/base16-light.css">
<link rel="stylesheet" href="theme/blackboard.css">
<link rel="stylesheet" href="theme/cobalt.css">
<link rel="stylesheet" href="theme/eclipse.css">
<link rel="stylesheet" href="theme/elegant.css">
<link rel="stylesheet" href="theme/erlang-dark.css">
<link rel="stylesheet" href="theme/lesser-dark.css">
<link rel="stylesheet" href="theme/mbo.css">
<link rel="stylesheet" href="theme/midnight.css">
<link rel="stylesheet" href="theme/monokai.css">
<link rel="stylesheet" href="theme/neat.css">
<link rel="stylesheet" href="theme/night.css">
<link rel="stylesheet" href="theme/obsidian.css">
<link rel="stylesheet" href="theme/paraiso-dark.css">
<link rel="stylesheet" href="theme/paraiso-light.css">
<link rel="stylesheet" href="theme/rubyblue.css">
<link rel="stylesheet" href="theme/solarized.css">
<link rel="stylesheet" href="theme/the-matrix.css">
<link rel="stylesheet" href="theme/tomorrow-night-eighties.css">
<link rel="stylesheet" href="theme/twilight.css">
<link rel="stylesheet" href="theme/vibrant-ink.css">
<link rel="stylesheet" href="theme/xq-dark.css">
<link rel="stylesheet" href="theme/xq-light.css">
        <link rel="stylesheet" href="addon/dialog/dialog.css">
		<link rel="stylesheet" href="corpo.css">
        <script src="lib/codemirror.js"></script>
        <script src="keymap/extra.js"></script>
		<script src="addon/edit/matchbrackets.js"></script>
        <script src="addon/selection/active-line.js"></script>
        <script src="addon/search/search.js"></script>
        <script src="addon/search/searchcursor.js"></script>
        <script src="addon/dialog/dialog.js"></script>
		<script src="mode/htmlmixed/htmlmixed.js"></script>
		<script src="mode/xml/xml.js"></script>
		<script src="mode/javascript/javascript.js"></script>
		<script src="mode/css/css.js"></script>
		<script src="mode/clike/clike.js"></script>
		<script src="mode/php/php.js"></script>
		<script src="mode/htmlembedded/htmlembedded.js"></script>
		<style type="text/css">.CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;font-size:<?=$fsize?>px;}</style>
	</head>
	<body>
        <div id="bar">
            <iframe id="saver" name="saveit"></iframe>
            <select onchange="setfsize()" name="fsize" id="fsize">
                <option>8</option>
                <option>9</option>
                <option selected>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>18</option>
                <option>20</option>
                <option>24</option>
            </select>
            <select onchange="selectTheme()" id='select' name='select'>
                <option selected>default</option>
                <option>3024-day</option>
                <option>3024-night</option>
                <option>ambiance</option>
                <option>base16-dark</option>
                <option>base16-light</option>
                <option>blackboard</option>
                <option>cobalt</option>
                <option>eclipse</option>
                <option>elegant</option>
                <option>erlang-dark</option>
                <option>lesser-dark</option>
                <option>mbo</option>
                <option>midnight</option>
                <option>monokai</option>
                <option>neat</option>
                <option>night</option>
                <option>obsidian</option>
                <option>paraiso-dark</option>
                <option>paraiso-light</option>
                <option>rubyblue</option>
                <option>solarized dark</option>
                <option>solarized light</option>
                <option>the-matrix</option>
                <option>tomorrow-night-eighties</option>
                <option>twilight</option>
                <option>vibrant-ink</option>
                <option>xq-dark</option>
                <option>xq-light</option>
            </select>
        </div>
        <form id="text" action="save.php?doc=<? echo $doc ?>" target="saveit"  method="post">
            <input id="save" type="submit" id="save" value="Salvar" />      
            <span id="tit"><? echo $doc ?></span> 
            <textarea id="code1" name="code1"><?
            echo $text;
            ?>
</textarea>
</form>
<script>
var editor1 = CodeMirror.fromTextArea(document.getElementById("code1"), {
lineNumbers: true,
matchBrackets: true,
mode: '<? echo $ext ?>',
indentUnit: 4,
indentWithTabs: true,
enterMode: "keep",
tabMode: "shift",
extraKeys: {
"Ctrl-S": function() {
saveit();
}
}
});
function saveit(){
document.getElementById('save').click();
}
var fsize = document.getElementById("fsize");
function setfsize() {
var size = fsize.options[fsize.selectedIndex].innerHTML;
var editor = document.getElementsByClassName('CodeMirror');
editor[0].style.fontSize=size+'px';
document.getElementById('text').action = "edit.php?doc=<? echo $doc ?>&f="+size;
}
var input = document.getElementById("select");
var theme = '<? if(isset($_POST["select"])) { echo $_POST["select"];} else {echo 'obsidian';}?>';
editor1.setOption("theme", theme);
//input.options[input.selectedIndex].innerHTML = theme;
function selectTheme() {
theme = input.options[input.selectedIndex].innerHTML;
editor1.setOption("theme", theme);
}
</script>
</body>
</html>
