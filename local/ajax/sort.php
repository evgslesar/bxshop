<?php
//if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

function process_form_data($data) {
    // Обработка данных формы
    if (empty($data['sortten'])) {
        return false;
    }
    return $data['sortten'];
}

function set_cookie($name, $value, $expire = 0) {
    // Установка куки
    setcookie($name, $value, $expire, '/', '', false, true);
}

// Обработка данных формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sortten = process_form_data($_POST);
    if ($sortten !== false) {
        set_cookie('sortten', $sortten);
    }
}