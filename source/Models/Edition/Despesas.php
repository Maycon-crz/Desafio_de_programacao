<?php
	require_once("../Lib/Conn.php");
	require_once("../Lib/Ferramentas.php");
	class EdicaoDeDespesas{	
		private static $con;
		public function __construct(){
			self::$con = (new Conn())->getConn();
			$ferramentas = new Ferramentas;			
			if(isset($_POST['descricao'])){				
				$this->validacao(self::$con, $ferramentas);
			}
			if(isset($_POST['excluir'])){				
				$this->excluir(self::$con, $ferramentas);				
			}
		}
		private function validacao($con, $ferramentas){
			$data["id"] = $_POST["id"] ?? "";
			$data["unidade"] = $_POST["unidade"] ?? "";
			$data["descricao"] = $_POST["descricao"] ?? "";
			$data["tipo_despesa"] = $_POST["tipo_despesa"] ?? "";
			$data["valor"] = $_POST["valor"] ?? "";
			$data["vencimento_fatura"] = $_POST["vencimento_fatura"] ?? "";
			$data["status_pagamento"] = $_POST["status_pagamento"] ?? "";

			$data["id"] = $ferramentas->filtrando($data["id"]);
			$data["unidade"] = $ferramentas->filtrando($data["unidade"]);
			$data["descricao"] = $ferramentas->filtrando($data["descricao"]);
			$data["tipo_despesa"] = $ferramentas->filtrando($data["tipo_despesa"]);
			$data["valor"] = $ferramentas->filtrando($data["valor"]);
			$data["vencimento_fatura"] = $ferramentas->filtrando($data["vencimento_fatura"]);
			$data["status_pagamento"] = $ferramentas->filtrando($data["status_pagamento"]);

			$msg = ($data["id"] == "") ? "Erro de ID entre em contato com o suporte!" : "";
			$msg = ($msg == "") ? $msg = ($data["unidade"] == "") ? "Digite a unidade!" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["descricao"] == "") ? "Digite a descrição!" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["tipo_despesa"] == "") ? "Digite o tipo de despesa!" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["valor"] == "") ? "Digite o valor!" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["vencimento_fatura"] == "") ? "Digite o vencimento da fatura!" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["status_pagamento"] == "") ? "Digite o status pagamento!" : "" : $msg;			
			if($msg == ""){
				$this->atualizar($con, $data);				
			}else{ echo json_encode($msg); }
		}
		private function atualizar($con, $data){
			$sql = "UPDATE despesas SET unidade=:unidade, descricao=:descricao, tipo_despesa=:tipo_despesa, valor=:valor, vencimento_fatura=:vencimento_fatura, status_pagamento=:status_pagamento WHERE id=:id";
			$sql = $con->prepare($sql);
			$sql->bindParam(":unidade", $data["unidade"]);
			$sql->bindParam(":descricao", $data["descricao"]);
			$sql->bindParam(":tipo_despesa", $data["tipo_despesa"]);
			$sql->bindParam(":valor", $data["valor"]);
			$sql->bindParam(":vencimento_fatura", $data["vencimento_fatura"]);
			$sql->bindParam(":status_pagamento", $data["status_pagamento"]);
			$sql->bindParam(":id", $data["id"]);
			if($sql->execute()){
				echo json_encode("Dados atualizados com sucesso!");
			}else{ echo json_encode("Erro ao atualizar!"); }
		}		
		private function excluir($con, $ferramentas){			
			$id = $_POST['excluir'] ?? "";
			$id = $ferramentas->filtrando($id);			
			$sql = "DELETE FROM despesas WHERE id=:id";
			$sql = $con->prepare($sql);			
			$sql->bindParam(":id", $id);
			if($sql->execute()){
				echo json_encode("Exluido com sucesso!");
			}else{ echo json_encode("Erro ao Exluir!"); }
		}
	}
	$edicaoDeDespesas = new EdicaoDeDespesas();
?>
