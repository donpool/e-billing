jQuery(document).ready(function () {
    
//     jQuery('input').keyup(function() {
//            this.value = this.value.toLocaleUpperCase();
//        });
        jQuery('textarea').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });

    jQuery('input.numberinput').bind('keypress', function (e) {
        return !(e.which != 8 && e.which != 0 &&
                (e.which < 48 || e.which > 57) && e.which != 46);
    });});


     function allFine(data) {
        if(data)
        {var obj = jQuery.parseJSON(data);
         alert(obj.data);}
                // display data returned from action
                //jQuery("#results").html(data);
                // refresh your grid
                jQuery.fn.yiiGridView.update('mdl-tthhexpediente-grid');
        }

function fnValidar(){
    
        var error = 0;
    jQuery('.requerido').each(function(i, elem){
              if(jQuery(elem).val() == ''){
            jQuery(elem).addClass( "error" );
            error++;
            }
         else jQuery(elem).removeClass( "error" );
        });
        return error
    }
    
    
    function fnPrueba(){
        var myDialog = jQuery("#idexpediente")
        alert(myDialog);
    // jQuery("#idexpediente").dialog("close");
        
    }
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


