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
						let unidades="<h2>Listagem de Unidades</h2>";
						for(let i=0; i<retorno.length; i++){
							unidades+="<ul class='border border-warning mt-3 p-0 text-center'>";
								unidades+="<li class='border p-3'>"+retorno[i]['identificacao']+"</li>";
								unidades+="<li class='border p-3'>"+retorno[i]['proprietario']+"</li>";
								unidades+="<li class='border p-3'>"+retorno[i]['condominio']+"</li>";
								unidades+="<li class='border p-3'>"+retorno[i]['endereco']+"</li>";
							unidades+="</ul>";
						}
						$("#linhaListagemDeUnidades").html(unidades);
						contador = contador+4;
					},
					error: function () { ferramentas("Aguarde", 0, 0); }
				});		
				$(".btListagemDeUnidades").text(texto+" ↓↓ ( X )");
				toggle=1;
			}else{
				$("#linhaListagemDeUnidades").html("");
				$(".btListagemDeUnidades").text(texto.replace(' ↓↓ ( X )', ''));
				toggle=0;
			}			
		});
	}
}
let listarUnidades = new ListarUnidades();