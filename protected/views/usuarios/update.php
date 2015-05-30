<div class="page-title">  </div>
<?php
 $this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>array(
                array('label'=>'OPERACIONES',
                  'items'=>array(
                    array('label'=>'Administrar Usuarios', 'url'=>array('admin')),
                    array('label'=>'Asignar Rol Usuarios', 'url'=>array('view', 'id'=>$model->usr_codigo)),
                    array('label'=>'Crear Usuarios', 'url'=>array('create')),
                  ),
                ),
            ),
    )); 


?>
</br>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>