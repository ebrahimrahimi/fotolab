<?php 

    function fileuploading($file_name, $file_tmp_name, $file_size) {
    //replaced: $_FILES["fileToUpload"]["name"] by $file_name  and $_FILES["fileToUpload"]["tmp_name"]  by $file_tmp_name and $_FILES["fileToUpload"]["size"] by $file_size
    
    $target_dir = "images/";
     $target_file = "";
    //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    //$target_file = $target_dir . basename($file_name);
     $target_file = $target_dir.basename($file_name);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);
    //$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $check = getimagesize($file_tmp_name);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "<h1> File is not an image </h1>";  
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    unlink ($target_file);
    //$uploadOk = 0;
}
// Check file size
if ($file_size > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($file_tmp_name, $target_file)) {
        //echo "The file ". basename( $file_name). " has been uploaded.";
        //$im = imagecreatefrompng($target_file);
        //header('Content-Type: image/jpeg');
        //imagepng($im);
        //header("Location: http://localhost/theWebite/index.php?myVar=" . $myPHPVar);
        //$_SESSION["currentpicture"] = $target_file;
        header('Location:index.php?uploadedfile='.$target_file);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    }

