<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'usr_codigo'); ?>
		<?php echo $form->textField($model,'usr_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usr_nombre'); ?>
		<?php echo $form->textField($model,'usr_nombre',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usr_ruc'); ?>
		<?php echo $form->textField($model,'usr_ruc',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usr_emal'); ?>
		<?php echo $form->textField($model,'usr_emal',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usr_direccion'); ?>
		<?php echo $form->textArea($model,'usr_direccion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usr_estado'); ?>
		<?php echo $form->textField($model,'usr_estado'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->