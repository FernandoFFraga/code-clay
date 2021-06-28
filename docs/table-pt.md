# Tabela    
<p>Essa ferramenta tem por objetivo estruturar os dados recebidos de um database em tabelas de forma prática e replicável.</p>

<br>

# Uso
<p> Siga as instruções a seguir:

## Namespace

```php

require('./vendor/autoload.php');

use Src\Tools\Table;

```

## Método de Construção
<p>Para a construção do objeto é necessário passar alguns paramêtros dentro de um array:</p>

<b>Chave - Descrição (padrão)</b>

* <b>id</b> - Identificador da tabela <i>(#table)</i>
* <b>classes</b> - Contém todas as classes da tabela <i>(.clay-table)</i>
* <b>align</b> - Padrão de alinhamento das células <i>(center)</i>
* <b>nowrap</b> - Padrão de nowrap das células <i>(true)</i>
* <b>tdClasses</b> - Define se as células irão receber classes de identificação <i>(true)</i>
* <b>tdId</b> - Define se as células irão receber id's para identificação <i>(true)</i>
* <b>trId</b> - Define se as linhas irão receber id's de identificação <i>(true)</i>
* <b>itemId</b> - Define a key de origem dos dados de identificação externa da linha. Ex: Código de um produto <i>(Empty)</i>

<b>Para construção com dados padrão:</b>
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

<b>Para construção com dados customizados:</b>
```php

require('./vendor/autoload.php');

use Src\Tools\Table;

$table = new Table([
    "id" => "prods",
    "align" => "right"
]);

//Sendo inseridos as configurações necessárias de acordo com as keys

```

## Definir cabeçalho
<p>Para definir o cabeçalho da tabela você irá utilizar o seguinte método, passando o valor de cada coluna em um array: </p>

```php

$table->setHeader([
    "Name",
    "Surname",
    "Age"
]);

```

<b>Resultado:</b>

| Name | Surname | Age |
|------|---------|-----|
| ...  | ...     | ... |

<b>Customizar</b>
<p>O exemplo acima considera as configurações padrões. Para customizar cada uma das colunas utilize uma array na posição de cada valor que deseja alterar, e passe o nome que será impresso por uma key content. </p>

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

<b>Resultado:</b>

| Name | Surname | Age |
|:----:|:-------:|----:|
| ...  | ...     | ... |

<i>Obs: O objeto utiliza uma hierárquia de configuração, por isso, caso não seja passado algum dos valores listados acima, ele utilizará o padrão definido na construção do objeto.</i>

<br>

## Definir body
<p>Para construir o corpo da tabela você deverá passar dois arrays: </p>
 
 * Array Source - Irá conter os dados da tabela
 * Array Config - Irá conter a configuração e bind das colunas

 <b>Exemplo de array source:</b>

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

<i> Obs 1: Geralmente esse array será produto de uma consulta ao banco de dados, caso o parâmetro "count" não seja passado ele irá contar automáticamente. </i>

<i> Obs 2: Os array_keys desse array serão utilizados no array de configuração. </i>

<br>

<b> Exemplo de array de configuração: </b>

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

<i>Obs 1: Seguindo o mesmo padrão do cabeçalho, para definir customizações para cada coluna, basta passar um array na posição referente a coluna.</i>

<i>Obs 2: Caso não seja passado algum paramêtro de customização, será utilizado o valor padrão definido na construção do objeto.</i>

<br>

<b>Montagem final:</b>

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

## Montar tabela
<p>Não é necessário passar nenhum paramêtro para esse método, e ele retornará a tag <b>&lt;table></b> completa em HTML</p>

```php

$tableHTML = $table->print(); //Storage

//or

<?= $table->print(); ?> //Echo

```

## Debug
<p>A classe da tabela possui um método que retorna a mensagem de erro correspondente a cada situação, utilize dessa forma: <p>

```php

<?= $table->error(); ?> //Echo

```

## Métodos adicionais
<p>Caso sejá necessário alterar o id ou as classes de uma tabela, utilize os seguintes métodos: </p>

```php

$table->setId("users"); //Contém o novo id

// and

$table->setClasses("class1 class2"); //Classes css
```

## Identificador de linhas
<p>O parâmetro <b> <i>itemId</i> </b> passado no momento da criação irá inserir um atributo chamado  <b> <i>data-id</i></b> dentro de cada linha, assim podendo ser utilizado junto de javascript para o que seja necessário.</p>

```html

<tbody>
    <tr data-id="1001">...</tr>
    <tr data-id="1002">...</tr>
    <tr data-id="1003">...</tr>
</tbody>

```

## Stylesheet
<p>Está disponivel um estilo amigável para as tabelas com class="clay-table" no arquivo:</p>

```bash
├── css
│   └── table-code-clay.css
│
```

## Versão
<p>Essa ferramenta se encontra na versão <b>1.0</b> </p>