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

Morris.Area({
        element: 'morris-area-chart',
         data: [{
            period: '2019-09',
            revenue: 0,
        },{
            period: '2019-12',
            revenue: 150000,
        }, {
            period: '2020-03',
            revenue: 1026911,
        }, {
            period: '2020-06',
            revenue: 1019609,
        }, {
            period: '2020-09',
            revenue: 1864841,
        }, {
            period: '2020-12',
            revenue: 2233936,
        },{
            period: '2021-03',
            revenue: 1681066,
        }, {
            period: '2021-06',
            revenue: 1310721,
        }, {
            period: '2021-09',
            revenue: 1950670,
        }, {
            period: '2021-12',
            revenue: 2118398,
        },{
            period: '2022-03',
            revenue: 1422860,
        }, {
            period: '2022-06',
            revenue: 2188936,
        }, {
            period: '2022-09',
            revenue: 2166508,
        }, {
            period: '2022-12',
            revenue: 2317307,
        },{
            period: '2023-03',
            revenue: 1240646,
        }, {
            period: '2023-06',
            revenue: 1836071,
        }

        ],
        xkey: 'period',
        ykeys: ['revenue'],
        labels: ['Выручка'],
        pointSize: 3,
        fillOpacity: 1,
        pointStrokeColors:['#03A9F5'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 3,
        hideHover: 'auto',
        lineColors: ['#03A9F5'],
        resize: true,
        ymin: 0,
        ymax: 2500000
    });

 });    
