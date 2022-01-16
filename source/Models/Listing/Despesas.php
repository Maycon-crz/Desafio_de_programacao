<?php
	require_once("../Lib/Conn.php");
	require_once("../Lib/Ferramentas.php");	
	class ListagemDeDespesas{
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
				$sql = "SELECT * FROM despesas WHERE 1=1 ORDER BY id DESC LIMIT :qtd";
		        $sql = $con->prepare($sql);
		        $sql->bindParam(":qtd", $contador, PDO::PARAM_INT);
				if($sql->execute()){
					$result = $sql->fetchAll(PDO::FETCH_ASSOC);
					$retorno = array();
					$contador=0;
					foreach($result as $retornando){
						$retorno[$contador]["id"] = $retornando["id"];
						$retorno[$contador]["descricao"] = $retornando["descricao"];
						$retorno[$contador]["tipo_despesa"] = $retornando["tipo_despesa"];
						$retorno[$contador]["valor"] = $retornando["valor"];
						$retorno[$contador]["vencimento_fatura"] = $retornando["vencimento_fatura"];
						$retorno[$contador]["status_pagamento"] = $retornando["status_pagamento"];
						$contador++;
					}
					echo json_encode($retorno);
				}else{ echo json_encode("Erro ao Listar Despesas!"); }
			}else{ echo json_encode("Erro ao Listar Despesas!"); }
		}
	}
	$listagemDeDespesas = new ListagemDeDespesas();
?>