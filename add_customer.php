<form action="" method="post">
<input type="text" name="customer" id="customer" value="">
<button type="submit" name="ok">Ekle</button>
</form>
<?php
    class MyDB extends SQLite3 {
        function __construct() {
        $this->open('customers.db');
        }
    }

    $db = new MyDB();

    if(isset($_POST['ok'])){
        $value = $_POST['customer'];
        $db->exec("CREATE TABLE "."[".$value."]"." "." (ID INT PRIMARY KEY AUTOINCREMENT, DATE TEXT NOT NULL, AMOUNT FLOAT NOT NULL)");
        echo $value." EKLENDI.<br>";
        $db->close();
    }
?>