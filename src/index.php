<?php

spl_autoload_register(function ($classname) {
    require_once './' . str_replace('\\', '/', $classname) . ".php";
});


use models\Client;
use models\Order;
use models\OrderProduct;
use models\Product;
use models\Shop;


$shop = new Shop();
$shop->insert(
    ['name', 'address'],
    [
        ['Магазин Ж', 'Адрес Ж'],
    ]
);
var_dump($shop->find(1));
var_dump($shop->delete(1));
var_dump($shop->find(1));
var_dump($shop->update(1, ['name' => '1111', 'address' => '2222']));

$client = new Client();
$client->insert(
    ['phone', 'name'],
    [
        ['0987654321', 'Клиент Ж'],
    ]
);
var_dump($client->find(1));
var_dump($client->delete(1));
var_dump($client->find(1));
var_dump($client->update(1, ['phone' => '1231231231', 'name' => 'Клиент Т']));

$product = new Product();
$product->insert(
    ['name', 'price', 'count'],
    [
        ['Продукт Ж', 10.2, 35],
    ]
);
var_dump($product->find(1));
var_dump($product->delete(1));
var_dump($product->update(1, ['name' => 'Продукт Т', 'price' => 23.5, 'count' => 20]));

$product = new Order();
$product->insert(
    ['created_at', 'shop_id', 'client_id'],
    [
        ['2023-08-01 10:00:00', 3, 6],
    ]
);
var_dump($product->find(1));
var_dump($product->delete(1));
var_dump($product->update(
    1,
    [
        'created_at' => '2023-08-01 10:00:00',
        'shop_id' => 3,
        'client_id' => 6
    ]
));

$product = new OrderProduct();
$product->insert(
    ['order_id', 'product_id', 'price'],
    [
        [3, 6, 35.4],
    ]
);
var_dump($product->find(1));
var_dump($product->delete(1));
var_dump($product->update(
    1,
    [
        'order_id' => 3,
        'product_id' => 6,
        'price' => 20
    ]
));
