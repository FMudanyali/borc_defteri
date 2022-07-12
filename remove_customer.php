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
            window.location.assign("index.php");
          }
        });
  </script>
</head>
<body>
<form action="" method="post">
<table id="myTable3" style="margin-top:300px;">
<tr><td><a><div id=diva>Müşteri Sil</div></a></td></tr>
<tr>
<td width=90%><input autofocus="autofocus" onfocus="this.select()" autocomplete="off" type="text" name="customer" id="customer" value=""></td>
<td width=10%><button type="submit" name="ok" id="someButton" onclick="ask()">Sil</button></td>
</tr>
</table>
</form>
<?php
    if(isset($_POST['ok'])){
        $turkish = array("Ö","Ü","İ","Ğ","Ç","Ş","ö","ü","ı","ğ","ç","ş");
        $english = array("O","U","I","G","C","S","o","u","i","g","c","s");
        $value = strtoupper(str_replace($turkish,$english,$_POST['customer']));
        $db->exec("DROP TABLE "."[".$value."]");
        echo $value." SİLİNDİ.<br>";
        $db->close();
    }
?>
</body>
</html>