let receipt = document.querySelector(".receipt")
let change = document.querySelector(".change")
let fullNameHeader = document.querySelector(".fullNameHeader")
let phoneHeader = document.querySelector(".phoneHeader")
let orderNumberHeader = document.querySelector(".orderNumberHeader")
let dateHeader = document.querySelector(".dateHeader")
let receiptTable1 = document.querySelector("#receiptTable1")
let table1 = document.querySelector(".table_col2 tbody")
let receiptTable2 = document.querySelector("#receiptTable2")
let table2 = document.querySelector(".table_col tbody")
let receiptTable3 = document.querySelector("#receiptTable3 tbody")
let receiptTable4 = document.querySelector("#receiptTable4 tbody")
let deadlineReceipt = document.querySelector(".receiptDeadline")
let parameter1 = document.querySelector(".parameter1")
let parameter2 = document.querySelector(".parameter2")
let parameter3 = document.querySelector(".parameter3")

receipt.onclick = function () {
    window.print()
}

let values = document.cookie.split(";")

change.onclick = function () {
    (async () => {
        const {value: number} = await Swal.fire({
            title: 'Введите номер заказа',
            input: 'text',
        })
        if (number !== "" && (number.length === 9 || number.length === 11)) {
            document.cookie = "numberOrder=" + number;
            location.reload()
        } else {
            Swal.fire({ icon: 'error',
                title: 'Ошибка',
                text: 'Введите корректно номер заказа!',
            })
        }
    })()
}

let checkOrders = document.cookie.match(/numberOrder=(.+?)(;|$)/);
let numberReceipt

if(checkOrders[0].length === 21 || checkOrders[0].length === 22) {
    numberReceipt = values[values.map(function(d){return d.slice(0,-10).trim()}).indexOf("numberOrder")].split('=')[1]

    $(document).ready (function () {
        $.ajax ({
            url: "ordersRequest.php",
            type: "POST",
            data: ({numberReceipt: numberReceipt}),
            dataType: "html",
            success: function (data) {
                data = JSON.parse(data);
                orderNumberHeader.innerText = "Заказ №" + data[0][0]
                fullNameHeader.innerHTML = data[0][1] + "&nbsp;" + data[0][2] + "&nbsp;" + data[0][3]
                phoneHeader.innerText = data[0][4]
                dateHeader.innerText = data[0][5]
                $($('#receiptTable3 tbody td:nth-child(1)')).text(data[0][6])
                $($('#receiptTable3 tbody td:nth-child(2)')).text(data[0][7])
                $($('#receiptTable3 tbody td:nth-child(3)')).text(data[0][8])
                $($('#receiptTable3 tbody td:nth-child(4)')).text(data[0][9])
                $($('#receiptTable3 tbody td:nth-child(5)')).text(data[0][10])
                $($('#receiptTable3 tbody td:nth-child(6)')).text(data[0][11])
                deadlineReceipt.innerText = "Дата готовности " + data[0][12]
                receiptTable4.innerHTML = "<tr><td>" + data[0][13] + " __________</td><td class='rightCol'>" + fullNameHeader.innerHTML + " __________</td></tr>"
    
                function createTable(tableData, table) {
                    let tableBody = document.createElement('tbody');
    
                    tableData.forEach(function(rowData) {
                        let row = document.createElement('tr');
    
                        rowData.forEach(function(cellData) {
                            let cell = document.createElement('td');
                            cell.appendChild(document.createTextNode(cellData));
                            row.appendChild(cell);
                        });
    
                        tableBody.appendChild(row);
                    });
    
                    table.appendChild(tableBody);
                }
    
                for(let i=0; i<data[1].length; i++) {
                    [data[1][i][0], data[1][i][1], data[1][i][2], data[1][i][3]] = [data[1][i][0], data[1][i][1], data[1][i][3], data[1][i][2]];
                }
                for(let i=0; i<data[2].length; i++) {
                    data[2][i].splice(3, 1)
                }
    
                data[1].push(["", data[0][14]]);
                data[2].push(["", data[0][15]]);
    
                createTable(data[1], receiptTable2);
                createTable(data[2], receiptTable1);
    
                $($('#receiptTable2 tbody tr:last-child td:first-child')).attr("colspan", 3).text("Итого").css({'font-weight': 'bold'});
                $($('#receiptTable1 tbody tr:last-child td:first-child')).attr("colspan", 6).text("Итого").css({'font-weight': 'bold'});
                $($('#receiptTable2 tbody tr:last-child td:last-child')).css({'font-weight': 'bold'});
                $($('#receiptTable1 tbody tr:last-child td:last-child')).css({'font-weight': 'bold'});
    
                $('#receiptTable1 td').click(function(){
                    if ($(this).parent().hasClass('deleteLine')) 
                        $(this).parent().removeClass('deleteLine');   
                    else
                        $(this).parent().addClass('deleteLine');                
                });
    
                $(document).keyup(function(e) {
                    if (e.key === "Delete" || e.keyCode === 46) {
                        $(".deleteLine").hide();
                    }
                });
    
                $('html').on('click', function(e){
                    if ($(e.target).get(0).tagName !== 'INPUT') {
                        $('table input').replaceWith( $('table input').val() );
                        $(this).parent().removeClass('deleteLine'); 
                    }
                });
                 
                $('#receiptTable1').on('dblclick', 'td', function() {
                    $(this).replaceWith(`<td><input value="${$(this).text()}"></td>`);
                });
                 
                $('button').on('click', function() {
                    $('#receiptTable1').append(`<tr><td>${$('.name').val()}</td><td>${$('.surname').val()}</td></tr>`);
                    $('.name').val(''), $('.surname').val('');
                });
    
            }
        });
    });
}
else {
    numberReceipt = values[values.map(function(d){return d.slice(0,-12).trim()}).indexOf("numberOrder")].split('=')[1]

    $(document).ready (function () {
        $.ajax ({
            url: "ordersRequest.php",
            type: "POST",
            data: ({numberReceiptRepair: numberReceipt}),
            dataType: "html",
            success: function (data) {
                data = JSON.parse(data);
                orderNumberHeader.innerText = data[0][0]
                fullNameHeader.innerHTML = data[0][1] + "&nbsp;" + data[0][2] + "&nbsp;" + data[0][3]
                phoneHeader.innerText = data[0][4]
                dateHeader.innerText = data[0][5]
                console.log(data[0])
                $($('#receiptTable3 tbody td:nth-child(1)')).text(data[0][11])
                $($('#receiptTable3 tbody td:nth-child(6)')).text(data[0][6])
                deadlineReceipt.innerText = "Дата готовности " + data[0][7]
                receiptTable4.innerHTML = "<tr><td>" + data[0][8] + " __________</td><td class='rightCol'>" + fullNameHeader.innerHTML + " __________</td></tr>"
    
                function createTable(tableData, table) {
                    let tableBody = document.createElement('tbody');
    
                    tableData.forEach(function(rowData) {
                        let row = document.createElement('tr');
    
                        rowData.forEach(function(cellData) {
                            let cell = document.createElement('td');
                            cell.appendChild(document.createTextNode(cellData));
                            row.appendChild(cell);
                        });
    
                        tableBody.appendChild(row);
                    });
    
                    table.appendChild(tableBody);
                }
    
                for(let i=0; i<data[1].length; i++) {
                    [data[1][i][0], data[1][i][1], data[1][i][2], data[1][i][3]] = [data[1][i][0], data[1][i][1], data[1][i][3], data[1][i][2]];
                }
                for(let i=0; i<data[2].length; i++) {
                    data[2][i].splice(3, 1)
                }
    
                data[1].push(["", data[0][9]]);
                data[2].push(["", data[0][10]]);
    
                createTable(data[1], receiptTable2);
                createTable(data[2], receiptTable1);
    
                $($('#receiptTable2 tbody tr:last-child td:first-child')).attr("colspan", 3).text("Итого").css({'font-weight': 'bold'});
                $($('#receiptTable1 tbody tr:last-child td:first-child')).attr("colspan", 6).text("Итого").css({'font-weight': 'bold'});
                $($('#receiptTable2 tbody tr:last-child td:last-child')).css({'font-weight': 'bold'});
                $($('#receiptTable1 tbody tr:last-child td:last-child')).css({'font-weight': 'bold'});
    
                $('#receiptTable1 td').click(function(){
                    if ($(this).parent().hasClass('deleteLine')) 
                        $(this).parent().removeClass('deleteLine');   
                    else
                        $(this).parent().addClass('deleteLine');                
                });
    
                $(document).keyup(function(e) {
                    if (e.key === "Delete" || e.keyCode === 46) {
                        $(".deleteLine").hide();
                    }
                });
    
                $('html').on('click', function(e){
                    if ($(e.target).get(0).tagName !== 'INPUT') {
                        $('table input').replaceWith( $('table input').val() );
                        $(this).parent().removeClass('deleteLine'); 
                    }
                });
                 
                $('#receiptTable1').on('dblclick', 'td', function() {
                    $(this).replaceWith(`<td><input value="${$(this).text()}"></td>`);
                });
                 
                $('button').on('click', function() {
                    $('#receiptTable1').append(`<tr><td>${$('.name').val()}</td><td>${$('.surname').val()}</td></tr>`);
                    $('.name').val(''), $('.surname').val('');
                });

                $(".block1").addClass("hiden");
                $(".block2").addClass("hiden");
                $(".block3").addClass("hiden");
    
            }
        });
    });
}


$(parameter1).change(function(){
    if(parameter1.value === "Скрыть элемент"){
        $(".block1").addClass("hiden");
    }
});

$(parameter2).change(function(){
    if(parameter2.value === "Скрыть элемент"){
        $(".block2").addClass("hiden");
    }
});

$(parameter3).change(function(){
    if(parameter3.value === "Скрыть элемент"){
        $(".block3").addClass("hiden");
    }
});

console.log(values)