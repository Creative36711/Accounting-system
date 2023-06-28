let rowOrders = document.querySelectorAll(".student-data-table tr")
let orderViewing = document.querySelectorAll(".orderViewing")
let orderChange = document.querySelectorAll(".orderChange")
let orderDelete = document.querySelectorAll(".orderDelete")
let cardClose = document.querySelector(".card-close")
let studentDataTable = document.querySelector(".student-data-table")
let cardHeaderRightIcon = document.querySelector(".card-header-right-icon")
let buttonClose = document.querySelector(".buttonClose")
let modalDate = document.querySelector(".modalDate")
let customerDescription = document.querySelector(".customerDescription")
let searchByAction = document.querySelector(".searchByAction")
let firstDate = document.querySelector(".firstDate")
let secondDate = document.querySelector(".secondDate")
let designers
let cookie = "Clients"

let customerName = document.querySelector(".customerName")

for (let i = 0; i < rowOrders.length; i++)
    rowOrders[i].onclick = function(event) {
        event = event || window.event;
        let target = event.target || event.srcElement;
        if (target === orderChange[i-1]) {
            sessionStorage.setItem('number', this.childNodes[1].innerText);
            window.location.href = "edit-clients.php"
        }
        if (target === orderDelete[i-1]) {
            let delClients = this.childNodes[1].innerText
            function deleteOrders() {
                $(document).ready (function () {
                    $.ajax ({
                        url: "ordersRequest.php",
                        type: "POST",
                        data: ({delClients: delClients}),
                        dataType: "html",
                        success: function (data) {
                            location.reload(data)
                        }
                    });
                });
            }
            Swal.fire({
                title: 'Вы уверены?',
                text: "После удаления вы не сможете восстановить этого клиента!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Да, удалить клиента',
                cancelButtonText: "Отмена",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Успешно!',
                        'Данный клиент был удален!',
                        'success',
                    )
                    deleteOrders();
                }
            })
        }
    }


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

customerName.onkeyup = function () {
    myFunction(2, customerName)
}

customerDescription.onkeyup = function () {
    myFunction(5, customerDescription)
}

searchByAction.onkeyup = function () {
    myFunction(8, searchByAction)
}

function filterRow (input) {
    if (input === "liCurrentMonth") {
        firstDate.value = moment().startOf('M').format('DD-MM-YYYY')
        secondDate.value = moment().endOf('M').format('DD-MM-YYYY')
    } else if (input === "liCurrentQuarter") {
        firstDate.value = moment().quarter(moment().quarter()).startOf('quarter').format('DD-MM-YYYY')
        secondDate.value = moment().quarter(moment().quarter()).endOf('quarter').format('DD-MM-YYYY')
    } else if (input === "liThisYear") {
        firstDate.value = moment().startOf('y').format('DD-MM-YYYY')
        secondDate.value = moment().endOf('y').format('DD-MM-YYYY')
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
        secondDate.value = moment().endOf('y').format('DD-MM-YYYY')
    } else if (input === "liArbitrarily") {
        firstDate.value = values[findPartial( values, "firstDate" +cookie)].split('=')[1]
        secondDate.value = values[findPartial( values, "secondDate" +cookie)].split('=')[1]
    }

    return input;
}

let values = document.cookie.split(";")

if (getCookie("ulDesigner" + cookie) === null) {
    designers = "Все дизайнеры"
} else {
    designers = values[findPartial( values, "ulDesigner"+cookie)].split('=')[1]
}


if (getCookie("ulPeriod" + cookie) === null) {
    document.cookie = "ulPeriod"+cookie+"=liCurrentMonth";
    firstDate = moment().startOf('M').format('DD-MM-YYYY')
    secondDate = moment().endOf('M').add(+1, 'd').format('DD-MM-YYYY')
    document.cookie = "ulDesigner"+cookie+"=Все дизайнеры";
    ajaxClients(firstDate, secondDate, designers)
}

for (let i = 0; i < values.length; i++) {
    if (values[i].trim().split("=")[0].includes(cookie) === true) {
        filterRow(values[i].trim().split("=")[1])
        if (values[i].trim().split("=")[1] === "Все дизайнеры" && values[i].trim().split("=")[0] === "ulDesignerClients") {
            $(".allDesigners a").css({'font-weight': 'bold'});
        } else if(values[i].trim().split("=")[0] === "ulDesignerClients") {
            $(".designers a").css({'font-weight': 'bold'});
        } else {
            $("." + values[i].trim().split("=")[1] + " a").css({'font-weight': 'bold'});
        }
    }
}

let tabTr = studentDataTable.getElementsByTagName("tr")
let designerArray = []
for (let i = 0; i < tabTr.length; i++) {
    let td = tabTr[i].getElementsByTagName("td")[9];
    if (td) {
        designerArray.push(td.innerHTML)
    }
}
designerArray = Array.from(new Set(designerArray));


for (let i = 0; i < designerArray.length; i++) {
    let ul = document.querySelector(".ulDesigner");
    let li = document.createElement("li");
    let a = document.createElement("A");
    li.classList.add("designer")
    ul.appendChild(li);
    a.innerHTML = designerArray[i]
    li.appendChild(a);
}
if ($(".allDesigners a").css('font-weight') !== "700") {
    $(".designer a").css({'font-weight': 'bold'});
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
            secondDate.value = moment().endOf('M').add(+1, 'd').format('DD-MM-YYYY')
        } else if (value === "liCurrentQuarter") {
            firstDate.value = moment().quarter(moment().quarter()).startOf('quarter').format('DD-MM-YYYY')
            secondDate.value = moment().quarter(moment().quarter()).endOf('quarter').add(+1, 'd').format('DD-MM-YYYY')
        } else if (value === "liThisYear") {
            firstDate.value = moment().startOf('y').format('DD-MM-YYYY')
            secondDate.value = moment().endOf('y').add(+1, 'd').format('DD-MM-YYYY')
        } else if (value === "liLastMonth") {
            firstDate.value = moment().startOf('M').add(-1, 'M').format('DD-MM-YYYY')
            secondDate.value = moment().subtract(1,'months').endOf('month').format('DD-MM-YYYY')
        } else if (value === "liLastQuarter") {
            firstDate.value = moment().quarter(moment().quarter()).startOf('quarter').add(-1, 'quarter').format('DD-MM-YYYY')
            secondDate.value = moment().quarter(moment().quarter()).endOf('quarter').add(-1, 'quarter').add(+1, 'd').format('DD-MM-YYYY')
        } else if (value === "liLastYear") {
            firstDate.value = moment().startOf('y').add(-1, 'y').format('DD-MM-YYYY')
            secondDate.value = moment().endOf('y').add(-1, 'y').add(+1, 'd').format('DD-MM-YYYY')
        } else if (value === "allTime") {
            firstDate.value = moment('2000/01/01', 'YYYY/MM/DD').format('DD-MM-YYYY')
            secondDate.value = moment().endOf('y').format('DD-MM-YYYY')
        }
    }
    if (key !== 'ulDesigner'+cookie && value !== 'liArbitrarily') {
        ajaxClients(firstDate.value, secondDate.value, designers)
    } else if (key === 'ulDesigner'+cookie && value !== 'liArbitrarily') {
        delete_cookie("ulDesigner"+cookie)
        document.cookie = key + "=" + targ.text;
        ajaxClients(firstDate.value, secondDate.value, targ.text)
        return;
    }
        document.cookie = key + "=" + value;
    jQuery(function($){
        $(document).mouseup(function (e){ // событие клика по веб-документу
            let div = $(".modalDate"); // тут указываем ID элемента
            let div2 = $(".pignose-calendar-wrapper")
            if ((!div.is(e.target) && div.has(e.target).length === 0) && (!div2.is(e.target) && div2.has(e.target).length === 0)) {
                document.cookie = "firstDate"+cookie+"=" + firstDate.value;
                document.cookie = "secondDate"+cookie+"=" + secondDate.value;
                ajaxClients(firstDate.value, secondDate.value, designers)
            }
        });
    });
});

buttonClose.onclick = function () {
    ajaxClients(firstDate.value, secondDate.value, designers)
    document.cookie = "firstDate"+cookie+"=" + firstDate.value;
    document.cookie = "secondDate"+cookie+"=" + secondDate.value;
}

cardClose.onclick = function () {
    document.cookie = "ulPeriod"+cookie+"=liCurrentMonth";
    firstDate = moment().startOf('M').format('DD-MM-YYYY')
    secondDate = moment().endOf('M').add(+1, 'd').format('DD-MM-YYYY')
    document.cookie = "ulDesigner"+cookie+"=Все дизайнеры";
    designers = "Все дизайнеры"
    ajaxClients(firstDate, secondDate, designers)
}

function findPartial( a, s ) {
    for( let i = 0; i < a.length; ++i )
        if( a[i].indexOf( s ) >= 0 )
            return i;
    return -1;
}

function ajaxClients(value1, value2, value3) {
    $.ajax ({
        url: "ordersRequest.php",
        type: "POST",
        data: ({firstDateClients: value1, secondDateClients: value2, designerClients: value3}),
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


console.log(values)
