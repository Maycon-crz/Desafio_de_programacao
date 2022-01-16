class ListarInquilinos{
	constructor(){
		this.listar(0);
	}
	listar(toggle){
		$(".btListagemDeInquilinos").click(function(){
			var contador=4;
			var texto = $(".btListagemDeInquilinos").text();
			if(toggle == 0){
				ferramentas("Aguarde", 1, 0);				
				$.ajax({
					url: $(this).attr("value"),
					type: "POST",
					data: {"listar": contador},
					dataType: "JSON",
					success: function(retorno){
						ferramentas("Aguarde", 0, 0);
						let inquilinos="<h2>Listagem de Inquilinos</h2>";
						for(let i=0; i<retorno.length; i++){
							inquilinos+="<ul class='border border-warning mt-3 p-0 text-center'>";
								inquilinos+="<li class='border p-3'>"+retorno[i]['nome']+"</li>";
								inquilinos+="<li class='border p-3'>"+retorno[i]['idade']+"</li>";
								inquilinos+="<li class='border p-3'>"+retorno[i]['sexo']+"</li>";
								inquilinos+="<li class='border p-3'>"+retorno[i]['telefone']+"</li>";
								inquilinos+="<li class='border p-3'>"+retorno[i]['email']+"</li>";
								inquilinos+="<li class='border p-3'>"+retorno[i]['unidade']+"</li>";
							inquilinos+="</ul>";
						}
						$("#linhaListagemDeInquilinos").html(inquilinos);
						contador = contador+4;
					},
					error: function () { ferramentas("Aguarde", 0, 0); }
				});
				$(".btListagemDeInquilinos").text(texto+" ↓↓ ( X )");
				toggle=1;
			}else{
				$("#linhaListagemDeInquilinos").html("");
				$(".btListagemDeInquilinos").text(texto.replace(' ↓↓ ( X )', ''));
				toggle=0;
			}
		});
	}
}
let listarInquilinos = new ListarInquilinos();