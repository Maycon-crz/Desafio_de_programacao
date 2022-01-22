<?php 
	require_once("../Lib/Conn.php"); 
	require_once("../Lib/Ferramentas.php"); 
	
	class RegistrationInquilinos{
		private static $con;
		public function __construct(){
			self::$con = (new Conn())->getConn();
			$ferramentas = new Ferramentas();			
			if(isset($_POST['nome'])){
				$this->validation(self::$con, $ferramentas);
			}
			if(isset($_POST['selectUnidades'])){
				$this->selectUnidades(self::$con);
			}
		}
		private function selectUnidades($con){
			$sql = "SELECT * FROM unidades";
			$sql = $con->prepare($sql);
			if($sql->execute()){
				$data = $sql->fetchAll(PDO::FETCH_ASSOC);
				$retorno = array();
				$contador=0;
				foreach($data as $retornando){
					$retorno[$contador]["id"] = $retornando["id"];
					$retorno[$contador]["identificacao"] = $retornando["identificacao"];
					$retorno[$contador]["proprietario"] = $retornando["proprietario"];
					$retorno[$contador]["condominio"] = $retornando["condominio"];
					$retorno[$contador]["endereco"] = $retornando["endereco"];
					$contador++;
				}
				echo json_encode($retorno);
			}else{ echo json_encode("Erro ao listar Unidade!"); }
		}		
		private function validation($con, $ferramentas){
			$data["nome"] = $_POST["nome"] ?? "";
			$data["idade"] = $_POST["idade"] ?? "";
			$data["sexo"] = $_POST["sexo"] ?? "";
			$data["telefone"] = $_POST["telefone"] ?? "";
			$data["email"] = $_POST["email"] ?? "";
			$data["unidade"] = $_POST["unidade"] ?? "";

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
				$this->cadastro($con, $data);
			}else{ echo json_encode($msg); }
		}
		private function cadastro($con, $data){
			$sql = "INSERT INTO inquilinos(nome, idade, sexo, telefone, email, unidade) VALUES(:nome, :idade, :sexo, :telefone, :email, :unidade)";
			$sql = $con->prepare($sql);
			$sql->bindParam(":nome", $data["nome"]);
			$sql->bindParam(":idade", $data["idade"]);
			$sql->bindParam(":sexo", $data["sexo"]);
			$sql->bindParam(":telefone", $data["telefone"]);
			$sql->bindParam(":email", $data["email"]);
			$sql->bindParam(":unidade", $data["unidade"]);
			if($sql->execute()){
				echo json_encode("Inquilino Cadastrado com sucesso!");
			}else{ echo json_encode("Erro ao cadastrar Inquilino!"); }
		}
	}
	$registrationInquilinos = new RegistrationInquilinos();