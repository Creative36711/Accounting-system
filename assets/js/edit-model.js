// Обьявление переменных

let modelName = document.querySelector(".modelName")
let manufacturingDate = document.querySelector(".manufacturingDate")
let designerModel = document.querySelector('.designerModel');
let modelCost = document.querySelector('.modelCost');
let designerPercentageModel = document.querySelector(".designerPercentageModel")

let addOrder = document.querySelector("#addOrder")
let numOrders = document.querySelector("#numOrders")


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

modelCost.onchange = moneyFormat

numOrders.value = sessionStorage.getItem('number')
sessionStorage.removeItem('number');

if (numOrders.value !== "") {
    document.querySelector(".card-header h4").innerText = "Обновить модель";
    document.querySelector(".breadcrumb .active").innerText = "Обновить модель";
    document.querySelector("#addOrder").innerText = "Обновить модель";
    let numModelAj = numOrders.value
    selectDesigner()
        $.ajax ({
            url: "ordersRequest.php",
            type: "POST",
            data: ({numModelAj: numModelAj}),
            dataType: "html",
            success: function (data) {
                data = JSON.parse(data);
                manufacturingDate.value = data[1]
                modelName.value = data[2]
                designerModel.value = data[3]
                name.value = data[3]
                modelCost.value = data[4].slice(0,-2)
                designerPercentageModel.value = formatPercentage(numFormat(data[5]) / numFormat(data[4]))
            }
        });
} else {
    manufacturingDate.value = moment().format('DD-MM-YYYY');
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
                    designerModel.appendChild(option)
                }
            }
        }
    });
}




