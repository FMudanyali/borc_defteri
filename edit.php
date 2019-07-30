<html>
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="styles.css">
  <?php include("functions.php")?>
  <script type="text/javascript" src="functions.js"></script>
  <script type="text/javascript" src="jquery.js"></script>
  <script>
        jQuery(document).on('keyup',function(evt) {
          if (evt.keyCode == 27) {
            window.location.assign("customers.php");
          }
        });
  </script>
</head>
<body>
<?php
$customer = $_GET['value'];
ob_start();
echo '<div id="title">';
echo "<h1>".$customer." : ".totalBalance($db,$customer)."</h1>";
echo '</div>';
showBalance($db,$customer);
date_default_timezone_set('Europe/Istanbul');
$date = date('d-m-Y H:i');
?>
<?php
if(isset($_POST['ok'])){
        $value = str_replace(',','.', $_POST['bill']);
        if (is_numeric($value) and $value!=0){
                $db->exec("INSERT INTO '".$customer."' (ID,DATE,AMOUNT) VALUES (NULL,'".$date."',$value)");
                ob_end_clean();
                ob_start();
                echo '<div id="title">';
                echo "<h1>".$customer." : ".totalBalance($db,$customer)."</h1>";
                echo '</div>';
                showBalance($db,$customer);
                echo $value." TL eklendi.<br>";
                $db->close();
        } else {
                ob_end_clean();
                ob_start();
                echo '<div id="title">';
                echo "<h1>".$customer." : ".totalBalance($db,$customer)."</h1>";
                echo "</div>";
                showBalance($db,$customer);
                echo $value." kabul edilemez.<br>";
                $db->close();
        }
}
?>
<br>
    <div id="bottom">
    <form action="" method="post" autocomplete="off">
    <table id="myTable2">
    <tr>  
    <td width=90%><input autofocus="autofocus" onfocus="this.select()" autocomplete="off" type="text" name="bill" id="bill" value=""></td>
    <td width=10%><button type="submit" name="ok" id="someButton">Ekle</button></td>
    </tr>
    </table>
    </form>
    </div>
</body>
</html>
