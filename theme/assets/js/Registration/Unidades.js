class CadastrosDeUnidades{
	constructor(){
		this.toogleCadastro();
		this.cadastrando();
	}
	toogleCadastro(){
		$(".btAbreCadastroDeUnidades").on("click", function(event){			
			$(".linhaUnidades").toggle();			
			$(".linhaInquilinos").hide();
			$(".linhaDespesas").hide();
		});	
	}
	cadastrando(){
		$("#formCadastroDeUnidades").submit(function(event){
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
					if(retorno == "Unidade Cadastrada com sucesso!"){
						ferramentas("Recarregar", 0, 0);
					}
				},
				error: function () { ferramentas("Aguarde", 0, 0); }
			});
		});
	}
}

let cadastrosDeUnidades = new CadastrosDeUnidades();