<?php
/* @var $this DocumentosController 2015*/
/* @var $model Documentos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documentos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    <?php $fields = array(
        'Usuarios.usr_ruc',
        'Usuarios.usr_nombre',
        'doc_clave_acceso',
        'doc_fecha_emision',
        'doc_total',
        'doc_matrizador',
    );
    foreach($fields as $field) : ?>
	<div class="row">
    <?php 
        if(strstr($field, '.')) {
            $parts = explode('.', $field);
            $label = $model->$parts[0]->$parts[1];
        } else
            $label = $model->$field;
        echo $form->labelEx($model,$field) . $label; 
    ?>
	</div>
    <?php endforeach; ?>
    
	<div class="row">
		<?php echo $form->labelEx($model,'doc_numerodelibro'); ?>
		<?php echo $form->textField($model,'doc_numerodelibro'); ?>
		<?php echo $form->error($model,'doc_numerodelibro'); ?>
	</div>
<!--

	<div class="row">
		<?php echo $form->labelEx($model,'doc_clave_acceso'); ?>
		<?php echo $form->textField($model,'doc_clave_acceso'); ?>
		<?php echo $form->error($model,'doc_clave_acceso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'doc_cod_doc'); ?>
		<?php echo $form->textField($model,'doc_cod_doc'); ?>
		<?php echo $form->error($model,'doc_cod_doc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'doc_fecha_emision'); ?>
		<?php echo $form->textField($model,'doc_fecha_emision'); ?>
		<?php echo $form->error($model,'doc_fecha_emision'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'doc_valor_total'); ?>
		<?php echo $form->textField($model,'doc_valor_total'); ?>
		<?php echo $form->error($model,'doc_valor_total'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'doc_estado'); ?>
		<?php echo $form->textField($model,'doc_estado'); ?>
		<?php echo $form->error($model,'doc_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'doc_fecadd'); ?>
		<?php echo $form->textField($model,'doc_fecadd'); ?>
		<?php echo $form->error($model,'doc_fecadd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'doc_fecupd'); ?>
		<?php echo $form->textField($model,'doc_fecupd'); ?>
		<?php echo $form->error($model,'doc_fecupd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usr_codigoupd'); ?>
		<?php echo $form->textField($model,'usr_codigoupd'); ?>
		<?php echo $form->error($model,'usr_codigoupd'); ?>
	</div>
-->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Grabar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
