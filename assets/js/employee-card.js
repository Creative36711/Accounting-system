let rowOrders = document.querySelectorAll(".media-body")
let changeEmployee = document.querySelector(".changeEmployee")
let employeeSurname = document.querySelector("#employeeSurname")
let employeeName = document.querySelector("#employeeName")
let employeePatronymic = document.querySelector("#employeePatronymic")
let position = document.querySelector("#position")
let activity = document.querySelector("#activity")
let employeeStatus = document.querySelector("#employeeStatus")
let ulStatus = document.querySelectorAll(".ulStatus li a")
let description = document.querySelector(".description")
let studentDataTable = document.querySelector(".student-data-table")
let firstDate = document.querySelector(".firstDate")
let secondDate = document.querySelector(".secondDate")
let cardHeaderRightIcon = document.querySelector(".rightIcon")
let buttonClose = document.querySelector(".buttonClose")
let cardClose = document.querySelector(".card-close")
let mediaHeading = document.querySelectorAll(".media-heading")
let ulKindWork = document.querySelectorAll(".ulKindWork li a")
let rowOrders2 = document.querySelectorAll(".student-data-table tr")
let orderChange = document.querySelectorAll(".orderChange")
let orderDelete = document.querySelectorAll(".orderDelete")
let numOrders = document.querySelector("#numOrders")
let employeeDate = document.querySelector(".employeeDate")
let selectEmployee = document.querySelector("#selectEmployee")
let typeService = document.querySelector("#typeService")
let sumEmployee = document.querySelector("#sumEmployee")
let employeeDescription = document.querySelector("#employeeDescription")

let cookie = "Employee"

for (let i = 0; i < rowOrders.length; i++)
    rowOrders[i].onclick = function() {
        let employeeAj = $(".media-heading")[i].innerText
        let employeeAjPosition = $(".media-body span")[i].innerText
        $.ajax ({
            url: "ordersRequest.php",
            type: "POST",
            data: ({employeeAj: employeeAj, employeeAjPosition:employeeAjPosition}),
            dataType: "html",
            success: function (data) {
                location.reload()
            }
        });
    }

changeEmployee.onclick = function (){
    let employeeAj2 = $(".user-profile-name").text()
    $("#condition").val("Обновить");
    $(".status").removeClass("displayNone")
    $.ajax ({
        url: "ordersRequest.php",
        type: "POST",
        data: ({employeeAj2: employeeAj2}),
        dataType: "html",
        success: function (data) {
           data = JSON.parse(data)
            employeeSurname.value = data[1]
            employeeName.value = data[2]
            employeePatronymic.value = data[3]
            position.value = data[4]
            activity.value = data[5]
            employeeStatus.value = data[7]
        }
    });
}

for (let i = 0; i < ulStatus.length; i++) {
    if ($(".activeStatus").text() === ulStatus[i].innerText) {
        ulStatus[i].classList.add("bold")
    }
}


for (let i = 0; i < ulKindWork.length; i++) {
    if ($(".activeStatus2").text() === ulKindWork[i].innerText) {
        ulKindWork[i].classList.add("bold")
    }
}


$(ulStatus).click(function (event) {
    let changeStatus = event.target.innerText;
    if ($(event.target).css('font-weight') === "700") return;
    $.ajax ({
        url: "ordersRequest.php",
        type: "POST",
        data: ({changeStatus: changeStatus}),
        dataType: "html",
        success: function (data) {
            location.reload()
        }
    });
});

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

description.onkeyup = function () {
    myFunction(5, description)
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
        secondDate.value = moment().subtract(1,'months').endOf('month').format('DD-MM-YYYY')
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

if (getCookie("ulPeriod" + cookie) === null) {
    document.cookie = "ulPeriod"+cookie+"=liCurrentMonth";
    firstDate = moment().startOf('M').format('DD-MM-YYYY')
    secondDate = moment().endOf('M').add(+1, 'd').format('DD-MM-YYYY')
    ajaxClients(firstDate, secondDate)
}

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
        ajaxClients(firstDate.value, secondDate.value)
    }
    if(key === 'ulKindWork'+cookie ) {
        ajaxClients2(targ.innerText)
        return
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

function ajaxClients(value1, value2) {
    $.ajax ({
        url: "ordersRequest.php",
        type: "POST",
        data: ({firstDateEmployee: value1, secondDateEmployee: value2}),
        dataType: "html",
        success: function (data) {
            location.reload()
        }
    });
}

function ajaxClients2(value1) {
    $.ajax ({
        url: "ordersRequest.php",
        type: "POST",
        data: ({KindWork: value1}),
        dataType: "html",
        success: function (data) {
            location.reload()
        }
    });
}

buttonClose.onclick = function () {
    ajaxClients(firstDate.value, secondDate.value)
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

for(let i = 0; i < mediaHeading.length; i++) {
    let newOption = new Option(mediaHeading[i].innerText);
    selectEmployee.append(newOption);
}

function moneyFormat() {
    this.value = this.value.replace(/\s/g, '')
    this.value = this.value.replace(",", '.')
    if (this.value.split(".")[1] !== undefined && this.value.split(".")[1].length > 2) {
        this.value = Number(this.value).toFixed(2)
    }
    this.value = new Intl.NumberFormat('ru-RU').format(this.value)
    if (this.value !== "" && this.value.indexOf(',') < 0) {
        this.value += ",00"
    }
    if (this.value.split(",")[1].length === 1) {
        this.value += "0"
    }
}

sumEmployee.onchange = moneyFormat
$(selectEmployee).val($(".user-profile-name").text())
employeeDate.value = moment().format('DD-MM-YYYY');


for (let i = 0; i < rowOrders2.length; i++)
    rowOrders2[i].onclick = function(event) {
        event = event || window.event;
        let target = event.target || event.srcElement;
        if (target === orderChange[i-1]) {
            if(this.childNodes[4].innerText === "Розница" || this.childNodes[4].innerText === "Модели" || this.childNodes[4].innerText === "Оклад"
             || this.childNodes[4].innerText === "Бонус" || this.childNodes[4].innerText === "Премия" || this.childNodes[4].innerText === "Штраф") {
                numOrders.value = this.childNodes[1].innerText
                 $('#addNote').modal('toggle'); 
                 document.querySelector("#addNote .modal-title").innerText = "Обновить запись:";
                 document.querySelector("#addNote .send").innerText = "Обновить";
                 let employeeAj3 = numOrders.value

                 $.ajax ({
                    url: "ordersRequest.php",
                    type: "POST",
                    data: ({employeeAj3: employeeAj3}),
                    dataType: "html",
                    success: function (data) {
                        data = JSON.parse(data);
                        employeeDate.value = data[1]
                        selectEmployee.value = data[2]
                        sumEmployee.value = data[3].slice(0,-2).replace("-", '')
                        typeService.value = data[5]
                        employeeDescription.value = data[4]
                        console.log(data);
                    }
                });

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ошибка',
                    text: 'Вы не можете редактировать данную запись на этой странице!'
                  })
            }
        }
        if (target === orderDelete[i-1]) {
            if(this.childNodes[4].innerText === "Розница" || this.childNodes[4].innerText === "Модели" || this.childNodes[4].innerText === "Оклад"
            || this.childNodes[4].innerText === "Бонус" || this.childNodes[4].innerText === "Премия" || this.childNodes[4].innerText === "Штраф") {
                let delEmployee = this.childNodes[1].innerText
                function deleteOrders() {
                    $(document).ready (function () {
                        $.ajax ({
                            url: "ordersRequest.php",
                            type: "POST",
                            data: ({delEmployee: delEmployee}),
                            dataType: "html",
                            success: function (data) {
                                location.reload(data)
                            }
                        });
                    });
                }
                Swal.fire({
                    title: 'Вы уверены?',
                    text: "После удаления вы не сможете восстановить эту запись!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Да, удалить запись',
                    cancelButtonText: "Отмена",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Успешно!',
                            'Данная запись была удалена!',
                            'success',
                        )
                        deleteOrders();
                    }
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ошибка',
                    text: 'Вы не можете удалить данную запись на этой странице!'
                  })
            }
        }   


    }


console.log(values)