$(document).ready(function() {
  $('#myInput').keyup(function() {
    var charMap = {
      Ç: 'C',
      Ö: 'O',
      Ş: 'S',
      İ: 'I',
      I: 'i',
      Ü: 'U',
      Ğ: 'G',
      ç: 'c',
      ö: 'o',
      ş: 's',
      ı: 'i',
      ü: 'u',
      ğ: 'g'
    };
    var str = $('#myInput').val();
    str_array = str.split('');
    for (var i = 0, len = str_array.length; i < len; i++) {
      str_array[i] = charMap[str_array[i]] || str_array[i];
    }
    str = str_array.join('');
    var clearStr = str.replace(/[çöşüğı]/gi, "");
    $('#myInput').val(clearStr);
    var print = clearStr;

  });
});

function ask() {
  var customer = document.getElementById("customer").value;
  return confirm(customer + ' KİŞİSİNİ SİLMEK İSTEDİĞİNDEN EMİN MİSİN?');
}

function remove_record(id) {
  var amount = document.getElementById(id+"amount").innerText.split(" ")[0];
  confirm(amount + 'TL KAYIDI SILMEK ISTEDIGINDEN EMIN MISIN?');
  if (!confirm) return;
  document.getElementById("editid").value = id;
  document.getElementById("someButton2").click();
}

function edit_record(id) {
  var oldamount = document.getElementById(id+"amount").innerText.split(" ")[0];
  var amount = prompt(oldamount+'TL NE ILE DEGISTIRILSIN?');
  amount = amount.replace(",",".");
  if (isNaN(amount)){
    alert(amount + " DOGRU BIR DEGER DEGIL.");
    return;
  }
  document.getElementById("editid").value = id;
  document.getElementById("amount").value = amount;
  document.getElementById("someButton2").click();
}

function searchNames() {
  // Declare variables 
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}

function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 0; i < (rows.length); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[1];
      y = rows[i + 1].getElementsByTagName("TD")[1];
      // Check if the two rows should switch place:
      val1 = Number(x.innerHTML.replace(' TL','').replace(',',''));
      val2 = Number(y.innerHTML.replace(' TL','').replace(',',''));
      if (val1 < val2) {
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}