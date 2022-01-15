<?php 
	require_once("../Lib/Conn.php"); 
	require_once("../Lib/Ferramentas.php"); 
	
	class RegistrationInquilinos{
		private static $con;
		public function __construct(){
			self::$con = (new Conn())->getConn();
			$ferramentas = new Ferramentas();			
			if(isset($_POST['registrationInquilinos_nome'])){
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
			$nome = $_POST["registrationInquilinos_nome"] ?? "";
			$idade = $_POST["registrationInquilinos_idade"] ?? "";
			$sexo = $_POST["registrationInquilinos_sexo"] ?? "";
			$telefone = $_POST["registrationInquilinos_telefone"] ?? "";
			$email = $_POST["registrationInquilinos_email"] ?? "";
			$unidade = $_POST["registrationInquilinos_Unidade"] ?? "";

			$nome = $ferramentas->filtrando($nome);
			$idade = $ferramentas->filtrando($idade);
			$sexo = $ferramentas->filtrando($sexo);
			$telefone = $ferramentas->filtrando($telefone);
			$email = $ferramentas->filtrando($email);
			$unidade = $ferramentas->filtrando($unidade);

			$msg = ($nome == "") ? "Digite o Nome" : "";
			$msg = ($msg == "") ? $msg = ($idade == "") ? "Digite a Idade" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($sexo == "") ? "Digite selecione o Sexo" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($telefone == "") ? "Digite o Telefone" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($email == "") ? "Digite o E-mail" : "" : $msg;
			$msg = ($msg == "") ? $msg = ($unidade == "Selecione a Unidade:") ? "Digite selecione a unidade" : "" : $msg;
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
	}
	$registrationInquilinos = new RegistrationInquilinos();