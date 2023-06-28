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
    <title>Отчет по дивидендам </title>
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
    <link href="assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/unix.css" rel="stylesheet">
    <link href="assets/css/style.css<?php require "version.php"; ?>" rel="stylesheet">
</head>

<body>

<?php
require "sheets.php";
require "blocks/header.php";
?>



<?php
$range = "Дивиденды!B1:B";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
$range2 = "Переменные SQL!S3:T3";
$response2 = $service->spreadsheets_values->get($spreadsheetId, $range2);
$values2 = $response2->getValues();
?>




    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Отчет по дивидендам</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-r-0 RemoveIndent">
                        <div class="page-header">
                            <div class="page-title">
                                <h1><a href="/help-dividends.php" target="_blank"><i class="ti-agenda"></i> Как устроен этот отчет?</a></h1>
                            </div>
                        </div>
                    </div>
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
                </div>
                <div id="main-content">
                    <div class="row rowChart">
                        <div class="col-lg-4">
                            <div class="card alert">
                                <div class="card-header m-b-90">
                                    <h4>Дивиденды</h4>
                                </div>
                                <div class="card-body">
                                    <div class="stat-widget-seven">
                                        <div class="stat-content">
                                            <div class="stat-heading">
                                                <div class="count-header"><h4>Дивиденды за этот год</h4></div>
                                                <div class="stat-count"><?php echo $values[0][0]?></div>
                                            </div>
                                            <div class="gradient-circle" id="visitor-circle">
                                                <i class="ti-cup"></i>
                                            </div>
                                            <div class="stat-footer">
                                                <div class="row m-0">
                                                    <div class="col-lg-6 p-0 text-left">
                                                        <div class="stat-count"><?php echo $values[1][0]?></div>
                                                        <div class="count-header">Среднемесячный заработок</div>
                                                    </div>
                                                    <div class="col-lg-6 p-0 text-right">
                                                        <div class="stat-count"><?php echo $values[2][0]?></div>
                                                        <div class="count-header">Средненедельный заработок</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 areaChart">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Статистика по дивидендам</h4>
                                    <ul class="list-inline text-right">
                                        <li>
                                            <h5><i class="fa fa-circle m-r-5 text-success"></i>Дивиденды</h5>
                                        </li>
                                    </ul>
                                    <div id="morris-area-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row withdrawalRow" data-toggle="modal" data-target="#exampleModalLong">
                        <div class="col-lg-3">
                            <div class="card withdrawal1">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-money color-success border-success"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Исмаилов И.Н.</div>
                                        <div class="stat-digit"><i></i><?php echo $values[4][0]?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card withdrawal3">
                                <div class="stat-widget-two withdrawal">
                                    <div class="stat-content">
                                        <div class="stat-text">Доступно </div>
                                        <div class="stat-digit"> <i class="fa"></i><?php echo $values[3][0]?></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success w-<?php echo $values[10][0]?>" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card withdrawal2">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-money color-success border-success"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Першукова О.П.</div>
                                        <div class="stat-digit"><i></i><?php echo $values[5][0]?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card withdrawal4">
                                <div class="stat-widget-two">
                                    <div class="stat-content">
                                        <div class="stat-text"><?php echo $values[9][0]?> </div>
                                        <div class="stat-digit"> <i class="fa"></i><?php echo $values[8][0]?></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger w-<?php echo $values[11][0]?>" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 chart">
                            <div class="media">
                                <div class="card alert">
                                    <div class="card-body">
                                        <div class="chartDiv chartDividends"></div>
                                        <ul class="chartData displayNone">
                                            <li><?php echo $values[6][0]?></li>
                                            <li><?php echo $values[7][0]?></li>
                                            <li><?php echo $values2[0][0]?></li>
                                            <li><?php echo $values2[0][1]?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>Эта таблица была обновлена в <span id="date-time"></span> <a href="#" class="page-refresh">Обновить данные</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                        <div class="card-header">
                            <h4>Вывод средств за текущий год </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Месяц</th>
                                        <th>Исмаилов И.Н.</th>
                                        <th>Першукова О.П.</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $range = "Дивиденды!E2:G";
                                    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                                    $values = $response->getValues();
                                    if (empty($values)) {
                                        print "Данные не найдены.\n";
                                    } else {
                                        $mask = "%10s %-10s %s\n";
                                        if ($values[0][0] !== "#VALUE!")
                                        foreach ($values as $row) {
                                            echo "<tr   >";
                                            echo "<td>" . $row[0] . "</td>";
                                            echo "<td>" . $row[1] . "</td>";
                                            echo "<td>" . $row[2] . "</td>";
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

<?php
require "blocks/search.php"
?>

    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>

    <script src="assets/js/lib/jquery.min.js"></script>
    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress-init.js"></script>
    <script src="assets/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="assets/js/lib/sparklinechart/sparkline.init.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <script src="assets/js/lib/morris-chart/raphael-min.js"></script>
    <script src="assets/js/lib/morris-chart/morris.js"></script>
    <script src="assets/js/lib/calendar-2/moment.latest.min.js"></script>
    <script src="assets/js/dividends.js<?php require "version.php"; ?>"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>