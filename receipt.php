<?php
    if (!isset($_COOKIE['user'])) {
        header('location: login.php');
    } 
?>

<!doctype html>
<html lang=ru>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Квитанции</title>

    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <link href="assets/css/receipt.css<?php require "version.php"; ?>"  rel="stylesheet">

</head>
<body>
<div class="bodyReceipt">
    <div class="book">
        <div class="page">

            <a href="/orders.php"><button class="button backReceipt no-print">Назад</button></a>
            <button class="button receipt no-print">Печать</button>
            <button class="button change no-print">Выбрать заказ</button>
            <div class="subpage">
                <div class="receiptHeader">ИП Першукова О.П. г.Дмитров, ул. Внуковская, 33б ИНН: 110100105503
                    <div class="descriptionHeader">(наименование организации, ИНН)</div>
                    Ф.И.О. клиента: <div class="fullNameHeader"></div>
                    <div>Телефон клиента: <div class="phoneHeader"></div></div>
                    <div class="descriptionOrderHeader">
                        <div class="orderNumberHeader"></div>
                        от <div class="dateHeader"></div>
                    </div>
                </div>
                <table class="receiptTable" id="receiptTable1">
                    <thead>
                    <tr>
                        <th>Наименование</th>
                        <th>Код</th>
                        <th>Категория</th>
                        <th>Ед-изм</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>Сумма</th>
                    </tr>
                    </thead>
                </table>
                <table class="receiptTable" id="receiptTable2">
                    <thead>
                    <tr>
                        <th>Вид услуги</th>
                        <th>Описание</th>
                        <th>Исполнитель</th>
                        <th>Сумма</th>
                    </tr>
                    </thead>
                </table>
                <table class="receiptTable" id="receiptTable3">
                    <thead>
                    <tr>
                        <th>Предоплата</th>
                        <th>Доплата</th>
                        <th>Цена без скидки</th>
                        <th>Скидка, %</th>
                        <th>Скидка, &#8381; </th>
                        <th>Цена со скидкой</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>

                <div class="square2">
                    <div class="receiptDeadline"></div>
                    <div class="square">
                        <div class="block1">
                        <select class="parameter1">
                            <option>Греб-1,0см(от тес.)</option>
                            <option>Греб-1,5см(от тес.)</option>
                            <option>Греб-2,0см(от тес.)</option>
                            <option>Греб-2,5см(от тес.)</option>
                            <option>Греб-3,0см(от тес.)</option>
                            <option>Греб-3,5см(от тес.)</option>
                            <option>Греб-1,0см(от пет.)</option>
                            <option>Греб-1,5см(от пет.)</option>
                            <option>Греб-2,0см(от пет.)</option>
                            <option>Греб-2,5см(от пет.)</option>
                            <option>Греб-3,0см(от пет.)</option>
                            <option>Греб-3,5см(от пет.)</option>
                            <option>Без гребешка</option>
                            <option>Скрыть элемент</option>
                        </select>
                            <input type="text" class="amount1" placeholder="Метраж">
                            <input type="text" class="amount1_2" placeholder="Кол. полот.">
                            <select class="kind1">
                                <option>Тюль</option>
                                <option>Порть.</option>
                            </select>
                            <input type="text" class="bottomParameter1" value="h=">
                        </div>
                        <div class="block2">
                        <select class="parameter2">
                            <option>Греб-1,0см(от тес.)</option>
                            <option>Греб-1,5см(от тес.)</option>
                            <option>Греб-2,0см(от тес.)</option>
                            <option>Греб-2,5см(от тес.)</option>
                            <option>Греб-3,0см(от тес.)</option>
                            <option>Греб-3,5см(от тес.)</option>
                            <option>Греб-1,0см(от пет.)</option>
                            <option>Греб-1,5см(от пет.)</option>
                            <option>Греб-2,0см(от пет.))</option>
                            <option>Греб-2,5см(от пет.)</option>
                            <option>Греб-3,0см(от пет.)</option>
                            <option>Греб-3,5см(от пет.)</option>
                            <option>Без гребешка</option>
                            <option>Скрыть элемент</option>
                        </select>
                            <input type="text" class="amount2" placeholder="Метраж">
                            <input type="text" class="amount2_2" placeholder="Кол. полот.">
                            <select class="kind2">
                                <option>Тюль</option>
                                <option>Порть.</option>
                            </select>
                            <input type="text" class="bottomParameter2" value="h=">
                        </div>
                        <div class="block3">
                        <select class="parameter3">
                            <option>Греб-1,0см(от тес.)</option>
                            <option>Греб-1,5см(от тес.)</option>
                            <option>Греб-2,0см(от тес.)</option>
                            <option>Греб-2,5см(от тес.)</option>
                            <option>Греб-3,0см(от тес.)</option>
                            <option>Греб-3,5см(от тес.)</option>
                            <option>Греб-1,0см(от пет.)</option>
                            <option>Греб-1,5см(от пет.)</option>
                            <option>Греб-2,0см(от пет.)</option>
                            <option>Греб-2,5см(от пет.)</option>
                            <option>Греб-3,0см(от пет.)</option>
                            <option>Греб-3,5см(от пет.)</option>
                            <option>Без гребешка</option>
                            <option>Скрыть элемент</option>
                        </select>
                        <input type="text" class="amount3" placeholder="Метраж">
                        <input type="text" class="amount3_2" placeholder="Кол. полот.">
                            <select class="kind3">
                                <option>Тюль</option>
                                <option>Порть.</option>
                            </select>
                            <input type="text" class="bottomParameter3" value="h=">
                        </div>
                    </div>
                </div>

                <table class="text" id="receiptTable4">
                    <thead>
                    <tr>
                        <td>Дизайнер</td>
                        <td class="rightCol">Ф.И.О. клиента</td>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="assets/js/lib/jquery.min.js"></script>
    <script src="assets/js/receipt.js<?php require "version.php"; ?>"></script>
    <script src ="assets/js/lib/sweetalert2/dist/sweetalert2.all.min.js"></script>

</body>
</html>
