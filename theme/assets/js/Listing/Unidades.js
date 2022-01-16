class ListarUnidades{
	constructor(){
		this.listar();
	}
	listar(){
		$(".btListagemDeUnidades").click(function(){
			ferramentas("Aguarde", 1, 0);	
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
let listarUnidades = new ListarUnidades();