<?php
$range = "Сверка!C2:C";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
?>

<!--sidebar-->
<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <li class="label">Главное</li>
                <li class="desktopPage classPage"><a href="/index.php"><i class="ti-home"></i> Рабочий стол </a></li>
                <li class="label">Клиенты, товар и услуги</li>
                <li class="ordersPage classPage"><a href="/orders.php"><i class="ti-pencil-alt"></i> Заказы </a></li>
                <li class="repairPage classPage"><a href="/repair.php"><i class="ti-cut"></i> Ремонт </a></li>
                <li class="modelPage classPage"><a href="/model.php"><i class="ti-light-bulb"></i> Модели </a></li>
                <li class="servicePage classPage"><a href="/services.php"><i class="ti-ruler-pencil"></i> Услуги </a></li>
                <li class="productPage classPage"><a href="/product.php"><i class="ti-shopping-cart"></i> Товар </a></li>
                <li class="summaryPage classPage"><a href="/order-summary.php"><i class="ti-write"></i> Сводка </a></li>
                <li class="receiptPage classPage"><a href="/receipt.php"><i class="ti-receipt"></i> Квитанции </a></li>
                <li class="clientsPage classPage"><a href="/clients.php"><i class="ti-id-badge"></i> Клиенты </a></li>

                <li class="label">Управленческий учет</li>
                <li class="operationPage classPage"><a href="/operations.php"><i class="ti-money"></i> Операции </a></li>
                <li class="contractorsPage classPage"><a href="/counterparties.php"><i class="ti-stamp"></i> Контрагенты </a></li>
                <li class="staffPage classPage"><a href="/employee-card.php"><i class="ti-user"></i> Сотрудники </a></li>
                <li class="depreciationPage classPage"><a href="/depreciation.php"><i class="ti-briefcase"></i> Амортизация </a></li>
                <li class="reportsPage classPage"><a class="sidebar-sub-toggle"><i class="ti-bar-chart"></i>Отчеты <span class="badge badge-primary">5</span><span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="/pnl.php">Прибыли и убытки</a></li>
                        <li><a href="/cashflow.php">Движение средств</a></li>
                        <li><a href="/balance.php">Балансовый отчет</a></li>
                        <li><a href="/debts.php">Отчет о задолженности</a></li>
                        <li><a href="/dividends.php">Отчет по дивидендам</a></li>
                    </ul>
                </li>
				<li class="comparisonPage classPage"><a class="sidebar-sub-toggle"><i class="ti-stats-up"></i>Аналитика <span class="badge badge-primary">1</span><span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="/comparison.php">Сравнение периодов</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<!--header-->
<div class="header">
    <div class="pull-left">
        <div class="logo"><a href="index.php"><!-- <img src="assets/images/logo.png" alt="" /> --><span>Дизайн студия Текстиль</span></a></div>
        <div class="hamburger sidebar-toggle">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
    </div>
    <div class="pull-right p-r-15">
        <ul>
        <li class="header-icon dib"><i class="ti-email"></i>
                <div class="drop-down">
                    <div class="dropdown-content-heading">
                        <span class="text-left notification">У вас нет новых сообщений</span>
                        <a href="#"><i class="ti-pencil-alt pull-right"></i></a>
                    </div>
                    <div class="dropdown-content-body">
                        <ul>
                            <li class="displayNone">
                                <a href="#">
                                    <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/1.jpg" alt="" />
                                    <div class="notification-content">
                                        <small class="notification-timestamp pull-right reconciliationRetail"><?php echo $values[0][0] ?></small>
                                        <div class="notification-heading">Администратор</div>
                                        <div class="notification-text">Сверка по розничным продажам не сходится!</div>
                                    </div>
                                </a>
                            </li>
                            <li class="displayNone">
                                <a href="#">
                                    <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/1.jpg" alt="" />
                                    <div class="notification-content">
                                        <small class="notification-timestamp pull-right reconciliationPrepayment"><?php echo $values[2][0] ?></small>
                                        <div class="notification-heading">Администратор</div>
                                        <div class="notification-text">Сверка по предоплатам не сходится!</div>
                                    </div>
                                </a>
                            </li>
                            <li class="displayNone">
                                <a href="#">
                                    <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/1.jpg" alt="" />
                                    <div class="notification-content">
                                        <small class="notification-timestamp pull-right reconciliationSurcharges"><?php echo $values[4][0] ?></small>
                                        <div class="notification-heading">Администратор</div>
                                        <div class="notification-text">Сверка по доплатам не сходится!</div>
                                    </div>
                                </a>
                            </li>
                            <li class="displayNone">
                                <a href="#">
                                    <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/2.jpg" alt="" />
                                    <div class="notification-content">
                                        <small class="notification-timestamp pull-right reconciliationGoods"><?php echo $values[6][0] ?></small>
                                        <div class="notification-heading">Администратор</div>
                                        <div class="notification-text">Остатки товаров не сходятся с 1С!</div>
                                    </div>
                                </a>
                            </li>
                            <li class="displayNone">
                                <a href="#">
                                    <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/2.jpg" alt="" />
                                    <div class="notification-content">
                                        <small class="notification-timestamp pull-right reconciliationRepair"><?php echo $values[8][0] ?></small>
                                        <div class="notification-heading">Администратор</div>
                                        <div class="notification-text">Сверка по ремонту не сходится!</div>
                                    </div>
                                </a>
                            </li>
                            <li class="text-center">
                                <a href="#" class="more-link">Смотреть все</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="header-icon dib"><img class="avatar-img" src="assets/images/avatar/1.jpg" alt="" /> <span class="user-avatar"> Администратор <i class="ti-angle-down f-s-10"></i></span>
                <div class="drop-down dropdown-profile">
                    <div class="dropdown-content-body">
                        <ul>
                            <li><a href="/unloading.php"><i class="ti-import"></i> <span>Выгрузка</span></a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>