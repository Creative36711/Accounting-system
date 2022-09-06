let chartData = document.querySelectorAll(".chartData li")

let start = moment().startOf('M').add(-12, 'M').format('DD-MM-YYYY')
let end = moment().subtract(1,'months').endOf('month').format('DD-MM-YYYY')

let studentDataTable = document.querySelector(".student-data-table")

function delete_cookie(name) {
    document.cookie = name +'=; Path=assets/js/orders.js; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}


if(chartData[0].innerText !== start || chartData[1].innerText !== end) {
    $.ajax ({
        url: "ordersRequest.php",
        type: "POST",
        data: ({firstDateDividends: start, secondDateDividends: end}),
        dataType: "html",
        success: function (data) {
            delete_cookie("ulPeriodReports")
            location.reload()
        }
    });
}


let table, tr, td, i;
table = studentDataTable;
tr = table.getElementsByTagName("tr");
for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if(td.innerText === "Заработная плата") {
        let element = td.parentElement
        $(element).css('cursor','pointer');
        $(element).click(function() {
            document.querySelector('.writeOff').click()
        });
    }
    if(td.innerText === "Вывод средств") {
        let element = td.parentElement
        $(element).css('cursor','pointer');
        $(element).click(function() {
            document.querySelector('.writeOff2').click()
        });
    }
}











