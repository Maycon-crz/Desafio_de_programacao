<?php

	class Ferramentas{
		public function filtrando($dados){
			$dados = trim($dados);
			$dados = htmlspecialchars($dados);			
			$dados = addslashes($dados);
			return $dados;		
		}
		public function sair(){			
			session_unset();
			session_destroy();
			echo json_encode("saiu");
		}
	}