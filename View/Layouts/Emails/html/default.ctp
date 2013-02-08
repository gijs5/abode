<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<title><?php echo $title_for_layout;?></title>
</head>
<body>
	<h1>Logo or header in every mail</h1>
	<?php echo $this->fetch('content');?>
</body>
</html>