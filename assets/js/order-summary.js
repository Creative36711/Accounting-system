let numberOrdersSumI = document.querySelector(".numberOrdersSumI")
let costPriceCard = document.querySelector(".costPriceCard")
let numberOrdersSumI2 = document.querySelector(".numberOrdersSumI2")
let numberOrdersSum = document.querySelector(".numberOrdersSum")
let informationAboutOrder = document.querySelector(".informationAboutOrder")

let values = document.cookie.split(";")

numberOrdersSum.onclick = function () {
    (async () => {
        const {value: number} = await Swal.fire({
            title: 'Введите номер заказа или модели',
            input: 'text',
        })
        if (number !== "") {
            document.cookie = "numberOrder=" + number;
            location.reload()
        } else {
            Swal.fire({ icon: 'error',
                title: 'Ошибка',
                text: 'Введите корректно номер заказа или модели!',
            })
        }
    })()
}

if (values[findPartial( values, "numberOrder" )] === undefined) {
    numberOrdersSumI2.innerText = "Укажите номер заказа или модели"
} else {
    numberOrdersSumI.innerText = values[findPartial( values, "numberOrder" )].split('=')[1]

    if (numberOrdersSumI.innerText.length !== 9) {
        numberOrdersSumI2.innerText = "Модель №"
    }

    let ordNumSumAj = numberOrdersSumI.innerText
    $.ajax ({
        url: "ordersRequest.php",
        type: "POST",
        data: ({ordNumSumAj: ordNumSumAj}),
        dataType: "html",
        success: function (data) {
            data = JSON.parse(data);
            $(".discount").text(data[0])
            $(".discountPercentage").text(data[1])
            $(".price").text(data[2])
            $(".profit").text(data[3])
            $(".profitability").text(data[4])
            $(".margin").text(data[5])
            $(".sewing").text(data[6])
            $(".installation").text(data[7])
            $(".registration").text(data[8])
            $(".retail").text(data[9])
            $(".extraCharge").text(data[10])
            $(".costPrice").text(data[11])

            if (data[11] !== "" && data[11] !== "-1,00 ₽") {
                $(".chartRow").removeClass("displayNone")
            } 


            let chart = am4core.create("chartDiv", am4charts.PieChart);

            let series = chart.series.push(new am4charts.PieSeries());
            series.dataFields.value = "sum";
            series.dataFields.category = "category";

            chart.data = [{
                "category": "Прибыль",
                "sum": numFormat(data[3])
            }, {
                "category": "Себестоимость",
                "sum": numFormat(data[12])
            }];

            if (data[11] === "" || data[11] === "-1,00 ₽") {
                $(".informationAboutOrder").removeClass("displayNone");

            }

            console.log(data[11])
        }
    });
}



function numFormat(val){
    val = parseFloat(val.replace(/\s/g, '').replace(",", '.'))
    return val;

}
function formatRuble(number) {
    number = new Intl.NumberFormat('ru-RU').format(number) + ' ₽';
    if (number !== "" && number.indexOf(',') < 0) {
        number += ",00"
    }
    if (number.split(",")[1].length === 1) {
        number += "0"
    }
    return number
}

costPriceCard.onclick = function () {
    (async () => {
        const {value: cost} = await Swal.fire({
            title: 'Введите себестоимость товара',
            input: 'text',
        })
        if (cost !== "" && numberOrdersSumI.innerText.length === 9) {
            let costPrice = cost.replace(".", ',')
            $(document).ready (function () {
                $.ajax ({
                    url: "ordersRequest.php",
                    type: "POST",
                    data: ({costPrice: costPrice}),
                    dataType: "html",
                    success: function (data) {
                        location.reload()
                    }
                });
            });
        } else {
            let costPrice2 = cost.replace(".", ',')
            $(document).ready (function () {
                $.ajax ({
                    url: "ordersRequest.php",
                    type: "POST",
                    data: ({costPrice2: costPrice2}),
                    dataType: "html",
                    success: function (data) {
                        location.reload()
                    }
                });
            });
        }
    })()
}

function findPartial( a, s ) {
    for( let i = 0; i < a.length; ++i )
        if( a[i].indexOf( s ) >= 0 )
            return i;
    return -1;
}

if ($(".table-bordered tbody tr").length !== 0) {
    ($(".alert-dismissable").removeClass("displayNone"))
}

function orderStatus() {
    (async () => {
    const { value: orderStatus } = await Swal.fire({
        title: 'Выберите статус данного заказа',
        confirmButtonText: 'Подтвердить',
        cancelButtonText: 'Отмена',
        input: 'select',
        inputOptions: {    
            '-1': 'Проверен',  
            ' ': 'Не проверен',
        },
        inputPlaceholder: 'Выберите статус',
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
            data: ({costPrice: orderStatus}),
            dataType: "html",
            success: function (data) {
                location.reload()
            }
        });
    });
    })()  
}

informationAboutOrder.onclick = function () {
    orderStatus()
}








