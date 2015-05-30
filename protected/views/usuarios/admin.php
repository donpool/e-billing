<script>
    jQuery(document).ready(function() {
     jQuery('#usuarios').addClass('active');
	});

</script>
<div class="page-title">  </div>
<?php
 $this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>array(
                array('label'=>'OPERACIONES',
                  'items'=>array(
                    array('label'=>'Administrar Usuarios', 'url'=>array('admin')),
                        array('label'=>'Crear Usuarios', 'url'=>array('create')),
                  ),
                ),
            ),
    )); 
 ?>

<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#usuarios-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    
<?php 
//$this->renderPartial('_search',array(
//	'model'=>$model,
//)); 
?>
    
</div><!-- search-form -->

<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuarios-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
              array(
                    'header'=>'No.',
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                  ),
		//'usr_codigo',
		'usr_nombre',
		'usr_ruc',
//		'usr_password',
		'usr_emal',
		'usr_direccion',
            array(
                    'name'=>'usr_estado',
		    'value'=>'($data->usr_estado)?"Activo":"Inactivo"',
                    ),
		/*'usr_fecadd',
		'usr_fecupd',
		*/
		array(
			'class'=>'CButtonColumn',
			 'template'=>'{view}{update}',
			
		),
	),
)); ?>
