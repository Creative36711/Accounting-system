let cardClose = document.querySelector(".card-close")
let cardHeaderRightIcon = document.querySelector(".card-header-right-icon")
let buttonClose = document.querySelector(".buttonClose")
let modalDate = document.querySelector(".modalDate")
let firstDate = document.querySelector(".firstDate")
let secondDate = document.querySelector(".secondDate")
let tableReports = document.querySelectorAll(".orderLine")

let cookie = "Reports"

function filterRow (input) {
    if (input === "liCurrentMonth") {
        firstDate.value = moment().startOf('M').format('DD-MM-YYYY')
        secondDate.value = moment().endOf('M').format('DD-MM-YYYY')
    } else if (input === "liCurrentQuarter") {
        firstDate.value = moment().quarter(moment().quarter()).startOf('quarter').format('DD-MM-YYYY')
        secondDate.value = moment().quarter(moment().quarter()).endOf('quarter').format('DD-MM-YYYY')
    } else if (input === "liThisYear") {
        firstDate.value = moment().startOf('y').format('DD-MM-YYYY')
        secondDate.value = moment().endOf('M').format('DD-MM-YYYY')
    } else if (input === "liLastMonth") {
        firstDate.value = moment().startOf('M').add(-1, 'M').format('DD-MM-YYYY')
        secondDate.value = moment().endOf('M').add(-1, 'M').format('DD-MM-YYYY')
    } else if (input === "liLastQuarter") {
        firstDate.value = moment().quarter(moment().quarter()).startOf('quarter').add(-1, 'quarter').format('DD-MM-YYYY')
        secondDate.value = moment().quarter(moment().quarter()).endOf('quarter').add(-1, 'quarter').format('DD-MM-YYYY')
    } else if (input === "liLastYear") {
        firstDate.value = moment().startOf('y').add(-1, 'y').format('DD-MM-YYYY')
        secondDate.value = moment().endOf('y').add(-1, 'y').format('DD-MM-YYYY')
    } else if (input === "allTime") {
        firstDate.value = moment('2000/01/01', 'YYYY/MM/DD').format('DD-MM-YYYY')
        secondDate.value = moment().endOf('M').format('DD-MM-YYYY')
    } else if (input === "liArbitrarily") {
        firstDate.value = values[findPartial( values, "firstDate" +cookie)].split('=')[1]
        secondDate.value = values[findPartial( values, "secondDate" +cookie)].split('=')[1]
    }

    return input;
}

let values = document.cookie.split(";")

if (getCookie("ulPeriod" + cookie) === null) {
    document.cookie = "ulPeriod"+cookie+"=liCurrentMonth";
    firstDate = moment().startOf('M').format('DD-MM-YYYY')
    secondDate = moment().endOf('M').format('DD-MM-YYYY')
    ajaxClients(firstDate, secondDate)
}

for (let i = 0; i < values.length; i++) {
    if (values[i].trim().split("=")[0].includes(cookie) === true) {
        filterRow(values[i].trim().split("=")[1])
        $("." + values[i].trim().split("=")[1] + " a").css({'font-weight': 'bold'});
    }
}


function delete_cookie(name) {
    document.cookie = name +'=; Path=assets/js/orders.js; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

$(cardHeaderRightIcon).click(function (event) {
    let targ, key, value;
    targ = event.target;
    value = targ.closest("li").classList[0]
    key = targ.closest('ul').classList[2]+cookie
    if (targ.tagName !== 'A' || ($(targ).css('font-weight') === "700" && key !== "liArbitrarily"+cookie)) return;
    if (key === 'ulPeriod'+cookie) {
        delete_cookie("ulPeriod" + cookie)
        if (value === "liCurrentMonth") {
            firstDate.value = moment().startOf('M').format('DD-MM-YYYY')
            secondDate.value = moment().endOf('M').format('DD-MM-YYYY')
        } else if (value === "liCurrentQuarter") {
            firstDate.value = moment().quarter(moment().quarter()).startOf('quarter').format('DD-MM-YYYY')
            secondDate.value = moment().quarter(moment().quarter()).endOf('quarter').format('DD-MM-YYYY')
        } else if (value === "liThisYear") {
            firstDate.value = moment().startOf('y').format('DD-MM-YYYY')
            secondDate.value = moment().endOf('M').format('DD-MM-YYYY')
        } else if (value === "liLastMonth") {
            firstDate.value = moment().startOf('M').add(-1, 'M').format('DD-MM-YYYY')
            secondDate.value = moment().subtract(1,'months').endOf('month').format('DD-MM-YYYY')
        } else if (value === "liLastQuarter") {
            firstDate.value = moment().quarter(moment().quarter()).startOf('quarter').add(-1, 'quarter').format('DD-MM-YYYY')
            secondDate.value = moment().quarter(moment().quarter()).endOf('quarter').add(-1, 'quarter').format('DD-MM-YYYY')
        } else if (value === "liLastYear") {
            firstDate.value = moment().startOf('y').add(-1, 'y').format('DD-MM-YYYY')
            secondDate.value = moment().endOf('y').add(-1, 'y').format('DD-MM-YYYY')
        } else if (value === "allTime") {
            firstDate.value = moment('2000/01/01', 'YYYY/MM/DD').format('DD-MM-YYYY')
            secondDate.value = moment().endOf('M').format('DD-MM-YYYY')
        }
    }
    if (value !== 'liArbitrarily') {
        ajaxClients(firstDate.value, secondDate.value)
    }
        document.cookie = key + "=" + value;
    jQuery(function($){
        $(document).mouseup(function (e){ // событие клика по веб-документу
            let div = $(".modalDate"); // тут указываем ID элемента
            let div2 = $(".pignose-calendar-wrapper")
            if ((!div.is(e.target) && div.has(e.target).length === 0) && (!div2.is(e.target) && div2.has(e.target).length === 0)) {
                document.cookie = "firstDate"+cookie+"=" + firstDate.value;
                document.cookie = "secondDate"+cookie+"=" + secondDate.value;
                ajaxClients(firstDate.value, secondDate.value)
            }
        });
    });
});

buttonClose.onclick = function () {
    ajaxClients(firstDate.value, secondDate.value)
    document.cookie = "firstDate"+cookie+"=" + firstDate.value;
    document.cookie = "secondDate"+cookie+"=" + secondDate.value;
}

cardClose.onclick = function () {
    document.cookie = "ulPeriod"+cookie+"=liCurrentMonth";
    firstDate = moment().startOf('M').format('DD-MM-YYYY')
    secondDate = moment().endOf('M').format('DD-MM-YYYY')
    ajaxClients(firstDate, secondDate)
}

function findPartial( a, s ) {
    for( let i = 0; i < a.length; ++i )
        if( a[i].indexOf( s ) >= 0 )
            return i;
    return -1;
}

function ajaxClients(value1, value2) {
    $.ajax ({
        url: "ordersRequest.php",
        type: "POST",
        data: ({firstDateReports: value1, secondDateReports: value2}),
        dataType: "html",
        success: function (data) {
            location.reload()
        }
    });
}

function getCookie(name) {
    let dc = document.cookie;
    let prefix = name + "=";
    let begin = dc.indexOf("; " + prefix);
    if (begin === -1) {
        begin = dc.indexOf(prefix);
        if (begin !== 0) return null;
    }
    else
    {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end === -1) {
            end = dc.length;
        }
    }
    return decodeURI(dc.substring(begin + prefix.length, end));
}

if ($("H4").first().text() === "Отчет по задолженностям") {
    let value;
    for(let i = 0; i < tableReports.length; i++) {
        value = tableReports[i].childNodes[0].innerText;
        if (value === "Дебиторская задолженность" || value === "Задолженость по зарплате" || value === "Прочая дебиторская задолженость" || value === "Кредиторская задолженность" || value === "Предоплаты по заказам" || value === "Прочая кредиторская задолженость" || value === "Неоплаченные заказы"){
            $(tableReports[i]).css({'font-weight': 'bold'});
        }
    }

}

console.log(values)
