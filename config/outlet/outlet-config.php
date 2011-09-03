<?php
return array(
	'connection' => array(
            'dsn'      => 'mysql:host=localhost;dbname=test',
            'username' => 'root',
            'password' => '',
            'dialect'  => 'mysql'
          ),
	'classes' => array(
		'User' => array(
			'table' => 'users',
			'props' => array(
				'ID' => array('id', 'int', array('pk'=>true, 'autoIncrement'=>true)),
				'Username' => array('username', 'varchar')
			)
		)
	)
);
