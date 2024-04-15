<?php
    function uploadFILES($fileName){
        //file upload path
        $targetDir = "../upload/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (!empty($_FILES["file"]["name"])) {
            // $allowTypes = array('jpg','png','jpeg','gif','pdf','docx','doc');
            $allowTypes = array('pdf', 'docx', 'doc', "xls", "xlsx");
            if (in_array($fileType, $allowTypes)) {
                //upload file to server
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                    $statusMsg = "The file " . $fileName . " has been uploaded.";
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            } else {
                $statusMsg = 'Sorry, only DOC,DOCX, & PDF files are allowed to upload.';
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }
    }
?>