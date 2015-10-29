<?php
class CronjobCommand extends CConsoleCommand {
       
    private $path;
    private $pathTemporal;
    private $pathXml;
    private $pathPdf;
    private $errores;
    private $_lockFile;
       

    public function run($args) {
        $this->path=Yii::getPathOfAlias('webroot'). '/data/documentos/';
        $this->_lockFile = $this->path.'CronJob.lock';

        if( !file_exists( $this->_lockFile ) ) {
            file_put_contents($this->_lockFile, getmypid(), LOCK_EX);
            touch( $this->_lockFile );
            $this->pathTemporal= $this->path.'tmp';
            $this->pathXml= $this->path.'xml';
            $this->pathPdf= $this->path.'pdf/';
            $this->scanDirectorio($this->pathTemporal);
            unlink( $this->_lockFile );
        } else {
            echo "  CronJob ya está corriendo [LockFile: {$this->_lockFile}]. Abortando ...\n";
        }

    }

    
    public function scanDirectorio( $path) {
        $dir = opendir($path);
        while ($elemento = readdir($dir)) {
            if( $elemento != "." && $elemento != "..") {
                if (!is_dir($path.$elemento)) {
                    $extension = explode(".", $elemento);
                    if (end($extension)=='xml')
                        $this->ProcesarArchivo ($path.DIRECTORY_SEPARATOR.$elemento);
                    else
                        rename ($path.'/'.$elemento, $this->pathPdf.$elemento);
                }
            }
        }
    }

   
    public function ProcesarArchivo($path) {
    
        $this->errores[]=array();
        $errores=array();
        $data=$this->LeerArchivoXML($path);
        if (count((array)$data)==0)
            echo 'Error:: Formato incorrecto en el archivo: '.basename($path)." \n";
        else {
            if(!$this->GuardarArchivo($data,$path)) {
                echo "Error :".  dirname($path)." \n";
                $newname= dirname($path).DIRECTORY_SEPARATOR.'Error_'.  str_replace('Error_','',basename($path,".xml")).".xml";
                rename($path, $newname);
            }
               //else  echo "OK :".basename($path)."\n";
              
        }
    }
       
       
    public function LeerArchivoXML($path) {
        $datos = new stdClass();
        $xmlFile = simplexml_load_file($path);
        if (!isset($xmlFile->infoTributaria)) {
            $xmlFile= simplexml_load_file($path,'SimpleXMLElement', LIBXML_NOCDATA);
            $languages= simplexml_load_string($xmlFile->comprobante, 'SimpleXMLElement', LIBXML_NOCDATA);
        }
        if (isset($languages->infoTributaria->claveAcceso)) {
            $datos = new stdClass();
            $datos->numeroAutorizacion = (string) $xmlFile->numeroAutorizacion;
            $datos->claveAcceso=(string) $languages->infoTributaria->claveAcceso;
            $datos->estab=(string) $languages->infoTributaria->estab;
            $datos->ptoEmi=(string) $languages->infoTributaria->ptoEmi;
            $datos->secuencial=(string) $languages->infoTributaria->secuencial;
            $datos->NumDocumento=$datos->estab."-". $datos->ptoEmi."-". $datos->secuencial;
            $datos->codDoc=(string) $languages->infoTributaria->codDoc;
            // Cambio Lee nuevos campos para insertarlos a la tabla documentos
            if (isset($languages->infoFactura)) {
                $datos->subtotal=$languages->infoFactura->totalConImpuestos->totalImpuesto->baseImponible;
                $datos->iva=$languages->infoFactura->totalConImpuestos->totalImpuesto->valor;
                $datos->total=$languages->infoFactura->importeTotal;
            } 
            else if (isset($languages->infoNotaCredito) ) {
                $datos->subtotal=$languages->infoNotaCredito->totalConImpuestos->totalImpuesto->baseImponible;
                $datos->iva=$languages->infoNotaCredito->totalConImpuestos->totalImpuesto->valor;
                $datos->total=$languages->infoNotaCredito->valorModificacion;
            }
            //Fin

            foreach ($languages->children() as $key=>$info) {
                if ($key=='infoFactura' or $key=='infoNotaDebito' or $key=='infoNotaCredito') { 
                    $datos->fechaemision=(string)$info->fechaEmision;
                    $datos->ruc=(string)$info->identificacionComprador;
                    $datos->nombre=(string)$info->razonSocialComprador;
                    //Cambio Leer el tipo de Identificacion del comprador
                    if ($info->tipoIdentificacionComprador==5) 
                        $datos->tipoIdentificacionComprador='C';
                    else  if ($info->tipoIdentificacionComprador==4) 
                        $datos->tipoIdentificacionComprador='R';
                    else 
                        $datos->tipoIdentificacionComprador='P';
                }
                else if ($key=='infoGuiaRemision') {
                    $datos->ruc=(string)$info->rucTransportista;
                    $datos->nombre=(string)$info->razonSocialTransportista;
                    $datos->fechaemision=(string)$info->fechaIniTransporte;
                }
                else if ($key=='infoCompRetencion') {
                    $datos->ruc=(string)$info->identificacionSujetoRetenido;  
                    $datos->nombre=(string)$info->razonSocialSujetoRetenido;
                    $datos->fechaemision=(string)$info->fechaEmision;
                }
                else if ($key=='infoAdicional') { 
                    foreach ($info as $node) {
                        foreach ($node->attributes() as $atr => $value) {
                            $atributo=(string)$value;
                            if ($atributo=="Email Cliente" || $atributo=="Email")
                                $datos->email=(string)$node;
                            if( !isset( $datos->email ) ) 
                                $datos->email = Yii::app()->params['adminEmail'];
                            if ($atributo=="Dirección")
                                $datos->direccion=(string)$node;
                            if ( strtolower( str_replace( array('é', 'è',  'É', 'È', 'Ê'), array('e', 'e',  'E', 'E', 'E'),$atributo))=="telefono")
                                $datos->telefono=(string)$node;
                            if (strtolower($atributo)=="celular")
                                $datos->celular=(string)$node;                                        
                            //Cambio Leer nuevo atributo Matrizador
                            if ($atributo=="Matrizador")
                                $datos->matrizador=(string)$node;
                            if (strtoupper($atributo)=="NÚMERO DE LIBRO")
                                $datos->numerodelibro=(string)$node;
                        }
                    }
                }
            }
        }

        return $datos;
    }


    public function GuardarArchivo($data,$path) {
        $usr_codigo=null;
        $email=null;
        $modelDoc=null;
        $respuesta=false;
        $usuario= Usuarios::model()->find("usr_ruc='{$data->ruc}'");

        if ($usuario==null) {
            $User=new Usuarios;
            $User->usr_nombre=$data->nombre;
            $User->usr_password=  md5($data->ruc);
            $User->usr_ruc=(string)$data->ruc;
            if(!empty ($data->email)) {
                $User->usr_emal=$data->email;
                $email=$data->email;
            }
            if(!empty ($data->direccion))
                $User->usr_direccion=$data->direccion;
            if(!empty ($data->telefono))
                $User->usr_telefono=(string)$data->telefono;
            if(!empty ($data->celular))
                $User->usr_telefono1=(string)$data->celular;
            if(! $User->save()) {  
                file_put_contents('./errores.txt', print_r($User->getErrors(), LOCK_EX));
                return false;
            }
            else {
                $usr_codigo = $User->primaryKey;
                $roles= Authassignment::model()->find(array(
                    'condition' => 'userid=:userid and itemname=:itemname ',
                    'params' => array(':userid'=>'"'.$usr_codigo.'"', 'itemname' => 'Invitado')
                ));
                if ($roles==null) {
                    $Rol=new Authassignment();
                    $Rol->itemname='Invitado';
                    $Rol->userid=$usr_codigo;
                    $Rol->save(); 
                }
           }
        }
        else {
            $usr_codigo=$usuario->usr_codigo;
            if(!empty ($data->email)&& (trim($data->email)!=trim($usuario->usr_emal)))
                $usuario->usr_emal=$data->email;
            $email=$usuario->usr_emal;
            if(!empty ($data->telefono))
                $usuario->usr_telefono=(string)$data->telefono;
            if(!empty ($data->celular))
                $usuario->usr_telefono1=(string)$data->celular;
            $usuario->usr_fecupd=new CDbExpression('NOW()');
            $usuario->save();
        }
        if ($usr_codigo!=null)
            $modelDoc= Documentos::model()->find('doc_clave_acceso="'.$data->claveAcceso.'"');
        if (count($modelDoc)>0) {
            echo "Actualizando {$data->claveAcceso}...\n";
            $modelDoc->doc_fecupd=new CDbExpression('NOW()');
            $this->setVarFields($modelDoc, $data, false);
            if(!$modelDoc->save()) {
                $respuesta=  false;
            } else {
                rename($path, $this->pathXml.'/'.$data->claveAcceso.'.xml');
                $respuesta=  true;
                $this->actionCrearPdf($data->claveAcceso);
            }
        } else {
            $model= new Documentos();  
            $model->doc_clave_acceso=  $data->claveAcceso;
            $model->doc_cod_doc=(string) $data->codDoc;
            $date = DateTime::createFromFormat('d/m/Y', $data->fechaemision);
            $model->doc_fecha_emision=$date->format('Y-m-d');
            $model->usr_codigo=$usr_codigo;
            $model->doc_num_documento=$data->NumDocumento;
            //Cambio 03-03-2015 Agregar a la tabla documetnos nuevos campos
            $this->setVarFields($model, $data, true);
            //Fin
           
            if (!$model->save()) {
                file_put_contents('./errores.txt', print_r($model->getErrors(), LOCK_EX));
                $respuesta=false;
            } else {
                rename($path,  $this->pathXml.'/'.$data->claveAcceso.'.xml');
                $respuesta=  true;
                $this->actionCrearPdf($data->claveAcceso);
//$email=null;
                $sendEmail = true;
                if(Yii::app()->params['debug']) {
                    $email = Yii::app()->params['debugEmail'];
                    $sendEmail = Yii::app()->params['debugSendEmail'];
                }
                if (!empty($email) && $sendEmail) {
                    echo 'enviando e-mail a: '.$email ;
                    $mail=new EnviarEmail;
                    $mail->enviar($email,$data->nombre,$data->claveAcceso,$data->NumDocumento,$data->codDoc);
                } 
                else
                    echo '  El archivo no tiene email para notificar o el parámetro "debug=true" y "debugSendEmail=false"'."\n";
            }
        }
        return $respuesta;
    }
    
    private function setVarFields($model, $data, $isNew) {
        $model->doc_tipoIdentificacionComprador=$data->tipoIdentificacionComprador;
        if (isset ($data->numeroAutorizacion))
            $model->doc_numero_autorizacion = $data->numeroAutorizacion;
        if (isset ($data->subtotal)) 
            $model->doc_subtotal=$data->subtotal;
        if (isset ($data->iva)) 
            $model->doc_iva=$data->iva;
        if (isset ($data->total)) 
            $model->doc_total=$data->total;
        if (isset ($data->matrizador)) 
            $model->doc_matrizador=$data->matrizador;
        if (isset ($data->numerodelibro)) 
            $model->doc_numerodelibro=$data->numerodelibro;
        if ($data->codDoc == '01') //Si es factura y es nueva o aún tiene N/A
            if($isNew || $model->doc_estadopago == 'N/A')
                $model->doc_estadopago = 'Por Cobrar';
        if ($isNew) { //Si es nuevo setea valores por defecto
            $model->doc_formapago=null;
            $model->doc_comisiona=0;
            $model->doc_retencion=0;
            $model->doc_ret_iva=0;
            $model->doc_ret_ir=0;
        }
        
        return $model;
    }

           
    public function actionCrearPdf($id){
        Yii::import('application.views.documentos.*');
        echo "Creando PDF $id ...\n";
        $pdf=new pdf();
        $pdf->run($id,$this->pathPdf,true);
    }
 
}
