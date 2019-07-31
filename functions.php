<?php  // Open the database
    class MyDB extends SQLite3 {
        function __construct() {
        $this->open('customers.db');
        }
    }
    $db = new MyDB();
    if(!$db) {
        echo $db->lastErrorMsg();
    }
function showBalance($db,$customer){
    $ret = $db->query("SELECT * FROM '".$customer."' ORDER BY ID DESC");
    echo '<div style="width:100%;padding-top:80px;">';
    echo "<table id=myTable>";
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
        if ($row['AMOUNT']<0){
            echo '<tr id=lmao style="background-color:rgb(25,60,35);">'
            .'<td id=lmao style="text-align:left;">'.$row['ID'] ."</td>"
            .'<td id=lmao  style="text-align:center;width:18em;">'.$row['DATE'] ."</td>"
            .'<td id=lmao  style="text-align:right;">'.$row['AMOUNT'] ." TL</td>";
        } else {
            echo '<tr id=lmao style="background-color:rgb(60,30,35);">'
            .'<td id=lmao  style="text-align:left;">'.$row['ID'] ."</td>"
            .'<td id=lmao  style="text-align:center;width:18em;">'.$row['DATE'] ."</td>"
            .'<td id=lmao  style="text-align:right;">'.$row['AMOUNT'] ." TL</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    echo '<div style="width:100%;padding-top:80px;">';
}
function totalBalance($db,$customer){
    $ret = $db->query("SELECT * FROM ". "[".$customer."]");
    $total = 0.0;
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
        $total = $total + $row['AMOUNT'];
    }
    return round($total,2)." TL";
}
function listPeople($db){
    echo '<table id="myTable">';
    $total_loan = 0;
    $tablesquery = $db->query("SELECT name FROM sqlite_master WHERE type='table';");
    while ($table = $tablesquery->fetchArray(SQLITE3_ASSOC)) {
        if ($table['name']!="sqlite_sequence" and $table['name']!="MARKET") {
            $customer = $table['name'];
            $customerBalance = totalBalance($db,$customer);
            echo "<tr>"
            .'<td><a href="edit.php?value='."$customer"
            .'"><div id="diva">'.$customer.'</div></a></td><td style="text-align:right;">'
            .$customerBalance.'</td>'."</tr>";
            $total_loan = $total_loan + $customerBalance;
        }
    }
    echo "<tr><td style=background-color:rgb(35,40,45);><a style=font-weight:600;><div id=diva>TOPLAM ALACAK: </div></a></td><td style=text-align:right;background-color:rgb(35,40,45);>".$total_loan." TL</td></tr>";
    echo "</table>";
    echo "<script>sortTable()</script>";
}
?>
