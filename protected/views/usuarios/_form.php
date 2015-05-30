<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	'enableAjaxValidation'=>false,
)); ?>
    <center>
<table class="ui-widget-content" width="90%" align='center' border ='1'> 
    <tr   height="30px" align="center">
        <td colspan="6"> <h1>INFORMACIÓN GENERAL</h1></td>
    </tr>
    <tr> <td></td><td colspan="3" height='35px'>	
            <p class="note"> Los campos que contienen <span class="required">*</span> son requeridos.</p></td>
    </tr>
    <tr>
        <td width='2%'></td>
        <td width='10%'><?php echo $form->labelEx($model,'usr_nombre'); ?></td>
	<td><?php echo $form->textField($model,'usr_nombre',array('size'=>100,'maxlength'=>500)); ?></td>
    </tr>
 
     <tr>
        <td width='2%'></td>
        <td width='10%'><?php echo $form->labelEx($model,'usr_ruc'); ?></td>
	<td><?php echo $form->textField($model,'usr_ruc',array('size'=>20,'maxlength'=>20)); ?></td>
    </tr>
     <tr>
        <td width='2%'></td>
        <td width='10%'><?php echo $form->labelEx($model,'usr_password'); ?></td>
	<td><?php echo $form->passwordField($model,'usr_password',array('size'=>60,'maxlength'=>100)); ?></td>
    </tr>
     <tr>
        <td width='2%'></td>
        <td width='10%'><?php echo $form->labelEx($model,'usr_emal'); ?></td>
	<td><?php echo $form->textField($model,'usr_emal',array('size'=>60,'maxlength'=>200)); ?></td>
    </tr>
    <tr>
        <td width='2%'></td>
        <td width='10%'><?php echo $form->labelEx($model,'usr_direccion'); ?></td>
	<td><?php echo $form->textArea($model,'usr_direccion',array('rows'=>2, 'cols'=>100)); ?></td>
    </tr>
     <tr>
        <td width='2%'></td>
        <td width='10%'><?php echo $form->labelEx($model,'usr_estado',array('class'=>'label')); ?> </td>
	<td><?php echo $form->dropDownList($model,'usr_estado',array ("1"=>"Activo","0"=>"Inactivo")); ?></td>
    </tr>
    
</table>
     <div class="row buttons" align='center'>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class' => 'rebuttonwide2 rebuttonwide2final')); ?>
	</div>
    </center>
<?php $this->endWidget(); ?>

</div><!-- form -->