<!-- VARIABLES DISPONIBLES PARA USARSE DENTRO DEL CUERPO DEL TEMPLATE:
  nombreCliente   : Nombre del cliente extraído del XML
  numeroDocumento : Número del comprobante extraído del XML
  claveAcceso     : Clave de acceso del comprobante extraído del XML
  emailAdmin      : Email del administrador configurado en params.php
  nombreEmpresa   : Nombre completo de empresa configurado en params.php
  logoUrl         : URL de la imagen del logo de la empresa
  ebillingUrl     : URL del sistema de e-billing
-->
<html>
    <head>
        <title>DOCUMENTO ELECTRÓNICO</title>
    </head>
    <body>
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center"><img src="{logoUrl}" height="150"></td>
            </tr>
            <tr>
                <td height="113" align="center">
                    <p>&nbsp;</p>
                    <p>Estimado(a)<br>
                    <strong>{nombreCliente}</strong></p>
                    <p>Tiene un nuevo DOCUMENTO No. {numeroDocumento}, se encuentra 
                    disponible para su visualización y descarga. Usted puede ingresar 
                    al sistema en {ebillingUrl} el usuario y contraseña serán su 
                    CI/RUC hasta que proceda a cambiarlo en el menú del sistema.</p>
                    <p>Clave de acceso del Documento otorgado por S.R.I.:</p>
                    <h4>{claveAcceso}</h4>
                    <p>Si tiene cualquier inquietud escríbanos a: {emailAdmin}</p>
                    <p>&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td align="center">{nombreEmpresa}</td>
            </tr>
        </table>
    </body>
</html>
