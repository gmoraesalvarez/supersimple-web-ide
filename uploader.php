<?php
// Where the file is going to be placed 

if (isset($_GET['dir']))
		{
			$dir = $_GET['dir'];
        }
    else {
        $dir='../';
        }
$target_path = $dir;
/* Add the original filename to our target path.  
Result is "uploads/filename.extension" */
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    echo basename( $_FILES['uploadedfile']['name']). 
    " enviado.";
} else{
    echo "Houve um erro.";
}
?>
