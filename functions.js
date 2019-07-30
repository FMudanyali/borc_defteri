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