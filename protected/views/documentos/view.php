<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

$this->breadcrumbs=array(
	'Documentoses'=>array('index'),
	$model->doc_codigo,
);

$this->menu=array(
	array('label'=>'List Documentos', 'url'=>array('index')),
	array('label'=>'Create Documentos', 'url'=>array('create')),
	array('label'=>'Update Documentos', 'url'=>array('update', 'id'=>$model->doc_codigo)),
	array('label'=>'Delete Documentos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->doc_codigo),'confirm'=>'¿Está seguro de eliminar este documento?')),
	array('label'=>'Manage Documentos', 'url'=>array('admin')),
);
?>

<h1>View Documentos #<?php echo $model->doc_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'doc_codigo',
		'usr_codigo',
		'doc_clave_acceso',
		'doc_cod_doc',
		'doc_fecha_emision',
		'doc_valor_total',
		'doc_num_documento',
		'doc_estado',
		'doc_fecadd',
		'doc_fecupd',
		'usr_codigoupd',
	),
)); ?>
