<pre><?php

require('./vendor/autoload.php');

use Src\Tools\Table;

$table = new Table([
    "itemId" => "id"
]);
$table->setHeader([
    "Nome",
    "Sobrenome",
    [
        "content" => "Idade",
        "align" => "right"
    ]
]);

$source = [
    [
        "id" => 1001,
        "name" => "Fernando",
        "surname" => "Fraga",
        "age" => 19
    ],
    [
        "id" => 1002,
        "name" => "Stefany",
        "surname" => "Decnop",
        "age" => 20
    ],
    [
        "id" => 1003,
        "name" => "Anderson",
        "surname" => "Asevedo",
        "age" => 20
    ],
    "count" => 3 //Opcional
];

$config = [
    "name",
    "surname",
    "age"
];

$table->setBody($source, $config);

print_r($table);

echo("</pre>");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/table-code-clay.css">
</head>
<body>
    <?= $table->print(); ?>
    
</body>
</html>