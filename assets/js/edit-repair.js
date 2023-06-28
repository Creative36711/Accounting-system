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
let paymentDate2 = document.querySelector(".paymentDate2")
let addOrder = document.querySelector("#addOrder")
let orderDate = document.querySelector(".orderDate2")
let numOrders = document.querySelector("#numOrders")
let designer = document.querySelector(".designer2")
let designerPercentage2 = document.querySelector(".designerPercentage2")
let deadline = document.querySelector(".deadline2")
let mainForm = document.querySelector("#mainForm")
let accountType = document.querySelector(".accountType")

let serviceCategory = document.querySelector(".serviceCategory")
let serviceName = document.querySelector(".serviceName")
let serviceQuantity = document.querySelector(".serviceQuantity") 
let seamstress = document.querySelector(".seamstress") 

// Вывести даты сдачи, возврата и оплаты
orderStatus.onchange = function () {
    if (orderStatus.value === "Сдан") {
        $(".dateOfReadiness2").val(moment().format('DD-MM-YYYY'));
        $("#dateOfReadiness").removeClass("displayNone");
    } else {
        $("#dateOfReadiness").addClass("displayNone");
        $(".dateOfReadiness2").val("");
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
}

let regex = /[^0-9\/+()-]/; // регулярка только цифры]

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

function moneyFormat(price) {
    price.value = price.value.replace(/\s/g, '')
    price.value = price.value.replace(",", '.')
    if (price.value.split(".")[1] !== undefined && price.value.split(".")[1].length > 2) {
        price.value = Number(price.value).toFixed(2)
    }
    price.value = new Intl.NumberFormat('ru-RU').format(price.value)
    if (price.value !== "" && price.value.indexOf(',') < 0) {
        price.value += ",00"
    }
    if (price.value.split(",")[1].length === 1) {
        price.value += "0"
    }
}

orderPrice.onchange = function() {
    moneyFormat(this)
}

let examination = false

addOrder.onclick = function () {
    if (orderStatus.value !== "Сдан") {
        dateOfReadiness.value = moment().format('DD-MM-YYYY');
    }
    if (paymentState2.value !== "Оплата") {
        paymentDate2.value = moment().format('DD-MM-YYYY');
    }


    if (examination !== true && numOrders.value === "" && $(".paymentState2").val() === "Оплата" ) 
        addOperations($(".paymentDate2").val(), $(".orderPrice2").val(), "Ремонт одежды")
    else if(examination !== true && numOrders.value !== "" && $(".paymentState2").val() === "Оплата" && paymentStateBefore !== "Оплата")
        addOperations($(".paymentDate2").val(), $(".orderPrice2").val(), "Ремонт одежды")
    else
        orderClick()
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
    orderClick()  
})()  
}

let orderStatusBefore
let paymentStateBefore


numOrders.value = sessionStorage.getItem('number')
sessionStorage.removeItem('number');

if (numOrders.value !== "") {
    document.querySelector(".card-header h4").innerText = "Обновить ремонт";
    document.querySelector(".breadcrumb .active").innerText = "Обновить ремонт";
    document.querySelector("#addOrder").innerText = "Обновить ремонт";
    seamstress.parentNode.className = 'displayNone';
    seamstress.removeAttribute("required")
    let numRepairAj = numOrders.value
    selectDesigner()
    $.ajax ({
            url: "ordersRequest.php",
            type: "POST",
            data: ({numRepairAj: numRepairAj}),
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
                serviceCategory.value = data[11]
                serviceNameFunc()
                serviceName.value = data[6]
                orderPrice.value = data[7].slice(0,-2)
                designer.value = data[8]
                orderStatus.value = data[9]
                paymentState2.value = data[10]
                serviceQuantity.value = data[12]
                designerPercentage2.value = formatPercentage(numFormat(data[13]) / numFormat(data[7]))
                paymentDate2.value = data[14]
                dateOfReadiness.value = data[15]
                deadline.value = data[16]

                orderStatusBefore = orderStatus.value
                paymentStateBefore = paymentState2.value
            }
        });
} else {
    orderNumber.value = "Ремонт №0"
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

const priceRepair = [
[{name: 'брюки под строчку', price: 250}, {name: 'брюки с тесьмой', price: 350}, {name: 'брюки трикотажные', price: 250}, {name: 'джинсы под строчку', price: 250}, {name: 'джинсы с сохранением фабричного шва', price: 350}, {name: 'джинсы с тесьмой', price: 350}, {name: 'юбка прямая со шлицей', price: 350}, {name: 'юбка расклешённая', price: 400}, {name: 'пиджак со шлицей', price: 600}, {name: 'пиджак без шлицы', price: 500}, {name: 'пальто деми', price: 800}, {name: 'пальто зима', price: 900}, {name: 'трикотаж футболка', price: 250}, {name: 'трикотаж платье', price: 300}],
[{name: 'блузка', price: 350}, {name: 'пиджак на подкладке женский', price: 700}, {name: 'пиджак на подкладке мужской', price: 900}, {name: 'пиджак без подкладки женский', price: 500}, {name: 'пиджак без подкладки мужской', price: 700}],
[{name: 'пиджак без подкладки', price: 400}, {name: 'пиджак на подкладке', price: 500}, {name: 'пальто (деми)', price: 500}, {name: 'пальто (зима)', price: 550}, {name: 'без манжета, куртка (деми)', price: 400}, {name: 'с манжетом, куртка (деми)', price: 500}, {name: 'без манжета, куртка (зима)', price: 450}, {name: 'с манжетом, куртка (зима)', price: 550}, {name: 'прямой, блузка', price: 250}, {name: 'с манжетом, блузка', price: 350}, {name: 'прямой на трикотаже', price: 250}],
[{name: 'юбку без пояса (бедра)', price: 300}, {name: 'юбку с поясом (боковые швы)', price: 500}, {name: 'юбку средний шов с поясом', price: 350}, {name: 'юбку джинсовую (с отстрочками)', price: 400}, {name: 'брюки без пояса (боковые швы)', price: 300}, {name: 'брюки без пояса (боковые швы + низ)', price: 400}, {name: 'брюки средний шов с поясом', price: 350}, {name: 'джинсы средний шов с поясом', price: 400}, {name: 'джинсы средний шов без пояса', price: 250}, {name: 'блузку', price: 250}, {name: 'пиджак по боковым швам', price: 500}, {name: 'пиджак по боковым швам и рельефам', price: 800}, {name: 'куртку (деми)', price: 600}, {name: 'куртку (зима) с утеплителем', price: 900}, {name: 'пальто по боковым швам', price: 800}, {name: 'пальто, один рельеф', price: 200}],
[{name: 'куртка детская утепленная', price: 450}, {name: 'куртка детская ветровка', price: 350}, {name: 'куртка утеплённая', price: 500}, {name: 'куртка ветровка', price: 400}, {name: 'потайной, юбка', price: 300}, {name: 'не потайной, юбка', price: 300}, {name: 'брюки женские и мужские', price: 350}, {name: 'джинсы', price: 350}],
[{name: 'юбка и брюки', price: 500}, {name: 'пиджак женский', price: 1500}, {name: 'пиджак мужской', price: 1800}, {name: 'куртка (деми)', price: 2000}, {name: 'куртка (зима)', price: 2000}, {name: 'пальто и плащ (деми)', price: 2000}, {name: 'пальто и плащ (зима)', price: 2000}, {name: 'жилет', price: 1000}],
[{name: 'на джинсах', price: 250}, {name: 'по шву в зимней куртке', price: 450}]
]

const newpPriceRepair = [].concat(priceRepair[0], priceRepair[1], priceRepair[2], priceRepair[3], priceRepair[4], priceRepair[5], priceRepair[6]);

function serviceNameFunc() {
    let option
    let a = serviceCategory.value
    $(serviceName)
    .empty()
    function loopArray(array) {
        for (let i = 0; i < array.length; i++) {
            option = document.createElement("option");
            option.innerText = array[i]["name"]
            serviceName.appendChild(option)
        }
    }
    switch (a) {
        case "Подшить низ":
            loopArray(priceRepair[0])
        break;
        case "Поднять рукав":
            loopArray(priceRepair[1])
        break;
        case "Укоротить рукав":
            loopArray(priceRepair[2])
        break;
        case "Ушить":
            loopArray(priceRepair[3])
        break;
        case "Замена молнии":
            loopArray(priceRepair[4])
        break;
        case "Замена подкладки":
            loopArray(priceRepair[5])
        break;
        case "Заштопать дырку":
            loopArray(priceRepair[6])
        break;
      }
}

serviceName.onchange = function() {
    let servicesInput = newpPriceRepair.filter(el => el.name === this.value)
    orderPrice.value = serviceQuantity.value * servicesInput[0]['price']
    moneyFormat(orderPrice)
}
serviceCategory.onchange = function() {
    serviceNameFunc()
    let servicesInput = newpPriceRepair.filter(el => el.name === serviceName.value)
    orderPrice.value = serviceQuantity.value * servicesInput[0]['price']
    moneyFormat(orderPrice)
}
serviceQuantity.oninput = function() {
    let servicesInput = newpPriceRepair.filter(el => el.name === serviceName.value)
    orderPrice.value = serviceQuantity.value * servicesInput[0]['price']
    moneyFormat(orderPrice)
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
                    seamstress.appendChild(option)
                }
            }
        }
    });
});







