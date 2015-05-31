<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'E-billing',
        'theme' => 'cupcake',
	'preload'=>array('log'),
        'language'=>'es',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.extensions.coco.*', 
	),

//	'modules'=>array(
//		// uncomment the following to enable the Gii tool
//		
//		'gii'=>array(
//			'class'=>'system.gii.GiiModule',
//			'password'=>'123',
//			// If removed, Gii defaults to localhost only. Edit carefully to taste.
//			'ipFilters'=>array('127.0.0.1','::1'),
//		),
//		
//	),

	// application components
	'components'=>array(
                'authManager'=>array(
                    'class'=>'CDbAuthManager',
                    'connectionID'=>'db',
                ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
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
                    ) ),
                ),

		// uncomment the following to enable URLs in path-format
                'urlFormat'=>'path',
                'showScriptName'=>false,
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=c3ebilling',
			'emulatePrepare' => true,
			'username' => 'c3ebilling',
			'password' => 'uxa7wF_DL7F',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
//                'rutatmp'=>Yii::app()->getBasePath(). '/data/documentos/tmp',
//                'rutaxml'=>Yii::app()->getBasePath(). '/data/documentos/xml',
//                'rutapdf'=>Yii::app()->getBasePath(). '/data/documentos/pdf',
           
                'rutatmp'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../data/documentos/tmp',
                'rutaxml'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../data/documentos/xml/',
                'rutapdf'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../data/documentos/pdf/',
	),
);
