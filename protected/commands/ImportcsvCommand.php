<?php
class ImportcsvCommand extends CConsoleCommand {
       
    private $path;
    private $errores;
    private $_lockFile;
       

    public function run($args) {
//Yii::app()->params['importCSVpercent'];
        $this->path = Yii::app()->params['rutacsv'];
        $this->_lockFile = $this->path.'ImportCSV.lock';

        if( !file_exists( $this->_lockFile ) ) {
            file_put_contents($this->_lockFile, getmypid(), LOCK_EX);
            touch( $this->_lockFile );
            $this->scanDirectorio();
            unlink( $this->_lockFile );
        } else {
            echo "  ImportCSV ya está corriendo [LockFile: {$this->_lockFile}]. Abortando ...\n";
        }

    }

    
    public function scanDirectorio() {
        $dir = opendir($this->path);
        while ($elemento = readdir($dir)) {
            if( $elemento != "." && $elemento != "..") {
                if (!is_dir($this->path.$elemento)) {
                    $extension = explode(".", $elemento);
                    if (end($extension)=='csv')
                        $data = $this->LeerArchivo ($this->path.DIRECTORY_SEPARATOR.$elemento);
                        if( $data )
                            $this->ProcesarDatos($data);
                }
            }
        }
    }

   
    public function LeerArchivo($path) {
        $retval = null;
        $this->errores[]=array();
        $errores=array();
        $data=file($path);
        if (count($data)==0)
            echo 'Error:: Archivo vacio: '.basename($path)." \n";
        else {
            foreach($data as $row) {
                $row = explode("\t", $row);
                $retval[$row['1']][] = $row;
            }
            foreach($retval['NOTA DE CREDITO'] as $nc) {
                $retval['NC'][] = $nc[2];
            }
        }
        return $retval;
    }
    
    
    private function ProcesarDatos($data) {
        foreach($data['FACTURA'] as $bill) {
            if(!in_array($bill[0], $data['NC'])) {
                $model = Documentos::model()->find('doc_num_documento="'.$bill[0].'"');
                if($model) {
                    $model->doc_comision_notario = $bill[6];
                    $model->doc_comision_matrizador = ($bill[6]*Yii::app()->params['importCSVpercent']/100);
                    $model->doc_numerodelibro = $bill[7];
                    if($model->save())
                        echo "Factura {$bill[0]} actualizada\n";
                }
            }
        }
    }

}
