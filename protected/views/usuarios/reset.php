<script>
    function fnValidar(){
    var error = 0;
    jQuery('.requerido').each(function(i, elem){
     
              if(jQuery(elem).val() == ''){
            jQuery(elem).addClass( "error" );
            error++;
            }
         else jQuery(elem).removeClass( "error" );
        });
        
        if (jQuery("#password1").val() != jQuery("#password2").val() ){
              jQuery("#mensaje").html('No Coinciden Los Password');
             error++;
            }
         else {
              jQuery("#mensaje").html('');
         }
        return error
    }
 
</script>
<style>
    .error
{
	background: #FEE;
	border-color: #C00;
}
    .log-lab{
    color: #a4aab2;
    display: block;
    font-size: 12px;
    font-weight: bold;
    padding-bottom: 11px;}
    
    

</style>
</br>
    <div>
              <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'frmCambio',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
            )); ?>
        
        <div class="page-title" align="center"><h1>- CAMBIAR PASSWORD -</h1></div>
        <center>
        <table width="60%"  border='1'>
            <tr>
                <th colspan='3' height="50" align="left"></th></tr>
            
            <tr>
           
                <td width='3%'></td>
                <td width='35%'><?php echo CHtml::label('Password Existente;','username',array('class'=>'log-lab')) ?></td>
                <td> <?php echo CHtml::passwordField('password0','',array('class'=>'pass requerido')); ?></td>
            </tr>
            
            <tr>
           
                <td width='3%'></td>
                <td width='25%'><?php echo CHtml::label('Nuevo Password:','username',array('class'=>'log-lab')) ?></td>
                <td> <?php echo CHtml::passwordField('password1','',array('class'=>'pass requerido')); ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?php echo CHtml::label('Nuevo Password (Confirmar):','username',array('class'=>'log-lab')) ?></td>
                <td><?php echo CHtml::passwordField('password2','',array('class'=>'pass requerido')); ?></td>
            </tr>
            
            <tr><td colspan='3' align='center'><div id='mensaje' style="height:25px ;color:red" ><?php  echo(isset($error)?$error:"") ?></div></td></tr>
            <tr align='center'><td colspan='3'><?php echo CHtml::submitButton('Actualizar',array("class"=>" rebuttonwide2 rebuttonwide2final","onClick"=>"  if(fnValidar()>0) return false;")); ?></td></tr>
            
        </table>
    </center>
        </br>
        
        
        <?php $this->endWidget(); ?>
    </div>
