<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="styles.css">
  <?php include("functions.php")?>
  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="functions.js"></script>
  <script>
        document.onkeydown = function(e){ 
        if (window.event.keyCode == 27) {
        history.go(-1);
        }
        };;
  </script>
</head>
<body>
<input type="text" id="myInput" onkeyup="searchNames()" placeholder="Ara..">
<?php  
listPeople($db);
?>
</body>
</html>