<?php
class EmailConfig {

	public $default = array(
		'transport' => 'Mail',
		'from' => 'gijs@gijs5.nl',
		'charset' => 'utf-8',
		'headerCharset' => 'utf-8',
		'emailFormat' => 'html',
		'layout' => 'default'
	);

	public $debug = array(
		'transport' => 'Debug',
		'from' => 'gijs@gijs5.nl',
		'to' => 'gijs@gijs5.nl',
		'charset' => 'utf-8',
		'headerCharset' => 'utf-8',
		'emailFormat' => 'html',
		'layout' => 'default'
	);

	/*
	public $gmail = array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'from' => 'gijs@gijs5.nl',
        'emailFormat' => 'html',
		'layout' => 'default',
        'username' => 'gijs.vijfhuizen@gmail.com',
        'password' => 'debevrijder',
        'transport' => 'Smtp',
        'log' => true
    );

	public $smtp = array(
		'transport' => 'Smtp',
		'from' => array('site@localhost' => 'My Site'),
		'host' => 'localhost',
		'port' => 25,
		'timeout' => 30,
		'username' => 'user',
		'password' => 'secret',
		'client' => null,
		'log' => false,
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);

	public $fast = array(
		'from' => 'you@localhost',
		'sender' => null,
		'to' => null,
		'cc' => null,
		'bcc' => null,
		'replyTo' => null,
		'readReceipt' => null,
		'returnPath' => null,
		'messageId' => true,
		'subject' => null,
		'message' => null,
		'headers' => null,
		'viewRender' => null,
		'template' => false,
		'layout' => false,
		'viewVars' => null,
		'attachments' => null,
		'emailFormat' => null,
		'transport' => 'Smtp',
		'host' => 'localhost',
		'port' => 25,
		'timeout' => 30,
		'username' => 'user',
		'password' => 'secret',
		'client' => null,
		'log' => true,
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);
	*/

}
