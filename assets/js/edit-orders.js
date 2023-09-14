// Обьявление переменных

let orderStatus = document.querySelector(".orderStatus")
let paymentState2 = document.querySelector(".paymentState2")
let orderNumber = document.querySelector('.orderNumber2');
let namePhone = document.querySelector('.phoneNumber2');
let surname = document.querySelector(".surname2")
let name = document.querySelector(".name2")
let patronymic = document.querySelector(".patronymic2")
let dateOfReadiness = document.querySelector(".dateOfReadiness2")
let orderPrice = document.querySelector(".orderPrice2")
let prepayment = document.querySelector(".prepayment2")
let paymentDate2 = document.querySelector(".paymentDate2")
let secondPrepayment = document.querySelector(".secondPrepayment2")
let thirdPrepayment = document.querySelector(".thirdPrepayment2")
let fourthPrepayment = document.querySelector(".fourthPrepayment2")
let fifthPrepayment = document.querySelector(".fifthPrepayment2")
let addOrder = document.querySelector("#addOrder")
let dateSecondPrepayment2 = document.querySelector(".dateSecondPrepayment2")
let dateThirdPrepayment2 = document.querySelector(".dateThirdPrepayment2")
let dateFourthPrepayment2 = document.querySelector(".dateFourthPrepayment2")
let dateFifthPrepayment2 = document.querySelector(".dateFifthPrepayment2")
let returnDate2 = document.querySelector(".returnDate2")
let orderDate = document.querySelector(".orderDate2")
let numOrders = document.querySelector("#numOrders")
let designer = document.querySelector(".designer2")
let prepaymentDate = document.querySelector(".prepaymentDate2")
let designerPercentage2 = document.querySelector(".designerPercentage2")
let deadline = document.querySelector(".deadline2")
let mainForm = document.querySelector("#mainForm")
let accountType = document.querySelector(".accountType")

// Автоматический процент дизайнера

designer.onchange = function () {
    if($('.designer2').val() === "Першукова О.П.") {
        $(".designerPercentage2").val("0,00%")
    }
}

// Показать новые предоплаты
document.querySelector(".addPrepayment").onclick = function () {
    if ($('#secondPrepayment').css('display') === "none") {
        $(".secondPrepayment").removeClass("displayNone");
        $(".dateSecondPrepayment").removeClass("displayNone");
    } else if ($('#thirdPrepayment').css('display') === "none") {
        $(".thirdPrepayment").removeClass("displayNone");
        $(".dateThirdPrepayment").removeClass("displayNone");
    } else if ($('#fourthPrepayment').css('display') === "none") {
        $(".fourthPrepayment").removeClass("displayNone");
        $(".dateFourthPrepayment").removeClass("displayNone");
    } else if ($('#fifthPrepayment').css('display') === "none") {
        $(".fifthPrepayment").removeClass("displayNone");
        $(".dateFifthPrepayment").removeClass("displayNone");
    }
}

// Вывести даты сдачи, возврата и оплаты
orderStatus.onchange = function () {
    if (orderStatus.value === "Возврат") {
        $(".returnDate2").val(moment().format('DD-MM-YYYY'));
        $(".returnDate").removeClass("displayNone");
        $(".addPrepayment").addClass("displayNone");
    } else {
        $(".returnDate").addClass("displayNone");
        $(".returnDate2").val("");
        $(".addPrepayment").removeClass("displayNone");
    }
    if (orderStatus.value === "Сдан") {
        $(".dateOfReadiness2").val(moment().format('DD-MM-YYYY'));
        $("#dateOfReadiness").removeClass("displayNone");
    } else {
        $("#dateOfReadiness").addClass("displayNone");
        $(".dateOfReadiness2").val("");
    }
    if (paymentState2.value === "Оплата" || orderStatus.value === "Возврат" || orderStatus.value === "Сдан") {
        $(".addPrepayment").addClass("displayNone");
    } else {
        $(".addPrepayment").removeClass("displayNone");
    }
}

paymentState2.onchange = function () {
    if (paymentState2.value === "Оплата") {
        $(".paymentDate2").val(moment().format('DD-MM-YYYY'));
        $("#paymentDate").removeClass("displayNone");
    } else {
        $("#paymentDate").addClass("displayNone");
        $(".paymentDate2").val("");
    }
    if (paymentState2.value === "Оплата" || orderStatus.value === "Возврат" || orderStatus.value === "Сдан") {
        $(".addPrepayment").addClass("displayNone");
    } else {
        $(".addPrepayment").removeClass("displayNone");
    }
}

// Автозаполнение номера заказа

let regex = /[^0-9\/+()-]/; // регулярка только цифры]
let data = new Date()
let month = String(0) + (data.getMonth() + 1)
if (month.length === 2) {
    month = String(0) + (data.getMonth() + 1)
} else {
    month = data.getMonth() + 1
}
year = data.getFullYear() - 2000
let numberOrder = "/" + month + "/" + year

function substitution () {
    this.value = this.value.replace(regex, '');

    if (orderNumber.value.length === 3) {
        $(this).val($(this).val() + numberOrder);
    }
}

orderNumber.onkeydown = function (event) {
    if (event.code !== "Backspace") {
        orderNumber.oninput = substitution
    } else {
        orderNumber.oninput = "";
    }
}

// Автозаполнение номера телефона

function phone() {
    this.value = this.value.replace(regex, '');

    if (namePhone.value.length === 1) {
        $(this).val($(this).val() + "+7(");
    }
    if (namePhone.value.length === 6) {
        $(this).val($(this).val() + ")");
    }
    if (namePhone.value.length === 10 || namePhone.value.length === 13) {
        $(this).val($(this).val() + "-");
    }
    let nam = namePhone.value.charAt(0)
    if (nam === "0" || nam === "1" || nam === "2" || nam === "3" || nam === "4" || nam === "5" || nam === "6" || nam === "7" || nam === "8" || nam === "9" || nam === "0") {
        this.value = this.value.replace(nam, '')
    }
}

namePhone.onkeydown = function (event) {
    if (event.code !== "Backspace") {
        namePhone.oninput = phone
    } else {
        namePhone.oninput = "";
    }
}

// Запрет на ввод символов в текстовый input

let regLetters = /[^а-яА-ЯёЁaA-zZ]/
let regText = /[0-9]/

function textInput () {
    this.value = this.value.replace(regLetters, '');
}

function textSInput () {
    this.value = this.value.replace(regText, '');
}

surname.oninput = textInput
name.oninput = textInput
patronymic.oninput = textSInput

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

orderPrice.onchange = function () {
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

    let or = parseFloat(this.value.replace(/\s/g, '').replace(",", '.'))
    let prep = parseFloat(prepayment.value.replace(/\s/g, '').replace(",", '.'))
    let prep2 = parseFloat(secondPrepayment.value.replace(/\s/g, '').replace(",", '.'))
    let prep3 = parseFloat(thirdPrepayment.value.replace(/\s/g, '').replace(",", '.'))
    let prep4 = parseFloat(fourthPrepayment.value.replace(/\s/g, '').replace(",", '.'))
    let prep5 = parseFloat(fifthPrepayment.value.replace(/\s/g, '').replace(",", '.'))

    if ((prep + prep2 + prep3 + prep4 + prep5) !== or && prep !== "" && prep !== 0) {
        paymentState2.value = "Предоплата"
    } else if ((prep + prep2 + prep3 + prep4 + prep5) === or) {
        paymentState2.value = "Оплата"
    } else if ((prep + prep2 + prep3 + prep4 + prep5) === 0) {
        paymentState2.value = "Не оплачен"
    } else if ((prep + prep2 + prep3 + prep4 + prep5) > or) {
        paymentState2.value = "Оплата"
    }

    if (paymentState2.value === "Оплата") {
        paymentDate2.value = moment().format('DD-MM-YYYY');
        $("#paymentDate").removeClass("displayNone");
    } else {
        $("#paymentDate").addClass("displayNone");
    }
    if (paymentState2.value === "Оплата" || orderStatus.value === "Возврат") {
        $(".addPrepayment").addClass("displayNone");
    } else {
        $(".addPrepayment").removeClass("displayNone");
    }
}

prepayment.onchange = function() {
    if (prepayment.value !== "") {
        document.querySelector('.prepaymentDate2').value = moment().format('DD-MM-YYYY');
    }
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

    let prep = parseFloat(this.value.replace(/\s/g, '').replace(",", '.'))
    let or = parseFloat(orderPrice.value.replace(/\s/g, '').replace(",", '.'))

    if (prep < or && prep !== "" && prep !== 0) {
        paymentState2.value = "Предоплата"
    } else if (prep === or) {
        paymentState2.value = "Оплата"
    } else if (prep === 0) {
        paymentState2.value = "Не оплачен"
    } else if (prep > or) {
        paymentState2.value = "Оплата"
    }

    if (paymentState2.value === "Оплата") {
        paymentDate2.value = moment().format('DD-MM-YYYY');
        $("#paymentDate").removeClass("displayNone");
    } else {
        $("#paymentDate").addClass("displayNone");
    }
    if (paymentState2.value === "Оплата" || orderStatus.value === "Возврат") {
        $(".addPrepayment").addClass("displayNone");
    } else {
        $(".addPrepayment").removeClass("displayNone");
    }
}

secondPrepayment.onchange = function() {
    if (secondPrepayment.value !== "0,00") {
        document.querySelector('.dateSecondPrepayment2').value = moment().format('DD-MM-YYYY');
    }
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

thirdPrepayment.onchange = function() {
    if (thirdPrepayment.value !== "0,00") {
        document.querySelector('.dateThirdPrepayment2').value = moment().format('DD-MM-YYYY');
    }
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

fourthPrepayment.onchange = function () {
    if (fourthPrepayment.value !== "0,00") {
        document.querySelector('.dateFourthPrepayment2').value = moment().format('DD-MM-YYYY');
    }
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

fifthPrepayment.onchange = function () {
    if (fifthPrepayment.value !== "0") {
        document.querySelector('.dateFifthPrepayment2').value = moment().format('DD-MM-YYYY');
    }
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

let examination = false

addOrder.onclick = function () {
    if (secondPrepayment.value === "0,00") {
        dateSecondPrepayment2.value = moment().format('DD-MM-YYYY');
    }
    if (thirdPrepayment.value === "0,00") {
        dateThirdPrepayment2.value = moment().format('DD-MM-YYYY');
    }
    if (fourthPrepayment.value === "0,00") {
        dateFourthPrepayment2.value = moment().format('DD-MM-YYYY');
    }
    if (fifthPrepayment.value === "0,00") {
        dateFifthPrepayment2.value = moment().format('DD-MM-YYYY');
    }
    if (orderStatus.value !== "Возврат") {
        returnDate2.value = moment().format('DD-MM-YYYY');
    }
    if (orderStatus.value !== "Сдан") {
        dateOfReadiness.value = moment().format('DD-MM-YYYY');
    }
    if (paymentState2.value !== "Оплата") {
        paymentDate2.value = moment().format('DD-MM-YYYY');
    }


    if (examination !== true && numOrders.value === "" && $(".paymentState2").val() !== "Не оплачен" ) 
        addOperations($(".prepaymentDate2").val(), $(".prepayment2").val(), "Предоплата по заказу")
    else if(examination !== true && numOrders.value === "" && $(".paymentState2").val() === "Не оплачен")
        addOperations2()
    else if(examination !== true && numOrders.value !== "" && $(".paymentState2").val() === "Не оплачен")
        orderClick()
    else if(examination !== true && numOrders.value !== "" && $(".orderStatus").val() !== "Возврат") {
        if(paymentStateBefore !== $(".paymentState2").val() && $(".paymentState2").val() === "Оплата") {
            let paymentChange = parseInt($(".orderPrice2").val().replace(/\s/g, '').replace(",", '.')) -  (parseInt($(".prepayment2").val().replace(/\s/g, '').replace(",", '.')) + parseInt($(".secondPrepayment2").val().replace(/\s/g, '').replace(",", '.')) + parseInt($(".thirdPrepayment2").val().replace(/\s/g, '').replace(",", '.')) + parseInt($(".fourthPrepayment2").val().replace(/\s/g, '').replace(",", '.')) + parseInt($(".fifthPrepayment2").val().replace(/\s/g, '').replace(",", '.')))
            addOperations3($(".paymentDate2").val(), paymentChange, "Доплата по заказу")
        } else if(secondPrepaymentBefore !== $(".secondPrepayment2").val()) {
            addOperations3($(".dateSecondPrepayment2").val(), $(".secondPrepayment2").val(), "Предоплата по заказу")
        } else if(thirdPrepaymentBefore !== $(".thirdPrepayment2").val()) {
            addOperations3($(".dateThirdPrepayment2").val(), $(".thirdPrepayment2").val(), "Предоплата по заказу")
        } else if(fourthPrepaymentBefore !== $(".fourthPrepayment2").val()) {
            addOperations3($(".dateFourthPrepayment2").val(), $(".fourthPrepayment2").val(), "Предоплата по заказу")
        } else if(fifthPrepaymentBefore !== $(".fifthPrepayment2").val()) {
            addOperations3($(".dateFifthPrepayment2").val(), $(".fifthPrepayment2").val(), "Предоплата по заказу")
        } else if(paymentStateBefore !== $(".paymentState2").val() && prepaymentBefore !== $(".prepayment2").val() && $(".paymentState2").val() === "Предоплата") {
            addOperations3($(".prepaymentDate2").val(), $(".prepayment2").val(), "Предоплата по заказу")
        } else {
            orderClick()
        }
    } else if(orderStatusBefore !== $(".orderStatus").val() && $(".orderStatus").val() === "Возврат" && $(".paymentState2").val() === "Предоплата" && numOrders.value !== "") {
        let paymentChange = parseInt($(".prepayment2").val().replace(/\s/g, '').replace(",", '.')) + parseInt($(".secondPrepayment2").val().replace(/\s/g, '').replace(",", '.')) + parseInt($(".thirdPrepayment2").val().replace(/\s/g, '').replace(",", '.')) + parseInt($(".fourthPrepayment2").val().replace(/\s/g, '').replace(",", '.')) + parseInt($(".fifthPrepayment2").val().replace(/\s/g, '').replace(",", '.'))
        addOperations3($(".returnDate2").val(), paymentChange, "Возврат денег клиенту")
    } else if(orderStatusBefore !== $(".orderStatus").val() && $(".orderStatus").val() === "Возврат" && $(".paymentState2").val() === "Оплата" && numOrders.value !== "") {
        addOperations3($(".returnDate2").val(), $(".orderPrice2").val(), "Возврат денег клиенту")
    }
}


function orderClick() {
    examination = true
    mainForm.setAttribute("onsubmit", " return true");
    addOrder.click()
}

function addOperations(date, sum, expenditure) {
    (async () => {
    let counterparty = $(".surname2").val() + " " + $(".name2").val().substr(0,1) + "." + $(".patronymic2").val().substr(0,1) + "."
    const { value: selectAccount } = await Swal.fire({
        title: 'Выберите счет на который поступили средства',
        confirmButtonText: 'Подтвердить',
        cancelButtonText: 'Отмена',
        input: 'select',
        inputOptions: {    
            'Касса': 'Касса',  
            'Наличные': 'Наличные',
            'Банковская карта': 'Банковская карта',
            'Расчетный счет': 'Расчетный счет',
        },
        inputPlaceholder: 'Выберите счет',
        showCancelButton: true,
        inputValidator: (value) => {
          return new Promise((resolve) => {
              resolve()
          })
        }
      })    
      $(document).ready (function () {
        $.ajax ({
            url: "ordersRequest.php",
            type: "POST",
            data: ({selectAccount: selectAccount, date: date, sum: sum, counterparty: counterparty, expenditure: expenditure, description: $('.orderNumber2').val()}),
            dataType: "html",
            success: function (data) {
               
            }
        });
    });
    const { value: numberClients } = await Swal.fire({
        title: 'Введите номер клиента',
        input: 'number',
        inputLabel: 'Пропустите этот шаг, если клиент новый',
        showCancelButton: true,
        confirmButtonText: 'Подтвердить',
        cancelButtonText: 'Пропустить',
        inputPlaceholder: 'Введите номер клиента'
    })
    if (parseInt(numberClients) > 1) {
        $(document).ready (function () {
            $.ajax ({
                url: "ordersRequest.php",
                type: "POST",
                data: ({numberClients: numberClients}),
                dataType: "html",
                success: function (data) {
                    
                }
            });
        });
    }
    orderClick()  
})()  
}

function addOperations2() {
    (async () => {
    const { value: numberClients } = await Swal.fire({
        title: 'Введите номер клиента',
        input: 'number',
        inputLabel: 'Пропустите этот шаг, если клиент новый',
        showCancelButton: true,
        confirmButtonText: 'Подтвердить',
        cancelButtonText: 'Пропустить',
        inputPlaceholder: 'Введите номер клиента'
    })
    if (parseInt(numberClients) > 1) {
        $(document).ready (function () {
            $.ajax ({
                url: "ordersRequest.php",
                type: "POST",
                data: ({numberClients: numberClients}),
                dataType: "html",
                success: function (data) {
                    
                }
            });
        });
    }
    orderClick()  
})()  
}

function addOperations3(date, sum, expenditure) {
    (async () => {
    let counterparty = $(".surname2").val() + " " + $(".name2").val().substr(0,1) + "." + $(".patronymic2").val().substr(0,1) + "."
    const { value: selectAccount } = await Swal.fire({
        title: 'Выберите счет на который поступили средства',
        confirmButtonText: 'Подтвердить',
        cancelButtonText: 'Отмена',
        input: 'select',
        inputOptions: {  
            'Касса': 'Касса',      
            'Наличные': 'Наличные',
            'Банковская карта': 'Банковская карта',
            'Расчетный счет': 'Расчетный счет',
        },
        inputPlaceholder: 'Выберите счет',
        showCancelButton: true,
        inputValidator: (value) => {
          return new Promise((resolve) => {
              resolve()
          })
        }
      })    
      $(document).ready (function () {
        $.ajax ({
            url: "ordersRequest.php",
            type: "POST",
            data: ({selectAccount: selectAccount, date: date, sum: sum, counterparty: counterparty, expenditure: expenditure, description: $('.orderNumber2').val()}),
            dataType: "html",
            success: function (data) {
               
            }
        });
    });
    orderClick()  
})()  
}


let orderStatusBefore
let paymentStateBefore
let prepaymentBefore
let secondPrepaymentBefore
let thirdPrepaymentBefore
let fourthPrepaymentBefore
let fifthPrepaymentBefore


numOrders.value = sessionStorage.getItem('number')
sessionStorage.removeItem('number');

if (numOrders.value !== "") {
    document.querySelector(".card-header h4").innerText = "Обновить заказ";
    document.querySelector(".breadcrumb .active").innerText = "Обновить заказ";
    document.querySelector("#addOrder").innerText = "Обновить заказ";
    let numOrdersAj = numOrders.value
    selectDesigner()
    $.ajax ({
            url: "ordersRequest.php",
            type: "POST",
            data: ({numOrdersAj: numOrdersAj}),
            dataType: "html",
            cache: false,
            success: function (data) {
                data = JSON.parse(data);
                orderNumber.value = data[0]
                orderDate.value = data[1]
                surname.value = data[2]
                name.value = data[3]
                patronymic.value = data[4]
                namePhone.value = data[5]
                orderPrice.value = data[6].slice(0,-2)
                designer.value = data[7]
                orderStatus.value = data[8]
                paymentState2.value = data[9]
                prepayment.value = data[10].slice(0,-2)
                prepaymentDate.value = data[11]
                secondPrepayment.value = data[12].slice(0,-2)
                dateSecondPrepayment2.value = data[13]
                thirdPrepayment.value = data[14].slice(0,-2)
                dateThirdPrepayment2.value = data[15]
                fourthPrepayment.value = data[16].slice(0,-2)
                dateFourthPrepayment2.value = data[17]
                fifthPrepayment.value = data[18].slice(0,-2)
                dateFifthPrepayment2.value = data[19]
                designerPercentage2.value = formatPercentage(numFormat(data[20]) / numFormat(data[6]))
                dateOfReadiness.value = data[21]
                paymentDate2.value = data[22]
                returnDate2.value = data[23]
                deadline.value = data[24]

                if (secondPrepayment.value !== "0,00") {
                    $('.secondPrepayment').removeClass("displayNone");
                    $('.dateSecondPrepayment').removeClass("displayNone");
                }
                if (thirdPrepayment.value !== "0,00") {
                    $('.thirdPrepayment').removeClass("displayNone");
                    $('.dateThirdPrepayment').removeClass("displayNone");
                }
                if (fourthPrepayment.value !== "0,00") {
                    $('.fourthPrepayment').removeClass("displayNone");
                    $('.dateFourthPrepayment').removeClass("displayNone");
                }
                if (fifthPrepayment.value !== "0,00") {
                    $('.fifthPrepayment').removeClass("displayNone");
                    $('.dateFifthPrepayment').removeClass("displayNone");
                }
                if (orderStatus.value === "Возврат") {
                    $('.returnDate').removeClass("displayNone");
                    $('.addPrepayment').addClass("displayNone");
                }
                if (orderStatus.value === "Сдан" && paymentState2.value === "Оплата") {
                    $('#dateOfReadiness').removeClass("displayNone");
                    $('.addPrepayment').addClass("displayNone");
                }
                if (paymentState2.value === "Оплата") {
                    $('#paymentDate').removeClass("displayNone");
                    $('.addPrepayment').addClass("displayNone");
                }
                if (prepayment.value === "0,00") {
                    $('.addPrepayment').addClass("displayNone");
                }

                orderStatusBefore = orderStatus.value
                paymentStateBefore = paymentState2.value
                prepaymentBefore = prepayment.value
                secondPrepaymentBefore = secondPrepayment.value
                thirdPrepaymentBefore = thirdPrepayment.value
                fourthPrepaymentBefore = fourthPrepayment.value
                fifthPrepaymentBefore = fifthPrepayment.value

            }
        });
} else {
    orderDate.value = moment().format('DD-MM-YYYY');
    selectDesigner()
}

function numFormat(val){
    val = val.slice(0,-2)
    val = parseFloat(val.replace(/\s/g, '').replace(",", '.'))
    return val;
}

function  formatPercentage(percent) {
    percent = String(percent * 100)
    if (percent !== "" && percent.indexOf(',') < 0) {
        percent += ",00"
    }
    if (percent.split(",")[1].length === 1) {
        percent += "0"
    }
    percent = percent.replace(".", ',') + "%"
    return percent
}

function selectDesigner() {
    $.ajax ({
        url: "ordersRequest.php",
        type: "POST",
        data: ({propertySelect: 'Дизайнер'}),
        dataType: "html",
        async: false,
        success: function (data) {
            data = JSON.parse(data);
            let option
            for (let i = 0; i < data.length; i++) {
                if (data[i][1] !== "Счет") {
                    option = document.createElement("option");
                    option.innerText = data[i][0]
                    designer.appendChild(option)
                }
            }
        }
    });
}


