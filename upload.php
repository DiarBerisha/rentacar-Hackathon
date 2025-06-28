<?php

// Check if the form is submitted
if (isset($_POST['submit'])) {

    // Check if file is uploaded without errors
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {

        // Define allowed file types (MIME types)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        // Get the file information
        $fileTmpPath = $_FILES['photo']['tmp_name']; // Temporary file location
        $fileName = $_FILES['photo']['name']; // Original file name
        $fileSize = $_FILES['photo']['size']; // File size
        $fileType = $_FILES['photo']['type']; // MIME type

        // Get the file extension
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Check if the uploaded file is an image (based on MIME type)
        if (in_array($fileType, $allowedTypes)) {

            // Generate a unique file name to prevent conflicts
            $newFileName = time() . "_" . rand(1000, 9999) . "." . $fileExtension;

            // Set the destination folder for the uploaded file
            $uploadDirectory = 'uploads/'; // Make sure this directory exists and is writable
            $destinationPath = $uploadDirectory . $newFileName;

            // Move the uploaded file to the destination directory
            if (move_uploaded_file($fileTmpPath, $destinationPath)) {
                echo "File successfully uploaded: <a href='$destinationPath'>$newFileName</a>";
            } else {
                echo "Error in uploading the file!";
            }
        } else {
            echo "Invalid file type! Only JPEG, PNG, and GIF are allowed.";
        }
    } else {
        echo "Error: " . $_FILES['photo']['error'];
    }
}

?>
