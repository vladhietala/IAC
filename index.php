<?php
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
<meta http-equiv="Content-Style-Type" content="text/css" />

<title>CellNet</title>

<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
 <script src="index.js" type="text/javascript"></script>
 <script src="mascara.js" type="text/javascript"></script>
</head>

<body>

<div id="container">
  <?php 
      include ("config/conecta.inc");
      include ("config/configure.php");
      include ("includes/top.php");
      include ("includes/menu.php");
      include ("includes/menuleft.php");
      include ($miolo);
      echo "<br clear=\"all\" />";
      include ("includes/rodape.inc");

  ?>

</div>

</body>
</html>