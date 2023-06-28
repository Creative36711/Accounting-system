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

    <title>Сравнение периодов</title>

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

<?php
$range = "Сравнение!A2:F";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
$range2 = "Переменные SQL!S3:T3";
$response2 = $service->spreadsheets_values->get($spreadsheetId, $range2);
$values2 = $response2->getValues();
?>
    <!-- /# sidebar, header -->
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Сравнение периодов</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-r-0 RemoveIndent">
                        <div class="page-header">
                            <div class="page-title">
                                <h1><a href="/help-comparison.php" target="_blank"><i class="ti-agenda"></i> Как устроен этот отчет?</a></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="/index.php">Главное</a></li>
                                    <li class="active">Аналитика</li>
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
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive tableOrders tabComparison">
										<ul class="chartData displayNone">
                                            <li><?php echo $values2[0][0]?></li>
                                            <li><?php echo $values2[0][1]?></li>
                                        </ul>
                                        <table class="table student-data-table m-t-20 table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Статья</th>
                                                    <th>Этот год</th>
													<th>Прошлый год</th>
													<th>Отклонение за месяц</th>
													<th>Отклонение за год</th>
													<th>Отклонение, %</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if (empty($values)) {
                                                print "Данные не найдены.\n";
                                            } else {
                                                $mask = "%10s %-10s %s\n";
                                                foreach ($values as $row) {
                                                    echo "<tr class='orderLine'>";
                                                        echo "<td>" . $row[0] . "</td>";
														echo "<td>" . $row[1] . "</td>";
														echo "<td>" . $row[2] . "</td>";
                                                        if (stristr($row[3], '-') !== false)
                                                            echo "<td class='color-danger'>" . $row[3] . "</td>";
                                                        else if ((stristr($row[3], '-') !== True) && $row[3] !== "0,00 ₽")
                                                            echo "<td class='color-success'>" . $row[3] . "</td>";
                                                        else 
                                                            echo "<td>" . $row[3] . "</td>";
														if (stristr($row[4], '-') !== false)
                                                            echo "<td class='color-danger'>" . $row[4] . "</td>";
                                                        else if ((stristr($row[4], '-') !== True) && $row[4] !== "0,00 ₽")
                                                            echo "<td class='color-success'>" . $row[4] . "</td>";
                                                        else 
                                                            echo "<td>" . $row[4] . "</td>";
														if (stristr($row[5], '-') !== false)
                                                            echo "<td class='color-danger'>" . $row[5] . "</td>";
                                                        else if ((stristr($row[5], '-') !== True) && $row[5] !== "0,00%")
                                                            echo "<td class='color-success'>" . $row[5] . "</td>";
                                                        else 
                                                            echo "<td>" . $row[5] . "</td>";
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

    <!-- Modal 1 -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                        <div class="card-header">
                            <h4>Сравнение заработной платы </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive tableOrders">
                                <table class="table student-data-table m-t-20 table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Ф.И.О.</th>
                                        <th>Этот год</th>
                                        <th>Прошлый год</th>
                                        <th>Отклонение за месяц</th>
                                        <th>Отклонение за год</th>
                                        <th>Отклонение, %</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $range3 = "Сравнение!K2:P";
                                    $response3 = $service->spreadsheets_values->get($spreadsheetId, $range3);
                                    $values3 = $response3->getValues();
                                    if (empty($values)) {
                                        print "Данные не найдены.\n";
                                    } else {
                                        $mask = "%10s %-10s %s\n";
                                        if ($values[0][0] !== "#VALUE!")
                                        foreach ($values3 as $row) {
                                            echo "<tr class='orderLine'>";
                                                echo "<td>" . $row[0] . "</td>";
                                                echo "<td>" . $row[1] . "</td>";
                                                echo "<td>" . $row[2] . "</td>";
                                                if (stristr($row[3], '-') !== false)
                                                    echo "<td class='color-danger'>" . $row[3] . "</td>";
                                                else if ((stristr($row[3], '-') !== True) && $row[3] !== "0,00 ₽")
                                                    echo "<td class='color-success'>" . $row[3] . "</td>";
                                                else 
                                                    echo "<td>" . $row[3] . "</td>";
                                                if (stristr($row[4], '-') !== false)
                                                    echo "<td class='color-danger'>" . $row[4] . "</td>";
                                                else if ((stristr($row[4], '-') !== True) && $row[4] !== "0,00 ₽")
                                                    echo "<td class='color-success'>" . $row[4] . "</td>";
                                                else 
                                                    echo "<td>" . $row[4] . "</td>";
                                                if (stristr($row[5], '-') !== false)
                                                    echo "<td class='color-danger'>" . $row[5] . "</td>";
                                                else if ((stristr($row[5], '-') !== True) && $row[5] !== "0,00%")
                                                    echo "<td class='color-success'>" . $row[5] . "</td>";
                                                else 
                                                    echo "<td>" . $row[5] . "</td>";
                                             echo "</tr>";
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

    <!-- Modal 2 -->
    <div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                        <div class="card-header">
                            <h4>Сравнение вывода средств </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive tableOrders">
                                <table class="table student-data-table m-t-20 table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Ф.И.О.</th>
                                        <th>Этот год</th>
                                        <th>Прошлый год</th>
                                        <th>Отклонение за месяц</th>
                                        <th>Отклонение за год</th>
                                        <th>Отклонение, %</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $range4 = "Сравнение!R2:W";
                                    $response4 = $service->spreadsheets_values->get($spreadsheetId, $range4);
                                    $values4 = $response4->getValues();
                                    if (empty($values)) {
                                        print "Данные не найдены.\n";
                                    } else {
                                        $mask = "%10s %-10s %s\n";
                                        if ($values[0][0] !== "#VALUE!")
                                        foreach ($values4 as $row) {
                                            echo "<tr class='orderLine'>";
                                            echo "<td>" . $row[0] . "</td>";
                                            echo "<td>" . $row[1] . "</td>";
                                            echo "<td>" . $row[2] . "</td>";
                                            if (stristr($row[3], '-') !== false)
                                                echo "<td class='color-danger'>" . $row[3] . "</td>";
                                            else if ((stristr($row[3], '-') !== True) && $row[3] !== "0,00 ₽")
                                                echo "<td class='color-success'>" . $row[3] . "</td>";
                                            else 
                                                echo "<td>" . $row[3] . "</td>";
                                            if (stristr($row[4], '-') !== false)
                                                echo "<td class='color-danger'>" . $row[4] . "</td>";
                                            else if ((stristr($row[4], '-') !== True) && $row[4] !== "0,00 ₽")
                                                echo "<td class='color-success'>" . $row[4] . "</td>";
                                            else 
                                                echo "<td>" . $row[4] . "</td>";
                                            if (stristr($row[5], '-') !== false)
                                                echo "<td class='color-danger'>" . $row[5] . "</td>";
                                            else if ((stristr($row[5], '-') !== True) && $row[5] !== "0,00%")
                                                echo "<td class='color-success'>" . $row[5] . "</td>";
                                            else 
                                                echo "<td>" . $row[5] . "</td>";
                                        echo "</tr>";
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div class="displayNone">
    <span class="writeOff DisplayNone" data-toggle="modal" data-target="#exampleModalLong">Сравнение заработной платы</span>
    <span class="writeOff2 DisplayNone" data-toggle="modal" data-target="#exampleModalLong2">Сравнение вывода средств</span>
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
    <script src="assets/js/comparison.js<?php require "version.php"; ?>"></script>


    <script>console.timeEnd('FirstWay')</script>







</body>

</html>