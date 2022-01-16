class ListarDespesas{
	constructor(){
		this.listar(0);
	}
	listar(toggle){
		$(".btListagemDeDespesas").click(function(){
			var contador=4;
			var texto = $(".btListagemDeDespesas").text();
			if(toggle == 0){
				ferramentas("Aguarde", 1, 0);
				$.ajax({
					url: $(this).attr("value"),
					type: "POST",
					data: {"listar": contador},
					dataType: "JSON",
					success: function(retorno){
						ferramentas("Aguarde", 0, 0);console.log(retorno);
						let despesas="<h2>Listagem de Despesas</h2>";
						for(let i=0; i<retorno.length; i++){
							despesas+="<ul class='border border-warning mt-3 p-0 text-center'>";
								despesas+="<li class='border p-3'>"+retorno[i]['descricao']+"</li>";
								despesas+="<li class='border p-3'>"+retorno[i]['tipo_despesa']+"</li>";
								despesas+="<li class='border p-3'>"+retorno[i]['valor']+"</li>";
								despesas+="<li class='border p-3'>"+retorno[i]['vencimento_fatura']+"</li>";
								despesas+="<li class='border p-3'>"+retorno[i]['status_pagamento']+"</li>";
							despesas+="</ul>";
						}
						$("#linhaListagemDeDespesas").html(despesas);
						contador = contador+4;
					},
					error: function () { ferramentas("Aguarde", 0, 0); }
				});
				$(".btListagemDeDespesas").text(texto+" ↓↓ ( X )");
				toggle=1;
			}else{
				$("#linhaListagemDeDespesas").html("");
				$(".btListagemDeDespesas").text(texto.replace(' ↓↓ ( X )', ''));
				toggle=0;
			}
		});
	}
}
let listarDespesas = new ListarDespesas();