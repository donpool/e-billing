<?php


function number_pad($number,$n) {
return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

function fnLeerFactura($languages){
    
$html.='';
$html.='<br><div id="rounded-box" style=" left: 0; position: static;  width:100%" >';
$html.='<table  width="100%"  cellspacing="8" cellpadding="8">';
$html.='<tr><td width="2%"></td><td width="140px">Fecha de Emision</td><td>'.$languages->infoFactura->fechaEmision.'</td></tr> ';
$html.='<tr><td width="2%"></td><td>Razon Social</td><td>'.$languages->infoFactura->razonSocialComprador.'</td></tr>';
$html.='<tr><td width="2%"></td><td>CI/RUC</td><td>'.$languages->infoFactura->identificacionComprador.'</td></tr>';
$html.='</table></div><br>';
$html.='<table class="detalle" width="100%" border="1" >';
$html.='<tr><th>Cod.<br>Principal</th><th>Cod.<br>Auxiliar</th><th>Descripción</th><th>Cantidad</th><th>Precio<br>Unitario</th><th>Descuento</th><th>Precio<br>Total</th></tr> ';
foreach ($languages->detalles->detalle as $value) {
$html.='<tr><td align="center">'.(string)$value->codigoPrincipal.'</td><td align="center">'.(string)$value->codigoAuxiliar.'</td><td align="center">'.(string)$value->descripcion.'</td>';
$html.='<td align="center">'.(string)$value->cantidad.'</td><td align="center">'.(string)$value->precioUnitario.'</td><td align="center">'.(string)$value->descuento.'</td><td align="right" width="120px">'.(string)$value->precioTotalSinImpuesto.'</td></tr>';
}
$html.='</table>';
$html.='<table  class="detalle" width="40%" border="1"  align="right" >';
$html.='<tr><td colapan=3>SUBTOTAL 12%</td><td align="right" width="83px">'.$languages->infoFactura->totalConImpuestos->totalImpuesto->baseImponible.'</td></tr>';
$html.='<tr><td colapan=3>SUBTOTAL SIN IMPUESTOS</td><td align="right">'.$languages->infoFactura->totalSinImpuestos.'</td></tr>';
$html.='<tr><td colapan=3>DESCUENTO</td><td align="right">'.$languages->infoFactura->totalDescuento.'</td></tr>';
$html.='<tr><td colapan=3>IVA 12%</td><td align="right">'.$languages->infoFactura->totalConImpuestos->totalImpuesto->valor.'</td></tr>';
$html.='<tr><td colapan=3>PROPINA</td><td align="right">'.$languages->infoFactura->propina.'</td></tr>';
$html.='<tr><td colapan=3 >VALOR TOTAL</td><td  align="right" width="120px">'.$languages->infoFactura->importeTotal.'</td></tr>';
$html.='</table>';


return $html;

}
function fnLeerInfoTributaria($data){
switch ($data->codDoc) {
case 1: $tipodocumento='F A C T U R A'; break;
case 4: $tipodocumento='NOTA DE CRÉDITO'; break;
case 5: $tipodocumento= 'NOTA DE DÉBITO'; break;
case 6: $tipodocumento='GUÍA DE REMISIÓN'; break;
case 7: $tipodocumento='COMPROBANTE DE RETENCIÓN'; break;
default: break;
}
$ambiente = ($data->ambiente==2) ? 'Producción' : 'Pruebas';
$html.='<br><br>
        <div id="rounded-box">
        <table cellspacing="10" cellpadding="10"  >
        <tr><td colspan="2" ><h3>'.$tipodocumento.'</h3></td></tr>
        <tr><td width="150px">R.U.C</td><td>'.$data->ruc.'</td></tr>
        <tr><td>N°</td><td>'.$data->estab."-". $data->ptoEmi."-". $data->secuencial.'</td></tr>
        <tr><td width="130px">Nombre Comercial</td><td>'.$data->nombreComercial.'</td></tr>
        <tr><td>Dirección</td><td>'.$data->dirMatriz.'</td></tr>
        <tr><td>Ambiente:</td><td>'. $ambiente.'</td></tr>
        <tr><td>Clave de Acceso</td><td>'.(string) $data->claveAcceso.'</td></tr>
        </table>
        </div>
';
return $html;
}

function fnLeerInfoAdicional($languages){
$data = new stdClass();
foreach ($languages->children() as $key=>$info){
if ($key=='infoAdicional'){
foreach ($info as $node) {
foreach ($node->attributes() as $atr => $value) {
$atributo=(string)$value;
if ($atributo=="Email")
$data->email=(string)$node;
if ($atributo=="Dirección")
$data->direccion=(string)$node;
if ($atributo=="Teléfono")
$data->telefono=(string)$node;
}
}}}
$html.='<div class="principal" style="width:55%;">INFORMACIÓN ADICIONAL';
$html.='<table>';
if (!empty($data->direccion))$html.= '<tr><td width="2%"></td><td >Dirección</td><td>'.(string)$data->direccion. '</td></tr>';
if (!empty($data->telefono)) $html .= '<tr><td></td><td>Teléfono</td><td>'.$data->telefono. '</td></tr>';
if (!empty($data->email)) $html .= '<tr><td></td><td>Email </td><td>'.$data->email. '</td></tr>';;
$html.='</table>';
$html.='</div>';
return $html;
}


function fnLeerArchivo($id){
$html.='<style>
        table.detalle {border-collapse:collapse; border: none; font-family:verdana ; font-size:75%}
        td {padding: 5; font-family:verdana ; font-size:70%}
        div.principal{border-radius:7px; border: 0.2mm solid #000000; padding: 1em;font-family:verdana ; font-size:70%;}
        div#rounded-box {font-family:verdana ; font-size:70%; border: 0.2mm solid #000000; margin:0 auto;padding:1;border-radius:7px;-moz-border-radius: 7px; -webkit-border-radius : 7px;}
        </style>';
$path= Yii::app()->basePath.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'documentos'.DIRECTORY_SEPARATOR.'xml'.DIRECTORY_SEPARATOR.$id.'.xml';
if (file_exists($path)){
$languages = simplexml_load_file($path);
if (!isset ($languages->infoTributaria)){
$languages= simplexml_load_file($path,'SimpleXMLElement', LIBXML_NOCDATA);
$languages= simplexml_load_string($languages->comprobante, 'SimpleXMLElement', LIBXML_NOCDATA);
}
$html.=fnLeerInfoTributaria($languages->infoTributaria);
if ($languages->infoTributaria->codDoc==1)
$html.=fnLeerFactura($languages);
$html.=fnLeerInfoAdicional($languages);
}
else
$html.='Error al Leer el Archivo';

return $html;
}

$header = '
<table width="100%" style="border-bottom: 1px solid #000088; vertical-align: bottom; font-family: serif;">
<tr><td width="36%"><img src= "themes/cupcake/img/logoGeo.png" width="205px" height="85px"/></td>
</table>';

$html = fnLeerArchivo($id);


 //echo $html; exit;

$mpdf = new mPDF('utf-8','LETTER','','',15,15,25,12,5,7);
//$mpdf->SetHeader(Yii::app()->name);
$mpdf->SetHTMLHeader($header);
$mpdf->SetFooter('Este documento no tiene validez tributaria.En caso de ser necesario, remitase al archivo electrónico.');
$mpdf->WriteHTML($html,false);
$mpdf->Output('factura','D');
Yii::app()->end();
?>

