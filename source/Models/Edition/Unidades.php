<?php
	require_once("../Lib/Conn.php");
	require_once("../Lib/Ferramentas.php");
	class EdicaoDeUnidades{	
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
			$data["identificacao"] = $_POST["registrationUnidades_identificacao"] ?? "";
			$data["proprietario"] = $_POST["registrationUnidades_proprietario"] ?? "";
			$data["condominio"] = $_POST["registrationUnidades_condominio"] ?? "";
			$data["endereco"] = $_POST["registrationUnidades_endereco"] ?? "";

			$data["identificacao"] = $ferramentas->filtrando($data["identificacao"]);
			$data["proprietario"] = $ferramentas->filtrando($data["proprietario"]);
			$data["condominio"] = $ferramentas->filtrando($data["condominio"]);
			$data["endereco"] = $ferramentas->filtrando($data["endereco"]);

			$msg = ($data["identificacao"] == "") ? "Digite a identificação" : "";
			$msg = ($msg == "") ? $msg = ($data["proprietario"] == "") ? "Digite o nome do proprietário" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["condominio"] == "") ? "Digite o condomínio" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["endereco"] == "") ? "Digite o endereço" : "" : $msg;
			
			if($msg === ""){
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
	$edicaoDeUnidades = new EdicaoDeUnidades();
?>
