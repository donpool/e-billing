<?php
Yii::import('application.extensions.phpmailer.JPhpMailer');

class EnviarEmail{

    public function enviar($to,$name,$claveacceso,$documento,$tipo) {
        $tipodocumento='-';
        try{
            $mailer=new JPhpMailer;
            if (!$mailer->ValidateAddress($to)){
                return "El mail $to es inválido.";
            }
            switch ($tipo) {
                case 1:  $tipodocumento='Ha recibido una nueva Factura Electrónica' ; break;
                case 4:  $tipodocumento='Ha recibido una nueva Nota de Crédito Electrónica '; break;
                case 5:  $tipodocumento='Ha recibido una nueva Nota de Débito Electrónica'; break;
                case 6:  $tipodocumento='Ha recibido una nueva Guia de Remisión Electrónica'; break;
                case 7:  $tipodocumento='Ha recibido un nuevo Comprobante de Retención Electrónico'; break;
                default: break;
            }
          
            $mailer->CharSet = 'utf-8';
            $mailer->IsSMTP();
            $mail->SMTPAuth = Yii::app()->params['smtpAuth'];
            $mailer->Host = Yii::app()->params['smptHost'];
            $mailer->Username = Yii::app()->params['smtpUser'];
            $mailer->Password = Yii::app()->params['smtpPass']; 
            $mailer->SetFrom(Yii::app()->params['adminEmail'], Yii::app()->params['companyName'].' e-billing');
            $mailer->Subject= $tipodocumento;
            $mailer->AddAddress($to,$name);
            $mailer->IsHTML(true); 
            $nombreCliente = $name;
            $numeroDocumento = $documento;
            $claveAcceso = $claveacceso;
            $emailAdmin = Yii::app()->params['adminEmail'];
            $nombreEmpresa = Yii::app()->params['companyFullName'];
            $logoUrl = Yii::app()->params['emailLogo'];
            $ebillingUrl = Yii::app()->params['webUrl'];
            
            eval('$emailBody='.$this->getEmailBody().';');
            $mailer->Body=$emailBody;
            $xml=Yii::getPathOfAlias('webroot') . '/data/documentos/xml/'.$claveacceso.'.xml';
            $pdf=Yii::getPathOfAlias('webroot') . '/data/documentos/pdf/'.$claveacceso.'.pdf';
            $mailer->AddAttachment($xml);
            $mailer->AddAttachment($pdf);

            if($mailer->Send()){
                return '1';
            }else{
                return 'Fallo al enviar el mail!';
            }
        }
        catch (phpmailerException $e){echo $e->errorMessage();} //Pretty error msg from PHPMailer
        catch (Exception $e){echo $e->getMessage();}
    }
    
    
    private function getEmailBody() {
        $retval = file_get_contents(Yii::getPathOfAlias('webroot').'/config/email.tpl');
        $retval = str_replace("'", "\'", $retval);
        $retval = str_replace('{', '\'.$', $retval);
        $retval = str_replace('}', '.\'', $retval);
        $retval = "'$retval'";
        return $retval;
    }  
}

        
