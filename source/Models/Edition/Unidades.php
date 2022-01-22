<?php
	require_once("../Lib/Conn.php");
	require_once("../Lib/Ferramentas.php");
	class EdicaoDeUnidades{	
		private static $con;
		public function __construct(){
			self::$con = (new Conn())->getConn();
			$ferramentas = new Ferramentas;			
			if(isset($_POST['identificacao'])){				
				$this->validacao(self::$con, $ferramentas);
			}
			if(isset($_POST['excluir'])){				
				$this->excluir(self::$con, $ferramentas);
			}
		}
		private function validacao($con, $ferramentas){
			$data["id"] = $_POST["id"] ?? "";
			$data["identificacao"] = $_POST["identificacao"] ?? "";
			$data["proprietario"] = $_POST["proprietario"] ?? "";
			$data["condominio"] = $_POST["condominio"] ?? "";
			$data["endereco"] = $_POST["endereco"] ?? "";

			$data["id"] = $ferramentas->filtrando($data["id"]);
			$data["identificacao"] = $ferramentas->filtrando($data["identificacao"]);
			$data["proprietario"] = $ferramentas->filtrando($data["proprietario"]);
			$data["condominio"] = $ferramentas->filtrando($data["condominio"]);
			$data["endereco"] = $ferramentas->filtrando($data["endereco"]);

			$msg = ($data["id"] == "") ? "Erro de ID entre em contato com o suporte!" : "";
			$msg = ($msg == "") ? $msg = ($data["identificacao"] == "") ? "Digite a identificação!" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["proprietario"] == "") ? "Digite o nome do proprietário!" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["condominio"] == "") ? "Digite o condomínio!" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($data["endereco"] == "") ? "Digite o endereço!" : "" : $msg;
			
			if($msg === ""){
				$this->atualizar($con, $data);
			}else{ echo json_encode($msg); }
		}
		private function atualizar($con, $data){
			$sql = "UPDATE unidades SET identificacao=:identificacao, proprietario=:proprietario, condominio=:condominio, endereco=:endereco WHERE id=:id";
			$sql = $con->prepare($sql);
			$sql->bindParam(":identificacao", $data["identificacao"]);
			$sql->bindParam(":proprietario", $data["proprietario"]);
			$sql->bindParam(":condominio", $data["condominio"]);
			$sql->bindParam(":endereco", $data["endereco"]);
			$sql->bindParam(":id", $data["id"]);
			if($sql->execute()){
				echo json_encode("Dados atualizados com sucesso!");
			}else{ echo json_encode("Erro ao atualizar"); }
		}
		private function excluir($con, $ferramentas){
			$id = $_POST['excluir'] ?? "";
			$id = $ferramentas->filtrando($id);			
			$sql = "DELETE FROM unidades WHERE identificacao=:identificacao";
			$sql = $con->prepare($sql);
			$sql->bindParam(":identificacao", $id);
			if($sql->execute()){
				echo json_encode("Exluido com sucesso!");
			}else{ echo json_encode("Erro ao Exluir, pode ser necessário excluir primeiro inquilinos e/ou despesas relacionadas a unidade!"); }				
		}
	}
	$edicaoDeUnidades = new EdicaoDeUnidades();
?>
