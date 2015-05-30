<?php
/* @var $this DocumentosController */
/* @var $data Documentos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->doc_codigo), array('view', 'id'=>$data->doc_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usr_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->usr_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_clave_acceso')); ?>:</b>
	<?php echo CHtml::encode($data->doc_clave_acceso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_cod_doc')); ?>:</b>
	<?php echo CHtml::encode($data->doc_cod_doc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_fecha_emision')); ?>:</b>
	<?php echo CHtml::encode($data->doc_fecha_emision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_valor_total')); ?>:</b>
	<?php echo CHtml::encode($data->doc_valor_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_num_documento')); ?>:</b>
	<?php echo CHtml::encode($data->doc_num_documento); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_estado')); ?>:</b>
	<?php echo CHtml::encode($data->doc_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_fecadd')); ?>:</b>
	<?php echo CHtml::encode($data->doc_fecadd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_fecupd')); ?>:</b>
	<?php echo CHtml::encode($data->doc_fecupd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usr_codigoupd')); ?>:</b>
	<?php echo CHtml::encode($data->usr_codigoupd); ?>
	<br />

	*/ ?>

</div>