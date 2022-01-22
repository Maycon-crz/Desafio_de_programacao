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
			$parametro = $ferramentas->filtrando($_POST["listar"]);
			$filtro = $ferramentas->filtrando($_POST["filtro"]);
	    	switch($parametro){
	    		case is_numeric($parametro):
	    			$sql = "SELECT * FROM despesas WHERE 1=1 ORDER BY id DESC LIMIT :qtd";
			        $sql = $con->prepare($sql);
			        $sql->bindParam(":qtd", $parametro, PDO::PARAM_INT);
	    		break;
	    		case "Unidades":
	    			$sql = "SELECT * FROM despesas WHERE unidade=:unidade ORDER BY id DESC";
			        $sql = $con->prepare($sql);
			        $sql->bindParam(":unidade", $filtro, PDO::PARAM_INT);
	    		break;
	    		case "Vencidas":
	    			date_default_timezone_set('America/Sao_Paulo');
	    			$agora = date('Y-m-d H:i:s');
					echo json_encode($agora);
	    			// $sql = "SELECT * FROM despesas WHERE unidade=:unidade ORDER BY id DESC";
			     //    $sql = $con->prepare($sql);
	    		break;
	    	}
			if($sql->execute()){
				$result = $sql->fetchAll(PDO::FETCH_ASSOC);
				$retorno = array();
				$contador=0;
				foreach($result as $retornando){
					$retorno[$contador]["id"] = $retornando["id"];
					$retorno[$contador]["unidade"] = $retornando["unidade"];
					$retorno[$contador]["descricao"] = $retornando["descricao"];
					$retorno[$contador]["tipo_despesa"] = $retornando["tipo_despesa"];
					$retorno[$contador]["valor"] = $retornando["valor"];
					$retorno[$contador]["vencimento_fatura"] = $retornando["vencimento_fatura"];
					$retorno[$contador]["status_pagamento"] = $retornando["status_pagamento"];
					$contador++;
				}
				echo json_encode($retorno);
			}else{ echo json_encode("Erro ao Listar Despesas!"); }			
		}
	}
	$listagemDeDespesas = new ListagemDeDespesas();
?>