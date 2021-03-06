<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Console Application',
        'timeZone' => 'Europe/Minsk',
	// preloading 'log' component
	'preload'=>array('log'),
        'import' => array(
	    'application.models.*',
            'application.helpers.*',
	),
	// application components
	'components'=>array(
            'db'=>array(
                'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../../../data/exchange.db',
            ),
            
            // uncomment the following to use a MySQL database
            /*
            'db'=>array(
                    'connectionString' => 'mysql:host=localhost;dbname=chat',
                    'emulatePrepare' => true,
                    'username' => 'mysql',
                    'password' => 'mysql',
                    'charset' => 'utf8',
            ),
            */

            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute', 'levels'=>'error, info, warning',
                    ),
                ),
            ),
	),
	'params'=>array(
            // this is used in contact page
            'supportEmail' => 'support.ex@lbr.ru',
            'adminEmail'   => 'help.ex@lbr.ru',
            'logistEmailRegional'       => 'kosarevich@lbr.ru',
            'logistEmailInternational'  => 'budaeva@lbr.ru',
            'minNotify'   => 30,
            'hoursBefore' => 24,
	),
);
