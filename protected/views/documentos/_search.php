<?php
/* @var $this DocumentosController */
/* @var $model Documentos */
/* @var $form CActiveForm */

?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	//'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
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
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'language' => 'es',
                    'attribute' => 'doc_fecha_emision',
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
                ));
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
            <?php echo $form->dropDownList($model,'doc_cod_doc',array (1=>"Factura",4=>"Nota de Credito",5=>"Nota de Debito",6=>"Guia de Remisión",7=>"Comprobante de Retencion"),array("empty"=>"Todos...")); ?></td>
        </td>
        <td>Número:</td>
        <td>
          <?php echo $form->textField($model,'doc_num_documento',array('size'=>35,'maxlength'=>100)); ?>  
        </td>
    </tr>
     <tr>
        <td width='2%'></td>
        <td><b>Cliente</b></td>
        <td>RUC./CI::</td>
        <td>
            <?php echo Chtml::textField('usr_ruc','');?></td>
        </td>
        <td>Nombre:</td>
        <td>
          <?php echo $form->textField($model,'usr_codigo',array('size'=>35)); ?>
        </td>
        
    </tr>
    <tr>
        <td colspan="2"></td>
        <td>E-mail</td>
        <td>
              <?php echo Chtml::textField('usr_email','',array('size'=>40)); ?>
        </td>
        <td># Libro</td>
        <td>
            <?php echo $form->textField($model,'doc_numerodelibro'); ?>
        </td>
    </tr>
    <tr><td colspan="6" align='center'>
          <?php echo CHtml::submitButton('Buscar', array('class' => 'rebutton')); ?>
          <?php echo CHtml::submitButton('Limpiar', array('class' => 'rebutton','onclick'=>'window.location.reload()')); ?> 
        </td></tr>
</table>
    </center>


<?php $this->endWidget(); ?>

</div><!-- search-form -->
