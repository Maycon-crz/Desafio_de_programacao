<?php
	require_once("../Lib/Conn.php");
	require_once("../Lib/Ferramentas.php");
	class EdicaoDeInquilinos{	
		private static $con;
		public function __construct(){
			self::$con = (new Conn())->getConn();
			$ferramentas = new Ferramentas;			
			if(isset($_POST["nome"])){
				$this->validacao(self::$con, $ferramentas);
			}
			if(isset($_POST["excluir"])){				
				$this->excluir(self::$con, $ferramentas);				
			}
		}
		private function validacao($con, $ferramentas){
			$data["id"] = $_POST["id"] ?? "";
			$data["nome"] = $_POST["nome"] ?? "";
			$data["idade"] = $_POST["idade"] ?? "";
			$data["sexo"] = $_POST["sexo"] ?? "";
			$data["telefone"] = $_POST["telefone"] ?? "";
			$data["email"] = $_POST["email"] ?? "";
			$data["unidade"] = $_POST["unidade"] ?? "";

			$data["id"] = $ferramentas->filtrando($data["id"]);
			$data["nome"] = $ferramentas->filtrando($data["nome"]);
			$data["idade"] = $ferramentas->filtrando($data["idade"]);
			$data["sexo"] = $ferramentas->filtrando($data["sexo"]);
			$data["telefone"] = $ferramentas->filtrando($data["telefone"]);
			$data["email"] = $ferramentas->filtrando($data["email"]);			
			$data["unidade"] = $ferramentas->filtrando($data["unidade"]);

			$msg = ($data["id"] == "") ? "Erro de ID entre em contato com o suporte!" : "";
			$msg = ($msg == "") ? $msg = ($data["nome"] == "") ? "Digite o Nome" : "" : $msg;
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
				$this->atualizar($con, $data);
			}else{ echo json_encode($msg); }
		}		
		private function atualizar($con, $data){
			$sql = "UPDATE inquilinos SET nome=:nome, idade=:idade, sexo=:sexo, telefone=:telefone, email=:email, unidade=:unidade WHERE id=:id";
			$sql = $con->prepare($sql);
			$sql->bindParam(":nome", $data["nome"]);
			$sql->bindParam(":idade", $data["idade"]);
			$sql->bindParam(":sexo", $data["sexo"]);
			$sql->bindParam(":telefone", $data["telefone"]);
			$sql->bindParam(":email", $data["email"]);
			$sql->bindParam(":unidade", $data["unidade"]);
			$sql->bindParam(":id", $data["id"]);
			if($sql->execute()){
				echo json_encode("Dados atualizados com sucesso!");
			}else{ echo json_encode("Erro ao atualizar"); }
		}
		private function excluir($con, $ferramentas){			
			$id = $_POST['excluir'] ?? "";
			$id = $ferramentas->filtrando($id);			
			$sql = "DELETE FROM inquilinos WHERE id=:id";
			$sql = $con->prepare($sql);			
			$sql->bindParam(":id", $id);
			if($sql->execute()){
				echo json_encode("Exluido com sucesso");
			}else{ echo json_encode("Erro ao Exluir"); }
		}
	}
	$edicaoDeInquilinos = new EdicaoDeInquilinos();
?>
