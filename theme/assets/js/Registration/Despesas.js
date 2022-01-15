class CadastroDeDespesas{
	constructor(){
		this.toogleCadastro();
		this.cadastrando();		
	}
	toogleCadastro(){
		$(".btAbreCadastroDeDespesas").on("click", function(event){			
			$(".linhaDespesas").toggle();
			$(".linhaInquilinos").hide();
			$(".linhaUnidades").hide();
		});	
	}
	cadastrando(){
		$("#formCadastroDeDespesas").submit(function(event){
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
				},
				error: function () { ferramentas("Aguarde", 0, 0); }
			});
		});
	}
}

let cadastroDeDespesas = new CadastroDeDespesas();