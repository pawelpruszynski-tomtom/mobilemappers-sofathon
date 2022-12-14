<?php


$uploadOk = 1;


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
                }
else {

     $total = count($_FILES['fileToUpload']['name']);
     echo "<p>Total files: ".$total."</p>";
     for( $i=0 ; $i < $total ; $i++ ) {

               $tmpFilePath = $_FILES['fileToUpload']['tmp_name'][$i];
               if ($tmpFilePath != ""){
                         echo "<p>File".$i."  </p>";
                         $newFilePath = "uploads/" .  basename($_FILES['fileToUpload']['name'][$i]);

                         if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                                           echo "<p>The file ". htmlspecialchars( basename( $_FILES['fileToUpload']['name'][$i])). " has been uploaded.</p>";}
                        else { echo "<p>Sorry, there was an error uploading your file.</p>"; }
                                      }
                                      }
    }

?>
