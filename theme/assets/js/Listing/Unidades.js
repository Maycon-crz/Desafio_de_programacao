class ListarUnidades{
	constructor(){
		this.listar(0);
	}
	listar(toggle){
		$(".btListagemDeUnidades").click(function(){			
			var contador=4;
			var texto = $(".btListagemDeUnidades").text();
			if(toggle == 0){
				ferramentas("Aguarde", 1, 0);				
				$.ajax({
					url: $(this).attr("value"),
					type: "POST",
					data: {"listar": contador},
					dataType: "JSON",
					success: function(retorno){
						ferramentas("Aguarde", 0, 0);						
						let unidades="<u><h2 class='text-success'>Listagem de Unidades</h2></u>";
						for(let i=0; i<retorno.length; i++){
							unidades+="<div class='row mt-3'>";
								unidades+="<div class='col-6 border bg-secondary'>Identificação: "+retorno[i]['identificacao']+"</div>";
								unidades+="<div class='col-6 border bg-secondary'>Proprietário: "+retorno[i]['proprietario']+"</div>";
							unidades+="</div><div class='row'>";
								unidades+="<div class='col-6 border bg-light'>Condomínio: "+retorno[i]['condominio']+"</div>";
								unidades+="<div class='col-6 border bg-light'>Endereço: "+retorno[i]['endereco']+"</div>";
							unidades+="</div>";
						}
						$("#linhaListagem").html(unidades);
						contador = contador+4;
					},
					error: function () { ferramentas("Aguarde", 0, 0); }
				});		
				$(".btListagemDeUnidades").text(texto+" ( X )");
				toggle=1;
			}else{
				$("#linhaListagem").html("");
				$(".btListagemDeUnidades").text(texto.replace(' ( X )', ''));
				toggle=0;
			}			
		});
	}
}
let listarUnidades = new ListarUnidades();