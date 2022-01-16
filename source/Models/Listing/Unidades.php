<?php
	require_once("../Lib/Conn.php");
	require_once("../Lib/Ferramentas.php");	
	class ListagemDeUnidades{
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
				$sql = "SELECT * FROM unidades WHERE 1=1 ORDER BY id DESC LIMIT :qtd";
		        $sql = $con->prepare($sql);
		        $sql->bindParam(":qtd", $contador, PDO::PARAM_INT);
				if($sql->execute()){
					$result = $sql->fetchAll(PDO::FETCH_ASSOC);
					$retorno = array();
					$contador=0;
					foreach($result as $retornando){
						$retorno[$contador]["id"] = $retornando["id"];
						$retorno[$contador]["identificacao"] = $retornando["identificacao"];
						$retorno[$contador]["proprietario"] = $retornando["proprietario"];
						$retorno[$contador]["condominio"] = $retornando["condominio"];
						$retorno[$contador]["endereco"] = $retornando["endereco"];
						$contador++;
					}
					echo json_encode($retorno);
				}else{ echo json_encode("Erro ao Listar Unidades!"); }
			}else{ echo json_encode("Erro ao Listar Unidades!"); }
		}
	}
	$listagemDeUnidades = new ListagemDeUnidades();
?>