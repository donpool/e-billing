
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
       
        <?php echo $form->labelEx($model,'Password',array('class'=>'log-lab')) ?>
        <?php echo $form->passwordField($model,'password',array('class'=>'login-input-user')); ?>
              
    
        <div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

        <?php echo CHtml::submitButton('Login',array("submit"=>array("user/index"),"class"=>"button")); ?>
        
<?php $this->endWidget(); ?>
    </div>
</div>


<!--
<div class="loginform">
	<div class="title"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo.png" width="112" height="35" /></div>
    <div class="body">
   	  <form id="form1" name="form1" method="post" action="index.html">
      	<label class="log-lab">Username1</label>
        <input name="textfield" type="text" class="login-input-user" id="user" value="Admin"/>
      	<label class="log-lab">Password</label>
        <input name="textfield" type="password" class="login-input-pass" id="password" value="Password"/>
        <input type="submit" name="button" id="button" value="Login" class="button"/>
        <?php //echo CHtml::submitButton('Login',array()); ?>
   	  </form>
    </div>
</div>

-->
