// Dashboard 1 Morris-chart
$(function () {
    var months = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
    "use strict";
Morris.Area({
        element: 'morris-area-chart',
         data: [{
            period: '2021-09',
            dividends: 69312,
        }, {
            period: '2021-10',
            dividends: 80647,
        }, {
            period: '2021-11',
            dividends: 94433,
        }, {
            period: '2021-12',
            dividends: 142542,
        }, {
            period: '2022-01',
            dividends: 43298,
        }, {
            period: '2022-02',
            dividends: 5720,
        }, {
            period: '2022-03',
            dividends: 47126,
        }, {
            period: '2022-04',
            dividends: 279007,
        }, {
            period: '2022-05',
            dividends: 156663,
        }, {
            period: '2022-06',
            dividends: 0,
        }, {
            period: '2022-07',
            dividends: 236665,
        }, {
            period: '2022-08',
            dividends: 19411,
        }


        ],
        xkey: 'period',
        ykeys: ['dividends'],
        labels: ['Дивиденды'],
        xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
            var month = months[x.getMonth()];
            return month;
          },
          dateFormat: function(x) {
            var month = months[new Date(x).getMonth()];
            return month;
          },
        pointSize: 3,
        fillOpacity: 0,
        pointStrokeColors:['#55ce63'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 3,
        hideHover: 'auto',
        lineColors: ['#55ce63'],
        resize: true
    });
 });    

 let chart = am4core.create("chartDiv", am4charts.PieChart);
 let chartData = document.querySelectorAll(".chartData li")

 let series = chart.series.push(new am4charts.PieSeries());
 series.dataFields.value = "sum";
 series.dataFields.category = "category";

 chart.data = [{
     "category": "Исмаилов И.Н.",
     "sum": chartData[0].innerText
 }, {
     "category": "Першукова О.П.",
     "sum": chartData[1].innerText
 }];

let start = moment().startOf('y').format('DD-MM-YYYY')
let end = moment().endOf('M').add(1, 'd').format('DD-MM-YYYY')
let sum = document.querySelector(".withdrawal .stat-digit")
let text = document.querySelector(".withdrawal .stat-text")

function delete_cookie(name) {
    document.cookie = name +'=; Path=assets/js/orders.js; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}


if(chartData[2].innerText !== start || chartData[3].innerText !== end) {
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

if(sum.innerText.search('-') !== -1) {
    text.innerText = "Вывод капитала"
    sum.style.color = '#e74c3c';
}

let withdrawal1 = $('.withdrawal1 .stat-digit').text().length
let withdrawal2 = $('.withdrawal2 .stat-digit').text().length
let withdrawal3 = $('.withdrawal3 .stat-digit').text().length
let withdrawal4 = $('.withdrawal4 .stat-digit').text().length

if(withdrawal1 < withdrawal2)
    $('.withdrawal1 .stat-digit i').text("2")
else if(withdrawal1 > withdrawal2)
    $('.withdrawal2 .stat-digit i').text("2")

if(withdrawal3 < withdrawal4) {
    $('.withdrawal3 .stat-digit i').text("2")
}
else if(withdrawal4 < withdrawal3) {
    $('.withdrawal4 .stat-digit i').text("2")
}

$('.chart .chartDiv').height($('.withdrawalRow').height() - 57)

if(500 < $('.chart').height()) {
    $('.chart .chartDiv').height("200");
    $('.chart').css("width", "100%");
}

$('#morris-area-chart').height($('.rowChart').height() - 130)







