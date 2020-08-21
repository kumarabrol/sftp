<?php
/**
 * Created by PhpStorm.
 * User: xunzhao
 * Date: 6/21/15
 * Time: 12:10 PM
 */

include_once ('Class_File.php');
class File_upload extends File
{
    private $originPath;


    /**
     * constructor
     * @param $fileList
     * @param $originPath
     */
    function __construct($fileList, $originPath)
    {   parent::__construct($fileList);
        $this->originPath = $originPath;
    }

    /**
     * split file and relocated the file
     * @return bool
     */
    public function splitFile()
    {

        try {
            if (!move_uploaded_file($this->fileList['tmp_name'][0], ROOT . $this->originPath . $this->fileList['name'][0])) {
                throw new RuntimeException('Failed to move uploaded file.');
            }else{
                chmod(ROOT . $this->originPath . $this->fileList['name'][0],0777);
                return true;
            }


        } catch (RuntimeException $e) {
            $this->errorMessage = $e->getMessage();
            return false;
        }

    }


    /**
     * get error message
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }


}
