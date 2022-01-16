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
					data: {"listar": contador},
					dataType: "JSON",
					success: function(retorno){
						ferramentas("Aguarde", 0, 0);console.log(retorno);
						let despesas="<h2>Edição de Despesas</h2>";
						for(let i=0; i<retorno.length; i++){
							despesas+="<form id='formEdicaoDespesas"+retorno[i]['id']+"' class='formulariosDeEdicaoDespesas' action='"+url.replace('Listing', 'Edition')+"'><ul class='border border-warning mt-3 p-0 text-center'>";
								despesas+="<li class='border p-3'><input type='text' class='form-control' name='descricao' value='"+retorno[i]['descricao']+"' /></li>";
								despesas+="<li class='border p-3'><input type='text' class='form-control' name='tipo_despesa' value='"+retorno[i]['tipo_despesa']+"' /></li>";
								despesas+="<li class='border p-3'><input type='text' class='form-control' name='valor' value='"+retorno[i]['valor']+"' /></li>";
								despesas+="<li class='border p-3'><input type='text' class='form-control' name='vencimento_fatura' value='"+retorno[i]['vencimento_fatura']+"' /></li>";
								despesas+="<li class='border p-3'><input type='text' class='form-control' name='status_pagamento' value='"+retorno[i]['status_pagamento']+"' /></li>";
								despesas+="<li><button value='"+retorno[i]['id']+"' class='form-control btn btn-outline-success mt-3 btFormulariosDeEdicaoDespesas' type='button'>Editar</button></li>";
								despesas+="<li><button value='"+retorno[i]['id']+"' class='form-control btn btn-outline-danger mt-3 btFormulariosDeEdicaoDespesas' type='button'>Excluir</button></li>";
							despesas+="</form></ul>";
						}
						$("#linhaEdicaoDeDespesas").html(despesas);
						contador = contador+4;
						objeto.editar();
					},
					error: function () { ferramentas("Aguarde", 0, 0); }
				});				
				toggle=1;				
			}else{
				$("#linhaEdicaoDeDespesas").html("");
				toggle=0;
			}			
		});
	}
	editar(){
		$(".formulariosDeEdicaoDespesas").submit(function(event){ event.preventDefault(); });
		$(".btFormulariosDeEdicaoDespesas").click(function(){
			let tipoDeFuncao = $(this).text();
			if(tipoDeFuncao == "Editar"){
				let idFormulario = $(this).val();
				let data = $("#formEdicaoDespesas"+idFormulario).serialize();
				console.log(data);
			}else{
				alert("Excluir");
			}			
		});
	}
}

let edicaoDeDespesas = new EdicaoDeDespesas();