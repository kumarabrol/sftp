<?php
/**
 * Created by PhpStorm.
 * User: xunzhao
 * Date: 6/29/15
 * Time: 4:42 PM
 */
include_once('Class_File.php');

class FileDelete extends File
{

    private $deleteStatus = true;

    /**
     * constructor
     * @param $fileList
     */
    function __construct($fileList)
    {
        parent::__construct($this->setFormattedAddress($fileList));
    }


    /**
     * delete the files
     */
    public function deleteFiles()
    {
        try {
            foreach ($this->fileList as $path) {
                if (!unlink(ROOT . $path)) {
                    $this->deleteStatus = false;
                    break;
                }
            }

        } catch (RuntimeException $e) {
            $this->errorMessage = $e->getMessage();
        }
        return $this->deleteStatus;
    }


    /**
     * get error message
     */
    public function getErrorMessage(){
        return $this->errorMessage;
    }


}