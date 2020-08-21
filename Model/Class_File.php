<?php
/**
 * Created by PhpStorm.
 * User: xunzhao
 * Date: 6/29/15
 * Time: 4:45 PM
 */
include_once ('../Conf/configure.php');
class File {

    protected  $fileList;
    protected  $errorMessage;

    /**
     * construct
     * @param $fileList
     */
    function __construct($fileList){
        $this->fileList = $fileList;
    }

    /**
     * formatted function
     * @param $argument
     * @return array|string
     */

    protected function setFormattedAddress($argument)
    {
        $finalValue = array();
        //if the it is an array
        foreach ($argument as $item) {
            array_push($finalValue, substr($item, 2));
        }
        return $finalValue;
    }




}