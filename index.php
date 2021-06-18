<?php

require __DIR__."/vendor/autoload.php";

use Src\Tools\Table;

$data = [
    0 => [
        "id"    => 14,
        "name"  => "Fernando",
        "email" => "fernando@gmail.com"
    ],
    1 => [
        "id"    => 15,
        "name"  => "Bruno",
        "email" => "bruno@gmail.com"
    ],
    2 => [
        "id"    => 16,
        "name"  => "Maria",
        "email" => "maria@gmail.com"
    ],
    3 => [
        "id"    => 18,
        "name"  => "Stefany",
        "email" => "stefany@gmail.com"
    ]
];

$table = new Table([
    "id" => "people",
    "itemId" => "id",
    "align" => "left",
    "tdId" => false,
]);

$table->setHeader([
    [
        "content" => "Id",
        "align" => "center",
    ],
    "Nome Completo",
    "Email"
]); 

$table->setBody($data, [
    [
        "content" => "id",
        "align" => "center"
    ],
    "name",
    "email"
    ]
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/table-code-clay.css">
    <title>Document</title>
</head>
<body>
    <?= $table->print(); ?>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</html>

