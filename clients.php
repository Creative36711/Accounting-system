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

    <title>Клиенты</title>

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
                                <h1>Клиенты</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="/index.php">Главное</a></li>
                                    <li class="active">Лист клиентов</li>
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
                                    <h4>Лист клиентов</h4>
                                    <div class="search-action searchModel">
                                        <a href="/edit-clients.php"><button type="button" class="btn btn-primary m-b-10 m-l-5">Добавить клиента</button></a>
                                        <div class="search-type dib">
                                            <input class="form-control input-rounded customerName" placeholder="Поиск по имени..." type="text">
                                        </div>
                                        <div class="search-type dib">
                                            <input class="form-control input-rounded customerDescription" placeholder="Поиск по описанию..." type="text">
                                        </div>
                                        <div class="search-type dib">
                                            <input class="form-control input-rounded searchByAction" placeholder="Поиск по действию..." type="text">
                                        </div>
                                    </div>
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
                                                    <th>Номер клиента</th>
                                                    <th>Имя клиента</th>
                                                    <th>Телефон</th>
                                                    <th>Повторный</th>
                                                    <th>Описание клиента</th>
                                                    <th>Категория</th>
                                                    <th>Описание категории</th>
                                                    <th>Что сделано</th>
                                                    <th>Дизайнер</th>
                                                    <th>Время записи</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $range = "SQL запросы!E1:N";
                                            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                                            $values = $response->getValues();
                                            if (empty($values)) {
                                                print "Данные не найдены.\n";
                                            } else {
                                                $mask = "%10s %-10s %s\n";
                                                foreach ($values as $row) {
                                                    echo "<tr class='orderLine'>";
                                                    echo "<td>" . '<span><a href="#"><i class="ti-pencil-alt color-success orderChange"></i></a></span> <span><a href="#"><i class="ti-trash color-danger orderDelete"></i> </a></span>' . "</td>";
                                                    echo "<td>" . $row[0] . "</td>";
                                                    echo "<td>" . $row[1] . "</td>";
                                                    echo "<td>" . $row[2] . "</td>";
                                                    echo "<td>" . $row[3] . "</td>";
                                                    echo "<td>" . $row[4] . "</td>";
                                                    echo "<td>" . $row[5] . "</td>";
                                                    echo "<td>" . $row[6] . "</td>";
                                                    echo "<td>" . $row[7] . "</td>";
                                                    echo "<td>" . $row[8] . "</td>";
                                                    echo "<td>" . $row[9] . "</td>";
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
    <script src="assets/js/leads.js<?php require "version.php"; ?>"></script>

    <script>console.timeEnd('FirstWay')</script>







</body>

</html>