<?php
	require_once("../Lib/Conn.php");
	require_once("../Lib/Ferramentas.php");
	class EdicaoDeInquilinos{	
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
			$data["nome"] = $_POST["registrationInquilinos_nome"] ?? "";
			$data["idade"] = $_POST["registrationInquilinos_idade"] ?? "";
			$data["sexo"] = $_POST["registrationInquilinos_sexo"] ?? "";
			$data["telefone"] = $_POST["registrationInquilinos_telefone"] ?? "";
			$data["email"] = $_POST["registrationInquilinos_email"] ?? "";
			$data["unidade"] = $_POST["registrationInquilinos_Unidade"] ?? "";

			$data["nome"] = $ferramentas->filtrando($data["nome"]);
			$data["idade"] = $ferramentas->filtrando($data["idade"]);
			$data["sexo"] = $ferramentas->filtrando($data["sexo"]);
			$data["telefone"] = $ferramentas->filtrando($data["telefone"]);
			$data["email"] = $ferramentas->filtrando($data["email"]);			
			$data["unidade"] = $ferramentas->filtrando($data["unidade"]);

			$msg = ($data["nome"] == "") ? "Digite o Nome" : "";
			$msg = ($msg == "") ? $msg = ($data["idade"] == "") ? "Digite a Idade" : "" : $msg;
			$msg = ($msg == "") ? $msg = (!is_numeric($data["idade"])) ? "Idade inválida" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["sexo"] == "") ? "Digite selecione o Sexo" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["telefone"] == "") ? "Digite o Telefone" : "" : $msg;			
			$msg = ($msg == "") ? $msg = (strlen($data["telefone"]) > 15 || strlen($data["telefone"]) < 12) ? "Telefone inválido" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["email"] == "") ? "Digite o E-mail" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["unidade"] == "Selecione a Unidade:") ? "Digite selecione a unidade" : "" : $msg;			
			$data["email"] = filter_var($data["email"], FILTER_SANITIZE_EMAIL);
			if(!filter_var($data["email"], FILTER_VALIDATE_EMAIL)){
				$msg = ($msg == "") ? $msg = "E-mail inválido!" : $msg;
			}
			if($msg == ""){
				/*$this->cadastro($con, $data);*/
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
	$edicaoDeInquilinos = new EdicaoDeInquilinos();
?>
