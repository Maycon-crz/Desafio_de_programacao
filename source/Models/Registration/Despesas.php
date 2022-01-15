<?php 
	require_once("../Lib/Conn.php"); 
	require_once("../Lib/Ferramentas.php"); 

	class RegistrationDespesas{
		private static $con;
		public function __construct(){
			self::$con = (new Conn())->getConn();
			$ferramentas = new Ferramentas();
			if(isset($_POST['registrationDespesas_descricao'])){
				$this->validation(self::$con, $ferramentas);
			}
		}
		private function validation($con, $ferramentas){
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
				$this->cadastro($con, $data);
			}else{ echo json_encode($msg); }
		}
		private function cadastro($con, $data){
			$sql = "INSERT INTO despesas(descricao, tipo_despesa, valor, vencimento_fatura, status_pagamento) VALUES(:descricao, :tipo_despesa, :valor, :vencimento_fatura, :status_pagamento)";
			$sql = $con->prepare($sql);
			$sql->bindParam(":descricao", $data["descricao"]);
			$sql->bindParam(":tipo_despesa", $data["tipo_despesa"]);
			$sql->bindParam(":valor", $data["valor"]);
			$sql->bindParam(":vencimento_fatura", $data["vencimento_fatura"]);
			$sql->bindParam(":status_pagamento", $data["status_pagamento"]);
			if($sql->execute()){
				echo json_encode("Despesa Cadastrada com sucesso!");
			}else{ echo json_encode("Erro ao cadastrar Despesa!"); }
		}
	}
	$registrationDespesas = new RegistrationDespesas();