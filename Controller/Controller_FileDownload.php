<?php
/**
 * Created by PhpStorm.
 * User: xunzhao
 * Date: 6/23/15
 * Time: 10:21 AM
 */

require_once ('../Model/Class_FileDownload.php');

if($_SERVER['REQUEST_METHOD'] === 'GET'){

    $getAllDownLoadAddresses = json_decode($_GET["downloadArray"]);
    //initial the file class
    $fileUpload = new FileDownload($getAllDownLoadAddresses);
    //check the status
    echo json_encode($fileUpload -> downloadFile());

}
