class CadastrosDeInquilinos{
	constructor(){	
		this.toogleCadastro();	
		this.cadastrando();
		this.mascaraDeTelefone();
	}
	toogleCadastro(){
		$(".btAbreCadastroDeInquilinos").on("click", function(event){			
			$(".linhaInquilinos").toggle();
			$(".linhaDespesas").hide();
			$(".linhaUnidades").hide();
		});	
	}
	cadastrando(){
		$("#formCadastroDeInquilinos").submit(function(event){
			ferramentas("Aguarde", 1, 0);
			event.preventDefault();		
			$.ajax({
				url: $(this).attr("action"),
				type: "POST",
				data: $(this).serialize(),
				dataType: "JSON",
				success: function(retorno){
					ferramentas("Aguarde", 0, 0);
					alert(retorno);
					if(retorno == "Inquilino Cadastrado com sucesso!"){
						ferramentas("Recarregar", 0, 0);
					}					
				},
				error: function () { ferramentas("Aguarde", 0, 0); }
			});
		});
	}	
	mascaraDeTelefone(){
		$(".telefoneMask").mask("(00) 0000-00000");
	}
}

let cadastrosDeInquilinos = new CadastrosDeInquilinos();