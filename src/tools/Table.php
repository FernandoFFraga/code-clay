<?php

namespace Src\Tools;

class Table
{
    /**
     * Var que irá receber as classes css que serão inclusas na tag table
     *
     * @var string
     */
    private $classes;

    /**
     * Var que irá receber o id que será usado para identificar os elementos
     *
     * @var string
     */
    private $id;

    /**
     * Define o padrão do atributo nowrap nas células.
     *
     * @var boolean
     */
    private $nowrap;

    /**
     * Define o padrão de alinhamento nas células
     * Valores: center|right|left
     * @var string
     */
    private $align;

    /**
     * Controlador para definir se as células deverão receber classes para 
     * identificação de colunas e linhas.
     * 
     * Ex: .table-row-1 .table-col-1
     *
     * @var boolean
     */
    private $tdClasses;

    /**
     * Controlador para definir se as células deverão receber ids para identi-
     * ficação única de célula.
     * 
     * Ex: #table-1-1
     *
     * @var boolean
     */
    private $tdId;

    /**
     * Controlador para definir se as linhas deverão receber ids para identifi-
     * cação única.
     * 
     * Ex: #table-1
     *
     * @var boolean
     */
    private $trId;

    /**
     * Var que irá guardar o cabeçalho em HTML
     *
     * @var string
     */
    public $header;

    /**
     * Var que irá guardar o corpo da tabela em HTML
     *
     * @var string
     */
    public $body;

    /**
     * Váriavel de controle que irá receber as mensagens de erro.
     *
     * @var string
     */
    private $error = 'No Errors';

    /**
     * Váriavel que irá receber o link com a referência de valor para
     * identificar a linha.
     *
     * @var string
     */
    private $itemId;

    /**
     * Váriavel que irá receber a tabela completa
     *
     * @var string
     */
    public $html;

    /**
     * Construi o objeto e define as configurações
     *
     * @param array $array
     * @return void
     */
    function __construct($array = array())
    {
       $this->id = $array['id'] ?? "table";
       $this->classes =  array_key_exists('classes', $array) ? $array['classes'] : "clay-table";
       $this->align = $array['align'] ?? 'center';
       $this->nowrap = array_key_exists('nowrap', $array) ? $array['nowrap'] : true;
       $this->tdClasses = array_key_exists('tdClasses', $array) ? $array['tdClasses'] : true;
       $this->tdId = array_key_exists('tdId', $array) ? $array['tdId'] : true;
       $this->trId = array_key_exists('trId', $array) ? $array['trId'] : true;
       $this->itemId = $array['itemId'] ?? "";
    }
    
    /**
     * Define as classes css inseridas na tag tabela
     *
     * @param string $value
     * @return void
     */
    public function setClasses($value = "clay-table")
    {
        $this->classes = $value;
    }

    /**
     * Define o id que será utilizado para identificar linhas e colunas
     *
     * @param string $value
     * @return void
     */
    public function setId($value = "table")
    {
        $this->id = $value;
    }


    /**
     * Função que define o cabeçalho da tabela
     *
     * @param array $headers
     * @return void
     */
    public function setHeader($headers = array())
    {
        if (is_array($headers)) {
            $count = count($headers);
            if ($count) {
                $nowrap = $this->nowrap ? "nowrap" : "";
                $align = $this->align ?? "left";

                $header = "<tr>";
                for ($i=0; $i < $count; $i++) {
                    if (is_array($headers[$i])) {
                        $customNowrap = $headers[$i]['nowrap'] ? "nowrap" : $nowrap;
                        $customAlign = $headers[$i]['align'] ?? $align; 
                        $customClass = $headers[$i]['class'] ? "class=\"{$headers[$i]['class']}\"" : "";

                        if (!$headers[$i]['content']) {
                            $this->error = "Não foi passado o conteúdo do {$i}° do cabeçalho!";
                        }

                        $header .= "
                            <th id='{$this->id}-th-{$i}' {$customClass} align='{$customAlign}' {$customNowrap}>
                                {$headers[$i]['content']}
                            </th>
                        ";

                    } else {
                        $header .= "
                            <th id='{$this->id}-th-{$i}' align='{$align}' {$nowrap}>
                                {$headers[$i]}
                            </th>
                        ";
                    }        
                }
                $header .= "</tr>";

                $this->header = $header;

            } else {
                $this->error = "O header precisa ter ao menos um elemento!";
            }
        } else {
            $this->error = "O paramêtro passado para o header não é um array";
        }
    }

    /**
     * Função que irá definir o body
     *
     * Src - Irá receber o array com os dados
     * Config - Irá receber o array com as informações de configuração
     * 
     * @param array $src
     * @param array $config
     * @return void
     */
    public function setBody($src = array(), $config = array())
    {
        if (is_array($src)) {
            $rows = $src['count'] ?? count($src);
            $cols = count($config);
            $body = "";

            $nowrap = $this->nowrap ? "nowrap" : "";
            $align = $this->align ?? "left";

            for ($y=0; $y < $rows; $y++) {
                $trId = $this->trId ? "id='{$this->id}-row-{$y}'" : "";

                $itemId = $this->itemId ? "data-id='{$src[$y][$this->itemId]}'" : ""; 
                $body .= "<tr {$trId} {$itemId}>";
                    for ($x=0; $x < $cols; $x++) {
                        $class = $this->tdClasses ? "{$this->id}-row-{$y} {$this->id}-col-{$x}" : "";
                        $id = $this->tdId ? "id='{$this->id}-{$y}-{$x}'" : "";

                        if (is_array($config[$x])) {
                            if (!$config['content']) {
                                $this->error = "Não foi passada a fonte para a coluna: {$x}";
                            }

                            $customAlign = $config[$x]['align'] ?? $align;

                            if (array_key_exists('nowrap', $config[$x])) {
                                $customNowrap = ($config[$x]['nowrap']) ? "nowrap" : "";
                            } else {
                                $customNowrap = $nowrap;
                            }

                            if (array_key_exists('tdId', $config[$x])) {
                                $id = ($config[$x]['tdId']) ? "id='{$this->id}-{$y}-{$x}'" : "";
                            }

                            if (array_key_exists('tdClasses', $config[$x])) {
                                $class = ($config[$x]['tdClasses']) ? "{$this->id}-row-{$y} {$this->id}-col-{$x}" : "";
                            }

                            $style = $config[$x]['style'] ? "style='{$config[$x]['style']}'" : "";

                            $class = $config[$x]['addClasses'] ? $config[$x]['addClasses']." ".$class : $class; 
                            $class = $class ? "class='{$class}'" : "";
                            $body .= "
                                <td {$class} {$id} align='{$customAlign}' {$style} {$customNowrap}>
                                    ".$src[$y][$config[$x]['content']]."
                                </td>
                            ";
                        } else {
                            $class = $class ? "class='{$class}'" : "";
                            $body .= "<td {$class} {$id} align='{$align}' {$nowrap}>".$src[$y][$config[$x]]."</td>";
                        }
                    }
                $body .= "</tr>";
            }

            $this->body = $body;
        } else {
            $this->error = "O paramêtro passado para o header não é um array";
        }
    }

    /**
     * Monta a tabela
     *
     * @return string $html
     */
    public function print(){
        $id = $this->id ? "id='{$this->id}'" : "";
        $class = $this->classes ? "class='{$this->classes}'" : "";

        $this->html  = "
            <table {$id} {$class}>
                <thead>
                    {$this->header}
                </thead>
                <tbody>
                    {$this->body}
                </tbody>
            </table>";

        return $this->html;
    }

    /**
     * Função que retorna os erros
     *
     * @return void
     */
    public function error()
    {
        return $this->error;
    }
}