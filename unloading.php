<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выгрузка</title>
    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <form action="ordersRequest.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="unloading"><br><br>
        <input type="submit" name="unloadingSubmit" value="Выгрузить">
    </form>
</body>
</html>