<?php
/**
 * Created by PhpStorm.
 * User: xunzhao
 * Date: 6/29/15
 * Time: 4:42 PM
 */

include_once ('../Model/Class_FileDelete.php');

if($_SERVER['REQUEST_METHOD'] ==='POST'){ //POST MEANS DELETE HERE (MARK AND BE ATTENTION)

    $deleteFile = new FileDelete($_POST['filePath']);
    if($deleteFile ->deleteFiles()){
        echo json_encode(array('success'=>true));
    }else{
        echo json_encode(array('success'=>false,'message'=>$deleteFile -> getErrorMessage()));
    }
}