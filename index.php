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
    <title>Рабочий стол</title>
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
$range = "Баланс!A1:A";
$range2 = "Баланс!F1:I2";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$response2 = $service->spreadsheets_values->get($spreadsheetId, $range2);
$values = $response->getValues();
$values2 = $response2->getValues();
?>




    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Рабочий стол</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li class="active">Рабочий стол</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="main-content">
                    <div class="row" id="rowBalance">
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header" id="balance1">
                                        <div class="header-title pull-left"><?php echo $values2[0][0]?></div>
                                        <div class="card-option drop-menu pull-right"><i class="ti-more-alt" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                            <ul class="card-option-dropdown dropdown-menu">
                                                <?php
                                                foreach ($values as $row) {
                                                    echo "<li><a href='#'>" . $row[0] . "</a></li>";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        <div class="pull-left">
                                            <span class="stat-digit"><?php echo $values2[1][0]?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header" id="balance2">
                                        <div class="header-title pull-left"><?php echo $values2[0][1]?></div>
                                        <div class="card-option drop-menu pull-right"><i class="ti-more-alt" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                            <ul class="card-option-dropdown dropdown-menu">
                                                <?php
                                                foreach ($values as $row) {
                                                    echo "<li><a href='#'>" . $row[0] . "</a></li>";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        <div class="pull-left">
                                            <span class="stat-digit"><?php echo $values2[1][1]?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header" id="balance3">
                                        <div class="header-title pull-left"><?php echo $values2[0][2]?></div>
                                        <div class="card-option drop-menu pull-right"><i class="ti-more-alt" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                            <ul class="card-option-dropdown dropdown-menu">
                                                <?php
                                                foreach ($values as $row) {
                                                    echo "<li><a href='#'>" . $row[0] . "</a></li>";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        <div class="pull-left">
                                            <span class="stat-digit"><?php echo $values2[1][2]?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header" id="balance4">
                                        <div class="header-title pull-left"><?php echo $values2[0][3]?></div>
                                        <div class="card-option drop-menu pull-right"><i class="ti-more-alt" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                            <ul class="card-option-dropdown dropdown-menu">
                                                <?php
                                                foreach ($values as $row) {
                                                    echo "<li><a href='#'>" . $row[0] . "</a></li>";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        <div class="pull-left">
                                            <span class="stat-digit"><?php echo $values2[1][3]?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 areaChart">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Выручка фирмы</h4>
                                    <ul class="list-inline text-right">
                                        <li>
                                            <h5><i class="fa fa-circle m-r-5 text-primary"></i>Выручка</h5>
                                        </li>
                                    </ul>
                                    <div id="morris-area-chart"></div>
                                </div>
                            </div>
                        </div>
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

<?php
require "blocks/search.php"
?>



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
    <!-- <script src="assets/js/lib/weather/weather-init.js"></script> -->
    <script src="assets/js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress-init.js"></script>
    <!-- <script src="assets/js/lib/chartist/chartist.min.js"></script>
    <script src="assets/js/lib/chartist/chartist-init.js"></script> -->
    <script src="assets/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="assets/js/lib/sparklinechart/sparkline.init.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <script src="assets/js/lib/morris-chart/raphael-min.js"></script>
    <script src="assets/js/lib/morris-chart/morris.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/index.js<?php require "version.php"; ?>"></script>
</body>

</html>