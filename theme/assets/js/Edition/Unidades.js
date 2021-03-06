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
						let unidades="<u><h2 class='text-success'>Edição de Unidades</h2></u>";
						for(let i=0; i<retorno.length; i++){
							unidades+="<form id='formEdicaoUnidades"+retorno[i]['id']+"' class='formulariosDeEdicaoUnidades' action='"+url.replace('Listing', 'Edition')+"'><ul class='border border-warning mt-3 p-0 text-center'>";
								unidades+="<label>Id:</label>";
								unidades+="<input type='number' class='form-control border' name='id' value='"+retorno[i]['id']+"' disabled />";
								unidades+="<label>Identificação:</label>";
								unidades+="<input type='text' class='form-control border' name='identificacao' value='"+retorno[i]['identificacao']+"' />";
								unidades+="<label>Proprietário:</label>";
								unidades+="<input type='text' class='form-control border' name='proprietario' value='"+retorno[i]['proprietario']+"' />";
								unidades+="<label>Condomínio:</label>";
								unidades+="<input type='text' class='form-control border' name='condominio' value='"+retorno[i]['condominio']+"' />";
								unidades+="<label>Endereço:</label>";
								unidades+="<input type='text' class='form-control border' name='endereco' value='"+retorno[i]['endereco']+"' />";
								unidades+="<button value='"+retorno[i]['id']+"' class='form-control btn btn-outline-success mt-3 btFormulariosDeEdicaoUnidades' type='button'>Editar</button>";
								unidades+="<button value='"+retorno[i]['id']+"' target='"+retorno[i]['identificacao']+"' class='form-control btn btn-outline-danger mt-3 btFormulariosDeEdicaoUnidades' type='button'>Excluir</button>";
							unidades+="</form></ul>";
						}
						$("#linhaEdicao").html(unidades);
						contador = contador+4;
						objeto.editar(objeto);
					},
					error: function () { ferramentas("Aguarde", 0, 0); }
				});				
				toggle=1;				
			}else{
				$("#linhaEdicao").html("");
				toggle=0;
			}			
		});
	}
	editar(objeto){
		$(".formulariosDeEdicaoUnidades").submit(function(event){ event.preventDefault(); });
		$(".btFormulariosDeEdicaoUnidades").click(function(){
			let tipoDeFuncao = $(this).text();
			let idFormulario = $(this).val();
			let url = $("#formEdicaoUnidades"+idFormulario).attr("action");
			if(tipoDeFuncao == "Editar"){
				ferramentas("Aguarde", 1, 0);				
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
				objeto.excluir(url, identificacao);
			}			
		});
	}
	excluir(url, identificacao){
		ferramentas("Aguarde", 1, 0);
		$.ajax({
			url: url,
			type: "POST",
			data: {"excluir": identificacao},
			dataType: "JSON",
			success: function(retorno){
				ferramentas("Aguarde", 0, 0);
				alert(retorno);
				if(retorno == "Exluido com sucesso!"){
					ferramentas("Recarregar", 0, 0);
				}
			},
			error: function () { ferramentas("Aguarde", 0, 0); }
		});
	}
}
let edicaoDeUnidades = new EdicaoDeUnidades();