let rowOrders = document.querySelectorAll(".student-data-table tr")
let orderViewing = document.querySelectorAll(".orderViewing")
let orderChange = document.querySelectorAll(".orderChange")
let orderDelete = document.querySelectorAll(".orderDelete")
let cardClose = document.querySelector(".card-close")
let studentDataTable = document.querySelector(".student-data-table")
let inputRounded = document.querySelector(".input-rounded")
let cardHeaderRightIcon = document.querySelector(".card-header-right-icon")
let firstDate = document.querySelector(".firstDate")
let secondDate = document.querySelector(".secondDate")
let buttonClose = document.querySelector(".buttonClose")
let modalDate = document.querySelector(".modalDate")
let saveInquiries = document.querySelector(".saveInquiries")
let range_023 = document.querySelector("#range_023")
let numLin023 = parseInt(document.querySelector(".numLin023").innerText)
let cookie = "Model"

for (let i = 0; i < rowOrders.length; i++)
    rowOrders[i].onclick = function(event) {
        event = event || window.event;
        let target = event.target || event.srcElement;
        if (target === orderChange[i-1]) {
            sessionStorage.setItem('number', this.childNodes[1].innerText);
            window.location.href = "edit-model.php"
        }
        if (target === orderDelete[i-1]) {
            let delModel = this.childNodes[1].innerText
            function deleteOrders() {
                $(document).ready (function () {
                    $.ajax ({
                        url: "ordersRequest.php",
                        type: "POST",
                        data: ({delModel: delModel}),
                        dataType: "html",
                        success: function (data) {
                            location.reload(data)
                        }
                    });
                });
            }
            Swal.fire({
                title: 'Вы уверены?',
                text: "После удаления вы не сможете восстановить эту модель!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Да, удалить модель',
                cancelButtonText: "Отмена",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Успешно!',
                        'Данная модель была удалена!',
                        'success',
                    )
                    deleteOrders();
                }
            })
        }
        if (target === orderViewing[i-1]) {
            document.cookie = "numberOrder=" + this.childNodes[1].innerText;
            (async () => {
                const inputOptions = new Promise((resolve) => {
                    setTimeout(() => {
                        resolve({
                            'services.php': 'Услуги',
                            'product.php': 'Товар',
                            'order-summary.php': 'Сводка',
                        })
                    }, 0)
                })

                const { value: color } = await Swal.fire({
                    title: 'Выберите, что желаете просмотреть',
                    input: 'radio',
                    inputOptions: inputOptions,
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Вам нужно выбрать хотя бы один вариант!'
                        }
                    }
                })
                if (color) {
                    window.location.href = `${color}`
                }
            })()
        }
}

let sortedRows = Array.from(studentDataTable.rows)
    .slice(1)
    .sort((rowA, rowB) => rowA.cells[0].innerHTML > rowB.cells[0].innerHTML ? 1 : -1);

studentDataTable.tBodies[0].append(...sortedRows);

function myFunction() {
    let input, filter, table, tr, td, i;
    input = inputRounded;
    filter = input.value.toUpperCase();
    table = studentDataTable;
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

inputRounded.onkeyup = function () {
    myFunction()
}

function filterRow (input) {
    let number;
    if (input === "Текущий месяц") {
        firstDate.value = moment().startOf('M').format('DD-MM-YYYY')
        secondDate.value = moment().endOf('M').format('DD-MM-YYYY')
        number = 2
    } else if (input === "Текущий квартал") {
        firstDate.value = moment().quarter(moment().quarter()).startOf('quarter').format('DD-MM-YYYY')
        secondDate.value = moment().quarter(moment().quarter()).endOf('quarter').format('DD-MM-YYYY')
        number = 2
    } else if (input === "Текущий год") {
        firstDate.value = moment().startOf('y').format('DD-MM-YYYY')
        secondDate.value = moment().endOf('y').format('DD-MM-YYYY')
        number = 2
    } else if (input === "Прошлый месяц") {
        firstDate.value = moment().startOf('M').add(-1, 'M').format('DD-MM-YYYY')
        secondDate.value = moment().subtract(1,'months').endOf('month').format('DD-MM-YYYY')
        number = 2
    } else if (input === "Прошлый квартал") {
        firstDate.value = moment().quarter(moment().quarter()).startOf('quarter').add(-1, 'quarter').format('DD-MM-YYYY')
        secondDate.value = moment().quarter(moment().quarter()).endOf('quarter').add(-1, 'quarter').format('DD-MM-YYYY')
        number = 2
    } else if (input === "Прошлый год") {
        firstDate.value = moment().startOf('y').add(-1, 'y').format('DD-MM-YYYY')
        secondDate.value = moment().endOf('y').add(-1, 'y').format('DD-MM-YYYY')
        number = 2
    } else if (input === "Все время") {
        firstDate.value = moment('2000/01/01', 'YYYY/MM/DD').format('DD-MM-YYYY')
        secondDate.value = moment().endOf('y').format('DD-MM-YYYY')
        number = 2
    } else if (input === "Произвольный период") {
        firstDate.value = values[findPartial( values, "firstDate"+cookie)].split('=')[1]
        secondDate.value = values[findPartial( values, "secondDate"+cookie)].split('=')[1]
        number = 2
    } else if (typeof number === 'undefined') {
        return;
    }
    let filter, table, tr, td, i;
    filter = input;
    table = studentDataTable;
    tr = table.getElementsByTagName("tr");
    if (number !== 2) {
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[number];
            if (td) {
                if (td.innerHTML.indexOf(filter) > -1) {
                    tr[i].classList.remove("delete")
                } else {
                    tr[i].classList.add("delete")
                }
            }
        }
    } else {
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[number];
            if (td) {
                if (standardDate(td.innerHTML) >= standardDate(firstDate.value) && standardDate(td.innerHTML) <= standardDate(secondDate.value)) {
                    tr[i].classList.remove("delete")
                } else {
                    tr[i].classList.add("delete")
                }
            }
        }
    }

    $(".delete").remove()
    return input;
}

let values = document.cookie.split(";")
if (values.map(function(d){return d.trim()}).indexOf("liCurrentMonth"+cookie+"=Текущий месяц") === -1
    && values.map(function(d){return d.trim()}).indexOf("liCurrentQuarter"+cookie+"=Текущий квартал") === -1
    && values.map(function(d){return d.trim()}).indexOf("liThisYear"+cookie+"=Текущий год") === -1
    && values.map(function(d){return d.trim()}).indexOf("liLastMonth"+cookie+"=Прошлый месяц") === -1
    && values.map(function(d){return d.trim()}).indexOf("liLastQuarter"+cookie+"=Прошлый квартал") === -1
    && values.map(function(d){return d.trim()}).indexOf("liLastYear"+cookie+"=Прошлый год") === -1
    && values.map(function(d){return d.trim()}).indexOf("allTime"+cookie+"=Все время") === -1
    && values.map(function(d){return d.trim()}).indexOf("liArbitrarily"+cookie+"=Произвольный период") === -1) {
    document.cookie = "liCurrentMonth"+cookie+"=Текущий месяц";
    values = document.cookie.split(";")
}

for (let i = 0; i < values.length; i++) {
    if (values[i].trim().split("=")[0].includes(cookie) === true) {
        filterRow(values[i].trim().split("=")[1])
        $("." + values[i].trim().split("=")[0].replace(cookie,'') + " a").css({'font-weight': 'bold'});
    }
}

function standardDate(date) {
    let dateArray = date.split('-');
    date = dateArray[1] + '/' + dateArray[0] + '/' + dateArray[2];
    date = new Date(date); // Nov 06 2013 00:00:00
    return date;
}

function delete_cookie(name) {
    document.cookie = name +'=; Path=assets/js/orders.js; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

$(cardHeaderRightIcon).click(function (event) {
    let value, key;
    value = event.target;
    key = value.closest("li").classList[0] + cookie
    if (value.tagName !== 'A' || ($(value).css('font-weight') === "700" && key !== "liArbitrarily"+cookie)) return;
    if (key === 'liArbitrarily'+cookie || key === 'firstDate'+cookie || key === 'secondDate'+cookie || key === 'liCurrentMonth'+cookie || key === 'liCurrentQuarter'+cookie || key === 'liThisYear'+cookie || key === 'liLastMonth'+cookie || key === 'liLastQuarter'+cookie || key === 'liLastYear'+cookie || key === 'allTime'+cookie) {
        delete_cookie("liCurrentMonth"+cookie)
        delete_cookie("liCurrentQuarter"+cookie)
        delete_cookie("liThisYear"+cookie)
        delete_cookie("liLastMonth"+cookie)
        delete_cookie("liLastQuarter"+cookie)
        delete_cookie("liLastYear"+cookie)
        delete_cookie("allTime"+cookie)
        delete_cookie("firstDate"+cookie)
        delete_cookie("secondDate"+cookie)
        delete_cookie("liArbitrarily"+cookie)
    }
    if (key === 'inquiries'+cookie) return;
    document.cookie = key + "=" + value.innerText;
    if (key !== 'liArbitrarily'+cookie) location.reload()
    jQuery(function($){
        $(document).mouseup(function (e){ // событие клика по веб-документу
            let div = $(".modalDate"); // тут указываем ID элемента
            let div2 = $(".pignose-calendar-wrapper")
            if ((!div.is(e.target) && div.has(e.target).length === 0) && (!div2.is(e.target) && div2.has(e.target).length === 0)) {
                document.cookie = "firstDate"+cookie+"=" + firstDate.value;
                document.cookie = "secondDate"+cookie+"=" + secondDate.value;
                location.reload()
            }
        });
    });
});

buttonClose.onclick = function () {
    document.cookie = "firstDate"+cookie+"=" + firstDate.value;
    document.cookie = "secondDate"+cookie+"=" + secondDate.value;
    location.reload()
}

cardClose.onclick = function () {
    delete_cookie("liCurrentMonth"+cookie)
    delete_cookie("liCurrentQuarter"+cookie)
    delete_cookie("liThisYear"+cookie)
    delete_cookie("liLastMonth"+cookie)
    delete_cookie("liLastQuarter"+cookie)
    delete_cookie("liLastYear"+cookie)
    delete_cookie("allTime"+cookie)
    delete_cookie("firstDate"+cookie)
    delete_cookie("secondDate"+cookie)
    delete_cookie("liArbitrarily"+cookie)

    document.cookie = "liCurrentMonth"+cookie+"=Текущий месяц";
    document.cookie = "allDesigners"+cookie+"=Все дизайнеры";
    document.cookie = "allStatuses"+cookie+"=Все";
    document.cookie = "allPrepayments"+cookie+"=Все";
    location.reload()
}

saveInquiries.onclick = function () {
    let stringsOrders = parseInt(range_023.value)
    delete_cookie("stringsModel")
    document.cookie = "stringsModel=" + stringsOrders + ";  expires=" + now.toUTCString() + "; path=/";
    location.reload()
}


$(function () {
    let numLin = parseInt(document.querySelector(".numLin023").innerText) - 1
    let from = values[findPartial( values, "stringsModel" )].split('=')[1]
    $("#range_023").ionRangeSlider({
        min: 100,
        max: numLin,
        from: from
    });
});


function findPartial( a, s ) {
    for( let i = 0; i < a.length; ++i )
        if( a[i].indexOf( s ) >= 0 )
            return i;
    return -1;
}

let now = new Date();
now.setTime(now.getTime() + 30 * 24 * 3600 * 1000);
document.cookie = "numLin023=" + numLin023 + ";  expires=" + now.toUTCString() + "; path=/";

console.log(values)