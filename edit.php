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
            window.location.assign("customers.php");
          }
        });
        jQuery(document).on('keyup',function(evt) {
          if (evt.keyCode == 18) {
                $kek = document.getElementById("bill").value;
                if ($kek < 0){
                        document.getElementById("bill").value = -1 * document.getElementById("bill").value;
                        document.getElementById("someButton").click();
                }
          }
        });
  </script>
</head>
<body>
<?php
$customer = $_GET['value'];
echo '<div id="title">';
echo "<h1>".$customer." : ".number_format(totalBalance($db,$customer),2)." TL</h1>";
echo '</div>';
showBalance($db,$customer);
date_default_timezone_set('Europe/Istanbul');
$date = date('d-m-Y H:i');
?>
<?php
if(isset($_POST['edited'])){
        if(!empty($_POST['amount'])){
                $db->exec("UPDATE '".$customer."' SET AMOUNT = ".$_POST['amount']." WHERE ID = ".$_POST['editid'].";");
                echo("<script>window.alert(\"KAYIT DUZENLENDI.\");</script>");
                echo("<meta http-equiv='refresh' content='0'>");
        } else {
                $db->exec("DELETE FROM '".$customer."' WHERE ID = ".$_POST['editid'].";");
                echo("<script>window.alert(\"KAYIT SILINDI.\");</script>");
                echo("<meta http-equiv='refresh' content='0'>");
        }
        $db->close();
}
if(isset($_POST['ok'])){
        $value = str_replace(',','.', $_POST['bill']);
        if (is_numeric($value) and $value!=0){
                $db->exec("INSERT INTO '".$customer."' (ID,DATE,AMOUNT) VALUES (NULL,'".$date."',$value)");
                $db->close();
                echo("<script>window.alert(\"".$value." EKLENDI.\");</script>");
                echo("<meta http-equiv='refresh' content='0'>");
        } else {
                echo("<script>window.alert(\"".$value." KABUL EDİLEMEZ.\");</script>");
                $db->close();
        }
}
?>
<br>
    <div id="bottom">
    <form action="" method="post" autocomplete="off" id="someformidk">
    <table id="myTable3">
    <tr>  
    <td width=90%><input autofocus="autofocus" onfocus="this.select()" autocomplete="off" type="text" name="bill" id="bill" value=""></td>
    <td width=10%><button type="submit" name="ok" id="someButton">Ekle</button></td>
    </tr>
    </table>
    </form>
    <form action="" method="post" autocomplete="off" id="otherformidk">
            <input style="display:none;"  autocomplete="off" type="text" name="editid" id="editid" value=""></td>
            <input style="display:none;"  autocomplete="off" type="text" name="amount" id="amount" value=""></td>
            <button style="display:none;" type="submit" name="edited" id="someButton2"></button>
    </div>
</body>
</html>
