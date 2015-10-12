<?php

class DocumentosController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
//            array('allow',  // allow all users to perform 'index' and 'view' actions
//                'actions'=>array('index','view','coco'),
//                'users'=>array('*'),
//            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('admin','update','delete','pdf'),
                'expression'=>'Yii::app()->authmanager->checkAccess("Administrador",Yii::app()->user->id) '
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('index','view','descarga','exportar','factporpagar'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
       
       
        //Cambio  02/03/2015 exportar a cvs
 public function actionExportar(){

     $model=new Documentos;
   if (isset($_POST['Documentos'])){
//echo '<pre>'.print_r($_POST,1).'</pre>'; exit;

         if (isset($_POST['doc_fecha_emisionInicio']) && isset ($_POST['doc_fecha_emisionFin']) )
        {
          
           $datetimemin=($_POST['doc_fecha_emisionInicio']);
           $datetimemax=($_POST['doc_fecha_emisionFin']);
          $tipo=isset($_POST['Documentos']['doc_cod_doc'])? $_POST['Documentos']['doc_cod_doc']:'1';
//              $m= Yii::app()->db->createCommand()->select("doc_fecha_emision  FECHA, doc_num_documento FACTURA, usr_nombre NOMBRES, IFNULL( doc_subtotal,'') SUBTOTAL,  IFNULL(doc_iva,'' )IVA,  IFNULL(doc_total,'') TOTAL, IFNULL(  CAST(usr_ruc as char(100)),'') CEDULA, IFNULL(doc_tipoIdentificacionComprador , '') TIPO, usr_emal CORREO,usr_direccion DIRECCION ,IFNULL(usr_telefono,'') TELEFONO1, IFNULL(usr_telefono1,'') TELEFONO2,doc_matrizador MATRIZADOR")
//                    ->from('documentos d')
//                    ->join('Usuarios u', 'u.usr_codigo=d.usr_codigo')
//                    ->where ( 'doc_cod_doc='.$tipo.' and doc_estado=true and (doc_fecha_emision  BETWEEN '."'".$datetimemin."'".' AND '."'".$datetimemax."'".')')
//                   ->order ('doc_fecha_emision')
//                    ->queryAll();
//            var_dump($m);
//            exit();
           CsvExport::export(
                Yii::app()->db->createCommand()->select("
                    doc_fecha_emision  FECHA, 
                    doc_num_documento FACTURA, 
                    usr_nombre NOMBRES, 
                    IFNULL( doc_subtotal,'') SUBTOTAL,  
                    IFNULL(doc_iva,'' )IVA,  
                    IFNULL(doc_total,'') TOTAL, 
                    IFNULL(  CAST(usr_ruc as char(100)),'') CEDULA, 
                    IFNULL(doc_tipoIdentificacionComprador , '') TIPO, 
                    IFNULL(usr_emal, '') CORREO,
                    IFNULL(usr_direccion, '') DIRECCION,
                    IFNULL(usr_telefono,'') TELEFONO1, 
                    IFNULL(usr_telefono1,'') TELEFONO2,
                    IFNULL(doc_matrizador, '') MATRIZADOR,
                    IFNULL(doc_numerodelibro, '') NUMERODELIBRO,
                    IFNULL(doc_estadopago, '') ESTADOPAGO,
                    IFNULL(doc_formapago, '') FORMAPAGO,
                    IFNULL(doc_comisiona, '') COMISIONA,
                    IFNULL(doc_comision_notario, '') COMISIONNOTARIO,
                    IFNULL(doc_comision_matrizador, '') COMISIONMATRIZADOR,
                    IFNULL(doc_retencion, '') RETENCION,
                    IFNULL(doc_ret_iva, '') RET_IVA,
                    IFNULL(doc_ret_ir, '') RET_IR"
                )
                    ->from('documentos d')
                    ->join('Usuarios u', 'u.usr_codigo=d.usr_codigo')
                    ->where ( 'doc_cod_doc='.$tipo.' and doc_estado=true and (doc_fecha_emision  BETWEEN '."'".$datetimemin."'".' AND '."'".$datetimemax."'".')')
                   ->order ('doc_fecha_emision')
                    ->queryAll(),
                   
                array(
                    'FECHA'=>array('date'),
                    'FACTURA'=>array('text'),
                    'NOMBRES'=>array('text'),
                    'SUBTOTAL'=>array('text'),
                    'IVA'=>array('text'),
                    'TOTAL'=>array('text'),
                    'CEDULA'=>array('text'),
                    'TIPO'=>array('text'),
                    'CORREO'=>array('text'),
                    'DIRECCION'=>array('text'),
                    'TELEFONO1'=>array('text'),
                    'TELEFONO2'=>array('text'),
                    'MATRIZADOR'=>array('text'),
                    'NUMERODELIBRO'=>array('text'),
                    'ESTADOPAGO'=>array('text'),
                    'FORMAPAGO'=>array('text'),
                    'COMISIONA'=>array('boolean'),
                    'COMISIONNOTARIO'=>array('text'),
                    'COMISIONMATRIZADOR'=>array('text'),
                    'RETENCION'=>array('boolean'),
                    'RET_IVA'=>array('text'),
                    'RET_IR'=>array('text'),
                ),
           true, // boolPrinxtRows
           "Registro-{$_POST['doc_fecha_emisionInicio']}-{$_POST['doc_fecha_emisionFin']}.xls"
           );
        }
      
   }
  
   else  $this->render('exportar',array('model'=>$model));
      

}
//
    
 public function actionFactporpagar(){

     $model=new Documentos;

   if (isset($_POST['doc_fecha_emisionInicio'])){

         if (isset($_POST['doc_fecha_emisionInicio']) && isset ($_POST['doc_fecha_emisionFin']) )
        {
          
           $datetimemin=($_POST['doc_fecha_emisionInicio']);
           $datetimemax=($_POST['doc_fecha_emisionFin']);
          $tipo='1';
//              $m= Yii::app()->db->createCommand()->select("doc_fecha_emision  FECHA, doc_num_documento FACTURA, usr_nombre NOMBRES, IFNULL( doc_subtotal,'') SUBTOTAL,  IFNULL(doc_iva,'' )IVA,  IFNULL(doc_total,'') TOTAL, IFNULL(  CAST(usr_ruc as char(100)),'') CEDULA, IFNULL(doc_tipoIdentificacionComprador , '') TIPO, usr_emal CORREO,usr_direccion DIRECCION ,IFNULL(usr_telefono,'') TELEFONO1, IFNULL(usr_telefono1,'') TELEFONO2,doc_matrizador MATRIZADOR")
//                    ->from('documentos d')
//                    ->join('Usuarios u', 'u.usr_codigo=d.usr_codigo')
//                    ->where ( 'doc_cod_doc='.$tipo.' and doc_estado=true and (doc_fecha_emision  BETWEEN '."'".$datetimemin."'".' AND '."'".$datetimemax."'".')')
//                   ->order ('doc_fecha_emision')
//                    ->queryAll();
//            var_dump($m);
//            exit();
$query = Yii::app()->db->createCommand()->select("
                    doc_fecha_emision  FECHA, 
                    doc_num_documento FACTURA, 
                    usr_nombre NOMBRES, 
                    IFNULL( doc_subtotal,'') SUBTOTAL,  
                    IFNULL(doc_iva,'' )IVA,  
                    IFNULL(doc_total,'') TOTAL, 
                    IFNULL(  CAST(usr_ruc as char(100)),'') CEDULA, 
                    IFNULL(doc_tipoIdentificacionComprador , '') TIPO, 
                    IFNULL(usr_emal, '') CORREO,
                    IFNULL(usr_direccion, '') DIRECCION,
                    IFNULL(usr_telefono,'') TELEFONO1, 
                    IFNULL(usr_telefono1,'') TELEFONO2,
                    IFNULL(doc_matrizador, '') MATRIZADOR,
                    IFNULL(doc_numerodelibro, '') NUMERODELIBRO,
                    IFNULL(doc_estadopago, '') ESTADOPAGO,
                    IFNULL(doc_formapago, '') FORMAPAGO,
                    IFNULL(doc_comisiona, '') COMISIONA,
                    IFNULL(doc_comision_notario, '') COMISIONNOTARIO,
                    IFNULL(doc_comision_matrizador, '') COMISIONMATRIZADOR,
                    IFNULL(doc_retencion, '') RETENCION,
                    IFNULL(doc_ret_iva, '') RET_IVA,
                    IFNULL(doc_ret_ir, '') RET_IR"
                )
                    ->from('documentos d')
                    ->join('Usuarios u', 'u.usr_codigo=d.usr_codigo')
                    ->where ( 'doc_estadopago="Por Cobrar" AND doc_cod_doc='.$tipo.' and doc_estado=true and (doc_fecha_emision  BETWEEN '."'".$datetimemin."'".' AND '."'".$datetimemax."'".')')
                    ->order ('doc_fecha_emision')
                    ->queryAll()
                    ;
           CsvExport::export(
                $query,
                   
                array(
                    'FECHA'=>array('date'),
                    'FACTURA'=>array('text'),
                    'NOMBRES'=>array('text'),
                    'SUBTOTAL'=>array('text'),
                    'IVA'=>array('text'),
                    'TOTAL'=>array('text'),
                    'CEDULA'=>array('text'),
                    'TIPO'=>array('text'),
                    'CORREO'=>array('text'),
                    'DIRECCION'=>array('text'),
                    'TELEFONO1'=>array('text'),
                    'TELEFONO2'=>array('text'),
                    'MATRIZADOR'=>array('text'),
                    'NUMERODELIBRO'=>array('text'),
                    'ESTADOPAGO'=>array('text'),
                    'FORMAPAGO'=>array('text'),
                    'COMISIONA'=>array('boolean'),
                    'COMISIONNOTARIO'=>array('text'),
                    'COMISIONMATRIZADOR'=>array('text'),
                    'RETENCION'=>array('boolean'),
                    'RET_IVA'=>array('text'),
                    'RET_IR'=>array('text'),
                ),
           true, // boolPrinxtRows
           "PorCobrar-{$_POST['doc_fecha_emisionInicio']}-{$_POST['doc_fecha_emisionFin']}.xls"
           );
        }
      
   }
  
   else  $this->render('factporpagar',array('model'=>$model));
      

}
       
        
public function actionCoco()
    {
            var_dump($this);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Documentos;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Documentos']))
        {
            $model->attributes=$_POST['Documentos'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->doc_codigo));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Documentos']))
        {
// Comento esta línea y agrego las otras dos porque esta no funca
//            $model->attributes=$_POST['Documentos'];
            foreach($_POST['Documentos'] as $key => $val)
                $model->setAttribute($key, $val);
            if($model->save())
//                $this->redirect(array('view','id'=>$model->doc_codigo));
                $this->redirect(array('admin'));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
           
                $model=new Documentos('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Documentos']))
            $model->attributes=$_GET['Documentos'];

        $this->render('index',array(
            'model'=>$model,
        ));
//                exit();
//                    $filtersConcurso= new FiltersForm;
//                    if (isset($_GET['FiltersForm']))
//                    {$filtersConcurso->filters=$_GET['FiltersForm'];}
//                    $model = Documentos::fnListDocuments(Yii::app()->user->id);
//                    $filteredData=$filtersConcurso->filter($model);
//                    $dataProvider=new CArrayDataProvider($filteredData,array(
//                        'keyField'=>false,
//                        'pagination'=>array(
//                            'pageSize'=>10,
//                            ),
//                        ));
//                   
//        $this->render('index',array(
//            'model'=>$dataProvider,
//                        'filter'=>$filtersConcurso,
//        ));
           
          
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
           $model=new Documentos('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Documentos']))
        $model->attributes=$_GET['Documentos'];
                else $model->doc_codigo = -1;
                 //$model=$model->findAll(array('limit'=>'1','order'=>'doc_codigo desc'));
                $this->render('admin',array('model'=>$model));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Documentos the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Documentos::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Documentos $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='documentos-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
       
       
       
        public function actionDescarga($id,$ext){
            if ($ext==='.xml')
                $filecontent=file_get_contents( Yii::app()->params['rutaxml'] . $id .$ext);
            else
                $filecontent=file_get_contents( Yii::app()->params['rutapdf'] . $id .$ext);  
            header("Content-Type: application/".$ext);
            header("Content-disposition: attachment; filename=$id".$ext);
            echo $filecontent;
            exit;
       }
      
         public function actionPdf($id){
            Yii::import('application.views.documentos.pdf');
            $pdf=new pdf();
            $pdf->run($id, Yii::app()->params['rutapdf'],false);

        }
      
}


     
