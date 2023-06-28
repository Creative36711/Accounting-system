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

    <title>Редактор заказов </title>

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
                                <h1>Ремонт</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="index.php">Главное</a></li>
                                    <li><a href="repair.php">Лист ремонта</a></li>
                                    <li class="active">Добавить заказ</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <form onsubmit="return false" class="card alert" id="mainForm" method="post" action="ordersRequest.php">
                        <div class="card-body">
                            <div class="card-header m-b-20">
                                <h4>Добавить ремонт</h4>
                            </div>
                            <input type="text" class="displayNone" id="numOrders" name="numOrders">
                            <div class="row">
                            <div class="col-md-3">
                                <div class="basic-form">
                                    <div class="form-group">
                                        <label>Номер заказа</label>
                                        <input type="text" class="form-control border-none input-flat bg-ash orderNumber2" maxlength="11" autocomplete="off" tabindex="1" name="orderNumber2" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Дата заказа</label>
                                            <input type="text" class="form-control calendar bg-ash orderDate2" placeholder="Выберите дату" id="text-calendar" name="orderDateRepair" required>
                                            <span class="ti-calendar form-control-feedback booking-system-feedback m-t-30"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Фамилия</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash surname2" tabindex="1" name="surname" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Имя</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash name2" tabindex="2" name="name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Отчество</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash patronymic2" tabindex="3" name="patronymic" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Номер телефона</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash phoneNumber2" maxlength="16" tabindex="4" name="phoneNumber" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Категория</label>
                                            <select class="form-control bg-ash border-none serviceCategory" tabindex="5" name="serviceCategory" required>
                                                <option selected disabled></option>
                                                <option>Подшить низ</option>
                                                <option>Поднять рукав</option>
                                                <option>Укоротить рукав</option>
                                                <option>Ушить</option>
                                                <option>Замена молнии</option>
                                                <option>Замена подкладки</option>
                                                <option>Заштопать дырку</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Наименование услуги</label>
                                            <select class="form-control bg-ash border-none serviceName" tabindex="6" name="serviceName" required>
                                                <option selected disabled></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Количество</label>
                                            <input type="number" class="form-control border-none input-flat bg-ash serviceQuantity" tabindex="7" name="serviceQuantity" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Сумма заказа</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash orderPrice2" maxlength="11" autocomplete="off" tabindex="8" name="orderPrice" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Дизайнер</label>
                                            <select class="form-control bg-ash border-none designer2" tabindex="9" name="designer" required>
                                                <option selected disabled></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Процент дизайнера</label>
                                            <select class="form-control bg-ash border-none designerPercentage2" tabindex="10" name="designerPercentage" required>
                                                <option selected disabled></option>
                                                <option>0,00%</option>
                                                <option>5,00%</option>
                                                <option>10,00%</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Статус оплаты</label>
                                            <select class="form-control bg-ash border-none paymentState2" name="paymentState" required>
                                                <option selected disabled></option>
                                                <option>Оплата</option>
                                                <option>Не оплачен</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Статус заказа</label>
                                            <select class="form-control bg-ash border-none orderStatus" name="orderStatus" required>
                                                <option>Принят</option>
                                                <option>В работе</option>
                                                <option>Готов</option>
                                                <option>Сдан</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Срок сдачи заказа</label>
                                            <input type="text" class="form-control calendar bg-ash deadline2" placeholder="Выберите дату" id="text-calendar" name="deadline" required>
                                            <span class="ti-calendar form-control-feedback booking-system-feedback m-t-30"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Швея</label>
                                            <select class="form-control bg-ash border-none seamstress" tabindex="11" name="seamstress" required>
                                                <option selected disabled></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 displayNone" id="paymentDate">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Дата оплаты</label>
                                            <input type="text" class="form-control calendar bg-ash paymentDate2" placeholder="Выберите дату" id="text-calendar" name="paymentDate" required>
                                            <span class="ti-calendar form-control-feedback booking-system-feedback m-t-30"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 displayNone" id="dateOfReadiness">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Дата сдачи заказа</label>
                                            <input type="text" class="form-control calendar bg-ash dateOfReadiness2" placeholder="Выберите дату" id="text-calendar" name="dateOfReadiness" required>
                                            <span class="ti-calendar form-control-feedback booking-system-feedback m-t-30"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" id="addOrder" type="submit">Добавить заказ</button>
                        </div>
                    </form>
                    <select class="accountType displayNone">                                                                   
                    </select>
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
    <script src="assets/js/edit-repair.js"></script>

    <script src ="assets/js/lib/sweetalert2/dist/sweetalert2.all.min.js<?php require "version.php"; ?>"></script>



</body>

</html>