let typeOfServiceInput = document.querySelector("#typeOfServiceInput")
let serviceProviderInput = document.querySelector("#serviceProviderInput")
let serviceAmount2 = document.querySelector(".serviceAmount2")
let percentageOfServiceInput = document.querySelector("#percentageOfServiceInput")
let serviceDescription2 = document.querySelector(".serviceDescription2")
let orderNumberServices = document.querySelector(".orderNumberServices")
let orderNumberServices2 = document.querySelector(".orderNumberServices2")
let rowOrders = document.querySelectorAll(".student-data-table tr")
let numServices = document.querySelector("#numServices")
let orderDelete = document.querySelectorAll(".orderDelete")
let orderChange = document.querySelectorAll(".orderChange")
let studentDataTable = document.querySelector(".student-data-table")
let addServices = document.querySelector("#addServices")
let saveInquiries = document.querySelector(".saveInquiries")
let range_021 = document.querySelector("#range_021")
let numLin021 = parseInt(document.querySelector(".numLin021").innerText)

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
    transport()
}

serviceAmount2.onchange = moneyFormat

for (let i = 0; i < rowOrders.length; i++)
    rowOrders[i].onclick = function(event) {
        event = event || window.event;
        let target = event.target || event.srcElement;
        if (target === orderChange[i-1]) {
            numServices.value = this.childNodes[7].innerText
            document.querySelector(".card-header h4").innerText = "Обновить услугу";
            document.querySelector("#addServices").innerText = "Обновить услугу";
            let numServicesAj = numServices.value
            $(document).ready (function () {
                $.ajax ({
                    url: "ordersRequest.php",
                    type: "POST",
                    data: ({numServicesAj: numServicesAj}),
                    dataType: "html",
                    success: function (data) {
                        data = JSON.parse(data);
                        orderNumberServices.value = data[1]
                        typeOfServiceInput.value = data[2]
                        serviceProviderInput.value = data[5]
                        serviceAmount2.value = data[4].slice(0,-2)
                        percentageOfServiceInput.value = formatPercentage(numFormat(data[6]) / numFormat(data[4]))
                        serviceDescription2.value = data[3]
                    }
                });
            });
        }
        if (target === orderDelete[i-1]) {
            let delSer = this.childNodes[7].innerText
            function deleteOrders() {
                $(document).ready (function () {
                    $.ajax ({
                        url: "ordersRequest.php",
                        type: "POST",
                        data: ({delSer: delSer}),
                        dataType: "html",
                        success: function (data) {
                            location.reload(data)
                        }
                    });
                });
            }
            Swal.fire({
                title: 'Вы уверены?',
                text: "После удаления вы не сможете восстановить эту услугу!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Да, удалить услугу',
                cancelButtonText: "Отмена",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Успешно!',
                        'Услуга была удалена!',
                        'success',
                    )
                    deleteOrders();
                }
            })
        }
}

let sortedRows = Array.from(studentDataTable.rows)
    .slice(1)
    .sort((rowA, rowB) => rowA.cells[0].innerHTML > rowB.cells[0].innerHTML ? 1 : -1);

studentDataTable.tBodies[0].append(...sortedRows);

function filterRow (input) {
    let filter, table, tr, td, i;
    filter = input;
    table = studentDataTable;
    tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                if (td.innerHTML.indexOf(filter) === 0) {
                    tr[i].classList.remove("delete")
                } else {
                    tr[i].classList.add("delete")
                }
            }
        }

    $(".delete").remove()
    return input;
}

let values = document.cookie.split(";")


addServices.onclick = function () {
    document.cookie = "numberOrder=" + orderNumberServices.value;
}

orderNumberServices2.onchange = function () {
    document.cookie = "numberOrder=" + orderNumberServices2.value;
    location.reload()
}
if (values[findPartial( values, "numberOrder" )] === undefined) {
    document.cookie = "numberOrder=" + studentDataTable.getElementsByTagName("tr")[1].childNodes[1].innerText
    values = document.cookie.split(";")
}

orderNumberServices.value = values[findPartial( values, "numberOrder" )].split('=')[1]

filterRow(values[findPartial( values, "numberOrder" )].split('=')[1])


function delete_cookie(name) {
    document.cookie = name +'=; Path=assets/js/orders.js; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function transport() {
    if (typeOfServiceInput.value === "Транспортные услуги") {
        serviceProviderInput.removeAttribute("required")
        percentageOfServiceInput.removeAttribute("required")
        $('#serviceProvider').addClass("displayNone");
        $('#percentageOfService').addClass("displayNone");
        serviceProviderInput.value = ""
        percentageOfServiceInput.value = ""
    } else {
        serviceProviderInput.setAttribute("required", "required");
        percentageOfServiceInput.setAttribute("required", "required");
        $('#serviceProvider').removeClass("displayNone");
        $('#percentageOfService').removeClass("displayNone");
    }
}

orderNumberServices.onchange = transport
typeOfServiceInput.onchange = transport
serviceProviderInput.onchange = transport
percentageOfServiceInput.onchange = transport
serviceDescription2.onchange = transport

saveInquiries.onclick = function () {
    let stringsServices = parseInt(range_021.value)
    delete_cookie("stringsServices")
    document.cookie = "stringsServices=" + stringsServices + ";  expires=" + now.toUTCString() + "; path=/";
                location.reload()
}

$(function () {
    let numLin021 = parseInt(document.querySelector(".numLin021").innerText) - 1
    let from = values[findPartial( values, "stringsServices" )].split('=')[1]
    $("#range_021").ionRangeSlider({
        min: 100,
        max: numLin021,
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
document.cookie = "numLin021=" + numLin021 + ";  expires=" + now.toUTCString() + "; path=/";

function numFormat(val){
    val = val.slice(0,-2)
    val = parseFloat(val.replace(/\s/g, '').replace(",", '.'))
    return val;
}

function  formatPercentage(percent) {
    percent = (percent * 100).toFixed(0)
    percent = String(percent)
    if (percent !== "" && percent.indexOf(',') < 0) {
        percent += ",00"
    }
    if (percent.split(",")[1].length === 1) {
        percent += "0"
    }
    percent = percent.replace(".", ',') + "%"
    return percent
}

$(document).ready (function () {
    $.ajax ({
        url: "ordersRequest.php",
        type: "POST",
        data: ({propertySelect: 'Исполнитель'}),
        dataType: "html",
        success: function (data) {
            data = JSON.parse(data);
            let option
            for (let i = 0; i < data.length; i++) {
                if (data[i][1] !== "Счет") {
                    option = document.createElement("option");
                    option.innerText = data[i][0]
                    serviceProviderInput.appendChild(option)
                }
            }
        }
    });
});

console.log(values)
