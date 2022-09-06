// Dashboard 1 Morris-chart
$(function () {
    var months = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
    "use strict";
Morris.Area({
        element: 'morris-area-chart',
         data: [{

            period: '2021-06',
            dividends: 0,
        }, {
            period: '2021-07',
            dividends: 0,
        }, {
            period: '2021-08',
            dividends: 0,
        }, {
            period: '2021-09',
            dividends: 92416,
        }, {
            period: '2021-10',
            dividends: 107529,
        }, {
            period: '2021-11',
            dividends: 125911,
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