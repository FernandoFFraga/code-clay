# Table    
<p>This tool aims to structure the data received from a database into tables in a practical and replicable way.</p>

<br>

# Utilization 
<p> Follow the instructions below: </p>

## Namespace

```php

require('./vendor/autoload.php');

use Src\Tools\Table;

```

## Method of construction 
<p>To construct the object, it is necessary to insert some parameters inside an array:</p>

<b>Key – Description (default)  </b>

* <b>id</b> - Table identifier  <i>(#table)</i>
* <b>classes</b> - Contains all classes from the table <i>(.clay-table)</i>
* <b>align</b> - Cell alignment pattern <i>(center)</i>
* <b>nowrap</b> - Cell nowrap pattern <i>(true)</i>
* <b>tdClasses</b> - Defines if the cells will receive identification classes <i>(true)</i>
* <b>tdId</b> - Defines if the cells will receive id’s for identification <i>(true)</i>
* <b>trId</b> - Defines if the rows will receive id’s for identification <i>(true)</i>
* <b>itemId</b> - Defines the source key of the line's external identification data. <i>(Empty)</i>

<b>For building with default data:</b>

```php

require('./vendor/autoload.php');

use Src\Tools\Table;

$table = new Table();

//or

$config = [
    "id" => "table",
    "classes" => "clay-table",
    "align" => "center",
    "nowrap" => true,
    "tdClasses" => true,
    "tdId" => true,
    "trId" => true,
    "itemId" => "",
];

$table = new Table($config);

```

<b>For building with custom data:</b>

```php

require('./vendor/autoload.php');

use Src\Tools\Table;

$table = new Table([
    "id" => "prods",
    "align" => "right"
]);

//Sendo inseridos as configurações necessárias de acordo com as keys

```

## Definition of header
<p>To define the table header you going to use the following method, passing the data of each column in an array: </p>

```php

$table->setHeader([
    "Name",
    "Surname",
    "Age"
]);

```

<b>Preview:</b>

| Name | Surname | Age |
|------|---------|-----|
| ...  | ...     | ... |

<b>Customize</b>
<p>The example above assumes the default settings. To customize each of the columns use an array at the position of each data you want to change, and enter the data that going to be printed by a key content. </p>

```php

$table->setHeader([
    "Name",
    "Surname",
    [
        "content" => "age",
        "align" => "right",
        "nowrap" => false,
        "class" => "title-th" //Class HTML 
    ]
]);

```

<b>Preview:</b>

| Name | Surname | Age |
|:----:|:-------:|----:|
| ...  | ...     | ... |

<i>Note: The object uses a configuration hierarchy, so if you do not enter any of the data listed above, it will use the default defined in the construction of the object.</i>

<br>

## Definition of body
<p>To build the table’s body you must define two arrays: </p>
 
 * Array Source - Going to contain the table data
 * Array Config - It going to contain the configuration and bind of the columns

 <b>Example of array source:</b>

 ```php

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
        "age" => 21
    ],
    [
        "id" => 1003,
        "name" => "Anderson",
        "surname" => "Asevedo",
        "age" => 20
    ],
    "count" => 3 //Opcional
];

 ```

<i>Note one: Usually this array will be the product of a database consult, if the "count" parameter is not defined it will automatically count.</i>

<i>Note two: The array_keys of this array going to be used in the configuration array. </i>

<br>

<b> Example of configuration array: </b>

```php

$config = [
    "name",
    "surname",
    "age"
];

//or

$config = [
    "name", //array_key
    "surname", //array_key
    [
        "content" => "age", //array_key
        "nowrap" => false,
        "tdId" => false,
        "tdClasses" => false,
        "style" => "color: red;", //inject css
        "addClasses" => "table-custom", //css class 
        "align" => "left"
    ]
];

```

<i>Note one: Following the same pattern of the header, to define customizations for each column, just insert an array in the position referring to the column.</i>

<i>Note two: If no customization parameter is defined, the default value defined in the construction of the object will be used.</i>

<br>

<b>Ultimate modeling:</b>

```php

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

```

## Table montage
<p>It is not necessary to enter any parameter for this method, it will return the complete <b>&lt;table></b> tag in HTML.</p>

```php

$tableHTML = $table->print(); //Storage

//or

<?= $table->print(); ?> //Echo

```

## Debug
<p>The table class has a method that returns the error message corresponding to each situation. Use in that way:<p>

```php

<?= $table->error(); ?> //Echo

```

## Additional Methods
<p>In case it is necessary to change the id or classes of a table, use the following methods: </p>

```php

$table->setId("users"); //Contém o novo id

// and

$table->setClasses("class1 class2"); //Classes css
```

## Line identifier
<p>The <b> <i>itemId</i> </b> parameter defined at creation time going to insert an attribute called <b> <i>data-id</i> </b> inside each row, so it can be used together with javascript for whatever is needed.</p>

```html

<tbody>
    <tr data-id="1001">...</tr>
    <tr data-id="1002">...</tr>
    <tr data-id="1003">...</tr>
</tbody>

```

## Stylesheet
<p>A style for tables with class = "clay-table" is available in the file:</p>

```bash
├── css
│   └── table-code-clay.css
│
```

## Versão
<p>This tool is in version <b>1.0</b> </p>