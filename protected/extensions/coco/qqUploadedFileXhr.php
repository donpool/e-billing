<?php
/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     * 
     */
    
    function save($path,$ext) {
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        if ($realSize != $this->getSize()){
            return false;
        }
        $target = fopen($path, "w");
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
//        
//        if ($ext=='xml'){
//            $respuesta=true;
//            $languages = simplexml_load_file($path);
//            if (isset($languages->infoTributaria->claveAcceso)){
//                $claveAcceso=(string) $languages->infoTributaria->claveAcceso;
//                $estab=(string) $languages->infoTributaria->estab;
//                $ptoEmi=(string) $languages->infoTributaria->ptoEmi;
//                $secuencial=(string) $languages->infoTributaria->secuencial;
//                $NumDocumento=$estab."-".$ptoEmi."-".$secuencial;
//                $codDoc=(string) $languages->infoTributaria->codDoc;
//           foreach ($languages->children() as $key=>$info)
//                {
//                     if ($key=='infoFactura' or $key=='infoNotaDebito' or $key=='infoNotaCredito'){  
//                         $fechaemision=(string)$info->fechaEmision;
//                         $ruc=(string)$info->identificacionComprador;
//                         $nombre=(string)$info->razonSocialComprador; 
//                     }
//                     else if ($key=='infoGuiaRemision'){
//                         $ruc=(string)$info->rucTransportista;
//                         $nombre=(string)$info->razonSocialTransportista;
//                         $fechaemision=(string)$info->fechaIniTransporte;
//                     }
//                     else if ($key=='infoCompRetencion'){
//                         $ruc=(string)$info->identificacionSujetoRetenido;
//                         $nombre=(string)$info->razonSocialSujetoRetenido;
//                         $fechaemision=(string)$info->fechaEmision;
//                     }
//                     
//                     else if ($key=='infoAdicional'){  
//                            foreach ($info as $node) {
//                                  foreach ($node->attributes() as $atr => $value) {
//                                      $atributo=(string)$value;
//                                      if ($atributo=="Email")
//                                      $email=(string)$node;
//                                      if ($atributo=="Dirección")
//                                      $direccion=(string)$node;
//                                      if ($atributo=="Teléfono")
//                                      $telefono=(string)$node;
//                                  }
//                            }
//                    }
//                }
//                $GLOBALS['nuevaruta']  = Yii::app()->params['ruta'].$ext.'/'.$claveAcceso.'.xml';
//                if (file_exists($path)) rename($path, $GLOBALS['nuevaruta'] );
//                $usuario= Usuarios::model()->find('usr_ruc= '.$ruc);
//                if ($usuario==null) 
//                {
//                    //creamos el nuevo Usuario
//                   $User=new Usuarios;
//                   $User->usr_nombre=$nombre;
//                   $User->usr_password=  md5($ruc);
//                   $User->usr_ruc=$ruc;
//                   if(!empty ($email))$User->usr_emal=$email;
//                   if(!empty ($direccion))$User->usr_direccion=$direccion;
//                   if( $User->save())  $usr_codigo = $User->primaryKey; 
//                }
//                else   $usr_codigo=$usuario->usr_codigo;
//                if ($usr_codigo==null) return false;
//                else{
//                        $modelDoc= Documentos::model()->find('doc_clave_acceso= '.$claveAcceso);
//                        if (count($modelDoc)>0){
//                           $modelDoc->usr_codigoupd=Yii::app()->user->id;
//                           $modelDoc->doc_fecupd=new CDbExpression('NOW()');
//                           $modelDoc->save();
//                        }
//                        else{
//                            $model= new Documentos();   
//                            $model->doc_clave_acceso=  $claveAcceso;
//                            $model->doc_cod_doc=(string) $languages->infoTributaria->codDoc;
//                            $date = DateTime::createFromFormat('d/m/Y', $fechaemision);
//                            $model->doc_fecha_emision=$date->format('Y-m-d');
//                            $model->usr_codigo=$usr_codigo;
//                            $model->doc_num_documento=$NumDocumento;
//                            $respuesta= $model->save();
////                            $mail= new EnviarEmail();
////                            $mail->enviar($modelUsuario->usr_email,$_POST['conductor'], $modelUsuario->usr_nombre,$reservacion->res_tiempoinicio,empty($_POST['conductor'])?'No hay conductor':$reservacion->conCodigo->con_nombre);
//                           }
//                   }
//                return  $respuesta;
//            }
//            else{
//                 if(file_exists($path)) 
//                    unlink($path);
//                return false;
//            }
//        }
//        else {
//            
//            rename($path, Yii::app()->params['rutapdf'].basename($path));
//        }
//      
            
            
        return true;
    }
    
    function getName() {
        return $_GET['qqfile'];
    }
    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])){
            return (int)$_SERVER["CONTENT_LENGTH"];
        } else {
            throw new Exception('Getting content length is not supported.');
        }
    }
    
        function xml_attribute($object, $attribute)
        {
            if(isset($object[$attribute]))
                return (string) $object[$attribute];
        }
}
