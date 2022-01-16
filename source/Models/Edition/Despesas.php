<?php
	require_once("../Lib/Conn.php");
	require_once("../Lib/Ferramentas.php");
	class EdicaoDeDespesas{	
		private static $con;
		public function __construct(){
			self::$con = (new Conn())->getConn();
			$ferramentas = new Ferramentas;			
			if(isset($_POST['NomeFantasia'])){				
				$this->validacao($con, $ferramentas);
			}
			if(isset($_POST['excluir'])){				
				$this->excluir($con, $ferramentas);				
			}
		}
		private function validacao($con, $ferramentas){
			$data["descricao"] = $_POST["registrationDespesas_descricao"] ?? "";
			$data["tipo_despesa"] = $_POST["registrationDespesas_tipo_despesa"] ?? "";
			$data["valor"] = $_POST["registrationDespesas_valor"] ?? "";
			$data["vencimento_fatura"] = $_POST["registrationDespesas_vencimento_fatura"] ?? "";
			$data["status_pagamento"] = $_POST["registrationDespesas_status_pagamento"] ?? "";

			$data["descricao"] = $ferramentas->filtrando($data["descricao"]);
			$data["tipo_despesa"] = $ferramentas->filtrando($data["tipo_despesa"]);
			$data["valor"] = $ferramentas->filtrando($data["valor"]);
			$data["vencimento_fatura"] = $ferramentas->filtrando($data["vencimento_fatura"]);
			$data["status_pagamento"] = $ferramentas->filtrando($data["status_pagamento"]);

			$msg = ($data["descricao"] == "") ? "Digite a descrição" : "";
			$msg = ($msg == "") ? $msg = ($data["tipo_despesa"] == "") ? "Digite o tipo de despesa" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["valor"] == "") ? "Digite o valor" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["vencimento_fatura"] == "") ? "Digite o vencimento da fatura" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["status_pagamento"] == "") ? "Digite o status pagamento" : "" : $msg;			
			if($msg == ""){
				/*$this->atualizar($con, $data);*/
			}else{ echo json_encode($msg); }
		}
		/*private function atualizar($con, $dados){
			$sql = "UPDATE empresas SET nome=:nome, estado=:estado, cidade=:cidade, cnpj=:cnpj WHERE id=:id";
			$sql = $con->prepare($sql);
			$sql->bindParam(":nome", $dados['NomeFantasia']);
			$sql->bindParam(":estado", $dados['Estado']);
			$sql->bindParam(":cidade", $dados['Cidade']);
			$sql->bindParam(":cnpj", $dados['CNPJ']);
			$sql->bindParam(":id", $dados['id']);
			if($sql->execute()){
				echo json_encode("Dados editados com sucesso");
			}else{ echo json_encode("Erro ao edita"); }
		}		
		private function excluir($con, $ferramentas){			
			$id = $_POST['excluir'] ?? "";
			$nomeEmpresa = $_POST['nomeEmpresa'] ?? "";
			$id = $ferramentas->filtrando($id);
			$nomeEmpresa = $ferramentas->filtrando($nomeEmpresa);
			if($nomeEmpresa != "Exclusao_Confirmada"){				
				$fornecedores = $this->verificaFornecedores($con, $nomeEmpresa);
			}else{
				$fornecedores = "no";
			}
			
			$retorno = array();
			if($fornecedores == "no"){
				$sql = "DELETE FROM empresas WHERE id=:id";
				$sql = $con->prepare($sql);			
				$sql->bindParam(":id", $id);
				if($sql->execute()){
					$retorno["msg"] = "Exluido com sucesso";
				}else{ $retorno["msg"] = "Erro ao Exluir"; }
			}else{
				$retorno["msg"] = "Fornecedores";
				$retorno["Fornecedores"] = $fornecedores;
			}
			echo json_encode($retorno);
		}
		private function verificaFornecedores($con, $nomeEmpresa){				
			$sql = "SELECT * FROM fornecedores WHERE empresa LIKE :empresa";
			$sql = $con->prepare($sql);
			$nomeEmpresa = "%".$nomeEmpresa."%";
			$sql->bindParam(':empresa', $nomeEmpresa);
			if($sql->execute()){
				$result = $sql->fetchAll(PDO::FETCH_ASSOC);
				$fornecedores = array();
				$contador=0;				
				foreach($result as $retorno){
					$fornecedores[$contador] = $retorno["nome"];
					$contador++;
				}
				if($fornecedores == ""){
					return "no";
				}else{
					return $fornecedores;
				}				
			}else{
				echo json_encode("Erro");
			}			
		}*/
	}
	$edicaoDeDespesas = new EdicaoDeDespesas();
?>
