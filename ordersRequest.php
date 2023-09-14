<?php

require "sheets.php";

if (isset($_POST['orderNumber'])) {
    $orderNumber = $_POST['orderNumber'];
    $orderDate = $_POST['orderDate'];
    $surname = $_POST['surname'];
    $dateOfReadiness = $_POST['dateOfReadiness'];
    $name = $_POST['name'];
    $orderPrice = str_replace('&nbsp;',  '', htmlentities($_POST['orderPrice']));
    $patronymic = preg_replace('/\s+/', ' ', $_POST['patronymic']);
    $prepayment = str_replace('&nbsp;', '', htmlentities($_POST['prepayment']));
    $phoneNumber = str_replace(['(', ')', '+', '-'], ['', '', '', ''], $_POST['phoneNumber']);
    $paymentState = $_POST['paymentState'];
    $designer = $_POST['designer'];
    $orderStatus = $_POST['orderStatus'];
    $designerPercentage = $orderPrice * (str_replace([',', '%'], ['.', ''], $_POST['designerPercentage']) / 100);
    $prepaymentDate = $_POST['prepaymentDate'];
    $secondPrepayment = str_replace('&nbsp;', '', htmlentities($_POST['secondPrepayment']));
    $dateSecondPrepayment = $_POST['dateSecondPrepayment'];
    $thirdPrepayment = str_replace('&nbsp;', '', htmlentities($_POST['thirdPrepayment']));
    $dateThirdPrepayment = $_POST['dateThirdPrepayment'];
    $returnDate = $_POST['returnDate'];
    $deadline = $_POST['deadline'];
    $paymentDate = $_POST['paymentDate'];
    $fourthPrepayment = str_replace('&nbsp;', '', htmlentities($_POST['fourthPrepayment']));
    $fifthPrepayment = str_replace('&nbsp;', '', htmlentities($_POST['fifthPrepayment']));
    $dateFourthPrepayment = $_POST['dateFourthPrepayment'];
    $dateFifthPrepayment = $_POST['dateFifthPrepayment'];
    $orderTime = date("Y-m-d H:i:s");

    // Добавить заказ
    if (empty($_POST['numOrders'])) {
        $range = "Заказы";
        $values = [
            [$orderNumber, $orderDate, $surname, $name, $patronymic, $phoneNumber, "", "", "", "", $orderPrice, "", "", $designer, $orderStatus, $paymentState, $prepayment, $prepaymentDate, $secondPrepayment, $dateSecondPrepayment, $thirdPrepayment, $dateThirdPrepayment, $fourthPrepayment, $dateFourthPrepayment, $fifthPrepayment, $dateFifthPrepayment, $designerPercentage, $dateOfReadiness, $paymentDate, $returnDate, $deadline, $orderTime]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );

        $range = "Товар";
        $values = [
            [$orderNumber, "Фурнитура", "", "Другое", "", "шт.", "1", "70", "70", ""]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'

        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );
        header("Location: edit-orders.php");
        // Обновить заказ
    } else {
            $range = "Заказы!A$_COOKIE[row]:AH$_COOKIE[row]";
            $values = [
                [$orderNumber, $orderDate, $surname, $name, $patronymic, $phoneNumber, "", "", "", "", $orderPrice, "", "", $designer, $orderStatus, $paymentState, $prepayment, $prepaymentDate, $secondPrepayment, $dateSecondPrepayment, $thirdPrepayment, $dateThirdPrepayment, $fourthPrepayment, $dateFourthPrepayment, $fifthPrepayment, $dateFifthPrepayment, $designerPercentage, $dateOfReadiness, $paymentDate, $returnDate, $deadline, $orderTime]
            ];
            $body = new Google_Service_Sheets_ValueRange([
                'values' => $values
            ]);
            $params = [
                'valueInputOption' => 'USER_ENTERED'
            ];
            $result = $service->spreadsheets_values->update(
                $spreadsheetId,
                $range,
                $body,
                $params
            );
        header("Location: orders.php");
    }
}

// Получить заказы
if(isset($_POST['numOrdersAj']) || $_POST['delNum']) {
    if(isset($_POST['numOrdersAj'])) {
        $numVal = $_POST['numOrdersAj'];
    } else {
        $numVal = $_POST['delNum'];
    }
    $range = "Ajax запросы!A2";
    $values = [
        [$numVal]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
    $range = "Ajax запросы!A2:Z2";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    if (empty($values)) {
        print "Данные не найдены.\n";
    } else {
        $mask = "%10s %-10s %s\n";
        setcookie("row", $values[0][25], time() + 3600 * 24);
        $_COOKIE['row'] = $values[0][25];
        foreach ($values as $row) {
            echo json_encode($row);
        }
    }
}

// Удалить заказы
if($_POST['delNum']) {
    $rowtodelete = $_COOKIE['row'] - 1;
    $batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
        'requests' => array(
            'deleteDimension' => array(
                'range' => array(
                    'sheetId' => 0,
                    'dimension' => "ROWS",
                    'startIndex' => $rowtodelete,
                    'endIndex' => $rowtodelete + 1
                )
            )
        )
    ));

    $result = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
}

if (isset($_POST['orderNumberServices'])) {
	
	if (($_POST['serviceProviderInput'] === "Першукова О.П." || $_POST['serviceProviderInput'] === "Исмаилов И.Н.") && $_POST['percentageOfServiceInput'] !== "0,00%") {
		$_POST['percentageOfServiceInput'] = "0,00%";
	}
	
    $orderNumberServices = $_POST['orderNumberServices'];
    $typeOfServiceInput = $_POST['typeOfServiceInput'];
    $serviceProviderInput = $_POST['serviceProviderInput'];
    $serviceAmount2 = str_replace('&nbsp;',  '', htmlentities($_POST['serviceAmount2']));
    $percentageOfServiceInput = ($_POST['percentageOfServiceInput'] !== null ? (str_replace([',', '%'], ['.', ''], $_POST['percentageOfServiceInput']) / 100) * $serviceAmount2 : $_POST['percentageOfServiceInput']);
    $serviceDescription2 = $_POST['serviceDescription2'];
// Добавить услуги
    if (empty($_POST['numServices'])) {
        $range = "Услуги";
        $values = [
            [$orderNumberServices, $typeOfServiceInput, $serviceDescription2, $serviceAmount2, $serviceProviderInput, $percentageOfServiceInput]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );
        header("Location: services.php");
        // Обновить услугу
} else {
        $range = "Услуги!A$_COOKIE[row]:F$_COOKIE[row]";
        $values = [
            [$orderNumberServices, $typeOfServiceInput, $serviceDescription2, $serviceAmount2, $serviceProviderInput, $percentageOfServiceInput]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $result = $service->spreadsheets_values->update(
            $spreadsheetId,
            $range,
            $body,
            $params
        );
        header("Location: services.php");
    }
}

// Получить услуги
if(isset($_POST['numServicesAj']) || $_POST['delSer']) {
    if(isset($_POST['numServicesAj'])) {
        $numVal = $_POST['numServicesAj'];
    } else {
        $numVal = $_POST['delSer'];
    }
    $range = "Ajax запросы!A5";
    $values = [
        [$numVal]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
    $range = "Ajax запросы!A5:G5";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    if (empty($values)) {
        print "Данные не найдены.\n";
    } else {
        $mask = "%10s %-10s %s\n";
        setcookie("row", $values[0][0], time() + 3600 * 24);
        $_COOKIE['row'] = $values[0][0];
        foreach ($values as $row) {
            echo json_encode($row);
        }
    }
}

// Удалить услуги
if($_POST['delSer']) {
    $rowtodelete = $_COOKIE['row'] - 1;
    $batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
        'requests' => array(
            'deleteDimension' => array(
                'range' => array(
                    'sheetId' => 540177108,
                    'dimension' => "ROWS",
                    'startIndex' => $rowtodelete,
                    'endIndex' => $rowtodelete + 1
                )
            )
        )
    ));

    $result = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
}

if (isset($_POST['orderNumberProduct'])) {
    $orderNumberProduct = $_POST['orderNumberProduct'];
    $pannierCode2 = $_POST['pannierCode2'];
    $pannierProduct2 = $_POST['pannierProduct2'];
    $pannierProductGroup2 = $_POST['pannierProductGroup2'];
    $pannierVendorCode2 = $_POST['pannierVendorCode2'];
    $pannierQuantity2 = $_POST['pannierQuantity2'];
    $pannierUnitInput = $_POST['pannierUnitInput'];
    $pannierPrice2 = str_replace('&nbsp;',  '', htmlentities($_POST['pannierPrice2']));
    $pannierSum2 = str_replace('&nbsp;',  '', htmlentities($_POST['pannierSum2']));
    $pannierCheckbox1 = $_POST['pannierCheckbox1'] === "Да" ? $_POST['pannierCheckbox1'] : "";
// Добавить товар
    if (empty($_POST['numProduct'])) {
        $range = "Товар";
        $values = [
            [$orderNumberProduct, $pannierProduct2, $pannierCode2, $pannierProductGroup2, $pannierVendorCode2, $pannierUnitInput, $pannierQuantity2, $pannierPrice2, $pannierSum2, $pannierCheckbox1]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'

        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );
        header("Location: product.php");
        // Обновить товар
    } else {
        $range = "Товар!A$_COOKIE[row]:J$_COOKIE[row]";
        $values = [
            [$orderNumberProduct, $pannierProduct2, $pannierCode2, $pannierProductGroup2, $pannierVendorCode2, $pannierUnitInput, $pannierQuantity2, $pannierPrice2, $pannierSum2, $pannierCheckbox1]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $result = $service->spreadsheets_values->update(
            $spreadsheetId,
            $range,
            $body,
            $params
        );
        header("Location: product.php");
    }
}

// Получить товар
if(isset($_POST['numProductAj']) || $_POST['delProd']) {
    if(isset($_POST['numProductAj'])) {
        $numVal = $_POST['numProductAj'];
    } else {
        $numVal = $_POST['delProd'];
    }
    $range = "Ajax запросы!A8";
    $values = [
        [$numVal]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
    $range = "Ajax запросы!A8:K8";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    if (empty($values)) {
        print "Данные не найдены.\n";
    } else {
        $mask = "%10s %-10s %s\n";
        setcookie("row", $values[0][0], time() + 3600 * 24);
        $_COOKIE['row'] = $values[0][0];
        foreach ($values as $row) {
            echo json_encode($row);
        }
    }
}

// Удалить товар
if($_POST['delProd']) {
    $rowtodelete = $_COOKIE['row'] - 1;
    $batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
        'requests' => array(
            'deleteDimension' => array(
                'range' => array(
                    'sheetId' => 1025958790,
                    'dimension' => "ROWS",
                    'startIndex' => $rowtodelete,
                    'endIndex' => $rowtodelete + 1
                )
            )
        )
    ));

    $result = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
}

// Получить заказ для сводки

if(isset($_POST['ordNumSumAj'])) {
    $numVal = $_POST['ordNumSumAj'];
    $range = "Ajax запросы!A14:B14";
    $values = [
        [$numVal, $numVal]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
    if (strlen($numVal) === 9) {
        $range = "Ajax запросы!C14:P14";
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();
        if (empty($values)) {
            print "Данные не найдены.\n";
        } else {
            $mask = "%10s %-10s %s\n";
            setcookie("row", $values[0][13], time() + 3600 * 24);
            $_COOKIE['row'] = $values[0][13];
            foreach ($values as $row) {
                echo json_encode($row);
            }
        }
    } else {
        $range = "Ajax запросы!A20:N20";
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();
        if (empty($values)) {
            print "Данные не найдены.\n";
        } else {
            $mask = "%10s %-10s %s\n";
            setcookie("row", $values[0][13], time() + 3600 * 24);
            $_COOKIE['row'] = $values[0][13];
            foreach ($values as $row) {
                echo json_encode($row);
            }
        }
    }

}

// Обновить себестоимость в сводке

if(isset($_POST['costPrice'])) {
    $costPrice = $_POST['costPrice'];
    $range = "Заказы!AG$_COOKIE[row]";
    $values = [
        [$costPrice]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
}

if(isset($_POST['costPrice2'])) {
    $costPrice = $_POST['costPrice2'];
    $range = "Модели!I$_COOKIE[row]";
    $values = [
        [$costPrice]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
}

// Получить данные для квитанции

if(isset($_POST['numberReceipt'])) {
    $numVal = $_POST['numberReceipt'];
    $range = "Квитанции!A2";
    $values = [
        [$numVal]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
    $range = "Квитанции!A2:P2";
    $range2 = "Квитанции!R1:U";
    $range3 = "Квитанции!W1:AD";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $response2 = $service->spreadsheets_values->get($spreadsheetId, $range2);
    $response3 = $service->spreadsheets_values->get($spreadsheetId, $range3);
    $values = $response->getValues();
    $values2 = $response2->getValues();
    $values3 = $response3->getValues();
    if (empty($values)) {
        print "Данные не найдены.\n";
    } else {
        $mask = "%10s %-10s %s\n";
        $arr = [];
        foreach ($values as $row) {
            array_push($arr, $row);
        }
        array_push($arr, $values2);
        array_push($arr, $values3);
       echo json_encode($arr);
    }
}

// Получить данные для квитанции (ремонт)

if(isset($_POST['numberReceiptRepair'])) {
    $numVal = $_POST['numberReceiptRepair'];
    $range = "Квитанции!A5";
    $values = [
        [$numVal]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
    $range = "Квитанции!A5:L5";
    $range2 = "Квитанции!AF1:AI";
    $range3 = "Квитанции!AK1:AR";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $response2 = $service->spreadsheets_values->get($spreadsheetId, $range2);
    $response3 = $service->spreadsheets_values->get($spreadsheetId, $range3);
    $values = $response->getValues();
    $values2 = $response2->getValues();
    $values3 = $response3->getValues();
    if (empty($values)) {
        print "Данные не найдены.\n";
    } else {
        $mask = "%10s %-10s %s\n";
        $arr = [];
        foreach ($values as $row) {
            array_push($arr, $row);
        }
        array_push($arr, $values2);
        array_push($arr, $values3);
       echo json_encode($arr);
    }
}

if (isset($_POST['modelName'])) {
    $modelName = $_POST['modelName'];
    $manufacturingDate = $_POST['manufacturingDate'];
    $designerModel = $_POST['designerModel'];
    $modelCost = str_replace('&nbsp;',  '', htmlentities($_POST['modelCost']));
    $designerPercentageModel = $modelCost * (str_replace([',', '%'], ['.', ''], $_POST['designerPercentageModel']) / 100);
    $orderTime = date("Y-m-d H:i:s");

    // Добавить модель
    if (empty($_POST['numOrders'])) {
        $range = "Модели";
        $values = [
            ["", $manufacturingDate, $modelName, $designerModel, "", $modelCost, $designerPercentageModel, $orderTime]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );
        header("Location: edit-model.php");
        // Обновить модель
    } else {
        $range = "Модели!A$_COOKIE[row]:AH$_COOKIE[row]";
        $values = [
            ["", $manufacturingDate, $modelName, $designerModel, "", $modelCost, $designerPercentageModel, $orderTime]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $result = $service->spreadsheets_values->update(
            $spreadsheetId,
            $range,
            $body,
            $params
        );
        header("Location: model.php");
    }
}


// Получить модель
if(isset($_POST['numModelAj']) || $_POST['delModel']) {
    if(isset($_POST['numModelAj'])) {
        $numVal = $_POST['numModelAj'];
    } else {
        $numVal = $_POST['delModel'];
    }
    $range = "Ajax запросы!A17";
    $values = [
        [$numVal]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
    $range = "Ajax запросы!A17:F17";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    if (empty($values)) {
        print "Данные не найдены.\n";
    } else {
        $mask = "%10s %-10s %s\n";
        setcookie("row", $values[0][0], time() + 3600 * 24);
        $_COOKIE['row'] = $values[0][0];
        foreach ($values as $row) {
            echo json_encode($row);
        }
    }
}

// Удалить модель
if($_POST['delModel']) {
    $rowtodelete = $_COOKIE['row'] - 1;
    $batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
        'requests' => array(
            'deleteDimension' => array(
                'range' => array(
                    'sheetId' => 2145198741,
                    'dimension' => "ROWS",
                    'startIndex' => $rowtodelete,
                    'endIndex' => $rowtodelete + 1
                )
            )
        )
    ));

    $result = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
}


// Вывод клиентов
if (isset($_POST['firstDateClients']) && isset($_POST['secondDateClients']) && isset($_POST['designerClients'])) {

    $firstDateClients = $_POST['firstDateClients'];
    $secondDateClients = $_POST['secondDateClients'];
    $designerClients = $_POST['designerClients'];
    if ($designerClients === "Все дизайнеры") {
        $formula = "=QUERY('Клиенты'!A2:J;\"select * Where (J>=\"&'Переменные SQL'!A3&\" And J<\"&'Переменные SQL'!B3&\") Order by A desc\")";
    } else {
        $formula = "=QUERY('Клиенты'!A2:J;\"select * Where (J>=\"&'Переменные SQL'!A3&\" And J<\"&'Переменные SQL'!B3&\" And I='\"&'Переменные SQL'!C3& \"') Order by A desc\")";
    }

    $range = "SQL запросы!E1";
    $values = [
        [$formula]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );

    $range = "Переменные SQL!A3:C3";
    $values = [
        [$firstDateClients, $secondDateClients, $designerClients]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
}

if (isset($_POST['customerDescription']) || isset($_POST['numberClients'])) {
    $customerDescription = $_POST['customerDescription'];
    $category = $_POST['category'];
    $categoryDescription = $_POST['categoryDescription'];
    $designerClients = $_POST['designerClients'];
    $whatDone = $_POST['whatDone'];
    $customerName = $_POST['customerName'];
    $customerPhone = str_replace(['(', ')', '+', '-'], ['', '', '', ''], $_POST['customerPhone']);
    $repeatedCheckbox = $_POST['repeatedCheckbox'] === "Да" ? $_POST['repeatedCheckbox'] : "";
    $orderTime = date("Y-m-d H:i:s");
    $numberClients = $_POST['numberClients'];

    // Добавить клиента
    if (empty($_POST['numOrders']) && empty($numberClients)) {
        $range = "Клиенты";
        $values = [
            ["", $customerName, $customerPhone, $repeatedCheckbox, $customerDescription, $category, $categoryDescription, $whatDone, $designerClients, $orderTime]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );
        header("Location: edit-clients.php");
        // Обновить клиента
    }
    else {
        if (empty($numberClients)) {
            $range = "Клиенты!B$_COOKIE[row]:I$_COOKIE[row]";
            $values = [
                [$customerName, $customerPhone, $repeatedCheckbox, $customerDescription, $category, $categoryDescription, $whatDone, $designerClients]
            ];
        } else {
            $range = "Клиенты!K$numberClients";
            $values = [
                ["Да"]
            ];
        }

        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $result = $service->spreadsheets_values->update(
            $spreadsheetId,
            $range,
            $body,
            $params
        );
        if (empty($numberClients)) header("Location: clients.php");
    }
}

// Получить клиента
if(isset($_POST['numClientsAj']) || $_POST['delClients']) {
    if(isset($_POST['numClientsAj'])) {
        $numVal = $_POST['numClientsAj'];
    } else {
        $numVal = $_POST['delClients'];
    }
    $range = "Ajax запросы!A23";
    $values = [
        [$numVal]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
    $range = "Ajax запросы!A23:I23";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    if (empty($values)) {
        print "Данные не найдены.\n";
    } else {
        $mask = "%10s %-10s %s\n";
        setcookie("row", $values[0][0], time() + 3600 * 24);
        $_COOKIE['row'] = $values[0][0];
        foreach ($values as $row) {
            echo json_encode($row);
        }
    }
}

// Удалить клиента
if($_POST['delClients']) {
    $rowtodelete = $_COOKIE['row'] - 1;
    $batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
        'requests' => array(
            'deleteDimension' => array(
                'range' => array(
                    'sheetId' => 287816090,
                    'dimension' => "ROWS",
                    'startIndex' => $rowtodelete,
                    'endIndex' => $rowtodelete + 1
                )
            )
        )
    ));

    $result = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
}

// Вывод операций
if (isset($_POST['firstDateOperations']) && isset($_POST['secondDateOperations']) && isset($_POST['itemOperations'])) {

    $firstDateOperations = $_POST['firstDateOperations'];
    $secondDateOperations = $_POST['secondDateOperations'];
    $itemOperations = $_POST['itemOperations'];
    $invoiceOperations = $_POST['invoiceOperations'];
    $typeTransactionOperations = $_POST['typeTransactionOperations'];

    if ($itemOperations === "Все статьи" && $invoiceOperations === "Все счета" && $typeTransactionOperations === "Все операции") {
        $formula = "=QUERY('Операции'!A2:H;\"select * Where (B>=\"&'Переменные SQL'!E3&\" And B<=\"&'Переменные SQL'!F3&\") Order by A desc\")";
    } else if ($itemOperations !== "Все статьи" && $invoiceOperations === "Все счета" && $typeTransactionOperations === "Все операции") {
        $formula = "=QUERY('Операции'!A2:H;\"select * Where (B>=\"&'Переменные SQL'!E3&\" And B<=\"&'Переменные SQL'!F3&\" And D='\"&'Переменные SQL'!G3& \"') Order by A desc\")";
    } else if ($itemOperations === "Все статьи" && $invoiceOperations !== "Все счета"  && $typeTransactionOperations === "Все операции") {
        $formula = "=QUERY('Операции'!A2:H;\"select * Where (B>=\"&'Переменные SQL'!E3&\" And B<=\"&'Переменные SQL'!F3&\" And G='\"&'Переменные SQL'!H3& \"') Order by A desc\")";
    } else if ($itemOperations === "Все статьи" && $invoiceOperations === "Все счета" && $typeTransactionOperations !== "Все операции") {
        $formula = "=QUERY('Операции'!A2:H;\"select * Where (B>=\"&'Переменные SQL'!E3&\" And B<=\"&'Переменные SQL'!F3&\" And H='\"&'Переменные SQL'!I3& \"') Order by A desc\")";
    } else if ($itemOperations !== "Все статьи" && $invoiceOperations !== "Все счета"  && $typeTransactionOperations === "Все операции") {
        $formula = "=QUERY('Операции'!A2:H;\"select * Where (B>=\"&'Переменные SQL'!E3&\" And B<=\"&'Переменные SQL'!F3&\" And D='\"&'Переменные SQL'!G3& \"' And G='\"&'Переменные SQL'!H3& \"') Order by A desc\")";
    } else if ($itemOperations !== "Все статьи" && $invoiceOperations === "Все счета"  && $typeTransactionOperations !== "Все операции") {
        $formula = "=QUERY('Операции'!A2:H;\"select * Where (B>=\"&'Переменные SQL'!E3&\" And B<=\"&'Переменные SQL'!F3&\" And D='\"&'Переменные SQL'!G3& \"' And H='\"&'Переменные SQL'!I3& \"') Order by A desc\")";
    } else if ($itemOperations === "Все статьи" && $invoiceOperations !== "Все счета"  && $typeTransactionOperations !== "Все операции") {
        $formula = "=QUERY('Операции'!A2:H;\"select * Where (B>=\"&'Переменные SQL'!E3&\" And B<=\"&'Переменные SQL'!F3&\" And G='\"&'Переменные SQL'!H3& \"' And H='\"&'Переменные SQL'!I3& \"') Order by A desc\")";
    } else if ($itemOperations !== "Все статьи" && $invoiceOperations !== "Все счета"  && $typeTransactionOperations !== "Все операции") {
        $formula = "=QUERY('Операции'!A2:H;\"select * Where (B>=\"&'Переменные SQL'!E3&\" And B<=\"&'Переменные SQL'!F3&\" And D='\"&'Переменные SQL'!G3& \"' And G='\"&'Переменные SQL'!H3& \"' And H='\"&'Переменные SQL'!I3& \"') Order by A desc\")";
    }

    $range = "SQL запросы!P1";
    $values = [
        [$formula]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );

    $range = "Переменные SQL!E3:I3";
    $values = [
        [$firstDateOperations, $secondDateOperations, $itemOperations, $invoiceOperations, $typeTransactionOperations]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
}

if (isset($_POST['typeTransaction'])) {
    $dateOperation = $_POST['dateOperation'];
    $typeTransaction = $_POST['typeTransaction'];
    $transactionAmount = str_replace('&nbsp;',  '', htmlentities($_POST['transactionAmount']));
    $operationArticle = $_POST['operationArticle'];
    $counterparty = $_POST['counterparty'];
    $account = $_POST['account'];
    $account2 = $_POST['account2'];
    $operationDescription = $_POST['operationDescription'];
    $commitmentCheckbox = $_POST['commitmentCheckbox'] === "Да" ? $_POST['commitmentCheckbox'] : "";
    $flexRadioDefault = ($_POST['flexRadioDefault'] === "Кредит" || $_POST['flexRadioDefault'] === "Дебет") ? $_POST['flexRadioDefault'] : "";
    
    if (!isset($_POST['counterparty2'])) 
        $counterparty = $_POST['counterparty'];
    else
        $counterparty = $_POST['counterparty2'];
        

    if (empty($account)) {
        $account = "";
    }
    if ($typeTransaction !== "Приход" && $flexRadioDefault !== "Дебет" && $operationArticle !== "Возврат по заказу" && $operationArticle !== "Оприходование" && $operationArticle !== "Оприходование при инвентаризации") {
        $transactionAmount = "-" . $transactionAmount;
    }

    function add() {
        global $dateOperation, $transactionAmount, $operationArticle, $operationDescription, $counterparty, $account, $typeTransaction, $commitmentCheckbox, $flexRadioDefault, $service, $spreadsheetId;

        $range = "Операции";
        $values = [
            ["", $dateOperation, $transactionAmount, $operationArticle, $operationDescription, $counterparty, $account, $typeTransaction, $commitmentCheckbox, $flexRadioDefault]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );
    }

    function update() {
        global $dateOperation, $transactionAmount, $operationArticle, $operationDescription, $counterparty, $account, $typeTransaction, $commitmentCheckbox, $flexRadioDefault, $service, $spreadsheetId;
        $range = "Операции!B$_COOKIE[row]:J$_COOKIE[row]";
        $values = [
            [$dateOperation, $transactionAmount, $operationArticle, $operationDescription, $counterparty, $account, $typeTransaction, $commitmentCheckbox, $flexRadioDefault]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $result = $service->spreadsheets_values->update(
            $spreadsheetId,
            $range,
            $body,
            $params
        );
    }

    // Добавить операцию
    if (empty($_POST['numOrders'])) {
        if ($typeTransaction === "Перевод") {
            $operationArticle = "";
            $counterparty = "";

            for ($i = 1; $i <= 2; $i++) {
                if ($i === 2) {
                    $transactionAmount = str_replace('-','',$transactionAmount);
                    $account = $account2;
                }
                add();
            }
            header("Location: edit-operations.php");
            return;
        } else if($operationArticle === "Розничные продажи" && $account === "Расчетный счет") {
            add();
            $typeTransaction = "Расход";
            $transactionAmount = $transactionAmount / 100 * 2.5;
            $transactionAmount = str_replace('.',',',$transactionAmount);
            $operationArticle = "Эквайринг";
            $operationDescription = "2,5%";
            $counterparty = "Сбербанк";
            $account = "Расчетный счет";
            $transactionAmount = "-" . $transactionAmount;
            add();
            header("Location: edit-operations.php");
            return;
        }
        add();
        header("Location: edit-operations.php");
        // Обновить операцию
    } else {
        if ($typeTransaction === "Перевод") {
            $operationArticle = "";
            $counterparty = "";

            for ($i = 1; $i <= 2; $i++) {
                if ($i === 2) {
                    $transactionAmount = str_replace('-','',$transactionAmount);
                    $account = $account2;
                    $_COOKIE['row'] = $_COOKIE['row'] + 1;
                }
                update();
            }
            header("Location: operations.php");
            return;
        }
        update();
        header("Location: operations.php");
    }
}

// Получить операцию
if(isset($_POST['numOperationsAj']) || $_POST['delOperations']) {
    if(isset($_POST['numOperationsAj'])) {
        $numVal = $_POST['numOperationsAj'];
    } else {
        $numVal = $_POST['delOperations'];
    }
    $range = "Ajax запросы!A26";
    $values = [
        [$numVal]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
    $range = "Ajax запросы!A26:M26";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    if (empty($values)) {
        print "Данные не найдены.\n";
    } else {
        $mask = "%10s %-10s %s\n";
        if ($values[0][12] === '#N/A') {
            setcookie("row", $values[0][0], time() + 3600 * 24);
            $_COOKIE['row'] = $values[0][0];
        } else {
            setcookie("row", $values[0][12], time() + 3600 * 24);
            $_COOKIE['row'] = $values[0][12];
        }

        foreach ($values as $row) {
            echo json_encode($row);
        }
    }
}

// Удалить операцию
if($_POST['delOperations']) {

    function delete(){
        global $service, $spreadsheetId;
        $rowtodelete = $_COOKIE['row'] - 1;
        echo $rowtodelete;
        $batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
            'requests' => array(
                'deleteDimension' => array(
                    'range' => array(
                        'sheetId' => 1040974203,
                        'dimension' => "ROWS",
                        'startIndex' => $rowtodelete,
                        'endIndex' => $rowtodelete + 1
                    )
                )
            )
        ));
        $result = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
    }

    if ($_POST['check'] === "0") {
        delete();
    } else {
        for ($i = 1; $i <= 2; $i++) {
            delete();
        }
    }

}

// Получить значения Select
if (isset($_POST['propertySelect'])) {

    $propertySelect = $_POST['propertySelect'];

    $range = "Переменные SQL!K3";
    $values = [
        [$propertySelect]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
    $range = "SQL запросы!Y1:Z";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    if (empty($values)) {
        print "Данные не найдены.\n";
    } else {
        $mask = "%10s %-10s %s\n";
        $arr = [];
        foreach ($values as $row) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
    }
}
// Изменить баланс
if(isset($_POST['value']) && isset($_POST['id'])) {
    $value = $_POST['value'];
    $id = $_POST['id'];
    if ($id === "balance1") {
        $range = "Баланс!F1";
    } else if ($id === "balance2") {
        $range = "Баланс!G1";
    } else if ($id === "balance3") {
        $range = "Баланс!H1";
    } else if ($id === "balance4") {
        $range = "Баланс!I1";
    }

    $values = [
        [$value]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );

}

// Сотрудники
if (isset($_POST['employeeSurname'])) {
    $employeeSurname = $_POST['employeeSurname'];
    $employeeName = $_POST['employeeName'];
    $employeePatronymic = $_POST['employeePatronymic'];
    $position = trim($_POST['position']);
    $activity = $_POST['activity'];
    $employeeStatus = $_POST['employeeStatus'];
    $condition = $_POST['condition'];
    $initials = $employeeSurname . " " . mb_substr($employeeName, 0, 1) . "." . mb_substr($employeePatronymic, 0, 1) . ".";
    $dateReceipt = date("Y-m-d");

// Добавить сотрудника
    if ($condition === "Добавить")  {
        $range = "Карточка сотрудника";
        $values = [
            ["", $initials, $employeeSurname, $employeeName, $employeePatronymic, $position, $activity, $employeeStatus, $dateReceipt]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );
        header("Location: employee-card.php");
        // Обновить сотрудника
    } else {
        $range = "Карточка сотрудника!B$_COOKIE[row]:H$_COOKIE[row]";
        $values = [
            [$initials, $employeeSurname, $employeeName, $employeePatronymic, $position, $activity, $employeeStatus]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $result = $service->spreadsheets_values->update(
            $spreadsheetId,
            $range,
            $body,
            $params
        );
        header("Location: employee-card.php");
    }
}

// Изменить сотрудника
if(isset($_POST['employeeAj']) && isset($_POST['employeeAjPosition'])) {

    $numVal = $_POST['employeeAj'];
    $employeeAjPosition = $_POST['employeeAjPosition'];

    if ($employeeAjPosition === "Швея" || $employeeAjPosition === "Установщик" || $employeeAjPosition === "Закройщик")
        $formula = "=QUERY('Услуги'!A2:H;\"select G, H, F, B, A, C Where (H>=\"&'Переменные SQL'!N3&\" And H<=\"&'Переменные SQL'!O3&\" And E='\"&'Переменные SQL'!P3& \"' And B='\"&'Переменные SQL'!Q3& \"') Order by H desc\")";
    else
        $formula = "=QUERY('Зарплата'!A2:I;\"select A, B, D, E, F, ' ' Where (B>=\"&'Переменные SQL'!N3&\" And B<=\"&'Переменные SQL'!O3&\" And C='\"&'Переменные SQL'!P3& \"' And E='\"&'Переменные SQL'!Q3& \"') Order by B desc label ' '''\")";

    $range = "SQL запросы!AQ1";
    $values = [
        [$formula]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );

    $range = "Ajax запросы!A29";
    $values = [
        [$numVal]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );

    if ($employeeAjPosition === "Швея")
    $numVal = "Пошив";
    else if ($employeeAjPosition === "Установщик")
    $numVal = "Установка карниза";
    else if ($employeeAjPosition === "Закройщик")
    $numVal = "Раскрой изделия";
    else
    $numVal = "Оклад";

    $range = "Переменные SQL!Q3";
    $values = [
        [$numVal]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
}
// Получить сотрудника
if(isset($_POST['employeeAj2'])) {
    $range = "Ajax запросы!A29:I29";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    if (empty($values)) {
        print "Данные не найдены.\n";
    } else {
        $mask = "%10s %-10s %s\n";
        setcookie("row", $values[0][8], time() + 3600 * 24);
        $_COOKIE['row'] = $values[0][8];
        foreach ($values as $row) {
            echo json_encode($row);
        }
    }
}
// Фильтр по категориям сотрудников
if(isset($_POST['changeStatus'])) {
    $changeStatus = $_POST['changeStatus'];

    if ($changeStatus !== "Все сотрудники") {
        $formula = "=QUERY('Карточка сотрудника'!A2:I;\"select B, G Where H='\"&'Переменные SQL'!M3&\"' Order by B ASC\")";
    } else {
        $formula = "=QUERY('Карточка сотрудника'!A2:I;\"select B, G\")";
    }

    $range = "SQL запросы!AN1";
    $values = [
        [$formula]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );



    $range = "Переменные SQL!M3";
    $values = [
        [$changeStatus]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
}


// Зарплата, применить фильтр
if ((isset($_POST['firstDateEmployee']) && isset($_POST['secondDateEmployee'])) || isset($_POST['KindWork'])) {

    if (!isset($_POST['KindWork'])) {
        $firstDateEmployee = $_POST['firstDateEmployee'];
        $secondDateEmployee = $_POST['secondDateEmployee'];
        $range = "Переменные SQL!N3:O3";
        $values = [
            [$firstDateEmployee, $secondDateEmployee]
        ];
    } else {
        $KindWork = $_POST['KindWork'];
        $range = "SQL запросы!AQ1";
        if($KindWork === "Заказы") 
            $formula = "=QUERY('Заказы'!A2:AB;\"select '  ', AB, AA, 'Заказ', A, ' ' Where (AB>=\"&'Переменные SQL'!N3&\" And AB<=\"&'Переменные SQL'!O3&\" And N='\"&'Переменные SQL'!P3& \"' And O='Сдан') Order by AB desc label 'Заказ''', ' ''', '  '''\")";
        else if($KindWork === "Розница" || $KindWork === "Модели" || $KindWork === "Оклад" || $KindWork === "Бонус" || $KindWork === "Премия" || $KindWork === "Штраф")
            $formula = "=QUERY('Зарплата'!A2:I;\"select A, B, D, E, F, ' ' Where (B>=\"&'Переменные SQL'!N3&\" And B<=\"&'Переменные SQL'!O3&\" And C='\"&'Переменные SQL'!P3& \"' And E='\"&'Переменные SQL'!Q3& \"') Order by B desc label ' '''\")";
        else if($KindWork === "Пошив" || $KindWork === "Установка карниза" || $KindWork === "Оформление окон" || $KindWork === "Раскрой изделия")
            $formula = "=QUERY('Услуги'!A2:H;\"select G, H, F, B, A, C Where (H>=\"&'Переменные SQL'!N3&\" And H<=\"&'Переменные SQL'!O3&\" And E='\"&'Переменные SQL'!P3& \"' And B='\"&'Переменные SQL'!Q3& \"') Order by H desc\")";
        
        $values = [
            [$formula]
        ];

        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $result = $service->spreadsheets_values->update(
            $spreadsheetId,
            $range,
            $body,
            $params
        );

        $range = "Переменные SQL!Q3";
        $values = [
            [$KindWork]
        ];
    }
    
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
}






if (isset($_POST['employeeDate'])) {
    $employeeDate = $_POST['employeeDate'];
    $selectEmployee = $_POST['selectEmployee'];
    $typeService = $_POST['typeService'];
    $sumEmployee = str_replace('&nbsp;',  '', htmlentities($_POST['sumEmployee']));
    if (!isset($_POST['employeeDescription']))
        $employeeDescription = "";
    else
        $employeeDescription = $_POST['employeeDescription'];

    if($typeService === "Штраф")
    $sumEmployee = "-" . $sumEmployee;

    // Добавить зарплату
    if (empty($_POST['numOrders'])) {
        $range = "Зарплата";
        $values = [
            ["", $employeeDate, $selectEmployee, $sumEmployee, $typeService, $employeeDescription]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );
        header("Location: employee-card.php");
        // Обновить зарплату
    } else {
            $range = "Зарплата!B$_COOKIE[row]:F$_COOKIE[row]";
            $values = [
                [$employeeDate, $selectEmployee, $sumEmployee, $typeService, $employeeDescription]
            ];
            $body = new Google_Service_Sheets_ValueRange([
                'values' => $values
            ]);
            $params = [
                'valueInputOption' => 'USER_ENTERED'
            ];
            $result = $service->spreadsheets_values->update(
                $spreadsheetId,
                $range,
                $body,
                $params
            );
            header("Location: employee-card.php");
    }
}

// Получить зарплату
if(isset($_POST['employeeAj3']) || $_POST['delEmployee']) {
    if(isset($_POST['employeeAj3'])) {
        $numVal = $_POST['employeeAj3'];
    } else {
        $numVal = $_POST['delEmployee'];
    }
    $range = "Ajax запросы!A32";
    $values = [
        [$numVal]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
    $range = "Ajax запросы!A32:F32";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    if (empty($values)) {
        print "Данные не найдены.\n";
    } else {
        $mask = "%10s %-10s %s\n";
        setcookie("row", $values[0][0], time() + 3600 * 24);
        $_COOKIE['row'] = $values[0][0];
        foreach ($values as $row) {
            echo json_encode($row);
        }
    }
}

// Удалить зарплату
if($_POST['delEmployee']) {
    $rowtodelete = $_COOKIE['row'] - 1;
    $batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
        'requests' => array(
            'deleteDimension' => array(
                'range' => array(
                    'sheetId' => 1301483738,
                    'dimension' => "ROWS",
                    'startIndex' => $rowtodelete,
                    'endIndex' => $rowtodelete + 1
                )
            )
        )
    ));

    $result = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
}

    // Добавить операцию через заказ
if (isset($_POST['selectAccount'])) {
    $selectAccount = $_POST['selectAccount'];
    $date = $_POST['date'];
    $sum = str_replace('&nbsp;',  '', htmlentities($_POST['sum']));
    $counterparty = $_POST['counterparty'];
    $description = $_POST['description'];
    $expenditure = $_POST['expenditure'];
    $type = "Приход";

    if ($expenditure === "Возврат денег клиенту") {
        $sum = "-" . $sum;
        $type = "Расход";
    }

    $range = "Операции";
    $values = [
        ["", $date, $sum, $expenditure, $description, $counterparty, $selectAccount, $type]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $insert = [
        "insertDataOption" => "INSERT_ROWS"
    ];
    $result = $service->spreadsheets_values->append(
        $spreadsheetId,
        $range,
        $body,
        $params,
        $insert
    );

    if ($expenditure !== "Возврат денег клиенту" && $selectAccount === "Расчетный счет") {
        $description = $_POST['description'] . " 1% Альфа-банк";
        $sum = $sum / 100 * 1;
        $sum = str_replace('.',',',$sum);
        $sum = "-" . $sum;
        $type = "Расход";

        $range = "Операции";
        $values = [
            ["", $date, $sum, "Эквайринг", $description, "Сбербанк", $selectAccount, $type]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );

    }

}

// Выгрузка
if (isset($_POST['unloadingSubmit']) and $_FILES) {

    function updateUnloading() {
        global $coordinates, $range, $spreadsheetId, $service, $values;
        
        $values = [
            [""]
        ];
        for ($i = 1; $i <= 2; $i++) {
            $body = new Google_Service_Sheets_ValueRange([
                'values' => $values
            ]);
            $params = [
                'valueInputOption' => 'USER_ENTERED'
            ];
            $result = $service->spreadsheets_values->update(
                $spreadsheetId,
                $range,
                $body,
                $params
            );
            $values = [
                [$coordinates]
            ];
        }
    }

    if($_FILES['unloading']['name'] === "Прибыль.htm") {
        move_uploaded_file($_FILES['unloading']['tmp_name'], "unloading/".$_FILES['unloading']['name']);

        $source='unloading/Прибыль.htm';
        $target='unloading/НоваяПрибыль.htm';
        // copy operation
        $sh=fopen($source, 'r');
        $th=fopen($target, 'w');
        while (!feof($sh)) {
            $line=fgets($sh);
            if (strpos($line, '</B>')===false && strpos($line, '<TD')!==false) {
                $line='' . PHP_EOL;
                $line = trim($line);
            } else {
                $line = str_replace('<B>','',$line) . PHP_EOL;
                $line = str_replace('</B>','',$line) . PHP_EOL;
                if (strpos($line, 'ALIGN=RIGHT')!==false) {
                    $line = str_replace('.',',',$line) . PHP_EOL;
                }
            }
            fwrite($th, $line);
        }
        
        fclose($sh);
        fclose($th);

        $coordinates = "=IMPORTHTML(\"http://c92648n6.beget.tech/unloading/НоваяПрибыль.htm\"; \"table\"; 1)";
        $range = "Выгрузка!A1";
        updateUnloading();

        header("Location: index.php");
    } else if($_FILES['unloading']['name'] === "Остатки.htm") {
        move_uploaded_file($_FILES['unloading']['tmp_name'], "unloading/".$_FILES['unloading']['name']);

        $source='unloading/Остатки.htm';
        $target='unloading/НовыеОстатки.htm';
        
        // copy operation
        $sh=fopen($source, 'r');
        $th=fopen($target, 'w');
        while (!feof($sh)) {
            $line=fgets($sh);
            if (strpos($line, '</B>')===false && strpos($line, '<TD')!==false) {
                $line='' . PHP_EOL;
                $line = trim($line);
            } else {
                $line = str_replace('<B>','',$line) . PHP_EOL;
                $line = str_replace('</B>','',$line) . PHP_EOL;
                if (strpos($line, 'ALIGN=RIGHT')!==false) {
                    $line = str_replace('.',',',$line) . PHP_EOL;
                }
            }
            fwrite($th, $line);
        }
        
        fclose($sh);
        fclose($th);

        $coordinates = "=IMPORTHTML(\"http://c92648n6.beget.tech/unloading/НовыеОстатки.htm\"; \"table\"; 1)";
        $range = "Выгрузка!H1";
        updateUnloading();

        header("Location: index.php");
    } else if($_FILES['unloading']['name'] === "Список.htm") {
        move_uploaded_file($_FILES['unloading']['tmp_name'], "unloading/".$_FILES['unloading']['name']);

        $source='unloading/Список.htm';
        $target='unloading/НовыйСписок.htm';
    
        // copy operation
        $sh=fopen($source, 'r');
        $th=fopen($target, 'w');
        while (!feof($sh)) {
            $line=fgets($sh);
            $line = iconv('windows-1251//IGNORE', 'UTF-8//IGNORE', $line);
            if (strpos($line, '<TABLE BORDER CELLSPACING=0>')!==false) {
                $line='<TABLE BORDER CELLSPACING=0 class="listWithCodes displayNone">' . PHP_EOL;
            }
            fwrite($th, $line);
        }
    
        fclose($sh);
        fclose($th);
        header("Location: index.php");
    } else {
        echo "You have uploaded the wrong file, make sure it is in htm format. Come back and try again.";
    }
}




if (isset($_POST['dateDepreciation'])) {
    $dateDepreciation = $_POST['dateDepreciation'];
    $term = $_POST['term'];
    $dateAt = strtotime('+' . $term .  'MONTH', strtotime($dateDepreciation));
    $newDate = date('Y-m-d', $dateAt);
    $assets = $_POST['assets'];
    $assetValue = str_replace('&nbsp;',  '', htmlentities($_POST['assetValue']));
    $depreciation = (int)$assetValue / (int)$term;
    $endTerm = $newDate;
    $writeOffCost = "";
    $operationArticle = $_POST['operationArticle'];
    if (empty($_POST['writeOffDate']))
        $writeOffDate = "";
    else {
        $strtotime = strtotime($_POST['writeOffDate']);
        $writeOffDate = date('Y-m-01', $strtotime);

        $strtotime2 = strtotime($dateDepreciation);
        $writeOffCostDate = date('Y-m-01', $strtotime2);

        $writeOffCost = $assetValue - ($depreciation * (round((strtotime($writeOffDate) - strtotime($writeOffCostDate)) / 2592000)));
    }

// Добавить амортизацию
    if (empty($_POST['numOrders'])) {
        $range = "Амортизация";
        $values = [
            ["", $dateDepreciation, $operationArticle, $assets, $assetValue, $term, $depreciation, $endTerm, $writeOffDate]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );
        header("Location: edit-depreciation.php");
        // Обновить амортизацию
} else {
        $range = "Амортизация!A$_COOKIE[row]:J$_COOKIE[row]";
        $values = [
            ["", $dateDepreciation, $operationArticle, $assets, $assetValue, $term, $depreciation, $endTerm, $writeOffDate, $writeOffCost]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $result = $service->spreadsheets_values->update(
            $spreadsheetId,
            $range,
            $body,
            $params
        );
        header("Location: depreciation.php");
    }
}

// Получить амортизацию
if(isset($_POST['numDepreciationAj']) || $_POST['delDepreciation']) {
    if(isset($_POST['numDepreciationAj'])) {
        $numVal = $_POST['numDepreciationAj'];
    } else {
        $numVal = $_POST['delDepreciation'];
    }
    $range = "Ajax запросы!A35";
    $values = [
        [$numVal]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
    $range = "Ajax запросы!A35:J35";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    if (empty($values)) {
        print "Данные не найдены.\n";
    } else {
        $mask = "%10s %-10s %s\n";
        setcookie("row", $values[0][0], time() + 3600 * 24);
        $_COOKIE['row'] = $values[0][0];
        foreach ($values as $row) {
            echo json_encode($row);
        }
    }
}

// Удалить амортизацию
if($_POST['delDepreciation']) {
    $rowtodelete = $_COOKIE['row'] - 1;
    $batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
        'requests' => array(
            'deleteDimension' => array(
                'range' => array(
                    'sheetId' => 574211923,
                    'dimension' => "ROWS",
                    'startIndex' => $rowtodelete,
                    'endIndex' => $rowtodelete + 1
                )
            )
        )
    ));

    $result = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
}

// Смена периода в отчетах
if (isset($_POST['firstDateReports']) && isset($_POST['secondDateReports'])) {

    $firstDateReports = $_POST['firstDateReports'];
    $secondDateReports = $_POST['secondDateReports'];

    $range = "Переменные SQL!S3:T3";
    $values = [
        [$firstDateReports, $secondDateReports]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );

}

if (isset($_POST['firstDateDividends']) && isset($_POST['secondDateDividends'])) {

    $firstDateDividends = $_POST['firstDateDividends'];
    $secondDateDividends = $_POST['secondDateDividends'];

    $range = "Переменные SQL!S3:T3";
    $values = [
        [$firstDateDividends, $secondDateDividends]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );

}

if (isset($_POST['orderDateRepair'])) {
    $orderNumber = $_POST['orderNumber2'];
    $orderDate = $_POST['orderDateRepair'];
    $surname = $_POST['surname'];
    $dateOfReadiness = $_POST['dateOfReadiness'];
    $name = $_POST['name'];
    $orderPrice = str_replace('&nbsp;',  '', htmlentities($_POST['orderPrice']));
    $patronymic = preg_replace('/\s+/', ' ', $_POST['patronymic']);
    $phoneNumber = str_replace(['(', ')', '+', '-'], ['', '', '', ''], $_POST['phoneNumber']);
    $paymentState = $_POST['paymentState'];
    $designer = $_POST['designer'];
    $orderStatus = $_POST['orderStatus'];
    $serviceCategory = $_POST['serviceCategory'];
    $designerPercentage = $orderPrice * (str_replace([',', '%'], ['.', ''], $_POST['designerPercentage']) / 100);
    $seamstress = $_POST['seamstress'];
    $serviceName = $_POST['serviceName'];
    $deadline = $_POST['deadline'];
    $paymentDate = $_POST['paymentDate'];
    $orderTime = date("Y-m-d H:i:s");
    $serviceQuantity = $_POST['serviceQuantity'];
    if($seamstress !== "Першукова О.П.") {
        $percentageOfTailoring = $orderPrice / 2;
    } else {
        $percentageOfTailoring = 0;
    }
    

    // Добавить ремонт
    if (empty($_POST['numOrders'])) {
        $range = "Ремонт";
        $values = [
            [$orderNumber, $orderDate, $surname, $name, $patronymic, $phoneNumber, $serviceName, $orderPrice, $designer, $orderStatus, $paymentState, $serviceCategory, $serviceQuantity, $designerPercentage, $paymentDate, $dateOfReadiness, $deadline, $orderTime]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );

        $range = "Услуги";
        $values = [
            [$orderNumber, "Пошив", $serviceCategory . ": " . $serviceName, $orderPrice, $seamstress, $percentageOfTailoring]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'

        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );
        header("Location: edit-repair.php");
        // Обновить ремонт
    } else {
            $range = "Ремонт!A$_COOKIE[row]:AH$_COOKIE[row]";
            $values = [
                [$orderNumber, $orderDate, $surname, $name, $patronymic, $phoneNumber, $serviceName, $orderPrice, $designer, $orderStatus, $paymentState, $serviceCategory, $serviceQuantity, $designerPercentage, $paymentDate, $dateOfReadiness, $deadline, $orderTime]
            ];
            $body = new Google_Service_Sheets_ValueRange([
                'values' => $values
            ]);
            $params = [
                'valueInputOption' => 'USER_ENTERED'
            ];
            $result = $service->spreadsheets_values->update(
                $spreadsheetId,
                $range,
                $body,
                $params
            );
        header("Location: repair.php");
    }
}

// Получить ремонт
if(isset($_POST['numRepairAj']) || $_POST['delRep']) {
    if(isset($_POST['numRepairAj'])) {
        $numVal = $_POST['numRepairAj'];
    } else {
        $numVal = $_POST['delRep'];
    }
    $range = "Ajax запросы!A38";
    $values = [
        [$numVal]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED'
    ];
    $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
    $range = "Ajax запросы!A38:R38";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    if (empty($values)) {
        print "Данные не найдены.\n";
    } else {
        $mask = "%10s %-10s %s\n";
        setcookie("row", $values[0][17], time() + 3600 * 24);
        $_COOKIE['row'] = $values[0][17];
        foreach ($values as $row) {
            echo json_encode($row);
        }
    }
}

// Удалить ремонт
if($_POST['delRep']) {
    $rowtodelete = $_COOKIE['row'] - 1;
    $batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
        'requests' => array(
            'deleteDimension' => array(
                'range' => array(
                    'sheetId' => 766522699,
                    'dimension' => "ROWS",
                    'startIndex' => $rowtodelete,
                    'endIndex' => $rowtodelete + 1
                )
            )
        )
    ));

    $result = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
}












