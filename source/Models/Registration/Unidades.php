<?php 
	require_once("../Lib/Conn.php"); 
	require_once("../Lib/Ferramentas.php"); 

	class RegistrationUnidades{
		private static $con;
		public function __construct(){
			self::$con = (new Conn())->getConn();
			$ferramentas = new Ferramentas();			
			if(isset($_POST['registrationUnidades_identificacao'])){
				$this->validation(self::$con, $ferramentas);
			}
		}
		private function validation($con, $ferramentas){
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
				$this->cadastro($con, $data);
			}else{ echo json_encode($msg); }
		}
		private function cadastro($con, $data){
			$sql = "INSERT INTO unidades(identificacao, proprietario, condominio, endereco) VALUES(:identificacao, :proprietario, :condominio, :endereco)";
			$sql = $con->prepare($sql);
			$sql->bindParam(":identificacao", $data["identificacao"]);
			$sql->bindParam(":proprietario", $data["proprietario"]);
			$sql->bindParam(":condominio", $data["condominio"]);
			$sql->bindParam(":endereco", $data["endereco"]);
			if($sql->execute()){
				echo json_encode("Unidade Cadastrada com sucesso!");
			}else{ echo json_encode("Erro ao cadastrar Unidade!"); }
		}
	}
	$registrationUnidades = new RegistrationUnidades();