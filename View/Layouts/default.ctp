<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('jquery-ui-1.9.2.custom.min', 'cake.generic', 'tmp.custom.styles'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		
		echo $this->html->scriptBlock('var basepath = "'.$this->webroot.'";', array('inline'=>true));
		echo $this->Html->script(array('jquery-1.8.3.min', 'jquery-ui-1.9.2.custom.min', 'jquery.functions'));
		
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link('Abode', '/') ?></h1>
			<div id="user_panel">
				Logged in as <?php echo $this->Session->read('Auth.User.username'); ?> | 
				<?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout')) ?>
			</div>
		</div>
		
		<div id="content">
			<div id="left">
				<?php echo $this->element('navigation') ?>
			</div>
			<div id="right">
				<div id="breadcrumbs">
					<?php echo $this->Html->getCrumbs(' > ', array('text' => 'Home', 'url' => '/', 'escape' => false)); ?>
				</div>
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<div id="footer">
			
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
