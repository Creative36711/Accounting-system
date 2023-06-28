let rowOrders = document.querySelectorAll(".student-data-table tr")
let orderChange = document.querySelectorAll(".orderChange")
let orderDelete = document.querySelectorAll(".orderDelete")
let studentDataTable = document.querySelector(".student-data-table")

let counterparty = document.querySelector(".counterparty")
let itemDescription = document.querySelector(".itemDescription")

let ulItem = document.querySelector(".ulItem");
let ulInvoice = document.querySelector(".ulInvoice")

for (let i = 0; i < rowOrders.length; i++)
    rowOrders[i].onclick = function(event) {
        event = event || window.event;
        let target = event.target || event.srcElement;
        if (target === orderChange[i-1]) {
            sessionStorage.setItem('number', this.childNodes[1].innerText);
            window.location.href = "edit-depreciation.php"
        }
        if (target === orderDelete[i-1]) {
            let delDepreciation = this.childNodes[1].innerText
            function deleteOrders() {
                $(document).ready (function () {
                    $.ajax ({
                        url: "ordersRequest.php",
                        type: "POST",
                        data: ({delDepreciation: delDepreciation}),
                        dataType: "html",
                        success: function (data) {
                            location.reload(data)
                        }
                    });
                });
            }
            Swal.fire({
                title: 'Вы уверены?',
                text: "После удаления вы не сможете восстановить эту операцию!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Да, удалить операцию',
                cancelButtonText: "Отмена",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Успешно!',
                        'Данный операция была удалена!',
                        'success',
                    )
                    deleteOrders();
                }
            })
        }
    }









