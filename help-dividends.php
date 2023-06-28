<?php
    if (!isset($_COOKIE['user'])) {
        header('location: login.php');
    } 
?>

<!DOCTYPE html>
<html lang="ru" data-direction="ltr"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://fonts.intercomcdn.com/" rel="preconnect" crossorigin="">

    <title>Отчет по дивидендам | Помощь</title>

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

  <div class="link__arrow o__ltr">Отчет по дивидендам</div>
</div>

  <div class="paper paper__large">
  <div class="content content__narrow">
    <div class="article intercom-force-break">
      <div class="article__meta" dir="ltr">
          <h1 class="t__h1">Отчет по дивидендам</h1>
          <div class="article__desc">
            
          </div>

      </div>
      <article dir="ltr">
        <p class="no-margin">Дивиденды — это часть прибыли, полученной компанией, которая распределяется между ее участниками. В нашем случае сумма дивидендов вычисляется по форумуле: чистая прибыль - 25% (реинвестиции) = дивиденды.</p>
        <div class="intercom-container"><img src="/assets/images/dividends-year.jpg"></div>
        <li><b>Дивиденды за этот год</b> - это сумма начисленных дивидендов за текущий календарный год.</li>
        <li><b>Среднемесячный заработок</b> - это сумма начисленных дивидендов деленная на количество прошедших месяцев.</li>
        <li><b>Средненедельный заработок</b> - это сумма начисленных дивидендов деленная на количество прошедших недель.</li>
        <p class="no-margin">Статистика по дивидендам показывает дивиденды который были начислены за последние 12 месяцев.</p>
        <div class="intercom-container"><img src="/assets/images/stats-dividends.jpg"></div>
        <p class="no-margin">Следующие четыре блока отвечают за вывод средств из бизнеса. Верхние два показывают, кто сколько денег взял за текущий календарный год. У левого нижнего блока есть два состояния: зеленый и красный, когда цифра обозначается зеленым цветом, это означает сумму, которую можно забрать в качестве дивидендов, если же вы видите обозначение красным цветом - зачит вы забирайте деньги из бизнеса, которые сейчас должны были работать и приносить доход. Также есть правый нижний блок, он показывает, кто нарушил баланс между участниками и на какую сумму он взял больше, чем ему положено за все время.</p>
        <div class="intercom-container"><img src="/assets/images/withdrawal-dividends.jpg"></div>
        <p class="no-margin">Диаграмма показывает в процентом и численном выражении, кто сколько денег взял с 01.07.2021 (момент заключения договора о распределении прибыли 50% на 50%)</p>
        <div class="intercom-container"><img src="/assets/images/diagram-dividends.jpg"></div>
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