<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
?>
<div class="page-title">  </div>
<?php

 $this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>array(
                array('label'=>'OPERACIONES',
                  'items'=>array(
                    array('label'=>'Administrar usuarios', 'url'=>array('admin')),
                    array('label'=>'Crear usuarios', 'url'=>array('create')),
                  ),
                ),
            ),
    )); 
 
?>
</br>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>