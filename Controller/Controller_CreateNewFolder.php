<?php
/**
 * Created by PhpStorm.
 * User: xunzhao
 * Date: 6/26/15
 * Time: 2:58 PM
 */

include_once('../Model/Class_CreateFolder.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $newFolderName = $_POST['newFolderName'];
    $originRootPath = $_POST['rootPath'];


    try {
        $createFolder = new CreateFolder($newFolderName, $originRootPath);

        if ($createFolder->createNewFolder()) {
            echo json_encode(array('success' => true, 'message' => $createFolder->getNewFolderPath()));
        } else {
            echo json_encode(array('success' => false, 'message' => $createFolder->getErrorMessage()));
        }
    } catch (Exception $e) {
        echo json_encode(array('success' => false, 'message' => $e->getMessage()));

    }


}