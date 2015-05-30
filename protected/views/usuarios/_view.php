<?php
/* @var $this UsuariosController */
/* @var $data Usuarios */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('usr_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->usr_codigo), array('view', 'id'=>$data->usr_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usr_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->usr_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usr_ruc')); ?>:</b>
	<?php echo CHtml::encode($data->usr_ruc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usr_password')); ?>:</b>
	<?php echo CHtml::encode($data->usr_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usr_emal')); ?>:</b>
	<?php echo CHtml::encode($data->usr_emal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usr_direccion')); ?>:</b>
	<?php echo CHtml::encode($data->usr_direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usr_estado')); ?>:</b>
	<?php echo CHtml::encode($data->usr_estado); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('usr_fecadd')); ?>:</b>
	<?php echo CHtml::encode($data->usr_fecadd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usr_fecupd')); ?>:</b>
	<?php echo CHtml::encode($data->usr_fecupd); ?>
	<br />

	*/ ?>

</div>

