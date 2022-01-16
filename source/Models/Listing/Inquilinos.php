<?php
	require_once("../Lib/Conn.php");
	require_once("../Lib/Ferramentas.php");	
	class ListagemDeInquilinos{
		private static $con;
		public function __construct(){
			self::$con = (new Conn())->getConn();
			$ferramentas = new Ferramentas;
			if(isset($_POST["listar"])){
				$this->listagem(self::$con, $ferramentas);
			}
		}	
		private function listagem($con, $ferramentas){
			$contador = $ferramentas->filtrando($_POST["listar"]);
			if(is_numeric($contador)){
				$sql = "SELECT * FROM inquilinos WHERE 1=1 ORDER BY id DESC LIMIT :qtd";
		        $sql = $con->prepare($sql);
		        $sql->bindParam(":qtd", $contador, PDO::PARAM_INT);
				if($sql->execute()){
					$result = $sql->fetchAll(PDO::FETCH_ASSOC);
					$retorno = array();
					$contador=0;
					foreach($result as $retornando){
						$retorno[$contador]["id"] = $retornando["id"];
						$retorno[$contador]["nome"] = $retornando["nome"];
						$retorno[$contador]["idade"] = $retornando["idade"];
						$retorno[$contador]["sexo"] = $retornando["sexo"];
						$retorno[$contador]["telefone"] = $retornando["telefone"];
						$retorno[$contador]["email"] = $retornando["email"];
						$retorno[$contador]["unidade"] = $retornando["unidade"];
						$contador++;
					}
					echo json_encode($retorno);
				}else{ echo json_encode("Erro ao Listar Inquilinos!"); }
			}else{ echo json_encode("Erro ao Listar Inquilinos!"); }
		}
	}
	$listagemDeInquilinos = new ListagemDeInquilinos();
?>