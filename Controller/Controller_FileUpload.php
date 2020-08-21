<?php
/**
 * Created by PhpStorm.
 * User: xunzhao
 * Date: 6/21/15
 * Time: 12:12 PM
 */
require_once('../Model/Class_FileUpload.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $uploadFile = new File_upload($_FILES['files'], $_POST['uploadPath']);
    if ($uploadFile->splitFile()) {
        echo json_encode(array('success' => true,'message'=>$_POST['uploadPath']));
   } else {
        echo json_encode(array('success' => false, 'message' =>$uploadFile->getErrorMessage()));
    }

}