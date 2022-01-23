class EdicaoDeDespesas{
	constructor(){
		this.listar(this, 0);
	}
	listar(objeto, toggle){
		$(".btAbreEdicaoDeDespesas").click(function(event){
			event.preventDefault();
			var contador=4;
			var url = $(this).attr("value");
			if(toggle == 0){
				ferramentas("Aguarde", 1, 0);
				$.ajax({
					url: url,
					type: "POST",
					data: {"listar": contador, "filtro": false},
					dataType: "JSON",
					success: function(retorno){
						ferramentas("Aguarde", 0, 0);
						let despesas="<u><h2 class='text-success'>Edição de Despesas</h2></u>";
						for(let i=0; i<retorno.length; i++){
							despesas+="<form id='formEdicaoDespesas"+retorno[i]['id']+"' class='formulariosDeEdicaoDespesas' action='"+url.replace('Listing', 'Edition')+"'><ul class='border border-warning mt-3 p-0 text-center'>";
								despesas+="<input type='hidden' class='form-control' name='id' value='"+retorno[i]['id']+"' />";
								despesas+="<label>Unidade:</label>";
								despesas+="<input type='text' class='form-control border' name='unidade' value='"+retorno[i]['unidade']+"' />";
								despesas+="<label>Descrição:</label>";
								despesas+="<input type='text' class='form-control border' name='descricao' value='"+retorno[i]['descricao']+"' />";
								despesas+="<label>Tipo de despesa:</label>";
								despesas+="<input type='text' class='form-control border' name='tipo_despesa' value='"+retorno[i]['tipo_despesa']+"' />";
								despesas+="<label>Valor:</label>";
								despesas+="<input type='text' class='form-control border' name='valor' value='"+retorno[i]['valor']+"' />";
								despesas+="<label>Vencimento da fatura:</label>";
								despesas+="<input type='text' class='form-control border' name='vencimento_fatura' value='"+retorno[i]['vencimento_fatura']+"' />";
								despesas+="<div class='border mt-3'><label class='form-control'>Status do pagamento:</label>";
								if(retorno[i]['status_pagamento'] == 0){
									despesas+="<input type='radio' name='status_pagamento' id='Pago"+retorno[i]['id']+"' value='1'>";
					                despesas+="<label for='Pago"+retorno[i]['id']+"'>Pago</label>";
					                despesas+="<input type='radio' name='status_pagamento' id='Pendente"+retorno[i]['id']+"' value='0' checked>";
					                despesas+="<label for='Pendente"+retorno[i]['id']+"'>Pendente</label>";
								}else{
									despesas+="<input type='radio' name='status_pagamento' id='Pago"+retorno[i]['id']+"' value='1' checked>";
					                despesas+="<label for='Pago"+retorno[i]['id']+"'>Pago</label>";
					                despesas+="<input type='radio' name='status_pagamento' id='Pendente"+retorno[i]['id']+"' value='0'>";
					                despesas+="<label for='Pendente"+retorno[i]['id']+"'>Pendente</label>";
								}
								despesas+="</div>";
								despesas+="<button value='"+retorno[i]['id']+"' class='form-control btn btn-outline-success mt-3 btFormulariosDeEdicaoDespesas' type='button'>Editar</button>";
								despesas+="<button value='"+retorno[i]['id']+"' class='form-control btn btn-outline-danger mt-3 btFormulariosDeEdicaoDespesas' type='button'>Excluir</button>";
							despesas+="</form></ul>";
						}
						$("#linhaEdicao").html(despesas);
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
		$(".formulariosDeEdicaoDespesas").submit(function(event){ event.preventDefault(); });
		$(".btFormulariosDeEdicaoDespesas").click(function(){
			let tipoDeFuncao = $(this).text();
			let idFormulario = $(this).val();
			let url = $("#formEdicaoDespesas"+idFormulario).attr("action");
			if(tipoDeFuncao == "Editar"){
				ferramentas("Aguarde", 1, 0);
				let data = $("#formEdicaoDespesas"+idFormulario).serialize();				
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
				objeto.excluir(url, idFormulario);
			}			
		});
	}
	excluir(url, idFormulario){
		if(confirm("Tem certeza que deseja excluir?")){
			ferramentas("Aguarde", 1, 0);
			$.ajax({
				url: url,
				type: "POST",
				data: {"excluir": idFormulario},
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
}

let edicaoDeDespesas = new EdicaoDeDespesas();