<?php

/**
 * Created by PhpStorm.
 * User: xunzhao
 * Date: 6/18/15
 * Time: 2:14 PM
 */
class FolderTree
{

    private $files;
    private $folder;
    private $folderContainer = array();

    /**
     * Define the php construct
     * @param $path
     */
    function __construct($path)
    {
        $files = array();
        if (file_exists($path)) {
            if ($path[strlen($path) - 1] == '/')
                $this->folder = $path;
            else
                $this->folder = $path . '/';

            $this->dir = opendir($path);
            while (($file = readdir($this->dir)) != false)
                $this->files[] = $file;
            closedir($this->dir);
        }
    }


    /**
     *
     * get file size
     * @param $bytes
     * @param int $decimals
     * @return string
     */
    function human_filesize($bytes, $decimals = 2) {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }



    /**
     * Create the tree list
     * @return string
     */
    function create_tree()
    {
        if (count($this->files) > 2) { /* First 2 entries are . and ..  -skip them */
            natcasesort($this->files);
            array_push($this->folderContainer,substr($this->folder,2));
            $list = '<ul class="filetree" style="display: none;">';
            // Group folders first
            foreach ($this->files as $file) {
                if (file_exists($this->folder . $file) && $file != '.' && $file != '..' && is_dir($this->folder . $file)) {
                    $list .= '<li class="folder collapsed"><span style="margin: 16px;cursor: pointer" rel="' . htmlentities($this->folder . $file) . '/">' . htmlentities($file) . '</span></li>';
                    array_push($this->folderContainer, substr($this->folder . $file.'/',2));

                }
            }
            // Group all files
            foreach ($this->files as $file) {
                if (file_exists($this->folder . $file) && $file != '.' && $file != '..' && !is_dir($this->folder . $file)) {
                    $ext = preg_replace('/^.*\./', '', $file);
                    $list .= '<li style="position:relative;" class="file ext_' . $ext . '"><h7 style="position:absolute;top:16px;left:78px;font-size:9px;color:#9E9B9B;">'.date("F d Y H:i:s",filemtime($this->folder . $file)).'</h7><input type="checkbox" style="margin-left:30px;margin-right:16px;" class="fileCheckBoxClass"><span style="cursor: pointer" rel="' . htmlentities($this->folder . $file) . '">' . htmlentities($file) .'  <i style="float:right">'.$this->human_filesize(filesize($this->folder . $file)).'</i></span></li>';
                }
            }
            $list .= '</ul>';
            return $list;
        }
        else {
            array_push($this->folderContainer,substr($this->folder,2));
        }
    }

    /**
     * return the folder list
     * @return mixed
     */
    function getFolderList(){
        return $this->folderContainer;
    }


}

