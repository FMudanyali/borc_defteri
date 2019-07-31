<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="styles.css">
  <?php include("functions.php")?>
  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="functions.js"></script>
  <script>
        jQuery(document).on('keyup',function(evt) {
          if (evt.keyCode == 27) {
            window.location.assign("whattodo.php");
          }
        });
  </script>
</head>
<body>
<input autofocus="autofocus" onfocus="this.select()" autocomplete="off" type="text" id="myInput" onkeyup="searchNames()" placeholder="Ara..">
<?php  
listPeople($db);
?>
</body>
</html>