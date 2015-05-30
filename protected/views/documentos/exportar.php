<div class="page-title">  </div>
<?php
 $this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>array(
                   array('label'=>'Administrar Archivos', 'url'=>array('admin')
                ),
            ),
    )); 
 ?>

<div class="wide form">
<?php $form=$this->beginWidget('CActiveForm', array(
	//'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>
<center>
    </br>        
<table class="ui-widget-content" width="80%" align='center' border ='0'> 
    <tr  bgcolor="" height="20px" align="center">
        <td colspan="6"><font color=""> <h1>BÚSQUEDA</h1></font></td>
    </tr>
    <tr> 
        <td width='2%'></td>
        <td width='15%'><b>Fecha</b></td>
        <td>Desde:</td>
        <td>
	    <?php  
                $this->widget(
                    'zii.widgets.jui.CJuiDatePicker',
                    array(
                        'language' => 'es',
                        'name' => 'doc_fecha_emisionInicio',
                        'htmlOptions' => array(
                        'size' => '10',         // textField size
                        'maxlength' => '10',    // textField maxlength
                        ),
                         'options'=>array(
                                    'autoSize'=>true,
                                    'dateFormat'=>'yy-mm-dd',
                                    'buttonImage'=>Yii::app()->theme->baseUrl.'/img/icons/sidemenu/calendar.png',
                                    'buttonImageOnly'=>true,
                                    'selectOtherMonths'=>true,
                                    'showAnim'=>'slide',
                                    'showButtonPanel'=>true,
                                    'showOn'=>'button',
                                    'showOtherMonths'=>true,
                                    'changeMonth' => 'true',
                                    'changeYear' => 'true',
                                ),
                    )
                );
            ?>
        </td>
        <td>Hasta:</td>
        <td>
            <?php  
                $this->widget(
                    'zii.widgets.jui.CJuiDatePicker',
                    array(
                        'language' => 'es',
                        'name' => 'doc_fecha_emisionFin',
                        'htmlOptions' => array(
                        'size' => '10',         // textField size
                        'maxlength' => '10',    // textField maxlength
                        ),
                         'options'=>array(
                                    'autoSize'=>true,
                                    'dateFormat'=>'yy-mm-dd',
                                    'buttonImage'=>Yii::app()->theme->baseUrl.'/img/icons/sidemenu/calendar.png',
                                    'buttonImageOnly'=>true,
                                    'selectOtherMonths'=>true,
                                    'showAnim'=>'slide',
                                    'showButtonPanel'=>true,
                                    'showOn'=>'button',
                                    'showOtherMonths'=>true,
                                    'changeMonth' => 'true',
                                    'changeYear' => 'true',
                                ),
                    )
                );
            ?>
        </td>
    </tr>
    <tr>
        <td width='2%'></td>
        <td><b>Documento</b></td>
        <td>Tipo:</td>
        <td>
            <?php echo $form->dropDownList($model,'doc_cod_doc',array (1=>"Factura",4=>"Nota de Credito")); ?></td>
        </td>
        <td></td>
        <td>
        </td>
    </tr>
   
    <tr>
        <td colspan="6" align='center'>
          <?php echo CHtml::submitButton('Exportar CSV', array('class' => 'rebutton','onclick'=>'if ((jQuery ("#doc_fecha_emisionInicio").val()=="")&&jQuery ("#doc_fecha_emisionFin").val()=="") {alert ("Fechas Requeridas"); return false;}')); ?>
          <?php echo CHtml::submitButton('Limpiar', array('class' => 'rebutton','onclick'=>'window.location.reload()')); ?> 
        </td>
    </tr>
</table>
    </center>


<?php $this->endWidget(); ?>

</div><!-- search-form -->