let studentDataTable = document.querySelector(".student-data-table")
let counterparty = document.querySelector(".counterparty")

function myFunction(column, inputRounded) {
    let input, filter, table, tr, td, i;
    input = inputRounded;
    filter = input.value.toUpperCase();
    table = studentDataTable;
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[column];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

counterparty.onkeyup = function () {
    myFunction(0, counterparty)
}