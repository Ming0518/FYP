<?php
if(isset($_POST['submit'])) {
    $file = $_FILES['image'];

    // File properties
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Check if file is uploaded without errors
    if($fileError === 0) {
        $fileDestination = 'images/user/' . $fileName;
        move_uploaded_file($fileTmpName, 'images/user/'.$fileName);
        echo 'File uploaded successfully!';
    } else {
        echo 'Error uploading file!';
    }
}
?>
