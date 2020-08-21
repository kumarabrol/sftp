<?php
/**
 * Created by PhpStorm.
 * User: xunzhao
 * Date: 6/23/15
 * Time: 10:21 AM
 */
include_once ('Class_File.php');

class FileDownload extends File
{

    /**
     * construct
     * @param $originPath
     */

    function __construct($originPath)
    {
        parent::__construct($this->setFormattedAddress($originPath));
    }


    /**
     * download files
     */
    public function downloadFile()
    {
        $downloadAddressPool = array();
        foreach ($this->fileList as $item) {
            $_setPath = ROOT . $item;
            $tempArrayList = [];
            if (file_exists($_setPath)) {
                $tempArrayList['url'] = DOMAIN.$item;
            } else {
                $tempArrayList['url'] = null;
            }
            array_push($downloadAddressPool, $tempArrayList);

        }
        return $downloadAddressPool;

    }


}