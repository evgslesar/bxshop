<?php
$arUrlRewrite=array (
  6 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/personal/orders_history/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/orders_history/index.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/hasta/goods/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/hasta/goods/index.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^\\??(.*)#',
    'RULE' => '&$1',
    'ID' => 'bitrix:catalog.section',
    'PATH' => '/favorites/index.php',
    'SORT' => 100,
  ),
);
