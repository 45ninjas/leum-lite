<?php
include_once "leum-lite.php";
?>

<!DOCTYPE html>
<html id="page-<?php echo get_class($leum->page); ?>">
<head>
	<meta name="viewport" content="width=device-width, inital-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo WebPath("/resources/bulma.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo WebPath("/resources/styles.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo WebPath("/resources/font-awesome-4.7.0/css/font-awesome.min.css") ?>">
	<title><?php echo $leum->title; ?></title>
</head>
<body>
	<?php $leum->Render(); ?>
</body>
</html>