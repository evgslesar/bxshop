<?php
$arUrlRewrite=array (
  12 => 
  array (
    'CONDITION' => '#^/test2/bitrix/services/ymarket/([\\w\\d\\-]+)?(/)?(([\\w\\d\\-]+)(/)?)?#',
    'RULE' => 'REQUEST_OBJECT=$1&METHOD=$4',
    'ID' => '',
    'PATH' => '/test2/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/video([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1&videoconf',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  13 => 
  array (
    'CONDITION' => '#^/test2/personal/history-of-orders/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/test2/personal/history-of-orders/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/personal/orders_history/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/orders_history/index.php',
    'SORT' => 100,
  ),
  14 => 
  array (
    'CONDITION' => '#^/test2/contacts/stores/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog.store',
    'PATH' => '/test2/contacts/stores/index.php',
    'SORT' => 100,
  ),
  15 => 
  array (
    'CONDITION' => '#^/test2/personal/order/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/test2/personal/order/index.php',
    'SORT' => 100,
  ),
  16 => 
  array (
    'CONDITION' => '#^/test2/info/articles/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/test2/info/articles/index.php',
    'SORT' => 100,
  ),
  17 => 
  array (
    'CONDITION' => '#^/test2/company/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/test2/company/news/index.php',
    'SORT' => 100,
  ),
  18 => 
  array (
    'CONDITION' => '#^/test2/info/article/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/test2/info/article/index.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  19 => 
  array (
    'CONDITION' => '#^/test2/info/brands/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/test2/info/brands/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/stssync/calendar/#',
    'RULE' => '',
    'ID' => 'bitrix:stssync.server',
    'PATH' => '/bitrix/services/stssync/calendar/index.php',
    'SORT' => 100,
  ),
  20 => 
  array (
    'CONDITION' => '#^/test2/info/brand/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/test2/info/brand/index.php',
    'SORT' => 100,
  ),
  21 => 
  array (
    'CONDITION' => '#^/test2/products/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/test2/products/index.php',
    'SORT' => 100,
  ),
  22 => 
  array (
    'CONDITION' => '#^/test2/services/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/test2/services/index.php',
    'SORT' => 100,
  ),
  24 => 
  array (
    'CONDITION' => '#^/test2/landings/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/test2/landings/index.php',
    'SORT' => 100,
  ),
  27 => 
  array (
    'CONDITION' => '#^/test2/personal/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.section',
    'PATH' => '/test2/personal/index.php',
    'SORT' => 100,
  ),
  23 => 
  array (
    'CONDITION' => '#^/test2/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/test2/catalog/index.php',
    'SORT' => 100,
  ),
  25 => 
  array (
    'CONDITION' => '#^/test2/sale/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/test2/sale/index.php',
    'SORT' => 100,
  ),
  26 => 
  array (
    'CONDITION' => '#^/test2/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/test2/news/index.php',
    'SORT' => 100,
  ),
  28 => 
  array (
    'CONDITION' => '#^/test/lp/#',
    'RULE' => NULL,
    'ID' => 'bitrix:landing.pub',
    'PATH' => '/test/lp/index.php',
    'SORT' => 100,
  ),
  34 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  33 => 
  array (
    'CONDITION' => '#^/blog/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/blog/index.php',
    'SORT' => 100,
  ),
);
