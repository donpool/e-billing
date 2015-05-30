<?php

class Upload 
{
      public function onFileUploaded($fullFileName,$userdata) {
      
          
         $file=  basename($fullFileName);
          $extension = explode(".", $file); 
          $ext=end($extension);
       if (end($extension)=='pdf') {
            $res=Yii::app()->params['rutaxml'].'/'.$file;
           rename($fullFileName, Yii::app()->params['rutapdf'].$file);
           }
       }
    
}