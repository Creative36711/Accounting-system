<?php
    if (!isset($_COOKIE['user'])) {
        header('location: login.php');
    } 
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Отчет о прибылях и убытках</title>

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
                    <div class="col-lg-4 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Отчет о прибылях и убытках</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-r-0 RemoveIndent">
                        <div class="page-header">
                            <div class="page-title">
                                <h1><a href="/help-pnl.php" target="_blank"><i class="ti-agenda"></i> Как устроен этот отчет?</a></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="/index.php">Главное</a></li>
                                    <li class="active">Отчеты</li>
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
                                    <h4>Сводная таблица</h4>
                                    <div class="card-header-right-icon">
                                        <ul>
                                            <li class="card-close"><i class="ti-close"></i></li>
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
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive tableOrders tabPnl">
                                        <table class="table student-data-table m-t-20 table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Показатель</th>
                                                    <th>Итого</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $range = "ОПиУ!A2:B";
                                            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                                            $values = $response->getValues();
                                            if (empty($values)) {
                                                print "Данные не найдены.\n";
                                            } else {
                                                $mask = "%10s %-10s %s\n";
                                                foreach ($values as $row) {
                                                    echo "<tr class='orderLine'>";
                                                        echo "<td>" . $row[0] . "</td>";
                                                        if (stristr($row[1], '-') !== false)
                                                            echo "<td class='color-danger'>" . $row[1] . "</td>";
                                                        else if ((stristr($row[1], '-') !== True) && $row[1] !== "0,00 ₽")
                                                            echo "<td class='color-success'>" . $row[1] . "</td>";
                                                        else 
                                                            echo "<td>" . $row[1] . "</td>";
                                                    echo "</tr>";
                                                }

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

    <!-- scripit init-->
    <script src="assets/js/reports.js<?php require "version.php"; ?>"></script>

    <script>console.timeEnd('FirstWay')</script>







</body>

</html>