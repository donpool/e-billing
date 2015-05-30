
<div class="page-title">  </div>
<?php
 $this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>array(
                array('label'=>'OPERACIONES',
                  'items'=>array(
                    array('label'=>'Crear Usuarios', 'url'=>array('create')),
                    array('label'=>'Actualizar Usuarios', 'url'=>array('update', 'id'=>$model->usr_codigo)),
                    array('label'=>'Administrar Usuarios', 'url'=>array('admin')),
                  ),
                ),
            ),
    )); 
 ?>

</br>
<h1>Rol Usuarios</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'usr_codigo',
		'usr_nombre',
		'usr_ruc',
		//'usr_password',
		'usr_emal',
		'usr_direccion',
		array('name'=>'usr_estado',"value"=>($model->usr_estado)? 'Activo': 'Inactivo',),
		'usr_fecadd',
		//'usr_fecupd',
	),
)); ?>
</br>

<table class=" ui-widget-content  " width="98%" align="center" border ="1" ">
    <thead>
        <tr bgcolor='#636663'>
        <th  width='20%' colspan='2' align="center" ><font color ="#FFFFF">Rol</font></th>
        <th><font color ="#FFFFF">Descripción</font></th>
        <th align="left"><font color ="#FFFFF">Estado</font></th>
        <th align="rigth "><font color ="#FFFFF">Accion</font></th>
        <th>-</th>
        </tr>
    </thead>
    <tbody>
            <?php 
              foreach  (Yii::app()->authmanager->getAuthItems(2) as $data) :
              $enabled= Yii::app()->authmanager->checkAccess($data->name,$model->usr_codigo) 
             ?> 
                   <tr>
                       <td width='3%'>&nbsp;</td>
                       <td><?php echo $data->name ?></td>
                       <td><?php echo  $data->description ?> </td>    
                       <td width='8%' align="left" > <?php echo $enabled? "<font color='#3EF531'> Asignado</font>":""; ?> </td>
                       <td align="left" class="ui-icon-alert">
                           <img src="
                            <?php echo Yii::app()->theme->baseUrl; ?>/img/icons/sidemenu/copy.png" width="16" height="16" alt="icon"/>
                            <?php  echo Chtml::link($enabled?" <font color ='red'>Inactivar </font>":"<font color ='#41973B'>Activar </font>",
                                   array("usuarios/assign","id"=>$model->usr_codigo,"item"=>$data->name))  
                            ?>
                       </td>
                       
                       
                   </tr>
            <?php endforeach; ?>
     </tbody>
</table>
