<script>
    jQuery(document).ready(function() {
     jQuery('#document').addClass('active');
	});

</script>
<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'documentos-grid',
	'dataProvider'=>$model->search(Yii::app()->user->id),
	'filter'=>$model,
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
                    'name'=>'doc_cod_doc',
                    'header'=>'Tipo',
                    'htmlOptions'=>(array('width'=>'auto')),
                    'filter'=>array(1=>"Factura",4=>"Nota de Credito",5=>"Nota de Debito",6=>"Guia de Remisión",7=>"Comprobante de Retencion"),
                    'value'=>function($data){
                        if ($data->doc_cod_doc  == 1){
                        $class = 'Factura';
                        }
                        else if ($data->doc_cod_doc == 4){
                        $class = 'Nota de Credito';
                        }
                        else if ($data->doc_cod_doc == 5){
                        $class = 'Nota de Debito';
                        }
                        else if ($data->doc_cod_doc == 6){
                        $class = 'Guia de Remisión';
                        }
                        else if ($data->doc_cod_doc == 7){
                       $class = 'Comprobante de Retención';
                        }
                        else{
                        $class = 'S/D';
                        }
                        return $class; },
                ),
                                
                'doc_num_documento',                                
                'doc_clave_acceso',
                'doc_fecha_emision' ,
    		array(
                    'name'=>'doc_codigo',
		    'filter'=>false,
                    'header'=>'pdf',
                    'htmlOptions'=>(array('align'=>'center')),
                    'type'=>'raw',
                    'value'=>function($data){
                      if ($data->doc_cod_doc==1 ||  $data->doc_cod_doc==4 || $data->doc_cod_doc==7 || $data->doc_cod_doc==6 ){
                            if (file_exists(Yii::app()->params['rutapdf'].str_replace("-", "",$data->doc_clave_acceso).'.pdf'))
  			    $class = CHtml::link(CHtml::image(Yii::app()->baseUrl."/images/pdf.png","pdf",array("title"=>"Descarga archivos pdf")), array("documentos/descarga","id"=>str_replace("-", "",$data->doc_clave_acceso),"ext"=>".pdf"));
                            else
                              $class = CHtml::link(CHtml::image(Yii::app()->baseUrl."/images/pdf.png","pdf",array("title"=>"Descarga archivo pdf.")), array("documentos/pdf","id"=>$data->doc_clave_acceso));
                        }
                        else          
                        $class ='-';
                        echo $class;
			 },
                 ),

                     array(
                    'name'=>'doc_codigo',
                    'filter'=>false,
                    'header'=>'xml',
                    'htmlOptions'=>(array('align'=>'center')),
                    'type'=>'raw',  
                    'value'=>function($data){
                        if (file_exists(Yii::app()->params['rutaxml'].str_replace("-", "",$data->doc_clave_acceso).'.xml')){
                        $class = CHtml::link(CHtml::image(Yii::app()->baseUrl."/images/xml.png","xml",array("title"=>"Descarga archivos xml")), array("documentos/descarga","id"=>str_replace("-", "",$data->doc_clave_acceso),"ext"=>".xml"));
                        }
                        else          
                         $class = '-';
                        echo $class; },
                 ),
	),
)); ?>
