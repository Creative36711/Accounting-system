let rowOrders = document.querySelectorAll(".student-data-table tr")
let orderChange = document.querySelectorAll(".orderChange")
let orderDelete = document.querySelectorAll(".orderDelete")
let cardClose = document.querySelector(".card-close")
let studentDataTable = document.querySelector(".student-data-table")
let cardHeaderRightIcon = document.querySelector(".card-header-right-icon")
let buttonClose = document.querySelector(".buttonClose")
let modalDate = document.querySelector(".modalDate")
let firstDate = document.querySelector(".firstDate")
let secondDate = document.querySelector(".secondDate")
let addLine = document.querySelector(".addLine")
let items
let invoices
let typeTransaction
let cookie = "Operations"

let counterparty = document.querySelector(".counterparty")
let itemDescription = document.querySelector(".itemDescription")

let ulItem = document.querySelector(".ulItem");
let ulInvoice = document.querySelector(".ulInvoice")

for (let i = 0; i < rowOrders.length; i++)
    rowOrders[i].onclick = function(event) {
        event = event || window.event;
        let target = event.target || event.srcElement;
        if (target === orderChange[i-1]) {
            sessionStorage.setItem('number', this.childNodes[1].innerText);
            sessionStorage.setItem('typeOperations', this.childNodes[8].innerText);
            window.location.href = "edit-operations.php"
        }
        if (target === orderDelete[i-1]) {
            let delOperations = this.childNodes[1].innerText
            let check
            if (this.childNodes[8].innerText !== "Перевод") {
                check = 0;
            } else {
                check = 1
            }
            function deleteOrders() {
                $(document).ready (function () {
                    $.ajax ({
                        url: "ordersRequest.php",
                        type: "POST",
                        data: ({delOperations: delOperations, check: check}),
                        dataType: "html",
                        success: function (data) {
                            location.reload(data)
                        }
                    });
                });
            }
            Swal.fire({
                title: 'Вы уверены?',
                text: "После удаления вы не сможете восстановить эту операцию!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Да, удалить операцию',
                cancelButtonText: "Отмена",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Успешно!',
                        'Данный операция была удалена!',
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

itemDescription.onkeyup = function () {
    myFunction(5, itemDescription)
}
counterparty.onkeyup = function () {
    myFunction(6, counterparty)
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

if (getCookie("ulItem" + cookie) === null) {
    items = "Все статьи"
    invoices = "Все счета"
} else {
    items = values[findPartial( values, "ulItem"+cookie)].split('=')[1]
    invoices = values[findPartial( values, "ulInvoice"+cookie)].split('=')[1]
}

if (getCookie("ulPeriod" + cookie) === null) {
    document.cookie = "ulPeriod"+cookie+"=liCurrentMonth";
    firstDate = moment().startOf('M').format('DD-MM-YYYY')
    secondDate = moment().endOf('M').add(+1, 'd').format('DD-MM-YYYY')
    document.cookie = "ulItem"+cookie+"=Все статьи";
    document.cookie = "ulInvoice"+cookie+"=Все счета";
    document.cookie = "ulTypeTransaction"+cookie+"=liAllType";
    typeTransaction = "Все операции"
    ajaxClients(firstDate, secondDate, items, invoices, typeTransaction)
}

typeTransaction = $("." + values[findPartial( values, "ulTypeTransaction"+cookie)].split('=')[1] + " a").text()

for (let i = 0; i < values.length; i++) {
    if (values[i].trim().split("=")[0].includes(cookie) === true) {
        filterRow(values[i].trim().split("=")[1])
        if (values[i].trim().split("=")[1] === "Все статьи" && values[i].trim().split("=")[0] === "ulItem"+cookie) {
            $(".itemAll a").css({'font-weight': 'bold'});
        } else if(values[i].trim().split("=")[0] === "ulItem"+cookie) {
            $(".items a").css({'font-weight': 'bold'});
        } else if (values[i].trim().split("=")[1] === "Все счета" && values[i].trim().split("=")[0] === "ulInvoice"+cookie) {
            $(".invoiceAll a").css({'font-weight': 'bold'});
        } else if(values[i].trim().split("=")[0] === "ulInvoice"+cookie) {
            $(".invoices a").css({'font-weight': 'bold'});
        } else {
            $("." + values[i].trim().split("=")[1] + " a").css({'font-weight': 'bold'});
        }
    }
}

function dynamicFilter(table, number, ulTag, name) {
    let tabTr = table
    let array = []
    for (let i = 0; i < tabTr.length; i++) {
        let td = tabTr[i].getElementsByTagName("td")[number];
        if (td) {
            array.push(td.innerHTML)
        }
    }
    array = Array.from(new Set(array));


    for (let i = 0; i < array.length; i++) {
        let ul = ulTag;
        let li = document.createElement("li");
        let a = document.createElement("A");
        li.classList.add(name)
        ul.appendChild(li);
        a.innerHTML = array[i]
        li.appendChild(a);
    }
    if ($("." + name + "All a").css('font-weight') !== "700") {
        $("." + name + " a").css({'font-weight': 'bold'});
    }
}

dynamicFilter(rowOrders, 4, ulItem, "item")
dynamicFilter(rowOrders, 7, ulInvoice, "invoice")

function delete_cookie(name) {
    document.cookie = name +'=; Path=assets/js/orders.js; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

$(cardHeaderRightIcon).click(function (event) {
    let targ, key, value;
    targ = event.target;
    value = targ.closest("li").classList[0]
    key = targ.closest('ul').classList[2]+cookie
    if (targ.tagName !== 'A' || ($(targ).css('font-weight') === "700" && value !== "liArbitrarily")) return;
    if (key === 'ulPeriod'+cookie && value !== 'liArbitrarily') {
        delete_cookie("ulPeriod" + cookie)
        if (value === "liCurrentMonth") {
            firstDate.value = moment().startOf('M').format('DD-MM-YYYY')
            secondDate.value = moment().endOf('M').format('DD-MM-YYYY')
        } else if (value === "liCurrentQuarter") {
            firstDate.value = moment().quarter(moment().quarter()).startOf('quarter').format('DD-MM-YYYY')
            secondDate.value = moment().quarter(moment().quarter()).endOf('quarter').format('DD-MM-YYYY')
        } else if (value === "liThisYear") {
            firstDate.value = moment().startOf('y').format('DD-MM-YYYY')
            secondDate.value = moment().endOf('y').format('DD-MM-YYYY')
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
            secondDate.value = moment().endOf('y').format('DD-MM-YYYY')
        }
        ajaxClients(firstDate.value, secondDate.value, items, invoices, typeTransaction)
    } else if (key === 'ulItem'+cookie && value !== 'liArbitrarily') {
        delete_cookie("ulItem"+cookie)
        document.cookie = key + "=" + targ.text;
        ajaxClients(firstDate.value, secondDate.value, targ.text, invoices, typeTransaction)
        return;
    } else if (key === 'ulInvoice'+cookie && value !== 'liArbitrarily') {
        delete_cookie("ulInvoice"+cookie)
        document.cookie = key + "=" + targ.text;
        ajaxClients(firstDate.value, secondDate.value, items, targ.text, typeTransaction)
        return;
    } else if (key === 'ulTypeTransaction'+cookie && value !== 'liArbitrarily') {
        delete_cookie("ulTypeTransaction"+cookie)
        document.cookie = key + "=" + value;
        ajaxClients(firstDate.value, secondDate.value, items, invoices, targ.text)
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
                ajaxClients(firstDate.value, secondDate.value, items, invoices, typeTransaction)
            }
        });
    });
});

buttonClose.onclick = function () {
    ajaxClients(firstDate.value, secondDate.value, items, invoices, typeTransaction)
    document.cookie = "firstDate"+cookie+"=" + firstDate.value;
    document.cookie = "secondDate"+cookie+"=" + secondDate.value;
}

cardClose.onclick = function () {
    document.cookie = "ulPeriod"+cookie+"=liCurrentMonth";
    firstDate = moment().startOf('M').format('DD-MM-YYYY')
    secondDate = moment().endOf('M').add(+1, 'd').format('DD-MM-YYYY')
    document.cookie = "ulItem"+cookie+"=Все статьи";
    items = "Все статьи"
    document.cookie = "ulInvoice"+cookie+"=Все счета";
    invoices = "Все счета"
    document.cookie = "ulTypeTransaction"+cookie+"=liAllType";
    typeTransaction = "Все операции"
    ajaxClients(firstDate, secondDate, items, invoices, typeTransaction)
}

function findPartial( a, s ) {
    for( let i = 0; i < a.length; ++i )
        if( a[i].indexOf( s ) >= 0 )
            return i;
    return -1;
}

function ajaxClients(value1, value2, value3, value4, value5) {
    $.ajax ({
        url: "ordersRequest.php",
        type: "POST",
        data: ({firstDateOperations: value1, secondDateOperations: value2, itemOperations: value3, invoiceOperations: value4, typeTransactionOperations: value5}),
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

addLine.onclick = function () {
        (async () => {
            const inputOptions = new Promise((resolve) => {
                setTimeout(() => {
                    resolve({
                        'Приход': 'Приход',
                        'Расход': 'Расход',
                        'Перевод': 'Перевод',
                        'Задолженность': 'Задолженность',
                        'Товародвижение': 'Товародвижение'
                    })
                }, 0)
            })

            const { value: color } = await Swal.fire({
                title: 'Выберите, какую операцию желаете внести',
                input: 'radio',
                inputOptions: inputOptions,
                customClass: 'swal-wide',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Вам нужно выбрать хотя бы один вариант!'
                    }
                }
            })
            if (color) {
                sessionStorage.setItem('typeOperations', `${color}`);
                window.location.href = "edit-operations.php"
            }
        })()
}


console.log(values)
