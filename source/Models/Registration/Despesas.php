<?php 
	require_once("../Lib/Conn.php"); 
	require_once("../Lib/Ferramentas.php"); 

	class RegistrationDespesas{
		public function __construct(){
			$ferramentas = new Ferramentas();
			if(isset($_POST['registrationDespesas_descricao'])){
				$this->validation($ferramentas);
			}
			if(isset($_POST['selectUnidades'])){
				$this->selectUnidades(self::$con);
			}
		}
		private function validation($ferramentas){
			$descricao = $_POST["registrationDespesas_descricao"] ?? "";
			$tipo_despesa = $_POST["registrationDespesas_tipo_despesa"] ?? "";
			$valor = $_POST["registrationDespesas_valor"] ?? "";
			$vencimento_fatura = $_POST["registrationDespesas_vencimento_fatura"] ?? "";
			$status_pagamento = $_POST["registrationDespesas_status_pagamento"] ?? "";

			$descricao = $ferramentas->filtrando($descricao);
			$tipo_despesa = $ferramentas->filtrando($tipo_despesa);
			$valor = $ferramentas->filtrando($valor);
			$vencimento_fatura = $ferramentas->filtrando($vencimento_fatura);
			$status_pagamento = $ferramentas->filtrando($status_pagamento);

			$msg = ($descricao == "") ? "Digite a descrição" : "";
			$msg = ($msg == "") ? $msg = ($tipo_despesa == "") ? "Digite o tipo de despesa" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($valor == "") ? "Digite o valor" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($vencimento_fatura == "") ? "Digite o vencimento da fatura" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($status_pagamento == "") ? "Digite o status pagamento" : "" : $msg;
			echo json_encode($msg);
		}
		/*private function cadastro($data){
			$sql = "INSERT INTO unidade(identificacao, proprietario, condominio, endereco) VALUES(:identificacao, :proprietario, :condominio, :endereco)";
			$sql = $con->prepare($sql);
			$sql->bindParam(":identificacao", $data["identificacao"]);
			$sql->bindParam(":proprietario", $data["proprietario"]);
			$sql->bindParam(":condominio", $data["condominio"]);
			$sql->bindParam(":endereco", $data["endereco"]);
			if($sql->execute()){
				echo json_encode("Unidade Cadastrada com sucesso!");
			}else{ echo json_encode("Erro ao cadastrar Unidade!"); }
		}*/
		private function selectUnidades($con){
			$sql = "SELECT * FROM unidades";
			$sql = $con->prepare($sql);
			if($sql->execute()){
				$data = $sql->fetchAll(PDO::FETCH_ASSOC);
				$retorno = array();
				$contador=0;
				foreach($data as $retornando){
					$retorno[$contador]["identificacao"] = $retornando["identificacao"];
					$retorno[$contador]["proprietario"] = $retornando["proprietario"];
					$retorno[$contador]["condominio"] = $retornando["condominio"];
					$retorno[$contador]["endereco"] = $retornando["endereco"];
					$contador++;
				}
				echo json_encode($retorno);
			}else{ echo json_encode("Erro ao listar Unidade!"); }
		}
	}
	$registrationDespesas = new RegistrationDespesas();