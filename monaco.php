<?
	//// CHECK SESSION
	session_start();
	$url='./';
	if ($_SESSION['nat'] != 'on') {header( "Location: $url" );}

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
        if ($ext=='js') {$ext='javascript';}
    }
    if ($doc != 'nil') {
        $text = file_get_contents($doc);
        $text = str_replace('&','&amp;',$text);
        $text = str_replace('<','&lt;',$text);
        $text = str_replace('>','&gt;',$text);
        $text = str_replace(" ",'&nbsp;',$text);
        $text = str_replace("	",'&#9;',$text);
        //$text = preg_replace("/\r\n|\r|\n/", '\\n', $text);
        //$text = urlencode($text);
        ///////$text = "    aqui é pra ter quatro espaços";
    }
?>
<!DOCTYPE html>
<html style="height: 100%;font-family:sans-serif;">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <link
        rel="stylesheet"
        data-name="./min/vs/editor/editor.main"
        href="./min/vs/editor/editor.main.css"
        />
    </head>
    <body style="height:100%;margin:0;width:100%;display: flex; flex-direction: column;
        background:#242424;align-items:stretch:">
        <div id="container" style="height:100%;max-width:1200px;width:100%;margin:auto;"><? echo $text; ?></div>
        <div id="salvar_but"
            style="position:fixed;bottom:2px;right:2px;border-radius:2px;padding:3px 16px 3px 16px;cursor:default;background:#212121;color:#f1f1f1;"
            onclick="salvar()">
            salvar
        </div>
        <div id="feedback"
            style="margin:auto;height:30px;width:100%;background:#363636;color:#fafafa;font-size:20px;">
            <select onchange="setfsize()" name="fsize" id="fsize"
                style="appearance:none;border-radius:2px;background:#263238;color:#f1f1f1;float:left;border:none;height:100%;width:50px;text-align:center;margin-left:4px;">
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
            <div id="modcheck" style="float:left;"></div>
        </div>
        <script>
var require = { paths: { vs: './min/vs' } };
</script>
        <script src="min/vs/loader.js"></script>
        <script src="min/vs/editor/editor.main.nls.js"></script>
<script src="min/vs/editor/editor.main.js"></script>
        <script>
            var text = container.innerHTML;
            container.innerHTML = '';
            text = text.replaceAll('&lt;','<');
            text = text.replaceAll('&gt;','>');
            text = text.replaceAll('&nbsp;',' ');
            text = text.replaceAll('&#9;','    ');
            text = text.replaceAll('&amp;','&');
            
            var editor = monaco.editor.create(document.getElementById('container'), {
                value: [text].join('\n'),
                language: '<? echo $ext; ?>',
                readOnly: false,
                fontSize: "12px",
                theme: "vs-dark"
            });
            
            /*require.config({ paths: { vs: 'vs' } });
            require(['vs/editor/editor.main'], function (){
var editor = monaco.editor.create(document.getElementById('container'), {
value: [text].join('\n'),
language: '<? //echo $ext; ?>',
                    /*readOnly: false,
                    fontSize: "12px",
                    theme: "vs-dark"
});
});
            */
            editor.onDidChangeModelContent(function (e) {
                salvar_but.style.background = "#1B5E20";
                modcheck.innerHTML = '<p style="font-size:14px;margin:0;margin-left:10px;margin-top: 6px;color:#fb9832">modificado</p>';
            });
            function setfsize(){
                var size = fsize.options[fsize.selectedIndex].innerHTML;
                let options = {"fontSize": size}
                editor.updateOptions(options);
                console.log('setting font '+size);
            }
            function salvar(autosave = false){
            server = './';
            console.log('salvar');
            var formData = new FormData();
            formData.append("save", "<? echo $doc; ?>");
            var blob = new Blob([editor.getValue()], { type: "text/xml"});
            formData.append("code1", blob);
            //data = editor.getValue();
            nome = '<? echo $doc; ?>';
            console.log('nome:'+nome);
            ////////// SEND DADOS TO SERVER
            saveremote = new XMLHttpRequest();
            saveremote.open("POST", server+'save.php', true);
            //saveremote.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            //saveremote.send("save="+nome+"&code1="+data); //saveremote.send('save='+nome+'&dados='+data);
            saveremote.send(formData);
            console.log('sent: '+blob);
            console.log('going for the save');
            saveremote.onload = function(){
            remotedebug=saveremote.responseText;
            console.log('save feedback:\n '+remotedebug);
            modcheck.innerHTML = '<p style="float:left;margin:0;margin-left:10px;">'+remotedebug+'</p>';
            salvar_but.style.background = '#212121';
            }
            }
        </script>
    </body>
</html>