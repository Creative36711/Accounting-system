<?php

if (!isset($_COOKIE['user'])) {
    header('location: login.php');
} 

if (!isset($_COOKIE['stringsServices'])) {
    setcookie("stringsServices", 100);
    $_COOKIE['stringsServices'] = 100;
}

if (!isset($_COOKIE['numLin021'])) {
    $_COOKIE['numLin021'] = 1000;
}

$_COOKIE['stringsServices'] = (int)$_COOKIE['numLin021'] - (int)$_COOKIE['stringsServices'];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Услуги</title>

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
    <link href="assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/unix.css" rel="stylesheet">
    <link href="assets/css/style.css<?php require "version.php"; ?>" rel="stylesheet">

    <link href="assets/css/lib/rangSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="assets/css/lib/rangSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">
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
                                <h1>Услуги</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="/index.php">Главное</a></li>
                                    <li class="active">Услуги</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card alert">
                                <div class="card-header pr">
                                    <h4>Добавить услугу</h4>
                                </div>
                                <form id="formServices" method="post" action="ordersRequest.php">
                                    <input type="text" class="displayNone" id="numServices" name="numServices">
                                    <div class="basic-form m-t-20" id="serviceAmount">
                                        <div class="form-group">
                                            <label>Номер заказа</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash orderNumberServices" autocomplete="off" name="orderNumberServices" maxlength="9" required>
                                        </div>
                                    </div>
                                    <div class="basic-form" id="typeOfService">
                                        <div class="form-group">
                                            <label>Вид услуги</label>
                                            <select class="form-control bg-ash border-none" id="typeOfServiceInput" name="typeOfServiceInput" required>
                                                <option selected disabled></option>
                                                <option>Пошив</option>
                                                <option>Установка карниза</option>
                                                <option>Оформление окон</option>
                                                <option>Транспортные услуги</option>
                                                <option>Раскрой изделия</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="basic-form" id="serviceProvider">
                                        <div class="form-group">
                                            <label>Исполнитель</label>
                                            <select class="form-control bg-ash border-none" id="serviceProviderInput" name="serviceProviderInput" required>
                                                <option selected disabled></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="basic-form m-t-20" id="serviceAmount">
                                        <div class="form-group">
                                            <label>Сумма</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash serviceAmount2" autocomplete="off" name="serviceAmount2" required>
                                        </div>
                                    </div>
                                    <div class="basic-form" id="percentageOfService">
                                        <div class="form-group">
                                            <label>Процент от выполнения</label>
                                            <select class="form-control bg-ash border-none" id="percentageOfServiceInput" name="percentageOfServiceInput" required>
                                                <option selected disabled></option>
                                                <option>0,00%</option>
                                                <option>20,00%</option>
                                                <option>30,00%</option>
                                                <option>40,00%</option>
                                                <option>50,00%</option>
                                                <option>55,00%</option>
                                                <option>80,00%</option>
                                                <option>100,00%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="basic-form" id="serviceDescription">
                                        <label>Описание услуги</label>
                                        <textarea class="form-control bg-ash serviceDescription2" cols="37" rows="3" name="serviceDescription2" required></textarea>
                                    </div>
                                    <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 m-t-30 sbmt-btn" id="addServices" type="submit">Добавить</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card alert">
                                <div class="card-header pr">
                                    <h4>Лист с услугами</h4>
                                    <div class="search-action">
                                        <div class="search-type dib">
                                            <input class="form-control input-rounded orderNumberServices2" placeholder="Введите номер заказа" type="text" maxlength="9" name="orderNumberServices2">
                                        </div>
                                    </div>
                                    <div class="card-header-right-icon">
                                        <ul>
                                            <li class="card-close" data-dismiss="alert"><i class="ti-close"></i></li>
                                            <li class="card-option drop-menu"><i class="ti-settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                                <ul class="card-option-dropdown dropdown-menu">
                                                    <li class="inquiries"><a data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="ti-server"></i> Запросы на сервер</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive tableServices">
                                        <table class="table student-data-table m-t-20">
                                            <thead>
                                                <tr>
                                                    <th>Действие</th>
                                                    <th>Вид услуги</th>
                                                    <th>Описание</th>
                                                    <th>Сумма</th>
                                                    <th>Исполнитель</th>
                                                    <th>Процент исполнителя</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $range = "Услуги!A" . $_COOKIE['stringsServices'] . ":G";
                                            $range2 = "Услуги!I1";
                                            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                                            $response2 = $service->spreadsheets_values->get($spreadsheetId, $range2);
                                            $values = $response->getValues();
                                            $values2 = $response2->getValues();
                                            if (empty($values)) {
                                                print "Данные не найдены.\n";
                                            } else {
                                                $mask = "%10s %-10s %s\n";
                                                foreach ($values as $row) {
                                                    echo "<tr class='orderLine'>";
                                                    echo "<td>" . '<span><a href="#"><i class="ti-pencil-alt color-success orderChange"></i></a></span> <span><a href="#"><i class="ti-trash color-danger orderDelete"></i> </a></span>' . "</td>";
                                                    echo "<td class='displayNone'>" . $row[0] . "</td>";
                                                    echo "<td>" . $row[1] . "</td>";
                                                    echo "<td>" . $row[2] . "</td>";
                                                    echo "<td>" . $row[3] . "</td>";
                                                    echo "<td>" . $row[4] . "</td>";
                                                    echo "<td>" . $row[5] . "</td>";
                                                    echo "<td class='displayNone'>" . $row[6] . "</td>";
                                                    echo "</tr>";
                                                }
                                                echo "<div class='numLin021 displayNone'>" . $values2[0][0] . "</div>";
                                            }
                                            ?>
                                            </tbody>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Запросы на сервер</h5>
            </div>
            <div class="modal-body">
                <h4>Выберите количество строк, выгружаемых с сервера. Рекомендуемое количество - 600 строк.</h4>
                <input type="text" id="range_021" value="" name="range" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary saveInquiries">Сохранить изменения</button>
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
    <script src="assets/js/scripts.js"></script>
    <!-- scripit init-->
    <script src="assets/js/services.js<?php require "version.php"; ?>"></script>
    <!-- sweetalert -->
    <script src = "assets/js/lib/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <script src="assets/js/lib/rangeSlider/ion.rangeSlider.min.js"></script>

    <script>console.timeEnd('FirstWay')</script>

</body>

</html>