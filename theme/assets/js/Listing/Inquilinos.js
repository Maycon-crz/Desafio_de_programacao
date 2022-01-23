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
						let inquilinos="<u><h2 class='text-success'>Listagem de Inquilinos</h2></u>";
						for(let i=0; i<retorno.length; i++){
							inquilinos+="<div class='row mt-3'>";
								inquilinos+="<div class='col-4 border bg-secondary'>Nome: "+retorno[i]['nome']+"</div>";
								inquilinos+="<div class='col-4 border bg-secondary'>Idade: "+retorno[i]['idade']+"</div>";
								inquilinos+="<div class='col-4 border bg-secondary'>Sexo: "+retorno[i]['sexo']+"</div>";
							inquilinos+="</div><div class='row'>";
								inquilinos+="<div class='col-4 border bg-light'>Telefone: "+retorno[i]['telefone']+"</div>";
								inquilinos+="<div class='col-4 border bg-light'>E-mail: </div>";
								inquilinos+="<div class='col-4 border bg-light'>Unidade: "+retorno[i]['unidade']+"</div>";
							inquilinos+="</div>";
						}
						inquilinos+="<p>Sexos: m=Masculino | f=Feminino | o=Outro</p>"
						$("#linhaListagem").html(inquilinos);
						contador = contador+4;
					},
					error: function () { ferramentas("Aguarde", 0, 0); }
				});
				$(".btListagemDeInquilinos").text(texto+" ( X )");
				toggle=1;
			}else{
				$("#linhaListagem").html("");
				$(".btListagemDeInquilinos").text(texto.replace(' ( X )', ''));
				toggle=0;
			}
		});
	}
}
let listarInquilinos = new ListarInquilinos();