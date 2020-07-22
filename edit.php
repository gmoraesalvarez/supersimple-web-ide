<?php 
    $doc='nil';
    $fsize=12;
    if (isset($_GET['f'])){
        $fsize=$_GET['f'];
        }
    if (isset($_GET['doc'])){
	$doc = $_GET['doc'];
        $path = pathinfo($doc);
        $ext = $path['extension'];
        $name = $path['basename'];
	if ($ext=='html') {$ext='php';}
	if ($ext=='js') {$ext='javascript';}
        }
    
    if ($doc != 'nil') {
        $text = file_get_contents($doc);
        $text = str_replace('&','&amp;',$text);
    	$text = str_replace('<','&lt;',$text);
    }
?>
<!doctype html>
<html>
	<head>
		<link href="font.css" rel="stylesheet"> 
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title><? echo $name ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<link rel=stylesheet href="doc/docs.css">
		<link rel=stylesheet href="lib/codemirror.css">		
		
		<link rel="stylesheet" href="theme/3024-day.css">
		<link rel="stylesheet" href="theme/3024-night.css">
		<link rel="stylesheet" href="theme/abcdef.css">
		<link rel="stylesheet" href="theme/ambiance.css">
		<link rel="stylesheet" href="theme/base16-dark.css">
		<link rel="stylesheet" href="theme/bespin.css">
		<link rel="stylesheet" href="theme/base16-light.css">
		<link rel="stylesheet" href="theme/blackboard.css">
		<link rel="stylesheet" href="theme/cobalt.css">
		<link rel="stylesheet" href="theme/colorforth.css">
		<link rel="stylesheet" href="theme/dracula.css">
		<link rel="stylesheet" href="theme/duotone-dark.css">
		<link rel="stylesheet" href="theme/duotone-light.css">
		<link rel="stylesheet" href="theme/eclipse.css">
		<link rel="stylesheet" href="theme/elegant.css">
		<link rel="stylesheet" href="theme/erlang-dark.css">
		<link rel="stylesheet" href="theme/hopscotch.css">
		<link rel="stylesheet" href="theme/icecoder.css">
		<link rel="stylesheet" href="theme/isotope.css">
		<link rel="stylesheet" href="theme/lesser-dark.css">
		<link rel="stylesheet" href="theme/liquibyte.css">
		<link rel="stylesheet" href="theme/material.css">
		<link rel="stylesheet" href="theme/mbo.css">
		<link rel="stylesheet" href="theme/mdn-like.css">
		<link rel="stylesheet" href="theme/midnight.css">
		<link rel="stylesheet" href="theme/monokai.css">
		<link rel="stylesheet" href="theme/neat.css">
		<link rel="stylesheet" href="theme/neo.css">
		<link rel="stylesheet" href="theme/night.css">
		<link rel="stylesheet" href="theme/one-dark.css">
		<link rel="stylesheet" href="theme/panda-syntax.css">
		<link rel="stylesheet" href="theme/paraiso-dark.css">
		<link rel="stylesheet" href="theme/paraiso-light.css">
		<link rel="stylesheet" href="theme/pastel-on-dark.css">
		<link rel="stylesheet" href="theme/railscasts.css">
		<link rel="stylesheet" href="theme/rubyblue.css">
		<link rel="stylesheet" href="theme/seti.css">
		<link rel="stylesheet" href="theme/solarized.css">
		<link rel="stylesheet" href="theme/the-matrix.css">
		<link rel="stylesheet" href="theme/tomorrow-night-bright.css">
		<link rel="stylesheet" href="theme/tomorrow-night-eighties.css">
		<link rel="stylesheet" href="theme/ttcn.css">
		<link rel="stylesheet" href="theme/twilight.css">
		<link rel="stylesheet" href="theme/vibrant-ink.css">
		<link rel="stylesheet" href="theme/xq-dark.css">
		<link rel="stylesheet" href="theme/xq-light.css">
		<link rel="stylesheet" href="theme/yeti.css">
		<link rel="stylesheet" href="theme/zenburn.css">
		
		<link rel="stylesheet" href="corpo.css"> 
        <!-- <script src="keymap/extra.js"></script> -->
        <link rel="stylesheet" href="addon/dialog/dialog.css">
        <link rel="stylesheet" href="addon/hint/show-hint.css">
        <script src="lib/codemirror.js"></script>
		<script src="addon/fold/xml-fold.js"></script>
		<script src="addon/edit/matchbrackets.js"></script>
		<script src="addon/edit/closebrackets.js"></script>
		<script src="addon/edit/matchtags.js"></script>
		<script src="addon/edit/closetag.js"></script>
        <script src="addon/selection/active-line.js"></script>
        <script src="addon/search/search.js"></script>
        <script src="addon/search/searchcursor.js"></script>
        <script src="addon/dialog/dialog.js"></script>
		<script src="addon/selection/active-line.js"></script>
        <script src="addon/hint/show-hint.js"></script>
        <script src="addon/hint/javascript-hint.js"></script>
        <script src="addon/hint/html-hint.js"></script>
		<script src="addon/hint/xml-hint.js"></script>
		<script src="mode/htmlmixed/htmlmixed.js"></script>
		<script src="mode/xml/xml.js"></script>
		<script src="mode/javascript/javascript.js"></script>
		<script src="mode/css/css.js"></script>
		<script src="mode/clike/clike.js"></script>
		<script src="mode/php/php.js"></script>
		<script src="mode/markdown/markdown.js"></script>
		<script src="mode/htmlembedded/htmlembedded.js"></script>
		<style type="text/css">
			.CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;
				font-size:<?=$fsize?>px;font-family:'Source Code Pro', monospace;}
		</style>
	</head>
	<body>
        <div id="bar">
            <iframe id="saver" name="saveit"></iframe>
            <select onchange="setfsize()" name="fsize" id="fsize">
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option selected>12</option>
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
				<option>abcdef</option>
				<option>ambiance</option>
				<option>base16-dark</option>
				<option>base16-light</option>
				<option>bespin</option>
				<option>blackboard</option>
				<option>cobalt</option>
				<option>colorforth</option>
				<option>dracula</option>
				<option>duotone-dark</option>
				<option>duotone-light</option>
				<option>eclipse</option>
				<option>elegant</option>
				<option>erlang-dark</option>
				<option>hopscotch</option>
				<option>icecoder</option>
				<option>isotope</option>
				<option>lesser-dark</option>
				<option>liquibyte</option>
				<option>material</option>
				<option>mbo</option>
				<option>mdn-like</option>
				<option>midnight</option>
				<option>monokai</option>
				<option>neat</option>
				<option>neo</option>
				<option>night</option>
				<option>one-dark</option>
				<option>panda-syntax</option>
				<option>paraiso-dark</option>
				<option>paraiso-light</option>
				<option>pastel-on-dark</option>
				<option>railscasts</option>
				<option>rubyblue</option>
				<option>seti</option>
				<option>solarized dark</option>
				<option>solarized light</option>
				<option>the-matrix</option>
				<option>tomorrow-night-bright</option>
				<option>tomorrow-night-eighties</option>
				<option>ttcn</option>
				<option>twilight</option>
				<option>vibrant-ink</option>
				<option>xq-dark</option>
				<option>xq-light</option>
				<option>yeti</option>
				<option>zenburn</option>
            </select> 
        </div>
        <form id="text" action="save.php?doc=<? echo $doc ?>" target="saveit"  method="post">
            <textarea id="code1" name="code1"><? echo $text; ?></textarea>
			<div class="formbar">
				<input id="save" type="submit" id="save" value="SALVAR" onclick="document.getElementById('le_change').innerHTML=''"/>
				<span id="le_tit" class="tit"><? echo $doc ?><span id="le_change" style="color:#FFB74D"></span></span> 
				
			</div>
		</form>
	</body>
</html>
<script>		
	var editor1 = CodeMirror.fromTextArea(document.getElementById("code1"), {
		//autoRefresh: true,
		lineNumbers: true,
		matchBrackets: true,
		autoCloseBrackets: true,
		matchTags: {bothTags: true},
		autoCloseTags: true,
		mode: '<? echo $ext ?>',
		indentUnit: 4,
		indentWithTabs: false,
		enterMode: "keep",
		tabMode: "shift",
		extraKeys: {"Ctrl-Space": "autocomplete"},
		extraKeys: {"Ctrl-S": function() {saveit();}}
		//extraKeys: {"Ctrl-Space": function() {testit();}},
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
	var theme = '<? if(isset($_POST["select"])) { echo $_POST["select"];} else {echo 'one-dark';}?>';
	//theme = 'solarized dark';
	editor1.setOption("theme", theme);
    editor1.on("change", function () {document.getElementById('le_change').innerHTML=' (modificado)';});
	//////input.options[input.selectedIndex].innerHTML = theme;
	function selectTheme() {
		theme = input.options[input.selectedIndex].innerHTML;
		editor1.setOption("theme", theme);
	}
</script>
