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
    <title>Карточка сотрудника</title>
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
    <link href="assets/css/lib/calendar2/semantic.ui.min.css" rel="stylesheet">
    <link href="assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
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
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Сотрудники</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="/index.php">Главное</a></li>
                                    <li class="active">Карточка сотрудника</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <!-- /# row -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card alert">
                                <div class="card-header">
                                    <h4>Информация о сотруднике</h4>
                                </div>
                                <div class="card-body">
                                    <div class="user-profile m-t-15">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="user-photo m-b-10">
                                                    <img class="img-responsive" src="assets/images/user-profile.jpg" alt="" />
                                                </div>
                                                <div class="useful-icon">
                                                    <span><a data-toggle="modal" data-target="#exampleModal" class="changeEmployee" href=""><i class="ti-pencil-alt"></i></a> </span>
                                                    <span><a href=""><i class="ti-printer"></i></a></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                        <?php
                                                        $range = "Ajax запросы!A29:W29";
                                                        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                                                        $values = $response->getValues();
                                                        if (empty($values)) {
                                                            print "Данные не найдены.\n";
                                                        } else {
                                                            $mask = "%10s %-10s %s\n";
                                                            echo "<div class='user-profile-name'>" . $values[0][0] . "</div>";
                                                            echo "<div class='custom-tab user-profile-tab'>";
                                                                echo "<ul class='nav nav-tabs' role='tablist'>";
                                                                    echo "<li role='presentation' class='active'><a href='#1' aria-controls='1' role='tab' data-toggle='tab'>Информация</a></li>";
                                                                    echo "<li role='presentation' class=''><a href='#2' aria-controls='1' role='tab' data-toggle='tab'>Зарплата</a></li>";
                                                                echo "</ul>";

                                                                echo "<div class='tab-content'>";
                                                                    echo "<div role='tabpanel' class='tab-pane active' id='1'>";
                                                                        echo "<div class='contact-information'>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Фамилия:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][1] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Имя:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][2] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Отчество:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][3] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Должность:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][4] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Дата приема:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][6] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Статус:</span>";
                                                                                if ($values[0][7] === "Работает")
                                                                                    echo "<span class='contact-website badge badge-success'>" . $values[0][7] . "</span>";
                                                                                else
                                                                                    echo "<span class='contact-website badge badge-danger'>" . $values[0][7] . "</span>";

                                                                            echo "</div>";
                                                                        echo "</div>";
                                                                    echo "</div>";
                                                                    echo "<div role='tabpanel' class='tab-pane' id='2'>";
                                                                        echo "<div class='contact-information'>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Текущий баланс:</span>";
                                                                                if (stristr($values[0][9], '-') === false)
                                                                                echo "<span class='contact-website color-success'>" . $values[0][9] . "</span>";
                                                                                else
                                                                                echo "<span class='contact-website color-danger'>" . $values[0][9] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Получено:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][10] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Заработанно:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][11] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Заказы:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][12] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Розница:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][13] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Модели:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][14] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Оформление:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][15] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Установка:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][16] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Пошив:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][17] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Оклад:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][18] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Бонус:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][19] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Премия:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][20] . "</span>";
                                                                            echo "</div>";
                                                                            echo "<div class='website-content'>";
                                                                                echo "<span class='contact-title'>Штраф:</span>";
                                                                                echo "<span class='contact-website'>" . $values[0][21] . "</span>";
                                                                            echo "</div>";
                                                                        echo "</div>";
                                                                    echo "</div>";
                                                                echo "</div>";
                                                            echo "</div>";

                                                        }
                                                        ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-header-right-icon">
                                        <ul>
                                            <li class="card-option drop-menu"><i class="ti-harddrives" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                                <ul class="card-option-dropdown dropdown-menu ulStatus">
                                                    <li class="works"><a href="#"><i></i>Работает</a></li>
                                                    <li class="fired"><a href="#"><i></i>Уволен</a></li>
                                                    <li class="all"><a href="#"><i></i>Все сотрудники</a></li>
                                                </ul>
                                            </li>
                                    </div>
                                    <h4>Все сотрудники </h4>
                                    <a href="#" class="addEmployee"><button type="button" class="btn btn-primary m-b-10 m-l-5" data-toggle="modal" data-target="#exampleModal">Добавить сотрудника</button></a>
                                </div>
                                <div class="recent-comment m-t-15 allEmployees">
                                    <?php
                                    $range = "SQL запросы!AN1:AP";
                                    $range2 = "Переменные SQL!M3:Q3";
                                    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                                    $response2 = $service->spreadsheets_values->get($spreadsheetId, $range2);
                                    $values = $response->getValues();
                                    $values2 = $response2->getValues();
                                    if (empty($values)) {
                                        print "Данные не найдены.\n";
                                    } else {
                                        $mask = "%10s %-10s %s\n";
                                        foreach ($values as $row) {
                                            echo "<div class='media employeeSelection'>";
                                                echo "<div class='media-left'>";
                                                    echo "<a href='#'><img class='media-object' src='assets/images/avatar/1.jpg' alt='...'></a>";
                                                echo "</div>";
                                                echo "<div class='media-body'>";
                                                    echo "<h4 class='media-heading color-primary'>". $row[0] ."</h4>";
                                                    echo "<p><span>" . $row[2] . "</span>: " . $row[1] ."</p>";
                                                echo "</div>";
                                            echo "</div>";
                                        }
                                    }
                                    echo "<div class='displayNone activeStatus'>". $values2[0][0] ."</div>";
                                    echo "<div class='displayNone activeStatus2'>". $values2[0][4] ."</div>";
                                    ?>

                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                        <!-- /# column -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header pr">
                                    <h4>Отчет по зарплате</h4>
                                    <div class="search-action">
                                        <a href="#" class="addRowEmployee"><button type="button" class="btn btn-primary m-b-10 m-l-5" data-toggle="modal" data-target="#addNote">Добавить запись</button></a>
                                        <div class="search-type dib">                                      
                                            <input class="form-control input-rounded description" placeholder="Поиск по описанию..." type="text">
                                        </div>
                                    </div>
                                    <div class="card-header-right-icon rightIcon">
                                        <ul>
                                            <li class="card-close"><i class="ti-close"></i></li>
                                            <li class="card-option drop-menu"><i class="ti-time" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                                <ul class="card-option-dropdown dropdown-menu ulPeriod">
                                                    <li class="liCurrentMonth"><a href="#"><i></i>Текущий месяц</a></li>
                                                    <li class="liCurrentQuarter"><a href="#"><i></i>Текущий квартал</a></li>
                                                    <li class="liThisYear"><a href="#"><i></i>Текущий год</a></li>
                                                    <li class="liLastMonth"><a href="#"><i></i>Прошлый месяц</a></li>
                                                    <li class="liLastQuarter"><a href="#"><i></i>Прошлый квартал</a></li>
                                                    <li class="liLastYear"><a href="#"><i></i>Прошлый год</a></li>
                                                    <li class="allTime"><a href="#"><i></i>Все время</a></li>
                                                    <li class="liArbitrarily"><a href="#" data-toggle="modal" data-target="#myModal"><i></i> Произвольный период</a></li>
                                                </ul>
                                            </li>
                                            <li class="card-option drop-menu"><i class="ti-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                                <ul class="card-option-dropdown dropdown-menu ulKindWork">
                                                    <li><a href="#">Заказы</a></li>
                                                    <li><a href="#">Розница</a></li>
                                                    <li><a href="#">Модели</a></li>
                                                    <li><a href="#">Оформление окон</a></li>
                                                    <li><a href="#">Установка карниза</a></li>
                                                    <li><a href="#">Пошив</a></li>
                                                    <li><a href="#">Раскрой изделия</a></li>
                                                    <li><a href="#">Оклад</a></li>
                                                    <li><a href="#">Бонус</a></li>
                                                    <li><a href="#">Премия</a></li>
                                                    <li><a href="#">Штраф</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>                      
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive tableOrders">
                                        <table class="table student-data-table m-t-20 table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Действие</th>
                                                    <th class='displayNone'>Номер</th>
                                                    <th>Дата</th>
                                                    <th>Сумма</th>
                                                    <th>Категория</th>
                                                    <th>Описание</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $range = "SQL запросы!AQ1:AV";
                                            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                                            $values = $response->getValues();
                                            if (empty($values)) {
                                                print "Данные не найдены.\n";
                                            } else {
                                                $mask = "%10s %-10s %s\n";
                                                foreach ($values as $row) {
                                                    echo "<tr>";
                                                    echo "<td>" . '<span><a href="#"><i class="ti-pencil-alt color-success orderChange"></i></a></span> <span><a href="#"><i class="ti-trash color-danger orderDelete"></i> </a></span>' . "</td>";
                                                    echo "<td class='displayNone'>" . $row[0] . "</td>";
                                                    echo "<td>" . $row[1] . "</td>";
                                                    echo "<td>" . $row[2] . "</td>";
                                                    echo "<td>" . $row[3] . "</td>";
                                                    echo "<td>" . $row[4] . ' ' . $row[5] . "</td>";
                                                    echo "</tr>";
                                                }

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



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="ordersRequest.php">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить сотрудника</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="employeeSurname" class="col-form-label">Фамилия:</label>
                        <input type="text" class="form-control" id="employeeSurname" autocomplete="off" name="employeeSurname" required>
                    </div>
                    <div class="form-group">
                        <label for="employeeName" class="col-form-label">Имя:</label>
                        <input type="text" class="form-control" id="employeeName" autocomplete="off" name="employeeName" required>
                    </div>
                    <div class="form-group">
                        <label for="employeePatronymic" class="col-form-label">Отчество:</label>
                        <input type="text" class="form-control" id="employeePatronymic" autocomplete="off" name="employeePatronymic" required>
                    </div>
                    <div class="form-group">
                        <label for="position" class="col-form-label">Должность:</label>
                        <input type="text" class="form-control" id="position" autocomplete="off" name="position" required>
                    </div>
                    <div class="form-group">
                        <label for="activity" class="col-form-label">Сфера деятельности:</label>
                        <input type="text" class="form-control" id="activity" autocomplete="off" name="activity" required>
                    </div>
                    <div class="form-group status displayNone">
                        <label for="employeeStatus" class="col-form-label">Статус работника:</label>
                        <select class="form-control bg-ash border-none" id="employeeStatus" name="employeeStatus" required>
                            <option>Работает</option>
                            <option>Уволен</option>
                        </select>
                    </div>
                    <div class="form-group displayNone">
                        <label for="condition" class="col-form-label">Статус операции:</label>
                        <select class="form-control bg-ash border-none" id="condition" name="condition" required>
                            <option>Добавить</option>
                            <option>Обновить</option>
                        </select>
                    </div>
                    <div class="form-group image-type">
                        <label>Загрузите фото сотрудника <span>(150 X 150)</span></label>
                        <input type="file" name="pic" accept="image/*">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="ordersRequest.php">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить запись</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="displayNone" id="numOrders" name="numOrders">
                <div class="form-group">
                    <label for="text-calendar" class="col-form-label">Дата:</label>
                    <input type="text" class="form-control calendar bg-ash employeeDate" placeholder="Выберите дату" id="text-calendar" name="employeeDate" required>             
                </div>
                <div class="form-group">
                    <label for="selectEmployee" class="col-form-label">Сотрудник:</label>
                    <select class="form-control bg-ash border-none" id="selectEmployee" name="selectEmployee" required>
                    </select>
                </div>
                <div class="form-group">
                      <label for="typeService" class="col-form-label">Категория:</label>
                      <select class="form-control bg-ash border-none" id="typeService" name="typeService" required>
                        <option selected disabled></option>
                        <option>Розница</option>
                        <option>Модели</option>
                        <option>Оклад</option>
                        <option>Бонус</option>
                        <option>Премия</option>
                        <option>Штраф</option>
                    </select>
                </div>
                <div class="form-group">
                       <label for="sumEmployee" class="col-form-label">Сумма:</label>
                       <input type="text" class="form-control" id="sumEmployee" autocomplete="off" name="sumEmployee" required>
                </div>
                <div class="form-group">
                     <label for="employeeDescription" class="col-form-label">Описание:</label>
                       <input type="text" class="form-control" id="employeeDescription" autocomplete="off" name="employeeDescription">
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-primary send">Добавить</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content modalDate">
            <div class="modal-header">
                <h4 class="modal-title">Выберите интервал</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="basic-form">
                            <div class="form-group">
                                <label>С какой даты</label>
                                <input type="text" class="form-control calendar bg-ash firstDate" placeholder="Выберите дату" id="text-calendar">
                                <span class="ti-calendar form-control-feedback booking-system-feedback m-t-30"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="basic-form">
                            <div class="form-group">
                                <label>По какую дату</label>
                                <input type="text" class="form-control calendar bg-ash secondDate" placeholder="Выберите дату" id="text-calendar">
                                <span class="ti-calendar form-control-feedback booking-system-feedback m-t-30"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default buttonClose" data-dismiss="modal">Закрыть</button>
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
    <!-- <script src="assets/js/lib/calendar-2/semantic.ui.min.js"></script> -->
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/prism.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/pignose.init.js"></script>
    <!-- scripit init-->
    <script src ="assets/js/lib/sweetalert2/dist/sweetalert2.all.min.js"></script>


    <script src="assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
<!--    <script src="assets/js/lib/weather/weather-init.js"></script>-->
    <script src="assets/js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress-init.js"></script>
<!--    <script src="assets/js/lib/chartist/chartist.min.js"></script>-->
<!--    <script src="assets/js/lib/chartist/chartist-init.js"></script>-->
    <script src="assets/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="assets/js/lib/sparklinechart/sparkline.init.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <script src="assets/js/scripts.js"></script>

    <script src="assets/js/employee-card.js<?php require "version.php"; ?>"></script>
    <!-- scripit init-->
</body>

</html>