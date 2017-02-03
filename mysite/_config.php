<?php

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	'type' => 'MySQLDatabase',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '1q2w3e4r',
	'database' => 'avemaria',
	'path' => ''
);

// Set the site locale
i18n::set_locale('en_US');
