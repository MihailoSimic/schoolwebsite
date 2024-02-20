<?php

$directory = "slike/";


if(isset($_POST["submit"])) {
    
    if(isset($_POST["pictureName"])) {
        $pictureName = $_POST["pictureName"];

       
        if(isset($_FILES["newPicture"]) && $_FILES["newPicture"]["error"] === UPLOAD_ERR_OK) {
           
            $originalFileName = $_FILES["newPicture"]["name"];
            $fileExtension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

            if($fileExtension === 'jpg' || $fileExtension === 'jpeg' || $fileExtension === 'png') {
                
                if(file_exists($directory . $pictureName . '.jpg') && file_exists($directory . $pictureName . '.png')) {
                   
                    unlink($directory . $pictureName . '.jpg');
                    unlink($directory . $pictureName . '.png');
                } elseif (file_exists($directory . $pictureName . '.jpg')) {
                    
                    unlink($directory . $pictureName . '.jpg');
                } elseif (file_exists($directory . $pictureName . '.png')) {
                    
                    unlink($directory . $pictureName . '.png');
                }

                
                move_uploaded_file($_FILES["newPicture"]["tmp_name"], $directory . $pictureName . '.' . $fileExtension);
                echo "Picture '$pictureName.$fileExtension' updated successfully.";
            } else {
                echo "Only JPG or PNG files are allowed.";
            }
        } else {
            echo "No new picture uploaded. Picture '$pictureName' remains unchanged.";
        }
    } else {
        echo "Picture name not provided.";
    }
}
?>