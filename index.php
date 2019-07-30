<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <?php include("functions.php")?>
  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="functions.js"></script>
</head>
<body>
<input type="text" id="myInput" onkeyup="searchNames()" placeholder="Ara..">
<?php  
listPeople($db);
?>
</body>
</html>