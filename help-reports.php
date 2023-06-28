<?php
    if (!isset($_COOKIE['user'])) {
        header('location: login.php');
    } 
?>

<!DOCTYPE html>
<html lang="ru" data-direction="ltr"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://fonts.intercomcdn.com/" rel="preconnect" crossorigin="">

    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Отчеты | Помощь</title>

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
      <div class="content educate_content"><section class="content section">
  <div class="breadcrumb" dir="ltr">
  <div class="link__arrow o__ltr">
    <a href="#">Все коллекции</a>
  </div>


  <div class="link__arrow o__ltr">Отчеты</div>
</div>

  <div class="section__bg">
    <div class="paper g__space collection__headline">
  <div class="collection o__ltr">
    <div class="collection__photo">
      <svg role="img" viewBox="0 0 48 48"><g id="file-spreadsheet" stroke-width="2" fill="none" fill-rule="evenodd" stroke-linecap="round"><path d="M41 47H7V1h22l12 12v34z" stroke-linejoin="round"></path><path d="M29 1v12h12" stroke-linejoin="round"></path><path d="M35 41H13V17h22v24zM13 23h22m-22 6h22m-22 6h22M21 17v24"></path></g></svg>
    </div>
    <div class="collection__meta intercom-force-break" dir="ltr">
      <h1 class="t__h1">Отчеты</h1>
      <p class="paper__preview">Описание ключевых отчетов в управленческом учете</p>
      <div class="avatar">
  <div class="avatar__info">
    <div>
      <span class="c__darker">
        6 статей в этой коллекции
      </span>
      <br>
    </div>
  </div>
</div>

    </div>
  </div>
</div>

    <div class="g__space">
    <a href="/help-pnl.php" class="t__no-und paper paper__article-preview">
      <div class="article__preview intercom-force-break" dir="ltr">
  <h2 class="t__h3"><span class="c__primary">Отчет о прибылях и убытках</span></h2>
  <span class="paper__preview c__body">Отчет о прибылях и убытках показывает финансовые результаты работы организации и используется для оценки эффективности ее деятельности.</span>

</div>

    </a>
    <a href="/help-cashflow.php" class="t__no-und paper paper__article-preview">
      <div class="article__preview intercom-force-break" dir="ltr">
  <h2 class="t__h3"><span class="c__primary">Отчет о движении денежных средств</span></h2>
  <span class="paper__preview c__body">Отчет ДДС помогает понять источники поступления денег и направления их расходования Отчет ДДС показывает, откуда деньги поступают и куда уходят.</span>

</div>

    </a>
    <a href="/help-balance.php" class="t__no-und paper paper__article-preview">
      <div class="article__preview intercom-force-break" dir="ltr">
  <h2 class="t__h3"><span class="c__primary">Балансовый отчет</span></h2>
  <span class="paper__preview c__body">Балансовый отчет - это моментальный снимок, который представляет состояние финансов фирмы в данный момент времени.</span>

</div>

    </a>
    <a href="/help-debts.php" class="t__no-und paper paper__article-preview">
      <div class="article__preview intercom-force-break" dir="ltr">
  <h2 class="t__h3"><span class="c__primary">Отчет по задолженностям</span></h2>
  <span class="paper__preview c__body">Отчет представляет собой список дебиторской и кредиторской задолженности в разрезе договоров контрагентов.</span>

</div>

    </a>
    <a href="/help-dividends.php" class="t__no-und paper paper__article-preview">
      <div class="article__preview intercom-force-break" dir="ltr">
  <h2 class="t__h3"><span class="c__primary">Отчет по дивидендам</span></h2>
  <span class="paper__preview c__body">Отчет по дивидендам содержит подробности обо всех дивидендах и выплатах в кач-ве дивидендов.</span>

</div>

    </a>

    <a href="/help-comparison.php" class="t__no-und paper paper__article-preview">
      <div class="article__preview intercom-force-break" dir="ltr">
  <h2 class="t__h3"><span class="c__primary">Сравнение периодов</span></h2>
  <span class="paper__preview c__body">Аналитический отчет, позволяющий определить тенденцию развития организаци на основе исторических данных.</span>

</div>

    </a>
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