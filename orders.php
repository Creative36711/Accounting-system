<?php

if (!isset($_COOKIE['user'])) {
     header('location: login.php');
} 

if (!isset($_COOKIE['stringsOrders'])) {
    setcookie("stringsOrders", 100);
    $_COOKIE['stringsOrders'] = 100;
}

if (!isset($_COOKIE['numLin'])) {
    $_COOKIE['numLin'] = 1000;
}


$_COOKIE['stringsOrders'] = (int)$_COOKIE['numLin'] - (int)$_COOKIE['stringsOrders'];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Лист заказов</title>

    <script>console.time('FirstWay')</script>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

    <!-- Styles -->
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/unix.css" rel="stylesheet">
    <link href="assets/css/style.css<?php require "version.php"; ?>" rel="stylesheet">
    <link href="assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
<!---->
    <link href="assets/css/lib/rangSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="assets/css/lib/rangSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">

</head>

<body>

<?php
require "sheets.php";
require "blocks/header.php";
?>
    <!-- /# sidebar, header -->
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Заказы</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="/index.php">Главное</a></li>
                                    <li class="active">Заказы</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header pr">
                                    <h4>Лист заказов</h4>
                                    <div class="search-action">

                                        <a href="/edit-orders.php"><button type="button" class="btn btn-primary m-b-10 m-l-5 addLine">Добавить заказ</button></a>
                                        <div class="search-type dib">
                                            <input class="form-control input-rounded" placeholder="Поиск по клиенту..." type="text">
                                        </div>
                                    </div>
                                    <div class="card-header-right-icon">
                                        <ul>
                                            <li class="card-close"><i class="ti-close"></i></li>
                                            <li class="card-option drop-menu"><i class="ti-settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                                <ul class="card-option-dropdown dropdown-menu">
                                                    <li class="inquiries"><a data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="ti-server"></i> Запросы на сервер</a></li>
                                                </ul>
                                            </li>
                                            <li class="card-option drop-menu"><i class="ti-money" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                                <ul class="card-option-dropdown dropdown-menu ulPaymentState">
                                                    <li class="liPrepayment"><a href="#"><i></i>Предоплата</a></li>
                                                    <li class="liPayment"><a href="#"><i></i>Оплата</a></li>
                                                    <li class="liNotPaid"><a href="#"><i></i>Не оплачен</a></li>
                                                    <li class="liWithoutPayment"><a href="#"><i></i>Без оплаты</a></li>
                                                    <li class="allPrepayments"><a href="#"><i></i>Все</a></li>
                                                </ul>
                                            </li>
                                            <li class="card-option drop-menu"><i class="ti-stats-up" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                                <ul class="card-option-dropdown dropdown-menu ulOrderStatus">
                                                    <li class="liAccepted"><a href="#"><i></i>Принят</a></li>
                                                    <li class="liInWork"><a href="#"><i></i>В работе</a></li>
                                                    <li class="liReady"><a href="#"><i></i>Готов</a></li>
                                                    <li class="liWasPassed"><a href="#"><i></i>Сдан</a></li>
                                                    <li class="liReturn"><a href="#"><i></i>Возврат</a></li>
                                                    <li class="allStatuses"><a href="#"><i></i>Все</a></li>
                                                </ul>
                                            </li>
                                            <li class="card-option drop-menu"><i class="ti-time" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                                <ul class="card-option-dropdown dropdown-menu ulPeriod">
                                                    <li class="liCurrentMonth"><a href="#"><i></i>Текущий месяц</a></li>
                                                    <li class="liCurrentQuarter"><a href="#"><i></i>Текущий квартал</a></li>
                                                    <li class="liThisYear"><a href="#"><i></i>Текущий год</a></li>
                                                    <li class="liLastMonth"><a href="#"><i></i>Прошлый месяц</a></li>
                                                    <li class="liLastQuarter"><a href="#"><i></i>Прошлый квартал</a></li>
                                                    <li class="liLastYear"><a href="#"><i></i>Прошлый год</a></li>
                                                    <li class="allTime"><a href="#"><i></i>Все время</a></li>
                                                    <li class="liArbitrarily"><a href="#" data-toggle="modal" data-target="#myModal"><i></i> Произвольный период</a></li>
                                                </ul>
                                            </li>
                                            <li class="card-option drop-menu"><i class="ti-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                                <ul class="card-option-dropdown dropdown-menu ulDesigner">
                                                    <li class="allDesigners"><a href="#">Все дизайнеры</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive tableOrders">
                                        <table class="table student-data-table m-t-20 table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Действие</th>
                                                    <th>Номер заказа</th>
                                                    <th>Дата заказа</th>
                                                    <th>Клиент</th>
                                                    <th>Телефон</th>
                                                    <th>Пошив</th>
                                                    <th>Установка карниза</th>
                                                    <th>Оформление</th>
                                                    <th>Транспортные расходы</th>
                                                    <th>Сумма заказа</th>
                                                    <th>Предоплата</th>
                                                    <th>Доплата</th>
                                                    <th>Дизайнер</th>
                                                    <th>Статус заказа</th>
                                                    <th>Статус оплаты</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $range = "Заказы!A" . $_COOKIE['stringsOrders'] . ":P";
                                            $range2 = "Заказы!AH1";
                                            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                                            $response2 = $service->spreadsheets_values->get($spreadsheetId, $range2);
                                            $values = $response->getValues();
                                            $values2 = $response2->getValues();
                                            if (empty($values)) {
                                                print "Данные не найдены.\n";
                                            } else {
                                                $mask = "%10s %-10s %s\n";
                                                foreach ($values as $row) {
                                                    echo "<tr class='orderLine'>";
                                                    echo "<td>" . '<span><a href="#"><i class="ti-eye color-default orderViewing"></i></a> </span> <span><a href="#"><i class="ti-pencil-alt color-success orderChange"></i></a></span> <span><a href="#"><i class="ti-trash color-danger orderDelete"></i> </a></span>' . "</td>";
                                                    echo "<td>" . $row[0] . "</td>";
                                                    echo "<td>" . $row[1] . "</td>";
                                                    echo "<td>" . $row[2] . "&nbsp;" . $row[3] . "&nbsp;" . $row[4] . "</td>";
                                                    echo "<td>" . $row[5] . "</td>";
                                                    echo "<td>" . $row[6] . "</td>";
                                                    echo "<td>" . $row[7] . "</td>";
                                                    echo "<td>" . $row[8] . "</td>";
                                                    echo "<td>" . $row[9] . "</td>";
                                                    echo "<td>" . $row[10] . "</td>";
                                                    echo "<td>" . $row[11] . "</td>";
                                                    echo "<td>" . $row[12] . "</td>";
                                                    echo "<td>" . $row[13] . "</td>";
                                                    if ($row[14] === "Сдан") {
                                                        echo "<td><span class='badge badge-success'>" . $row[14] . "</span></td>";
                                                    } else if ($row[14] === "Принят") {
                                                        echo "<td><span class='badge badge-danger'>" . $row[14] . "</span></td>";
                                                    } else if ($row[14] === "В работе") {
                                                        echo "<td><span class='badge badge-warning'>" . $row[14] . "</span></td>";
                                                    } else if ($row[14] === "Готов") {
                                                        echo "<td><span class='badge badge-primary'>" . $row[14] . "</span></td>";
                                                    } else if ($row[14] === "Возврат") {
                                                        echo "<td><span class='badge badge-warining'>" . $row[14] . "</span></td>";
                                                    }
                                                    if ($row[15] === "Оплата") {
                                                        echo "<td><span class='badge badge-success'>" . $row[15] . "</span></td>";
                                                    } else if ($row[15] === "Предоплата") {
                                                        echo "<td><span class='badge badge-primary'>" . $row[15] . "</span></td>";
                                                    } else if ($row[15] === "Без оплаты") {
                                                        echo "<td><span class='badge badge-warining'>" . $row[15] . "</span></td>";
                                                    } else if ($row[15] === "Не оплачен") {
                                                        echo "<td><span class='badge badge-danger'>" . $row[15] . "</span></td>";
                                                    }
                                                    echo "</tr>";
                                                }
                                                echo "<div class='numLin displayNone'>" . $values2[0][0] . "</div>";
                                            }
                                            ?>
                                            </tbody>
                                            </div>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->

                    </div>
                    <!-- /# row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>Эта таблица была обновлена в <span id="date-time"></span> <a href="#" class="page-refresh">Обновить данные</a></p>
                            </div>

                            <!-- Modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Запросы на сервер</h5>
            </div>
            <div class="modal-body">
                <h4>Выберите количество строк, выгружаемых с сервера. Рекомендуемое количество - 300 строк.</h4>
                <input type="text" id="range_02" value="" name="range" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary saveInquiries">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content modalDate">
            <div class="modal-header">
                <h4 class="modal-title">Выберите интервал</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="basic-form">
                            <div class="form-group">
                                <label>С какой даты</label>
                                <input type="text" class="form-control calendar bg-ash firstDate" placeholder="Выберите дату" id="text-calendar">
                                <span class="ti-calendar form-control-feedback booking-system-feedback m-t-30"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="basic-form">
                            <div class="form-group">
                                <label>По какую дату</label>
                                <input type="text" class="form-control calendar bg-ash secondDate" placeholder="Выберите дату" id="text-calendar">
                                <span class="ti-calendar form-control-feedback booking-system-feedback m-t-30"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default buttonClose" data-dismiss="modal">Закрыть</button>
            </div>
        </div>

    </div>
</div>

<?php
require "blocks/search.php"
?>
    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.min.js"></script>
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/js/scripts.js"></script>
    <!-- sweetalert -->
    <script src ="assets/js/lib/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <script src="assets/js/lib/calendar-2/moment.latest.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/semantic.ui.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/prism.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/pignose.init.js"></script>
    <!-- scripit init-->
    <script src="assets/js/orders.js<?php require "version.php"; ?>"></script>
    <!-- scripit init-->


    <script src="assets/js/lib/rangeSlider/ion.rangeSlider.min.js"></script>

    <script>console.timeEnd('FirstWay')</script>







</body>

</html>