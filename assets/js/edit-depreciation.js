// Обьявление переменных

let dateDepreciation = document.querySelector(".dateDepreciation")
let assets = document.querySelector(".assets")
let assetValue = document.querySelector(".assetValue")
let term = document.querySelector(".term")
let writeOffDate = document.querySelector(".writeOffDate")
let operationArticle = document.querySelector(".operationArticle")

let cardHeader = document.querySelector(".card-header h4");

let addOrder = document.querySelector("#addOrder")
let numOrders = document.querySelector("#numOrders")



numOrders.value = sessionStorage.getItem('number')
sessionStorage.removeItem('number');

if (numOrders.value !== "") {
    document.querySelector(".card-header h4").innerText = "Обновить актив";
    document.querySelector(".breadcrumb .active").innerText = "Обновить актив";
    document.querySelector("#addOrder").innerText = "Обновить актив";
    $(".writeOffDateBlock").removeClass("displayNone")
    let numDepreciationAj = numOrders.value
    $(document).ready (function () {
        $.ajax ({
            url: "ordersRequest.php",
            type: "POST",
            data: ({numDepreciationAj: numDepreciationAj}),
            dataType: "html",
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                dateDepreciation.value = data[1]
                operationArticle.value = data[2]
                assets.value = data[3]
                assetValue.value = data[4].slice(0,-2)
                term.value = data[5]
                writeOffDate.value = data[8]
                if(typeof data[8] === 'undefined')
                writeOffDate.value = ""
                else
                writeOffDate.value = data[8]
            }
        });
    });
} else {
    dateDepreciation.value = moment().format('DD-MM-YYYY');
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

function numberFormat() {
    let regex = /[^0-9]/; // регулярка только цифры]
    this.value = this.value.replace(regex, '');
}

assetValue.onchange = moneyFormat
term.oninput = numberFormat











