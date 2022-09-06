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

    <title>Редактор активов </title>

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
    <link href="assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
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
    <!-- /# sidebar -->

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Амортизация</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="index.php">Главное</a></li>
                                    <li><a href="depreciation.php">Амортизация</a></li>
                                    <li class="active">Добавить актив</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <form class="card alert" id="mainForm" method="post" action="ordersRequest.php">
                        <div class="card-body">
                            <div class="card-header m-b-20">
                                <h4>Добавить актив</h4>
                            </div>
                            <input type="text" class="displayNone" id="numOrders" name="numOrders">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Дата</label>
                                            <input type="text" class="form-control calendar bg-ash dateDepreciation" placeholder="Выберите дату" id="text-calendar" name="dateDepreciation" required>
                                            <span class="ti-calendar form-control-feedback booking-system-feedback m-t-30"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 counterpartyMd3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Актив</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash assets" autocomplete="off" name="assets" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Стоимость</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash assetValue" maxlength="11" autocomplete="off" name="assetValue" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                 <div class="basic-form">
                                    <div class="form-group">
                                        <label>Срок полезного использования, в месяцах</label>
                                        <input type="text" class="form-control border-none input-flat bg-ash term" autocomplete="off" name="term" required>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-3 operationArticleMd-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Статья</label>
                                            <select class="form-control bg-ash border-none operationArticle" name="operationArticle" required>
                                                <option selected disabled></option>
                                                <option>Нематериальная собственность</option>
                                                <option>Мебель</option>
                                                <option>Образцы</option>
                                                <option>Офисная техника и ее принадлежности</option>
                                                <option>Оформление торгового зала и улицы</option>
                                                <option>Техника и инструменты производства</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-md-3 writeOffDateBlock displayNone">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Дата списания</label>
                                            <input type="text" class="form-control calendar bg-ash writeOffDate" placeholder="Выберите дату" id="text-calendar" name="writeOffDate">
                                            <span class="ti-calendar form-control-feedback booking-system-feedback m-t-30"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" id="addOrder" type="submit">Добавить актив</button>
                        </div>
                    </form>
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





    <?php
    require "sheets.php";
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
    <script src="assets/js/scripts.js"></script>
    <!-- scripit init-->
    <script src="assets/js/edit-depreciation.js<?php require "version.php"; ?>"></script>




</body>

</html>