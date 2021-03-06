﻿<?php
/**
 * http://github.com/valums/file-uploader
 *
 * Multiple file upload component with progress-bar, drag-and-drop.
 * © 2010 Andrew Valums ( andrew(at)valums.com )
 *
 * 	(Adapted to Yii Framework by:  Christian Salazar, christiansalazarh@gmail.com ,bluyell, @yiienespanol)
 *
 * Licensed under GNU GPL 2 or later and GNU LGPL 2 or later, see license.txt.
 */
class ValumsFileUploader {
    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;

    function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760){
        $allowedExtensions = array_map("strtolower", $allowedExtensions);

        $this->allowedExtensions = $allowedExtensions;
        $this->sizeLimit = $sizeLimit;

        //$this->checkServerSettings();

        if (isset($_GET['qqfile'])) {
            $this->file = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        } else {
            $this->file = false;
        }
    }

    public function checkServerSettings(){
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));

        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit){
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';
            return array('error' => "increase post_max_size and upload_max_filesize to ".$size);
        }

        return null;
    }

    private function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;
        }
        return $val;
    }

    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = TRUE){
      
        if (!is_writable($uploadDirectory)){
            return array('error' => CocoWidget::t("Server error. Upload directory isn't writable."));
        }

        if (!$this->file){
            return array('error' => CocoWidget::t('No files were uploaded.'));
        }

        $size = $this->file->getSize();

        if ($size == 0) {
            return array('error' => CocoWidget::t('File is empty'));
        }

        if ($size > $this->sizeLimit) {
            return array('error' => CocoWidget::t('File is too large'));
        }

        $pathinfo = pathinfo($this->file->getName());
        $filename = $pathinfo['filename'];
        //$filename = md5(uniqid());
        $ext = $pathinfo['extension'];

        if($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => CocoWidget::t('File has an invalid extension, it should be one of '). $these . '.');
        }

        if(!$replaceOldFile){
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                $filename .= rand(10, 99);
            }
        }
       //6046578 $filename =Yii::app()->session['informe_inm'] ;//$_SESSION['informe_inm'];
        $fullpath = $uploadDirectory . $filename . '.' . $ext;

        if ($this->file->save($fullpath,$ext)){
         //  if (!empty($GLOBALS['nuevaruta'] ))  $fullpath =$GLOBALS['nuevaruta'];
               $pathinfo = pathinfo($this->file->getName());
            return array('success'=>true,'filename'=>$filename,'size'=>$size,'ext'=>$ext,'path'=>$uploadDirectory,'fullpath'=>$fullpath);
        } else {
            return array('error'=>
				CocoWidget::t('No se pudo guardar el archivo subido . La carga fue cancelado, o ha encontrado un error de servidor'));
        }

    }
}

/*
// list of valid extensions, ex. array("jpeg", "xml", "bmp")
$allowedExtensions = array();
// max file size in bytes
$sizeLimit = 10 * 1024 * 1024;

$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
$result = $uploader->handleUpload('uploads/');
// to pass data through iframe you will need to encode all html tags
echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
*/