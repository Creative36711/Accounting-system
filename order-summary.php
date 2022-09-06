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

    <title>Сводка</title>

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

    <link href="assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
	<!-- Styles -->
    <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
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




    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Сводка</h1>
                            </div>
                        </div>
                    </div><!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="index.php">Главное</a></li>
                                    <li class="active">Сводка</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /# column -->
                </div><!-- /# row -->
                <div id="main-content">
                    <div class="alert alert-warning fade in alert-dismissable displayNone">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Предупреждение!</strong> Имеются не списанные заказы или модели, проверьте информацию о списании.
                    </div>
                    <div class="row padding">
                            <div class="card">
                                <div class="media">
                                    <div class="media-body displayFlex">
                                        <span class="numberOrdersSum"><b class="numberOrdersSumI2">Заказ №</b><b class="numberOrdersSumI"></b></span>
                                        <span class="writeOff" data-toggle="modal" data-target="#exampleModalLong"><b>Информация о списании</b></span>
                                        <span class="informationAboutOrder displayNone"><b>Статус заказа</b></span>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-tag f-s-22 color-primary border-primary round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4 class="discount"></h4>
                                        <h6>Цена со скидкой</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-money f-s-22 color-success border-success round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4 class="profit"></h4>
                                        <h6>Прибыль</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-industry f-s-22 color-warning border-warning round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4 class="sewing"></h4>
                                        <h6>Доход по пошиву</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-product-hunt f-s-22 border-danger color-danger round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4 class="retail"></h4>
                                        <h6>Розничная цена товара</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-percent f-s-22 color-primary border-primary round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4 class="discountPercentage"></h4>
                                        <h6>Процент скидки</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-briefcase f-s-22 color-success border-success round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4 class="profitability"></h4>
                                        <h6>Рентабельность</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-industry f-s-22 color-warning border-warning round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4 class="installation"></h4>
                                        <h6>Доход по установке</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-percent f-s-22 border-danger color-danger round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4 class="extraCharge"></h4>
                                        <h6>Наценка на товар</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-ruble f-s-22 color-primary border-primary round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4 class="price"></h4>
                                        <h6>Цена без скидки</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-pie-chart f-s-22 color-success border-success round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4 class="margin"></h4>
                                        <h6>Маржа</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-industry f-s-22 color-warning border-warning round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4 class="registration"></h4>
                                        <h6>Доход по оформлению</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card costPriceCard">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-shopping-cart f-s-22 border-danger color-danger round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4 class="costPrice"></h4>
                                        <h6>Себестоимость товара</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row padding chartRow displayNone">
                        <div class="media">
                            <div class="card alert">
                                <div class="card-body">
                                    <div class="chartDiv chartSummary"></div>
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

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                        <div class="card-header">
                            <h4>Заказы и модели, которые нужно списать </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Номер заказа/модели</th>
                                        <th>Дизайнер</th>
                                        <th>Статус заказа/модели</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $range = "SQL запросы!A:C";
                                    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                                    $values = $response->getValues();
                                    if (empty($values)) {
                                        print "Данные не найдены.\n";
                                    } else {
                                        $mask = "%10s %-10s %s\n";
                                        if ($values[0][0] !== "#VALUE!")
                                        foreach ($values as $row) {
                                            echo "<tr class='orderLine'>";
                                            echo "<td>" . $row[0] . "</td>";
                                            echo "<td>" . $row[1] . "</td>";
                                            // echo "<td><span class='badge badge-success'>Сдан</span></td>";
                                            if ($row[2] === "-1,00 ₽") {
                                                echo "<td><span class='badge badge-success'>Проверен</span></td>";
                                            } else {
                                                echo "<td><span class='badge badge-danger'>Не проверен</span></td>";
                                            }
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

    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>

    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- sidebar -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <!-- bootstrap -->
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- Circle Progress Bar -->
    <script src="assets/js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress-init.js"></script>
    <script src="assets/js/lib/chartist/chartist.min.js"></script>
<!--    <script src="assets/js/lib/chartist/chartist-init.js"></script>-->
    <script src="assets/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="assets/js/lib/sparklinechart/sparkline.init.js"></script>
    <!-- Bar Chat Js -->
    <script src="assets/js/lib/peitychart/jquery.peity.min.js"></script><!-- scripit init-->
    <script src="assets/js/lib/peitychart/peitychart.init.js"></script><!-- scripit init-->


<!--    <script src="assets/js/lib/datamap/d3.min.js"></script>-->
<!--    <script src="assets/js/lib/datamap/topojson.js"></script>-->
<!--    <script src="assets/js/lib/datamap/datamaps.world.min.js"></script>-->
<!--    <script src="assets/js/lib/datamap/datamap-init.js"></script>-->
    <!-- scripit init-->
    <script src="assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel-init.js"></script>

<!--    <script src="assets/js/lib/morris-chart/raphael-min.js"></script>-->
<!--    <script src="assets/js/lib/morris-chart/morris.js"></script>-->
<!--    <script src="assets/js/lib/morris-chart/morris-init.js"></script>-->

    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/order-summary.js<?php require "version.php"; ?>"></script>

    <script src ="assets/js/lib/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <script>console.timeEnd('FirstWay')</script>

</body>

</html>