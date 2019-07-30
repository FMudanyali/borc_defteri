<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="styles.css">
  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="functions.js"></script>
</head>
<body>
<?php
    $passwd = "sel66ma77";
    if (isset($_POST['ok'])) {
        if ($_POST['password']==$passwd){
            header('Location: whattodo.php'); //
        } else {
            echo "Yanlış şifre</br>";
        }
    }
?>
<form action="" method="post" autocomplete="off">
<table id="myTable2" style="margin-top:300px;">
<tr>
<td width=90%><input autofocus="autofocus" onfocus="this.select()" autocomplete="off" type="password" name="password" id="password" value=""></td>
<td width=10%><button type="submit" name="ok" id="someButton">Gir</button></td>
</tr>
</table>
</form>
</body>
</html>