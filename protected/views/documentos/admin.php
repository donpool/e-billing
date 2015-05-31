<script>
    jQuery(document).ready(function() {
        jQuery('#docAdmin').addClass('active');
//        jQuery('.rebutton').click();
    });
</script>
<style>
    #documentos-grid_c1 { width: auto; }
</style>

<div class="page-title">  </div>
<?php
    $this->widget('application.extensions.mbmenu.MbMenu',array(
        'items'=>array(
            array('label'=>'OPCIONES',
                'items'=>array(
                    array('label'=>'Administrar Archivos', 'url'=>array('admin')),
                ),
            ),
            array('label'=>'Exportar CSV', 'url'=>array('exportar'),),
        ),
    )); 
?>
<center>
<?php   
    $this->widget('ext.coco.CocoWidget'
        ,array(
            'id'=>'cocowidget',
            'onCompleted'=>'function(id,filename,jsoninfo){  jQuery.fn.yiiGridView.update("documentos-grid"); }',
            'onCancelled'=>'function(id,filename){ alert("cancelled"); }',
            'onMessage'=>'function(m){ alert(m); }',
            'allowedExtensions'=>array('xml','pdf'), // server-side mime-type validated
            'sizeLimit'=>2000000, // limit in server-side and in client-side
            'uploadDir' => Yii::app()->params['rutatmp'], // coco will @mkdir it
            // this arguments are used to send a notification
            // on a specific class when a new file is uploaded,
            'receptorClassName'=>'application.models.Upload',
            'methodName'=>'onFileUploaded',
            'userdata'=>$model->usr_codigo,//$modelconcurso->rawData['con_informe'],//$model->primaryKey,
            // controls how many files must be uploaded
            'maxUploads'=>100, // defaults to -1 (unlimited)
            'maxUploadsReachMessage'=>'No more files allowed', // if empty, no message is shown
            // controls how many files the can select (not upload, for uploads see also: maxUploads)
            'multipleFileSelection'=>true, // true or false, defaults: true
            'buttonText'=>'Subir Documentos',
            'dropFilesText'=>'Suelte aqui !',
            'htmlOptions'=>array('style'=>'width: 680px;height:auto; display:;'),
            //            'defaultControllerName'=>'documentos',
            //            'defaultActionName'=>'coco',
        )
    );
?>
</center>

<div class="search-form" style="display:">
<?php 
    $this->renderPartial('_search',array(
        'model'=>$model,
    ));
?> 
</div>
<?php
    Yii::app()->clientScript->registerScript('search', "
        $('.search-button').click(function(){
            $('.search-form').toggle();
            return false;
        });
        $('.search-form form').submit(function(){
            $('#documentos-grid').yiiGridView('update', {
                data: $(this).serialize()
            });
            return false;
        });
    ");
?>
</br>
<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'documentos-grid',
        'dataProvider'=>$model->search(null),
        //'filter'=>$model,
        'summaryText' => "Mostrando {start} – {end} de {count} resultados",
        'pager'=>array(
        'header' => 'Ir a la pagina:',
        'firstPageLabel' => '< <',
        'prevPageLabel' => 'Anterior',
        'nextPageLabel' => 'Siguiente',
        'lastPageLabel' => '>>;',),
        'columns'=>array(
            array(
                'header'=>'No.',
                'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{update}',
                'htmlOptions'=>(array('align'=>'center','width'=>'10px','class'=>'update-button')),
            ),
            array(
                'name' => 'Usuarios.usr_ruc',
                'header' => 'Identificación',
                'filter' => CHtml::activeTextField($model, 'usr_codigo'),
                'value' => '$data->Usuarios->usr_ruc',
                'htmlOptions'=>(array('width'=>'40px')),
            ),
            array(
                'name' => 'Usuarios.usr_nombre',
                'header' => 'Razon Social',
                'filter' => CHtml::activeTextField($model, 'usr_codigo'),
                'value' => '$data->Usuarios->usr_nombre',
            ),
            array(
                'name' => 'Usuarios.usr_emal',
                'header' => 'E-mail'
            ),
            array(
                'name'=>'doc_cod_doc',
                'header'=>'Tipo',
                'htmlOptions'=>(array('width'=>'auto')),
                'filter'=>array(1=>"Factura",4=>"Nota de Credito",5=>"Nota de Debito",6=>"Guia de Remisión",7=>"Comprobante de Retencion"),
                'value'=>function($data) {
                    if ($data->doc_cod_doc  == 1) {
                        $class = 'Factura';
                    }
                    else if ($data->doc_cod_doc == 4) {
                        $class = 'Nota de Credito';
                    }
                    else if ($data->doc_cod_doc == 5) {
                        $class = 'Nota de Debito';
                    }
                    else if ($data->doc_cod_doc == 6) {
                        $class = 'Guia de Remisión';
                    }
                    else if ($data->doc_cod_doc == 7) {
                        $class = 'Comprobante de Retención';
                    }
                    else{
                        $class = 'S/D';
                    }
                    return $class; 
                },
            ),
            'doc_num_documento', 
    //      'doc_clave_acceso',
            'doc_matrizador',
            'doc_numerodelibro',
            'doc_subtotal',
            'doc_iva',
            'doc_total',
            array('name'=>'doc_fecha_emision', 'htmlOptions'=>array('width'=>'10%')),
            array(
                'name'=>'doc_clave_acceso',
                'header'=>'pdf',
                'htmlOptions'=>(array('align'=>'center')),
                'type'=>'raw',
                'value'=>function($data) {
                    if ($data->doc_cod_doc==1 || $data->doc_cod_doc==4 || $data->doc_cod_doc==7 || $data->doc_cod_doc==6 ) {
                        if (file_exists(Yii::app()->params['rutapdf'].str_replace("-", "",$data->doc_clave_acceso).'.pdf'))
                            $class = CHtml::link(CHtml::image(Yii::app()->baseUrl."/images/pdf.png","pdf",array("title"=>"Descarga archivos pdf")), array("documentos/descarga","id"=>str_replace("-", "",$data->doc_clave_acceso),"ext"=>".pdf"));
                        else
                            $class = CHtml::link(CHtml::image(Yii::app()->baseUrl."/images/pdf.png","pdf",array("title"=>"Descarga archivo pdf.")), array("documentos/pdf","id"=>$data->doc_clave_acceso));
                    } else          
                        $class ='-';
                    echo $class;
                },
            ),
            array(
                'name'=>'doc_clave_acceso',
                'header'=>'xml',
                'htmlOptions'=>(array('align'=>'center')),
                'type'=>'raw',  
                'value'=>function($data) {
                    if (file_exists(Yii::app()->params['rutaxml'].str_replace("-", "",$data->doc_clave_acceso).'.xml')){
                        $class = CHtml::link(CHtml::image(Yii::app()->baseUrl."/images/xml.png","xml",array("title"=>"Descarga archivos xml")), array("documentos/descarga","id"=>str_replace("-", "",$data->doc_clave_acceso),"ext"=>".xml"));
                    } else          
                        $class ='-'; //Yii::getPathOfAlias('webroot').Yii::app()->params['rutaxml'].str_replace("-", "",$data->doc_clave_acceso).'.xml' ;
                    echo $class; 
                },
            ),
        ),
    )); 

