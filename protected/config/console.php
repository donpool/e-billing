<?php
require_once(dirname(__FILE__).'/params.php');

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>$params['basePath'],
	'name'=>$params['name'],
	// preloading 'log' component
	'preload'=>array('log'),
    'import'=>array(
        'application.components.*',
        'application.models.*',
        'application.extensions.phpmailer.JPhpMailer',
    ),
	// application components
	'components'=>array(
	    // uncomment the following to use a MySQL database        
		'db'=>$params['db'],
        'ePdf' => $params['ePdf'],
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron.log',
                    'levels'=>'error, warning',
                ),
                 array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron_trace.log',
                    'levels'=>'error,trace info',
                ),
            ),

        ),

	),
    
	'params'=>$params['params'],
);





