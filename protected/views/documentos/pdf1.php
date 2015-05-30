<?php


function number_pad($number,$n) {
return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}


function fnLeerRetencion($languages){

$html.='<br>    
<div id="rounded-box" >
      <span>  <table cellspacing="10" cellpadding="10" width="98%"  >
        <tr><td colspan="2"><b>'.$languages->infoTributaria->razonSocial.'</b></td></tr>
        <tr><td colspan="2">'.$languages->infoTributaria->nombreComercial.'</td></tr>
        <tr><td>Dirección Matriz</td><td>'.$languages->infoTributaria->dirMatriz.'</td></tr>
        <tr><td>Dirección Sucursal </td><td>'.$languages->infoCompRetencion->dirEstablecimiento.'</td></tr>
        <tr><td>Contribuyente Especial Nro</td><td>'.$languages->infoCompRetencion->contribuyenteEspecial.'</td></tr>
        <tr><td>Obligado a llevar Contabilidad</td><td>'.$languages->infoCompRetencion->obligadoContabilidad.'</td></tr>
            
        </table></span>
  </div>';

$html.='<br><div id="rounded-box" style=" clear:both; left: 0; position: static;  width:100%" >';
$html.='<table  width="100%"  cellspacing="8" cellpadding="8">';
$html.='<tr><td width="2%"></td><td width="140px">Fecha de Emision</td><td>'.$languages->infoCompRetencion->fechaEmision.'</td></tr> ';
$html.='<tr><td width="2%"></td><td>Razon Social</td><td>'.$languages->infoCompRetencion->razonSocialSujetoRetenido.'</td></tr>';
$html.='<tr><td width="2%"></td><td>CI/RUC</td><td>'.$languages->infoCompRetencion->identificacionSujetoRetenido.'</td></tr>';
$html.='</table></div><br>';
$html.='<table class="detalle" width="100%" border="1" >';
$html.='<tr><th>Comprobante</th><th>Número</th><th>Fecha <br>Emisión</th><th>Ejercicio <br>Fiscal</th><th>Base Imponible para<br>la Retención</th><th>Impuesto</th><th>Porcentaje<br>Retención</th><th>Precio Unitario</th></tr> ';
foreach ($languages->impuestos->impuesto as $value) {
if ((string)$value->codigo==1) $impuesto='RENTA';
else if ((string)$value->codigo==2) $impuesto='IVA';
else if ((string)$value->codigo==6) $impuesto='ISD';

if ((string)$value->codDocSustento==1) $codigo='Factura';
$html.='<tr align="center"><td >'. $codigo.'</td><td>'.(string)$value->numDocSustento.'</td><td>'.(string)$value->fechaEmisionDocSustento.'</td>';
$html.='<td>'.(string)$languages->infoCompRetencion->periodoFiscal.'</td><td>'.(string)$value->baseImponible.'</td><td>'.$impuesto.'</td><td width="120px">'.(string)$value->porcentajeRetener.'</td><td>'.(string)$value->valorRetenido.'</td></tr>';
}
$html.='</table><br>';
return $html;
}

function fnLeerGuia($languages){
$html.='<br>    
<div id="rounded-box" >
      <span>  <table cellspacing="10" cellpadding="10" width="98%"  >
        <tr><td colspan="2"><b>'.$languages->infoTributaria->razonSocial.'</b></td></tr>
        <tr><td colspan="2">'.$languages->infoTributaria->nombreComercial.'</td></tr>
        <tr><td>Dirección Matriz</td><td>'.$languages->infoTributaria->dirMatriz.'</td></tr>
        <tr><td>Dirección Sucursal: </td><td>'.$languages->infoGuiaRemision->dirEstablecimiento.'</td></tr>
        <tr><td>Contribuyente Especial Nro</td><td>'.$languages->infoGuiaRemision->contribuyenteEspecial.'</td></tr>
        <tr><td>Obligado a llevar Contabilidad</td><td>'.$languages->infoGuiaRemision->obligadoContabilidad.'</td></tr>
            
        </table></span>
  </div>';

$html.='<br><div id="rounded-box" style=" clear:both; left: 0; position: static;  width:100%" >';
$html.='<table  width="100%"  cellspacing="8" cellpadding="8">';
$html.='<tr><td width="2%"></td><td width="200px">Identificación (Transportista)</td><td colspan="2">'.$languages->infoGuiaRemision->rucTransportista.'</td></tr> ';
$html.='<tr><td width="2%"></td><td>Razón Social / Nombres y Apellidos:</td><td  colspan="2">'.$languages->infoGuiaRemision->razonSocialTransportista.'</td></tr>';
$html.='<tr><td width="2%"></td><td>Placa:</td><td  colspan="2">'.$languages->infoGuiaRemision->placa.'</td></tr>';
$html.='<tr><td width="2%"></td><td>Punto de Partida:</td><td  colspan="2">'.$languages->infoGuiaRemision->dirPartida.'</td></tr>';
$html.='<tr><td width="2%"></td><td>Fecha inicio Transporte</td><td >'.$languages->infoGuiaRemision->fechaIniTransporte.'</td><td width="140px">Fecha fin Transporte</td><td>'.$languages->infoGuiaRemision->fechaFinTransporte.'</td></tr>';
$html.='</table></div><br>';

$html.='<div id="rounded-box" style=" clear:both; left: 0; position: static;  width:100%" >';

foreach ($languages->destinatarios->destinatario as $value) {
$html.='<table width="100%"  cellspacing="5" cellpadding="5" >';
$html.='<tr><td width="2%"></td><td width="25%">Motivo Traslado:</td><td>'.$value->motivoTraslado.'</td></tr> ';
$html.='<tr><td width="2%"></td><td>Destino(Punto de llegada)</td><td>'.$value->dirDestinatario.'</td></tr>';
$html.='<tr><td width="2%"></td><td>Identificación (Destinatario)</td><td>'.$value->identificacionDestinatario.'</td></tr>';
$html.='<tr><td width="2%"></td><td>Razón Social/Nombres Apellidos</td><td>'.$value->razonSocialDestinatario.'</td></tr>';
$html.='<tr><td width="2%"></td><td>Ruta:</td><td>'.$value->ruta.'</td></tr>';
$html.='</table>';

$html.='<table class="detalle" width="90%" border="1"  align="center"  >';
$html.='<tr><th>Cantidad</th><th>Descripcion</th><th>Código Principal</th><th>Código Auxiliar</th>';
foreach ($value->detalles->detalle as $datos) {
  $html.='<tr align="center"><td>'. $datos->cantidad.'</td><td>'.(string) $datos->descripcion.'</td><td>'. $datos->codigoInterno.'</td><td>'.$datos->codigoAdicional .'</td>';  
}
$html.='</table><br>';
$html.='</div>';

}

return $html;
}


function fnLeerFactura($languages){
$html.='<br>
<div id="rounded-box" >
      <span>  <table cellspacing="10" cellpadding="10" width="98%"  >
        <tr><td colspan="2"><b>'.$languages->infoTributaria->razonSocial.'</b></td></tr>
        <tr><td colspan="2">'.$languages->infoTributaria->nombreComercial.'</td></tr>
        <tr><td width="20%">Dirección Matriz</td><td>'.$languages->infoTributaria->dirMatriz.'</td></tr>
        <tr><td>Dirección Sucursal</td><td>'.$languages->infoFactura->dirEstablecimiento.'</td></tr>
        <tr><td>Obligado a llevar Contabilidad</td><td>'.$languages->infoFactura->obligadoContabilidad.'</td></tr>
        </table></span>
  </div>';

$html.='<br><div id="rounded-box" style=" clear:both; left: 0; position: static;  width:100%" >';
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
$tipoEmision = ($data->emision==1) ? 'Normal' : 'Por Indisponibilidad del Sistema';
$html.='<br><br>
  <div id="rounded-box" >
      <span>  <table border="0"  width="100%"  >
        <tr><td colspan="2" ><h3>'.$tipodocumento.'</h3></td></tr>
        <tr><td width="150px">R.U.C</td><td>&nbsp;&nbsp;&nbsp;'.$data->ruc.'</td></tr>
        <tr><td>N°</td><td>&nbsp;&nbsp;&nbsp;'.$data->estab."-". $data->ptoEmi."-". $data->secuencial.'</td></tr>
        <tr><td>Ambiente:</td><td>&nbsp;&nbsp;&nbsp;'. $ambiente.'</td></tr>
        <tr><td>Emisión:</td><td>&nbsp;&nbsp;&nbsp;'. $tipoEmision.'</td></tr>
        <tr>
                <td rowspan="3">Clave Acceso:</td>
<!--
                <td><barcode  code="'.$data->claveAcceso.'" type="C128A"/></td>
        </tr>
        <tr>
-->
                <td>&nbsp;&nbsp;&nbsp;'.$data->claveAcceso .'</td>
        </tr>
</table></span>
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
if ($atributo=="Email Cliente")
$data->email=(string)$node;
if( !isset( $datos->email ) ) $datos->email = 'comprobantes@notario35quito.com';
if ($atributo=="Dirección")
$data->direccion=(string)$node;
if ($atributo=="Teléfono")
$data->telefono=(string)$node;
}
}}}
$html.='<br><div class="principal" style="width:55%;">INFORMACIÓN ADICIONAL';
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
        td {padding: 3; font-family:verdana ; font-size:70%}
        div.principal{clear:both;border-radius:7px; border: 0.2mm solid #000000; padding: 1em;font-family:verdana ; font-size:70%;}
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
else if ($languages->infoTributaria->codDoc==6)
$html.=fnLeerGuia($languages);
else if ($languages->infoTributaria->codDoc==7)
$html.=fnLeerRetencion($languages);

$html.=fnLeerInfoAdicional($languages);
}
else
$html.='Error al Leer el Archivo';

return $html;
}

$header = '
<table width="100%" style="border-bottom: 1px solid #000088; vertical-align: bottom; font-family: serif;">
<tr><td width="36%"><img src= "themes/cupcake/img/logo.png" height="85"/></td>
</table>';

$html = fnLeerArchivo($id);


//echo $html; exit;

$mpdf = new mPDF('utf-8','LETTER','','',15,15,25,12,5,7);
//$mpdf->SetHeader(Yii::app()->name);
$mpdf->SetHTMLHeader($header);
$mpdf->SetFooter('Este documento no tiene validez tributaria. En caso de ser necesario, remítase al archivo electrónico.');
$mpdf->WriteHTML($html,false);
$mpdf->Output('Documento Electronico','D');
Yii::app()->end();
?>

