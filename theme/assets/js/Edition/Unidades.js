class EdicaoDeUnidades{
	constructor(){
		this.listar(this, 0);
	}
	listar(objeto, toggle){
		$(".btAbreEdicaoDeUnidades").click(function(event){
			event.preventDefault();
			var contador=4;
			var url = $(this).attr("value");
			if(toggle == 0){
				ferramentas("Aguarde", 1, 0);				
				$.ajax({
					url: url,
					type: "POST",
					data: {"listar": contador},
					dataType: "JSON",
					success: function(retorno){
						ferramentas("Aguarde", 0, 0);						
						let unidades="<h2>Edição de Unidades</h2>";
						for(let i=0; i<retorno.length; i++){
							unidades+="<form id='formEdicaoUnidades"+retorno[i]['id']+"' class='formulariosDeEdicaoUnidades' action='"+url.replace('Listing', 'Edition')+"'><ul class='border border-warning mt-3 p-0 text-center'>";
								unidades+="<li><input type='hidden' class='form-control' name='id' value='"+retorno[i]['id']+"' /></li>";
								unidades+="<li class='border p-3'><input type='text' class='form-control' name='identificacao' value='"+retorno[i]['identificacao']+"' /></li>";
								unidades+="<li class='border p-3'><input type='text' class='form-control' name='proprietario' value='"+retorno[i]['proprietario']+"' /></li>";
								unidades+="<li class='border p-3'><input type='text' class='form-control' name='condominio' value='"+retorno[i]['condominio']+"' /></li>";
								unidades+="<li class='border p-3'><input type='text' class='form-control' name='endereco' value='"+retorno[i]['endereco']+"' /></li>";
								unidades+="<li><button value='"+retorno[i]['id']+"' class='form-control btn btn-outline-success mt-3 btFormulariosDeEdicaoUnidades' type='button'>Editar</button></li>";
								unidades+="<li><button value='"+retorno[i]['id']+"' target='"+retorno[i]['identificacao']+"' class='form-control btn btn-outline-danger mt-3 btFormulariosDeEdicaoUnidades' type='button'>Excluir</button></li>";								
							unidades+="</form></ul>";
						}
						$("#linhaEdicaoDeUnidades").html(unidades);
						contador = contador+4;
						objeto.editar();
					},
					error: function () { ferramentas("Aguarde", 0, 0); }
				});				
				toggle=1;				
			}else{
				$("#linhaEdicaoDeUnidades").html("");
				toggle=0;
			}			
		});
	}
	editar(){
		$(".formulariosDeEdicaoUnidades").submit(function(event){ event.preventDefault(); });
		$(".btFormulariosDeEdicaoUnidades").click(function(){
			let tipoDeFuncao = $(this).text();
			let idFormulario = $(this).val();
			let url = $("#formEdicaoUnidades"+idFormulario).attr("action");
			if(tipoDeFuncao == "Editar"){				
				let data = $("#formEdicaoUnidades"+idFormulario).serialize();				
				$.ajax({
					url: url,
					type: "POST",
					data: data,
					dataType: "JSON",
					success: function(retorno){
						ferramentas("Aguarde", 0, 0);
						alert(retorno);
					},
					error: function () { ferramentas("Aguarde", 0, 0); }
				});
			}else{
				let identificacao = $(this).attr("target");
				$.ajax({
					url: url,
					type: "POST",
					data: {"excluir": identificacao},
					dataType: "JSON",
					success: function(retorno){
						ferramentas("Aguarde", 0, 0);
						alert(retorno);
					},
					error: function () { ferramentas("Aguarde", 0, 0); }
				});
			}			
		});
	}
}
let edicaoDeUnidades = new EdicaoDeUnidades();