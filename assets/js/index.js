let rowBalance = document.querySelector("#rowBalance")
let balance1 = document.querySelector("#balance1")
let balance1Tag = document.querySelectorAll("#balance1 a")
let balance2Tag = document.querySelectorAll("#balance2 a")
let balance3Tag = document.querySelectorAll("#balance3 a")
let balance4Tag = document.querySelectorAll("#balance4 a")


for (let i = 0; i < balance1Tag.length; i++) {
    if ($("#balance1 .pull-left").text() === balance1Tag[i].innerText) {
        balance1Tag[i].classList.add("bold")
    }
}
for (let i = 0; i < balance2Tag.length; i++) {
    if ($("#balance2 .pull-left").text() === balance2Tag[i].innerText) {
        balance2Tag[i].classList.add("bold")
    }
}
for (let i = 0; i < balance3Tag.length; i++) {
    if ($("#balance3 .pull-left").text() === balance3Tag[i].innerText) {
        balance3Tag[i].classList.add("bold")
    }
}
for (let i = 0; i < balance4Tag.length; i++) {
    if ($("#balance4 .pull-left").text() === balance4Tag[i].innerText) {
        balance4Tag[i].classList.add("bold")
    }
}

$(rowBalance).click(function (event) {
    let value, id;
    value = event.target;
    if (value.tagName !== 'A' || $(value).css('font-weight') === "700") return;
    id = value.closest('.stat-header').id
    $(document).ready (function () {
        $.ajax ({
            url: "ordersRequest.php",
            type: "POST",
            data: ({value: value.innerText, id: id}),
            dataType: "html",
            success: function (data) {
                location.reload(data)
            }
        });
    });
})

$(function () {
    var months = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
    "use strict";
Morris.Area({
        element: 'morris-area-chart',
         data: [{
            period: '2022-06',
            revenue: 316042,
        }, {
            period: '2022-07',
            revenue: 937824,
        }, {
            period: '2022-08',
            revenue: 419789,
        }, {
            period: '2022-09',
            revenue: 808895,
        }, {
            period: '2022-10',
            revenue: 665973,
        }, {
            period: '2022-11',
            revenue: 695760,
        }, {
            period: '2022-12',
            revenue: 907628,
        }, {
            period: '2023-01',
            revenue: 505432,
        }, {
            period: '2023-02',
            revenue: 387797,
        }, {
            period: '2023-03',
            revenue: 354917,
        }, {
            period: '2023-04',
            revenue: 382722,
        }, {
            period: '2023-05',
            revenue: 846185,
        }


        ],
        xkey: 'period',
        ykeys: ['revenue'],
        labels: ['Выручка'],
        xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
            var month = months[x.getMonth()];
            return month;
          },
          dateFormat: function(x) {
            var month = months[new Date(x).getMonth()];
            return month;
          },
        pointSize: 3,
        fillOpacity: 1,
        pointStrokeColors:['#03A9F5'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 3,
        hideHover: 'auto',
        lineColors: ['#03A9F5'],
        resize: true,
        ymin: 300000,
        ymax: 1100000
    });
 });    
