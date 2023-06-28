<?php
    if (!isset($_COOKIE['user'])) {
        header('location: login.php');
    } 
?>

<!DOCTYPE html>
<html lang="ru" data-direction="ltr"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://fonts.intercomcdn.com/" rel="preconnect" crossorigin="">

    <title>Отчет по задолженностям | Помощь</title>

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

  <div class="link__arrow o__ltr">Отчет по задолженностям</div>
</div>

  <div class="paper paper__large">
  <div class="content content__narrow">
    <div class="article intercom-force-break">
      <div class="article__meta" dir="ltr">
          <h1 class="t__h1">Отчет по задолженностям</h1>
          <div class="article__desc">
            
          </div>

      </div>
      <article dir="ltr">
        <p class="no-margin">КЗ (кредиторская задолженность) и ДЗ (дебиторская задолженность) возникают при взаиморасчетах с партнерами как следствие разрыва во времени между платежом и переходом права собственности в рамках коммерческого взаимодействия двух организаций. Другими словами, КЗ\ДЗ – это задолженность одной из сторон по выполнению своих обязательств в рамках коммерческого соглашения.</p>
          <li>КЗ – это наша задолженность (обязательства). Это может быть простая задолженность в виде денежных долгов (например, банковские кредиты) или отсрочки платежей (коммерческие кредиты), так и задолженность перед персоналом по ЗП и пр.</li>
          <li>ДЗ – задолженность наших контрагентов: партнеров, персонала, внебюджетных фондов, банков (депозиты) и пр.</li>
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