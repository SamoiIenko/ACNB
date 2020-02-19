 <?php 

require 'db.php'; // подключаем библиотеку ReadbeenPHP и соединяемся с базой данных
  require('phpQuery-onefile.php');  // подключаем phpQuery
  define('HOST','https://www.drive.ru/brands/toyota/models/2017/land_cruiser_prado'); // сюда мы вписываем адрес сайта-донора, который необходимо спарсить 
 
  $data_site = file_get_contents(HOST); // получаем страницу сайта-донора
  $document = phpQuery::newDocument($data_site);
  $content_prev = $document->find('.car-builds-table tbody');
  $content_prev->find('.dv-mobile-row')->remove();
  $content_prev = $content_prev->find('tr');
 
  // перебираем в цикле все посты
  foreach ($content_prev as $el) {
      // Парсим превьюшки статей
  $pq = pq($el); // pq это аналог $ в jQuery
  $car_name = $pq->find('.car-builds-table-title .car-build-link')->text(); // парсим текст имени комплектации 
  $car_price = $pq->find('.car-builds-table-price a')->text(); // парсим ссылку на статью
    storeCarName($car_name, $car_price);

    
  
  } 


  


/* header('Content-type: text/html; charset=utf-8');
require 'phpQuery-onefile.php';

function print_arr($arr) {
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

$url = 'https://www.drive.ru/brands/bmw';
$file = file_get_contents($url);


$doc = phpQuery::newDocument($file);

foreach($doc->find('#brand-icons-list .car-icon') as $article) {
    $article = pq($article);
    $article->find('.car-icon-image')->wrap('<div class="auto">');
    $img = $article->find('.car-icon-image img')->attr('src');
    $namecar = $article->find('.car-icon-caption')->html();
    echo "<img src='$img'>";
    echo $namecar;
    echo '<hr>';

} */