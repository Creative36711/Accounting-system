<?php

if (!isset($_COOKIE['user'])) {
        header('location: login.php');
} 

if (!isset($_COOKIE['stringsProduct'])) {
    setcookie("stringsProduct", 100);
    $_COOKIE['stringsProduct'] = 100;
}

if (!isset($_COOKIE['numLin022'])) {
    $_COOKIE['numLin022'] = 4000;
}

$_COOKIE['stringsProduct'] = (int)$_COOKIE['numLin022'] - (int)$_COOKIE['stringsProduct'];
?>



<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Товар</title>

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
    <link href="assets/css/print.css<?php require "version.php"; ?>" rel="stylesheet">

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
                                <h1>Товар</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="/index.php">Главное</a></li>
                                    <li class="active">Товар</li>
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
                                    <h4>Добавить товар</h4>
                                </div>
                                <form id="formServices" method="post" action="ordersRequest.php">
                                    <input type="text" class="displayNone" id="numProduct" name="numProduct">
                                    <div class="basic-form m-t-20" id="productAmount">
                                        <div class="form-group">
                                            <label>Номер заказа</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash orderNumberProduct" autocomplete="off" name="orderNumberProduct" maxlength="9" required>
                                        </div>
                                    </div>
                                    <div class="basic-form m-t-20" id="pannierCode">
                                        <div class="form-group">
                                            <label>Код</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash pannierCode2" autocomplete="off" name="pannierCode2">
                                        </div>
                                    </div>
                                    <div class="basic-form m-t-20" id="pannierProduct">
                                        <div class="form-group">
                                            <label>Товар</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash pannierProduct2" autocomplete="off" name="pannierProduct2" required>
                                        </div>
                                    </div>
                                    <div class="basic-form m-t-20" id="pannierQuantity">
                                        <div class="form-group">
                                            <label>Количество</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash pannierQuantity2" autocomplete="off" name="pannierQuantity2" required>
                                        </div>
                                    </div>
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Группа товаров</label>
                                            <select class="form-control bg-ash border-none" id="pannierProductGroup2" name="pannierProductGroup2" required>
                                                <option selected disabled></option>
                                                <option>Карниз</option>
                                                <option>Ламбрекен</option>
                                                <option>Покрывало</option>
                                                <option>Подушки</option>
                                                <option>Портьера</option>
                                                <option>Тюль</option>
                                                <option>Чехол</option>
                                                <option>Другое</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="basic-form m-t-20" id="pannierVendorCode">
                                        <div class="form-group">
                                            <label>Артикул</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash pannierVendorCode2" autocomplete="off" name="pannierVendorCode2">
                                        </div>
                                    </div>
                                    <div class="basic-form" id="percentageOfService">
                                        <div class="form-group">
                                            <label>Единица измерения</label>
                                            <select class="form-control bg-ash border-none" id="pannierUnitInput" name="pannierUnitInput" required>
                                                <option selected disabled></option>
                                                <option>кг.</option>
                                                <option>компл.</option>
                                                <option>м.</option>
                                                <option>Мкв.</option>
                                                <option>пар</option>
                                                <option>пог.м</option>
                                                <option>Упак</option>
                                                <option>шт.</option>
                                                <option>Рул.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="basic-form m-t-20" id="pannierPrice">
                                        <div class="form-group">
                                            <label>Цена</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash pannierPrice2" autocomplete="off" name="pannierPrice2" required>
                                        </div>
                                    </div>
                                    <div class="basic-form m-t-20" id="pannierSum">
                                        <div class="form-group">
                                            <label>Сумма</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash pannierSum2" autocomplete="off" name="pannierSum2" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-check form-check-inline checkboxOne">
                                        <input class="form-check-input pannierCheckbox1" type="checkbox" id="inlineCheckbox1" value="Да" name="pannierCheckbox1">
                                        <label class="form-check-label" for="inlineCheckbox1">Заказной материал</label>
                                    </div>
                                    <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 m-t-30 sbmt-btn" id="addProduct" type="submit">Добавить</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card alert">
                                <div class="card-header pr">
                                    <h4>Лист товаров</h4>
                                    <div class="search-action">
                                        <div class="search-type dib">
                                            <input class="form-control input-rounded orderNumberProduct2" placeholder="Введите номер заказа" type="text" maxlength="11" name="orderNumberProduct2">
                                        </div>
                                    </div>
                                    <div class="card-header-right-icon">
                                        <ul>
                                            <li class="card-close"><i class="ti-close"></i></li>
                                            <li class="card-option drop-menu"><i class="ti-settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                                <ul class="card-option-dropdown dropdown-menu">
                                                    <li class="inquiries"><a data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="ti-server"></i> Запросы на сервер</a></li>
                                                </ul>
                                            </li>
                                            <li class="card-option drop-menu"><i class="ti-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                                <ul class="card-option-dropdown dropdown-menu">
                                                    <li class="customProduct"><a href="#"><i></i> Заказной товар</a></li>
                                                    <li class="itemAmount"><a href="#"><i></i> Сумма товара</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive tableProduct">
                                        <table class="table student-data-table m-t-20">
                                            <thead>
                                                <tr>
                                                    <th>Действие</th>
                                                    <th class='displayNone numOr'>Номер заказа</th>
                                                    <th>Товар</th>
                                                    <th>Код</th>
                                                    <th>Группа товаров</th>
                                                    <th>Артикул</th>
                                                    <th>Единица измерения</th>
                                                    <th>Количество</th>
                                                    <th>Цена</th>
                                                    <th>Сумма</th>
                                                    <th class="displayNone">Заказной материал</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $range = "Товар!A" . $_COOKIE['stringsProduct'] . ":K";
                                            $range2 = "Товар!L1";
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
                                                    echo "<td class='displayNone numOr'>" . $row[0] . "</td>";
                                                    echo "<td>" . $row[1] . "</td>";
                                                    echo "<td>" . $row[2] . "</td>";
                                                    echo "<td>" . $row[3] . "</td>";
                                                    echo "<td>" . $row[4] . "</td>";
                                                    echo "<td>" . $row[5] . "</td>";
                                                    echo "<td>" . $row[6] . "</td>";
                                                    echo "<td>" . $row[7] . "</td>";
                                                    echo "<td>" . $row[8] . "</td>";
                                                    echo "<td class='displayNone'>" . $row[9] . "</td>";
                                                    echo "<td class='displayNone'>" . $row[10] . "</td>";
                                                    echo "</tr>";
                                                }
                                                echo "<div class='numLin022 displayNone'>" . $values2[0][0] . "</div>";
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
                <h4>Выберите количество строк, выгружаемых с сервера. Рекомендуемое количество - 400 строк.</h4>
                <input type="text" id="range_022" value="" name="range" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary saveInquiries">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>


<?php
require "unloading/НовыйСписок.htm";
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
    <script src="assets/js/product.js<?php require "version.php"; ?>"></script>
    <!-- sweetalert -->
    <script src = "assets/js/lib/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <script src="assets/js/lib/rangeSlider/ion.rangeSlider.min.js"></script>

    <script>console.timeEnd('FirstWay')</script>
</body>
</html>