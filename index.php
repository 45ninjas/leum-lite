<?php
include_once "leum-light.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, inital-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo WebPath("/resources/bulma.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo WebPath("/resources/purecss.css"); ?>">
	<title><?php echo $leum->title; ?></title>
</head>
<body>
	<?php $leum->Render(); ?>
</body>
</html>