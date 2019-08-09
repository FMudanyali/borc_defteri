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
    // Top padding so elements dont get under customer name.
    echo '<div style="width:100%;padding-top:80px;"></div>';
    echo "<table id=myTable2>";
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
        //Red background if positive, otherwise green.
        if ($row['AMOUNT']<0){
            echo '<tr id=lmao style="background-color:rgb(25,60,35);">'
            .'<td id=lmao style="text-align:left;">'.$row['ID'] ."</td>"
            .'<td id=lmao  style="text-align:center;width:18em;">'.$row['DATE'] ."</td>"
            .'<td id=lmao  style="text-align:right;">'.number_format($row['AMOUNT'],2)." TL</td>";
        } else {
            echo '<tr id=lmao style="background-color:rgb(60,30,35);">'
            .'<td id=lmao  style="text-align:left;">'.$row['ID'] ."</td>"
            .'<td id=lmao  style="text-align:center;width:18em;">'.$row['DATE'] ."</td>"
            .'<td id=lmao  style="text-align:right;">'.number_format($row['AMOUNT'],2)." TL</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    // Bottom padding so elements dont get under input bar.
    echo '<div style="width:100%;padding-top:80px;"></div>';
}
function totalBalance($db,$customer){
    $ret = $db->query("SELECT * FROM ". "[".$customer."]");
    $total = 0.0;
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
        $total = $total + $row['AMOUNT'];
    }
    // Round the result for readability.
    return $total;
}
function listPeople($db){
    echo '<table id="myTable">';
    // To calculate total amount of loan.
    $tablesquery = $db->query("SELECT name FROM sqlite_master WHERE type='table';");
    while ($table = $tablesquery->fetchArray(SQLITE3_ASSOC)) {
        // Ignore this table
        if ($table['name']!="sqlite_sequence") {
            $customer = $table['name'];
            $customerBalance = totalBalance($db,$customer);
            echo "<tr>"
            .'<td><a href="edit.php?value='."$customer"
            .'"><div id="diva">'.$customer.'</div></a></td><td style="text-align:right;">'
            .number_format($customerBalance,2).' TL</td>'."</tr>";
        }
    }
    echo "</table><script>sortTable()</script>";
}
function toplamAlacak($db){
    $total_loan = 0;
    $tablesquery = $db->query("SELECT name FROM sqlite_master WHERE type='table';");
    while ($table = $tablesquery->fetchArray(SQLITE3_ASSOC)) {
        if ($table['name']!="sqlite_sequence") {
            $customer = $table['name'];
            $customerBalance = totalBalance($db,$customer);
            $total_loan = $total_loan + $customerBalance;
        }
    }
    echo "Toplam Alacak: ".number_format($total_loan,2)." TL";  
} 
?>
