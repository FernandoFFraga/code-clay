<?php 
 
class Table{
	private $dataware;
	private $html;
	private $header;
	private $body;
	private $id;
	private $class;

	function __construct($class, $id){
		$this->id    = $id;
		$this->class = $class;
	}

	function renderTable(){

		$id = $this->id ? $this->id : ''; 			//Operador ternário
		$class = $this->class ? $this->class : '';  //Operador ternário

		$this->html  = "<table id='".$id."' class='".$this->class."'>
							<thead>
								".$this->header."
							</thead>
							<tbody>
								".$this->body."
							</tbody>
						</table>";
	}

	function setHeader($array){
		$count = count($array);

		$data = "<tr>";
		for ($i=0; $i < $count; $i++) {
			if (is_array($array[$i])) {
				$data .= "<th>".$array[$i][0]."</th>";
			} else {
				$data .= "<th nowrap>".$array[$i]."</th>";
			}
		}
		$data .= "</tr>";

		$this->header = $data;
	}

	function setBody($config, $dataware){
		$count = count($config);
		for ($i=0; $i < $dataware['count']; $i++) {
			$response .= "<tr id='".$this->id."-".$i."'>";
			for ($y=0; $y < $count; $y++) {
				if (is_array($config[$y])) {
					$response .= "<td id='".$this->id."-".$i."-".$y."' ".$config[$y][1].">".$dataware[$i][$config[$y][0]]."</td>";
				} else {
					$response .= "<td id='".$this->id."-".$i."-".$y."'>".$dataware[$i][$config[$y]]."</td>";
				}
			}
			$response .= "</tr>";
		}

		$this->body = $response;
	}

	function printTable(){
		$this->renderTable();
		echo $this->html;	
	}
}

?>