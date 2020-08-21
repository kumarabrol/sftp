<?php
require_once('../Model/Class_FolderTree.php');
/**
 * Created by PhpStorm.
 * User: xunzhao
 * Date: 6/18/15
 * Time: 2:22 PM
 */

if($_SERVER['REQUEST_METHOD']==='POST') {
    $path = urldecode($_POST['dir']);
    $tree = new FolderTree($path);
    $getTree = $tree->create_tree();
    $getFolder = $tree -> getFolderList();
    echo json_encode(array('tree'=>$getTree,'folder'=>$getFolder));
}