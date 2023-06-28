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

    <title>Контрагенты</title>

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
                                <h1>Контрагенты</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="/index.php">Главное</a></li>
                                    <li class="active">Лист контрагентов</li>
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
                                    <h4>Контрагенты</h4>
                                    <div class="search-action">

                                        <div class="search-type dib">
                                            <input class="form-control input-rounded counterparty" placeholder="Поиск по контрагенту..." type="text">
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive tableOrders">
                                        <table class="table student-data-table m-t-20 table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Название</th>
                                                    <th>Баланс</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $range = "SQL запросы!AK2:AL";
                                            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                                            $values = $response->getValues();
                                            if (empty($values)) {
                                                print "Данные не найдены.\n";
                                            } else {
                                                $mask = "%10s %-10s %s\n";
                                                foreach ($values as $row) {
                                                    if ($row[1] !== "0,00 ₽") {
                                                        echo "<tr class='orderLine'>";
                                                    } else {
                                                        echo "<tr class='orderLine displayNone'>";
                                                    }
                                                    echo "<td>" . $row[0] . "</td>";
                                                    if (stristr($row[1], '-') !== false) {
                                                        echo "<td>" . '<font size="2px">Мы должны</font> ' . '<span class="color-danger">' . $row[1] . '</span>' . "</td>";
                                                    } else {
                                                        echo "<td>" . '<font size="2px">Должен нам</font> ' . '<span class="color-success">' . $row[1] . '</span>' . "</td>";
                                                    }
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
    <script src="assets/js/counterparty.js<?php require "version.php"; ?>"></script>


    <script>console.timeEnd('FirstWay')</script>







</body>

</html>