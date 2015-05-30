<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

$this->breadcrumbs=array(
	'Documentoses'=>array('index'),
	$model->doc_codigo=>array('view','id'=>$model->doc_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Documentos', 'url'=>array('index')),
	array('label'=>'Create Documentos', 'url'=>array('create')),
	array('label'=>'View Documentos', 'url'=>array('view', 'id'=>$model->doc_codigo)),
	array('label'=>'Manage Documentos', 'url'=>array('admin')),
);
?>

<h1>Update Documentos <?php echo $model->doc_codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>