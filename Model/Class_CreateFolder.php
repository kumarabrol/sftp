<?php
/**
 * Created by PhpStorm.
 * User: xunzhao
 * Date: 6/26/15
 * Time: 3:09 PM
 */
include_once('../Conf/configure.php');

class CreateFolder
{

    private $newFolderName;
    private $originRootPath;
    private $errorMessage;


    /**
     * constructor
     * @param $newFolderName
     * @param $originRootPath
     */
    function __construct($newFolderName, $originRootPath)
    {
        $this->newFolderName = $newFolderName;
        $this->originRootPath = $originRootPath;
    }


    /**
     * create new folder
     * @return bool
     * @throws Exception
     */
    public function createNewFolder()
    {
        try {
            if (is_dir(ROOT . $this->originRootPath)) {
                if (!mkdir(ROOT . $this->originRootPath . $this->newFolderName, 0777, true)) {
                    $this->errorMessage = 'Failure to create the new folder, no Permission ';
                } else {
                    chmod(ROOT . $this->originRootPath . $this->newFolderName,0777);
                    return true;
                }
            } else {
                $this->errorMessage = 'Folder does not exist';
                return false;
            }
        } catch (Exception $e) {
            throw new Exception('Failure to create the new folder, already existed');
        }
    }


    /**
     * return new folder path
     * @return string
     */
    public function getNewFolderPath()
    {
        return $this->originRootPath . $this->newFolderName . '/';
    }


    /**
     *
     * return error message
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }


}
