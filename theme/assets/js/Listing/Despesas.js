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
				$(".btListagemDeDespesas").text(texto+" ( X )");
				objeto.listar(objeto, url, 4, false);				
			}else{
				$("#linhaListagem").html("");
				$(".btListagemDeDespesas").text(texto.replace(' ( X )', ''));
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
				ferramentas("Aguarde", 0, 0);
				let despesas="<h2 class='text-success'>Listagem de Despesas</h2>";
				despesas+="<select name='unidade' class='form-select mt-3' id='selectComUnidadesFiltroDespesas'>"
                despesas+="<option>Selecione a Unidade:</option>";
            	despesas+="</select>";
            	despesas+="<form class='m-3' id='formFiltroPorData'>";
            	despesas+="<input type='datetime-local' name='dataInicio' />";
            	despesas+="<input type='datetime-local' name='dataFim' />";
            	despesas+="<button type='submit' class='btn btn-outline-success p-1 ms-3'>Buscar</button>";
            	despesas+="</form>";
				for(let i=0; i<retorno.length; i++){
					let vencimento_fatura = retorno[i]['vencimento_fatura'].split(" ", 1);
					let remodelandoData = vencimento_fatura[0].split("-");	
					let ano = remodelandoData[0];
					let mes = remodelandoData[1];
					let dia = remodelandoData[2];
					let status_pagamento = (retorno[i]['status_pagamento'] == 0 ) ? "Pendende" : "Pago";					
					despesas+="<div class='row mt-3'>";
					despesas+="<div class='col-6 border bg-secondary'>Descrição: "+retorno[i]['descricao']+"</div>";
					despesas+="<div class='col-6 border bg-secondary'>Tipo despesa: "+retorno[i]['tipo_despesa']+"</div>";
					despesas+="</div><div class='row'>";
					despesas+="<div class='col-4 border bg-light'>Valor: "+retorno[i]['valor']+"</div>";
					despesas+="<div class='col-4 border bg-light'>Vencimento da fatura: "+dia+"/"+mes+"/"+ano+"</div>";
					despesas+="<div class='col-4 border bg-light'>Status pagamento: "+status_pagamento+"</div>";
					despesas+="</div>";					
				}
				$("#linhaListagem").html(despesas);
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
		$("#formFiltroPorData").submit(function(event){
			event.preventDefault();
			let dataInicio = $("input[name='dataInicio']").val();
			let dataFim = $("input[name='dataFim']").val();
			let datas = dataInicio+"|"+dataFim;			
			objeto.listar(objeto, url, "Vencidas", datas);
		});
	}	
}
let listarDespesas = new ListarDespesas();