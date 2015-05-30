
<div class="loginform">
    <div class="title"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo.png" width="112" height="35" /></div>
    <div class="body">
   	
              <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
            )); ?>
       <?php echo $form->labelEx($model,'username',array('class'=>'log-lab')) ?>
       <?php echo $form->textField($model,'username',array('class'=>'login-input-user')); ?>
       <?php echo $form->error($model,'username'); ?>
        
        <?php echo $form->labelEx($model,'Password',array('class'=>'log-lab')) ?>
        <?php echo $form->passwordField($model,'password',array('class'=>'login-input-pass')); ?>
        <?php echo $form->error($model,'password'); ?>      
    
        <div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

        <?php echo CHtml::submitButton('Login',array("class"=>"button"));
        ?>
        
        <?php $this->endWidget(); ?>
    </div>
</div>