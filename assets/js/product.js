let orderNumberProduct = document.querySelector(".orderNumberProduct")
let pannierCode2 = document.querySelector(".pannierCode2")
let pannierProduct2 = document.querySelector(".pannierProduct2")
let pannierVendorCode2 = document.querySelector(".pannierVendorCode2")
let pannierQuantity2 = document.querySelector(".pannierQuantity2")
let pannierProductGroup2 = document.querySelector("#pannierProductGroup2")
let pannierUnitInput = document.querySelector("#pannierUnitInput")
let pannierPrice2 = document.querySelector(".pannierPrice2")
let pannierSum2 = document.querySelector(".pannierSum2")
let pannierCheckbox1 = document.querySelector(".pannierCheckbox1")
let pannierCheckbox2 = document.querySelector(".pannierCheckbox2")
let rowOrders = document.querySelectorAll(".student-data-table tr")
let numProduct = document.querySelector("#numProduct")
let orderChange = document.querySelectorAll(".orderChange")
let orderDelete = document.querySelectorAll(".orderDelete")
let studentDataTable = document.querySelector(".student-data-table")
let orderNumberProduct2 = document.querySelector(".orderNumberProduct2")
let addProduct = document.querySelector("#addProduct")
let customProduct = document.querySelector(".customProduct")
let numOr = document.querySelectorAll(".numOr")
let cardClose = document.querySelector(".card-close")
let saveInquiries = document.querySelector(".saveInquiries")
let range_022 = document.querySelector("#range_022")
let numLin022 = parseInt(document.querySelector(".numLin022").innerText)
let itemAmount = document.querySelector(".itemAmount")

pannierPrice2.onchange = function () {
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

    pannierSum2.value = pannierSum2.value.replace(/\s/g, '')
    pannierSum2.value = pannierSum2.value.replace(",", '.')
    if (pannierSum2.value.split(".")[1] !== undefined && pannierSum2.value.split(".")[1].length > 2) {
        pannierSum2.value = Number(pannierSum2.value).toFixed(2)
    }
    pannierSum2.value = new Intl.NumberFormat('ru-RU').format(pannierSum2.value)
    if (pannierSum2.value !== "" && pannierSum2.value.indexOf(',') < 0) {
        pannierSum2.value += ",00"
    }
    if (pannierSum2.value.split(",")[1].length === 1) {
        pannierSum2.value += "0"
    }
}

pannierQuantity2.onchange = function () {
    this.value = this.value.replace(/\s/g, '')
    this.value = this.value.replace(",", '.')
    if (this.value.split(".")[1] !== undefined && this.value.split(".")[1].length > 2) {
        this.value = Number(this.value).toFixed(2)
    }
    this.value = this.value.replace(".", ',')

    pannierSum2.value = pannierSum2.value.replace(/\s/g, '')
    pannierSum2.value = pannierSum2.value.replace(",", '.')
    if (pannierSum2.value.split(".")[1] !== undefined && pannierSum2.value.split(".")[1].length > 2) {
        pannierSum2.value = Number(pannierSum2.value).toFixed(2)
    }
    pannierSum2.value = new Intl.NumberFormat('ru-RU').format(pannierSum2.value)
    if (pannierSum2.value !== "" && pannierSum2.value.indexOf(',') < 0) {
        pannierSum2.value += ",00"
    }
    if (pannierSum2.value.split(",")[1].length === 1) {
        pannierSum2.value += "0"
    }
}

function sumInput () {
    pannierSum2.value = pannierQuantity2.value.replace(/\s/g, '').replace(",", ".") * pannierPrice2.value.replace(/\s/g, '').replace(",", ".")
}

pannierPrice2.oninput = sumInput
pannierQuantity2.oninput = sumInput

pannierCode2.onchange = function () {

    pannierPrice2.value = pannierPrice2.value.replace(/\s/g, '')
    pannierPrice2.value = pannierPrice2.value.replace(",", '.')
    if (pannierPrice2.value.split(".")[1] !== undefined && pannierPrice2.value.split(".")[1].length > 2) {
        pannierPrice2.value = Number(pannierPrice2.value).toFixed(2)
    }
    pannierPrice2.value = new Intl.NumberFormat('ru-RU').format(pannierPrice2.value)
    if (pannierPrice2.value !== "" && pannierPrice2.value.indexOf(',') < 0) {
        pannierPrice2.value += ",00"
    }
    if (pannierPrice2.value.split(",")[1].length === 1) {
        pannierPrice2.value += "0"
    }

    pannierSum2.value = pannierSum2.value.replace(/\s/g, '')
    pannierSum2.value = pannierSum2.value.replace(",", '.')
    if (pannierSum2.value.split(".")[1] !== undefined && pannierSum2.value.split(".")[1].length > 2) {
        pannierSum2.value = Number(pannierSum2.value).toFixed(2)
    }
    pannierSum2.value = new Intl.NumberFormat('ru-RU').format(pannierSum2.value)
    if (pannierSum2.value !== "" && pannierSum2.value.indexOf(',') < 0) {
        pannierSum2.value += ",00"
    }
    if (pannierSum2.value.split(",")[1].length === 1) {
        pannierSum2.value += "0"
    }

    if (this.value !== "") {
        $(pannierProduct2).attr('readonly', true);
        $(pannierUnitInput).attr('readonly', true);
        $(pannierPrice2).attr('readonly', true);
    } else {
        $(pannierProduct2).attr('readonly', false);
        $(pannierUnitInput).attr('readonly', false);
        $(pannierPrice2).attr('readonly', false);
    }

}

// Данные из списка

// Поиск кода
function getTableColumnCodeGlobal(col){
    let ColumnCodeGlobal=[];
    $('.listWithCodes').each(function() {
        $('tr>td:nth-child('+col+')',$(this)).each(function() {
            ColumnCodeGlobal.push($(this).text());
        });
    });
    return ColumnCodeGlobal;
}
let codeGlobal = getTableColumnCodeGlobal(1);

codeGlobal.splice(0, 2);

for(let i = 0; i < codeGlobal.length; i++)
{
    codeGlobal[i] = codeGlobal[i].replace(/\n/g, '')
}

// Поиск наименования
function getTableColumnCodeGlobal2(col){
    let ColumnCodeGlobal=[];
    $('.listWithCodes').each(function() {
        $('tr>td:nth-child('+col+')',$(this)).each(function() {
            ColumnCodeGlobal.push($(this).text());
        });
    });
    return ColumnCodeGlobal;
}
let codeGlobal2 = getTableColumnCodeGlobal2(2);

for(let i = 0; i < codeGlobal2.length; i++)
{
    codeGlobal2[i] = codeGlobal2[i].replace(/\n/g, '')
}

// Поиск ед изм
function getTableColumnCodeGlobal3(col){
    let ColumnCodeGlobal=[];
    $('.listWithCodes').each(function() {
        $('tr>td:nth-child('+col+')',$(this)).each(function() {
            ColumnCodeGlobal.push($(this).text());
        });
    });
    return ColumnCodeGlobal;
}
let codeGlobal3 = getTableColumnCodeGlobal3(3);

for(let i = 0; i < codeGlobal3.length; i++)
{
    codeGlobal3[i] = codeGlobal3[i].replace(/\n/g, '')
}

// Поиск цены
function getTableColumnCodeGlobal4(col){
    let ColumnCodeGlobal=[];
    $('.listWithCodes').each(function() {
        $('tr>td:nth-child('+col+')',$(this)).each(function() {
            ColumnCodeGlobal.push($(this).text());
        });
    });
    return ColumnCodeGlobal;
}
let codeGlobal4 = getTableColumnCodeGlobal4(4);

for(let i = 0; i < codeGlobal4.length; i++)
{
    codeGlobal4[i] = codeGlobal4[i].replace(/\n/g, '')
}

// Появление данных при вводе кода
pannierCode2.oninput = function() {
    let codeInput = codeGlobal.indexOf(this.value)
    pannierProduct2.value = codeGlobal2[codeInput]
    pannierUnitInput.value = codeGlobal3[codeInput]
    pannierPrice2.value = codeGlobal4[codeInput]
    if (pannierCode2.value === "") {
        pannierProduct2.value = ""
        pannierPrice2.value = ""
    }
    // Суммирование
    pannierSum2.value = pannierQuantity2.value.replace(/\s/g, '').replace(",", ".") * pannierPrice2.value.replace(/\s/g, '').replace(",", ".")
}

for (let i = 0; i < rowOrders.length; i++)
    rowOrders[i].onclick = function(event) {
        event = event || window.event;
        let target = event.target || event.srcElement;
        if (target === orderChange[i-1]) {
            numProduct.value = this.childNodes[11].innerText
            document.querySelector(".card-header h4").innerText = "Обновить товар";
            document.querySelector("#addProduct").innerText = "Обновить товар";
            let numProductAj = numProduct.value
            $(document).ready (function () {
                $.ajax ({
                    url: "ordersRequest.php",
                    type: "POST",
                    data: ({numProductAj: numProductAj}),
                    dataType: "html",
                    success: function (data) {
                        data = JSON.parse(data);
                        orderNumberProduct.value = data[1]
                        pannierCode2.value = data[3]
                        pannierProduct2.value = data[2]
                        pannierQuantity2.value = data[7]
                        pannierProductGroup2.value = data[4]
                        pannierVendorCode2.value = data[5]
                        pannierUnitInput.value = data[6]
                        pannierPrice2.value = data[8].slice(0,-2)
                        pannierSum2.value = data[9].slice(0,-2)
                        data[10] === "Да" ? $(pannierCheckbox1).attr('checked',true) : $(pannierCheckbox1).attr('checked',false);
                    }
                });
            });
        }
        if (target === orderDelete[i-1]) {
            let delProd = this.childNodes[11].innerText
            function deleteOrders() {
                $(document).ready (function () {
                    $.ajax ({
                        url: "ordersRequest.php",
                        type: "POST",
                        data: ({delProd: delProd}),
                        dataType: "html",
                        success: function (data) {
                            location.reload(data)
                        }
                    });
                });
            }
            Swal.fire({
                title: 'Вы уверены?',
                text: "После удаления вы не сможете восстановить этот товар!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Да, удалить товар',
                cancelButtonText: "Отмена",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Успешно!',
                        'Товар был удален!',
                        'success',
                    )
                    deleteOrders();
                }
            })
        }
    }

let sortedRows = Array.from(studentDataTable.rows)
    .slice(1)
    .sort((rowA, rowB) => rowA.cells[4].innerHTML > rowB.cells[4].innerHTML ? 1 : -1);

studentDataTable.tBodies[0].append(...sortedRows);

function filterRow (input) {
    let filter, table, tr, td, i, arr;
    filter = input;
    if (filter !== "Да") {
        arr = 1;
    } else {
        arr = 10;
        $(numOr).removeClass("displayNone")
    }
    table = studentDataTable;
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[arr];
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


addProduct.onclick = function () {
    document.cookie = "numberOrder=" + orderNumberProduct.value;
}

orderNumberProduct2.onchange = function () {
    document.cookie = "numberOrder=" + orderNumberProduct2.value;
    location.reload()
}

if (values[findPartial( values, "numberOrder" )] === undefined) {
    document.cookie = "numberOrder=" + studentDataTable.getElementsByTagName("tr")[1].childNodes[1].innerText
    values = document.cookie.split(";")
}

orderNumberProduct.value = values[findPartial( values, "numberOrder" )].split('=')[1]

if (values.indexOf('customProduct=Да') !== -1 || values.indexOf(' customProduct=Да') !== -1) {
    $(".customProduct a").css({'font-weight': 'bold'});
    filterRow("Да")
} else {
    filterRow(values[findPartial( values, "numberOrder" )].split('=')[1])
}

function delete_cookie(name) {
    document.cookie = name +'=; Path=assets/js/orders.js; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

customProduct.onclick = function () {
    document.cookie = "customProduct=Да";
    location.reload()
}

cardClose.onclick = function () {
    delete_cookie("customProduct")
    location.reload()
}

saveInquiries.onclick = function () {
    let stringsProduct = parseInt(range_022.value)
    delete_cookie("stringsProduct")
    document.cookie = "stringsProduct=" + stringsProduct + ";  expires=" + now.toUTCString() + "; path=/";
                location.reload()
}

$(function () {
    let numLin022 = parseInt(document.querySelector(".numLin022").innerText) - 1
    let from = values[findPartial( values, "stringsProduct" )].split('=')[1]
    $("#range_022").ionRangeSlider({
        min: 100,
        max: numLin022,
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
document.cookie = "numLin022=" + numLin022 + ";  expires=" + now.toUTCString() + "; path=/";

itemAmount.onclick = function () {
    function getTableColumnValues3(col3){
        let columnValues=[];
        $(studentDataTable).each(function() {
            $('tr>td:nth-child('+col3+')',$(this)).each(function() {
                columnValues.push($(this).text());
            });
        });
        return columnValues;
    }
    let value3 = getTableColumnValues3(4);
    let value4 = getTableColumnValues3(10);

    for(let i = 0; i < value4.length; i++) {
        value4[i] = value4[i].replace(/\s/g, '').replace(",", '.')
    }

    let arrVal3 = []
    for(let i = 0; i < value3.length; i++) {
        if (value3[i] === "") {
            arrVal3.push(true)
        } else {
            arrVal3.push(false)
        }
    }

    let indices = [];

    let element = true
    let idx = arrVal3.indexOf(element);
    while (idx !== -1) {
        indices.push(idx);
        idx = arrVal3.indexOf(element, idx + 1);
    }


    for (let i = indices.length -1; i >= 0; i--)
        value4.splice(indices[i],1);

    // Суммирование
    let sumVal4 = 0;
    for(let i=0;i<value4.length;i++) {
        sumVal4 = sumVal4 + parseFloat(value4[i]);
    }

    sumVal4 = new Intl.NumberFormat('ru-RU').format(sumVal4)
    if (sumVal4 !== "" && sumVal4.indexOf(',') < 0) {
        sumVal4 += ",00"
    }
    if (sumVal4.split(",")[1].length === 1) {
        sumVal4 += "0"
    }
    Swal.fire('Сумма товара с заполненными кодами: ' + sumVal4 + " ₽")
}


console.log(values)


