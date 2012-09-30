<?php
include("../inc/config.php");

  //  *  The file is too large and you do not want to have it on your server.
   // * You wanted the person to upload a picture and they uploaded something else, like an executable file (.exe).
   // * There were problems uploading the file and so you can't keep it.
   
   
// Where the file is going to be placed 

$target_path = "../content/images/" . $_POST["imgdir"];

/* Add the original filename to our target path.  
Result is "uploads/filename.extension" */

$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

//Waring message if the file is not of gif or jpg
if (!($_FILES['uploadedfile']['type']== "image/gif" || $_FILES['uploadedfile']['type']== "image/jpeg" )) {
echo "You may only upload GIF or JPG!! files.<br>";
//echo $_FILES['uploadedfile']['type'];
exit;
} 

else {
//actually put the file on remote disk
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
    " has been uploaded";
	} else	{
    echo "There was an error uploading the file, please try again!";
		}
}

?>
<META http-equiv='refresh' content='0; url=testiframeform.php'>