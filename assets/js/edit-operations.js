// Обьявление переменных

let typeTransaction = document.querySelector(".typeTransaction")
let transactionAmount = document.querySelector(".transactionAmount")
let operationArticle = document.querySelector(".operationArticle")
let counterparty = document.querySelector(".counterparty")
let account = document.querySelector(".account")
let operationDescription = document.querySelector(".operationDescription")
let commitmentCheckbox = document.querySelector(".commitmentCheckbox")
let dateOperation = document.querySelector(".dateOperation")
let account2 = document.querySelector(".account2")

let cardHeader = document.querySelector(".card-header h4");

let addOrder = document.querySelector("#addOrder")
let numOrders = document.querySelector("#numOrders")



numOrders.value = sessionStorage.getItem('number')
sessionStorage.removeItem('number');
typeTransaction.value = sessionStorage.getItem('typeOperations')

$(document).ready (function () {
    $.ajax ({
        url: "ordersRequest.php",
        type: "POST",
        data: ({propertySelect: typeTransaction.value}),
        dataType: "html",
        success: function (data) {
            data = JSON.parse(data);
            let option
            let option2
            for (let i = 0; i < data.length; i++) {
                if (data[i][1] !== "Счет") {
                    option = document.createElement("option");
                    option.innerText = data[i][0]
                    operationArticle.appendChild(option)
                } else if (data[i][1] === "Счет") {
                    option = document.createElement("option");
                    option2 = document.createElement("option");
                    option.innerText = data[i][0]
                    option2.innerText = data[i][0]
                    account.appendChild(option)
                    account2.appendChild(option2)
                }
            }
            if (numOrders.value !== "") {
                document.querySelector(".card-header h4").innerText = "Обновить операцию:";
                document.querySelector(".breadcrumb .active").innerText = "Обновить операцию";
                document.querySelector("#addOrder").innerText = "Обновить операцию";

                let numOperationsAj = numOrders.value

                $.ajax ({
                    url: "ordersRequest.php",
                    type: "POST",
                    data: ({numOperationsAj: numOperationsAj}),
                    dataType: "html",
                    success: function (data) {
                        data = JSON.parse(data);
                        dateOperation.value = data[1]
                        transactionAmount.value = data[2].slice(0,-2).replace("-", '')
                        operationArticle.value = data[3]
                        operationDescription.value = data[4]
                        console.log(data);
                        counterparty.value = data[5]
                        if (typeTransaction.value === "Перевод") {
                            account.value = data[10]
                            account2.value = data[11]
                        } else {
                            account.value = data[6]
                        }
                        typeTransaction.value = data[7]
                        data[8] === "Да" ? $(commitmentCheckbox).attr('checked',true) : $(commitmentCheckbox).attr('checked',false);
                        if (data[9] === "Кредит") {
                            $("#flexRadioDefault1").attr('checked',true)
                        } else if (data[9] === "Дебет") {
                            $("#flexRadioDefault2").attr('checked',true)
                        }
                        if (operationArticle.value === "Возврат поставщику") {
                            $(".hideDebt2").addClass("displayNone")
                        }
                    }
                });
            } else {
                dateOperation.value = moment().format('DD-MM-YYYY');
            }
        }
    });
});


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

transactionAmount.onchange = moneyFormat

cardHeader.innerText = cardHeader.innerText + " " + typeTransaction.value.toLowerCase()
if (typeTransaction.value === "Задолженность") {
    $(".accountMd3").addClass("displayNone")
    $(".commitmentCheckboxMd3").addClass("displayNone")
    $(".flexRadioDefaultMd3").removeClass("displayNone")
    $(account).removeAttr('required');
    $(commitmentCheckbox).attr('checked',true)
    $("#flexRadioDefault1").attr('checked',true)
} else if (typeTransaction.value === "Товародвижение") {
    $(".accountMd3").addClass("displayNone")
    $(account).removeAttr('required');
} else if (typeTransaction.value === "Перевод") {
    $(".operationArticleMd-3").addClass("displayNone")
    $(".counterpartyMd3").addClass("displayNone")
    $(".commitmentCheckboxMd3").addClass("displayNone")
    $(operationArticle).removeAttr('required')
    $(counterparty).removeAttr('required')
    $(".account2Md3").removeClass("displayNone")
    account2.required = true
    $(".accountMd3 label").text("Откуда")
    $(".account2Md3 label").text("Куда")
}

if (typeTransaction.value === "Товародвижение") {
    operationArticle.onchange = function () {

        if (this.value === "Возврат поставщику") {
            commitmentCheckbox.checked = true
            $(".commitmentCheckboxMd3").addClass("displayNone")
        } else {
            commitmentCheckbox.checked = false
            $(".commitmentCheckboxMd3").removeClass("displayNone")
        }
    }
} else if(typeTransaction.value === "Расход") {
    operationArticle.onchange = function () {
        if (this.value === "Заработная плата") {
            $(".counterpartyMd3").addClass("displayNone")
            $(".counterparty3Md3").addClass("displayNone")
            $(".counterparty").removeAttr('required')
            $(".counterparty3").removeAttr('required')
            $(".counterparty2Md3").removeClass("displayNone")
            $(".counterparty2").prop('required',true);
            $(".counterparty3").removeAttr('name')
            document.querySelector(".counterparty2").name = "counterparty2"
            $(".counterparty").val('')
        } else if (this.value === "Вывод средств") {
            $(".counterpartyMd3").addClass("displayNone")
            $(".counterparty2Md3").addClass("displayNone")
            $(".counterparty").removeAttr('required')
            $(".counterparty2").removeAttr('required')
            $(".counterparty3Md3").removeClass("displayNone")
            $(".counterparty3").prop('required',true);
            $(".counterparty2").removeAttr('name')
            document.querySelector(".counterparty3").name = "counterparty2"
            $(".counterparty").val('')
        } else {
            $(".counterpartyMd3").removeClass("displayNone")
            $(".counterparty").prop('required',true);
            $(".counterparty2Md3").addClass("displayNone")
            $(".counterparty3Md3").addClass("displayNone")
            $(".counterparty2").removeAttr('required')
            $(".counterparty3").removeAttr('required')
            $(".counterparty2").val('')
            $(".counterparty3").val('')
        }
    }
}










