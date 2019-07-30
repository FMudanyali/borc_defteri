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
    echo '<table id="myTable">';
    $ret = $db->query("SELECT * FROM ". "[".$customer."]");
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
        if ($row['AMOUNT']<0){
            echo '<tr style="background-color:rgb(25,60,35);">'
            .'<td style="text-align:left;">'.$row['ID'] ."</td>"
            .'<td style="text-align:center;width:18em;">'.$row['DATE'] ."</td>"
            .'<td style="text-align:right;">'.$row['AMOUNT'] ." TL</td>";
        } else {
            echo '<tr style="background-color:rgb(60,30,35);">'
            .'<td style="text-align:left;">'.$row['ID'] ."</td>"
            .'<td style="text-align:center;width:18em;">'.$row['DATE'] ."</td>"
            .'<td style="text-align:right;">'.$row['AMOUNT'] ." TL</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
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
        if ($table['name']!="sqlite_sequence") {
            $customer = $table['name'];
            echo "<tr>"
            .'<td><a href="edit.php?value='."$customer"
            .'"><div id="diva">'.$customer.'</div></td><td style="text-align:right;">'
            .totalBalance($db,$customer).'</a></td>'."</tr>";
            $total_loan = $total_loan + totalBalance($db,$customer);
        }
    }
    echo "<tr><td><a><div id=diva>Toplam Alınacak: </div></a></td><td>".$total_loan." TL</td></tr>";
    echo "</table>";
}
?>
