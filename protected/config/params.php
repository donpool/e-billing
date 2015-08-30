<?php

$params = array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'E-Billing',
    'params'=>array(
        'webUrl'=>'http://www.notario35quito.com/e-billing',
        'adminEmail'=>'comprobantes@notario35quito.com',
        'companyName'=>'Notario 35 Quito',
        'companyFullName'=>'NOTARIO TRIGÉSIMO QUINTO - QUITO D.M.',
        'companyAddress'=>'Gaspar de Villarroel y Amazonas, Quito, Ecuador',
        'companyEmail'=>'info@notario35quito.com',
        'companyURL'=>'http://www.notario35quito.com',
        'emailLogo'=>'http://www.notario35quito.com/logonotario.png',
        'smptHost'=>'localhost',
        'smtpAuth'=>false,
        'smtpUser'=>'comprobantes',
        'smtpPass'=>'F4ctur4s2015',
        'rideFooter'=>'RIDE',
        'rutatmp'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../data/documentos/tmp',
        'rutaxml'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../data/documentos/xml/',
        'rutapdf'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../data/documentos/pdf/',
        'rutacsv'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../data/documentos/csv',
        'path'=>'p-billing/assets/documentos/xml/..',
        'debug'=>true,
        'debugSendEmail'=>false,
        'debugEmail'=>'donpool@gmail.com',
        'importCSVpercent'=>5,
    ),
    'db'=>array(
        'connectionString' => 'mysql:host=localhost;dbname=pbilling',
        'emulatePrepare' => true,
        'username' => 'pbilling',
        'password' => '0f28ca4f',
        'charset' => 'utf8',
    ),
    'ePdf' => array(
        'class' => 'ext.yii-pdf.EYiiPdf',
        'params' => array(
            'mpdf' => array(
                'librarySourcePath' => 'application.vendors.mpdf.*',
                'constants' => array(
                    '_MPDF_TEMP_PATH' =>Yii::getPathOfAlias('application.runtime'),
                ),
                'class'=>'mpdf',
            ),
            'HTML2PDF' => array(
                'librarySourcePath' => 'application.vendors.html2pdf.*',
                'classFile' => 'html2pdf.class.php',
            )
        ),
    ),
);
