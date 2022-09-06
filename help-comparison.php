<?php
    if (!isset($_COOKIE['user'])) {
        header('location: login.php');
    } 
?>

<!DOCTYPE html>
<html lang="ru" data-direction="ltr"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://fonts.intercomcdn.com/" rel="preconnect" crossorigin="">

    <title>Сравнение периодов | Помощь</title>

    <link rel="stylesheet" href="assets/css/help.css" media="all">
    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">

  </head>
  <body class="header__lite">
    <header class="header">
  <div class="container header__container o__ltr" dir="ltr">
    <div class="content">
      <div class="mo o__centered o__reversed header__meta_wrapper">
        <div class="mo__aside">
          <div class="header__links">
              <a target="_blank" rel="noopener" href="/index.php" class="header__home__url"><svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><g stroke="#FFF" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"><path d="M11.5 6.73v6.77H.5v-11h7.615M4.5 9.5l7-7M13.5 5.5v-5h-5"></path></g></svg><span>Перейти в систему учета Текстиль</span></a>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

    <div class="container">
      <div class="content educate_content"><section class="section section__article">
    <div class="breadcrumb" dir="ltr">
  <div class="link__arrow o__ltr">
    <a href="#">Все коллекции</a>
  </div>

      <div class="link__arrow o__ltr">
        <a href="/help-reports.php">Отчеты</a>
      </div>

  <div class="link__arrow o__ltr">Сравнение периодов</div>
</div>

  <div class="paper paper__large">
  <div class="content content__narrow">
    <div class="article intercom-force-break">
      <div class="article__meta" dir="ltr">
          <h1 class="t__h1">Сравнение периодов</h1>
          <div class="article__desc">
            
          </div>

      </div>
      <article dir="ltr">
        <p class="no-margin">В сравнении периодов можно проанализировать текущую ситуацию с прошедшей и увидеть в каком направлении двигается организация. Данные берутся из отчета о прибылях и убытках, поэтому чтобы хорошо тут ориентироваться, стоит прочитать <a href="/help-pnl.php" class="intercom-content-link" data-is-internal-link="true">эту статью</a>.</p>
        <h2 id="-----" data-post-processed="true"><b>Разбираемся что к чему</b></h2>
        <div class="intercom-container"><img src="/assets/images/help-comparison.jpg"></div>
        <li><b>Этот год</b> - показывает среднее значение по статье за прошедшие 12 месяцев. Пример: 01.05.2021 - 30.04.2022 </li>
        <li><b>Прошлый год</b> - показывает среднее значение по статье за прошедшие 12 месяцев, только уже год назад. Пример: 01.05.2020 - 30.04.2021   </li>
        <li><b>Отклонение за месяц</b> - это средняя разница между числовыми значениями за эти 12 месяцев и предыдущие.</li>
        <li><b>Отклонение за год</b> - это реальная разница между числовыми значениями за эти 12 месяцев и предыдущие.</li>
        <li><b>Отклонение, %</b> - разнца между двумя числовыми значениями в процентах.</li>
      </article>
    </div>
  </div>

</div>

</section>
</div>
    </div>
    <footer class="footer">
  <div class="container">
    <div class="content">
      <div class="u__cf" dir="ltr">
        <div class="footer__logo">
          <a href="/help-reports.php">
            <img src="/assets/images/logo-help.png">
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>

</style></div></body></html>