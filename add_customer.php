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
            window.location.assign("whattodo.php");
        }
        };;
  </script>
</head>
<body>
<form action="" method="post">
<table id="myTable2" style="margin-top:300px;">
<tr><td><a><div id=diva>Müşteri Ekle</div></a></td></tr>
<tr>
<td width=90%><input autofocus="autofocus" onfocus="this.select()" autocomplete="off" type="text" name="customer" id="customer" value=""></td>
<td width=10%><button type="submit" name="ok" id="someButton">Ekle</button></td>
</tr>
</table>
</form>
<?php
    if(isset($_POST['ok'])){
        $turkish = array("Ö","Ü","İ","Ğ","Ç","Ş","ö","ü","ı","ğ","ç","ş");
        $english = array("O","U","I","G","C","S","o","u","i","g","c","s");
        $value = strtoupper(str_replace($turkish,$english,$_POST['customer']));
        $db->exec("CREATE TABLE "."[".$value."]"." "." ('ID' INTEGER PRIMARY KEY AUTOINCREMENT, 'DATE' TEXT NOT NULL, 'AMOUNT' REAL NOT NULL)");
        echo $value." EKLENDI.<br>";
        $db->close();
    }
?>
</body>
</html>