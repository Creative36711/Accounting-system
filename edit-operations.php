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

    <title>Редактор операций </title>

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

$range = "SQL запросы!BH1:BH";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
?>
    <!-- /# sidebar -->

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Операции</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="index.php">Главное</a></li>
                                    <li><a href="operations.php">Лист операций</a></li>
                                    <li class="active">Добавить операцию</li>
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
                                <h4>Добавить операцию:</h4>
                            </div>
                            <input type="text" class="displayNone" id="numOrders" name="numOrders">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Дата</label>
                                            <input type="text" class="form-control calendar bg-ash dateOperation" placeholder="Выберите дату" id="text-calendar" name="dateOperation" required>
                                            <span class="ti-calendar form-control-feedback booking-system-feedback m-t-30"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Сумма</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash transactionAmount" maxlength="11" autocomplete="off" name="transactionAmount" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 operationArticleMd-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Статья</label>
                                            <select class="form-control bg-ash border-none operationArticle" name="operationArticle" required>
                                                <option selected disabled></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 counterpartyMd3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Контрагент</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash counterparty" name="counterparty" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 counterparty2Md3 displayNone">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Контрагент</label>
                                            <select class="form-control bg-ash border-none counterparty2" name="counterparty2">
                                                <option selected disabled></option>
                                                <?php
                                                foreach ($values as $row) {
                                                    echo "<option>" . $row[0] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 counterparty3Md3 displayNone">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Контрагент</label>
                                            <select class="form-control bg-ash border-none counterparty3">
                                                <option selected disabled></option>                                               
                                                <option>Исмаилов И.Н.</option>
                                                <option>Першукова О.П.</option>                    
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 displayNone">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Тип операции</label>
                                            <select class="form-control bg-ash border-none typeTransaction" name="typeTransaction" required>
                                                <option selected disabled></option>
                                                <option>Приход</option>
                                                <option>Расход</option>
                                                <option>Перевод</option>
                                                <option>Задолженность</option>
                                                <option>Товародвижение</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 accountMd3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Счет</label>
                                            <select class="form-control bg-ash border-none account" name="account" required>
                                                <option selected disabled></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 account2Md3 displayNone">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Счет</label>
                                            <select class="form-control bg-ash border-none account2" name="account2">
                                                <option selected disabled></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Описание</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash operationDescription" name="operationDescription">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 commitmentCheckboxMd3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <div class="form-check form-check-inline checkboxEdit">
                                                <input class="form-check-input commitmentCheckbox" type="checkbox" id="inlineCheckbox1" value="Да" name="commitmentCheckbox">
                                                <label class="form-check-label" for="inlineCheckbox1">Учитывать в обязательствах</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 flexRadioDefaultMd3 displayNone">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <div class="radioForm">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Кредит" name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Кредиторская
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Дебет" name="flexRadioDefault" id="flexRadioDefault2">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Дебиторская
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" id="addOrder" type="submit">Добавить операцию</button>
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
    <script src="assets/js/edit-operations.js<?php require "version.php"; ?>"></script>




</body>

</html>