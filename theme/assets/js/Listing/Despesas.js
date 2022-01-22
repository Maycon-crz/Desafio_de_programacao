class ListarDespesas{
	constructor(){
		this.toggleDespesas(this, 0);
	}
	toggleDespesas(objeto, toggle){
		$(".btListagemDeDespesas").click(function(){			
			let texto = $(".btListagemDeDespesas").text();
			let url = $(this).attr("value");
			if(toggle == 0){				
				toggle=1;
				$(".btListagemDeDespesas").text(texto+" ↓↓ ( X )");
				objeto.listar(objeto, url, 4, false);				
			}else{
				$("#linhaListagemDeDespesas").html("");
				$(".btListagemDeDespesas").text(texto.replace(' ↓↓ ( X )', ''));
				toggle=0;
			}
		});
	}
	listar(objeto, url, parametro, filtro){
		ferramentas("Aguarde", 1, 0);
		$.ajax({
			url: url,
			type: "POST",
			data: {"listar": parametro, "filtro": filtro},
			dataType: "JSON",
			success: function(retorno){
				ferramentas("Aguarde", 0, 0);console.log(retorno);
				let despesas="<h2>Listagem de Despesas</h2>";
				despesas+="<select name='unidade' class='form-select mt-3' id='selectComUnidadesFiltroDespesas'>"
                despesas+="<option>Selecione a Unidade:</option>";
            	despesas+="</select>";
            	despesas+="<button tipe='button' class='form-control btn btn-outline-danger mt-3' id='btfiltroPorFaturaVencida'>Mostrar despesas com fatura vencida</button>";
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
				selectComUnidades();
				objeto.filtroPorUnidade(objeto, url);
				objeto.filtroPorFaturaVencida(objeto, url);
			},
			error: function () { ferramentas("Aguarde", 0, 0); }
		});		
	}
	filtroPorUnidade(objeto, url){
		$("#selectComUnidadesFiltroDespesas").on("change", function(){
			let unidade = $(this).val();			
			if(unidade != "Selecione a Unidade:"){				
				objeto.listar(objeto, url, "Unidades", unidade);
			}
		});
	}
	filtroPorFaturaVencida(objeto, url){
		$("#btfiltroPorFaturaVencida").click(function(){
			objeto.listar(objeto, url, "Vencidas", false);
		});
	}	
}
let listarDespesas = new ListarDespesas();