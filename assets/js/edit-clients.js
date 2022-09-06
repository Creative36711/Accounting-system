// Обьявление переменных

let customerDescription = document.querySelector(".customerDescription")
let category = document.querySelector(".category")
let categoryDescription = document.querySelector('.categoryDescription');
let designerClients = document.querySelector('.designerClients');
let whatDone = document.querySelector(".whatDone")
let customerName = document.querySelector(".customerName")
let customerPhone = document.querySelector(".customerPhone")
let repeatedCheckbox = document.querySelector(".repeatedCheckbox")

let addOrder = document.querySelector("#addOrder")
let numOrders = document.querySelector("#numOrders")

function phone() {
    let regex = /[^0-9\/+()-]/; // регулярка только цифры]
    this.value = this.value.replace(regex, '');

    if (this.value.length === 1) {
        $(this).val($(this).val() + "+7(");
    }
    if (this.value.length === 6) {
        $(this).val($(this).val() + ")");
    }
    if (this.value.length === 10 || this.value.length === 13) {
        $(this).val($(this).val() + "-");
    }
    let nam = this.value.charAt(0)
    if (nam === "0" || nam === "1" || nam === "2" || nam === "3" || nam === "4" || nam === "5" || nam === "6" || nam === "7" || nam === "8" || nam === "9" || nam === "0") {
        this.value = this.value.replace(nam, '')
    }
}

customerPhone.onkeydown = function (event) {
    if (event.code !== "Backspace") {
        this.oninput = phone
    } else {
        this.oninput = "";
    }
}

numOrders.value = sessionStorage.getItem('number')
sessionStorage.removeItem('number');
selectDesigner()

if (numOrders.value !== "") {
    document.querySelector(".card-header h4").innerText = "Обновить клиента";
    document.querySelector(".breadcrumb .active").innerText = "Обновить клиента";
    document.querySelector("#addOrder").innerText = "Обновить клиента";
    let numClientsAj = numOrders.value
    $(document).ready (function () {
        $.ajax ({
            url: "ordersRequest.php",
            type: "POST",
            data: ({numClientsAj: numClientsAj}),
            dataType: "html",
            success: function (data) {
                data = JSON.parse(data);
                customerName.value = data[1]
                customerPhone.value = data[2]
                data[3] === "Да" ? $(repeatedCheckbox).attr('checked',true) : $(repeatedCheckbox).attr('checked',false);
                customerDescription.value = data[4]
                category.value = data[5]
                categoryDescription.value = data[6]
                whatDone.value = data[7]
                designerClients.value = data[8]
            }
        });
    });
}

function numFormat(val){
    val = val.slice(0,-2)
    val = parseFloat(val.replace(/\s/g, '').replace(",", '.'))
    return val;
}

function selectDesigner() {
    $.ajax ({
        url: "ordersRequest.php",
        type: "POST",
        data: ({propertySelect: 'Дизайнер'}),
        dataType: "html",
        success: function (data) {
            data = JSON.parse(data);
            let option
            for (let i = 0; i < data.length; i++) {
                if (data[i][1] !== "Счет") {
                    option = document.createElement("option");
                    option.innerText = data[i][0]
                    designerClients.appendChild(option)
                }
            }
        }
    });
}





