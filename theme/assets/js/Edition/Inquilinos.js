class EdicaoDeInquilinos{
	constructor(){
		this.listar(this, 0);
	}
	listar(objeto, toggle){
		$(".btAbreEdicaoDeInquilinos").click(function(event){
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
						let inquilinos="<h2>Edição de Inquilinos</h2>";
						console.log(retorno);
						console.log(url);
						for(let i=0; i<retorno.length; i++){
							inquilinos+="<form id='formEdicaoInquilinos"+retorno[i]['id']+"' class='formulariosDeEdicaoInquilinos' action='"+url.replace('Listing', 'Edition')+"'><ul class='border border-warning mt-3 p-0 text-center'>";
								inquilinos+="<li><input type='hidden' class='form-control' name='id' value='"+retorno[i]['id']+"' /></li>";
								inquilinos+="<li class='border p-3'><input type='text' class='form-control' name='nome' value='"+retorno[i]['nome']+"' /></li>";
								inquilinos+="<li class='border p-3'><input type='text' class='form-control' name='idade' value='"+retorno[i]['idade']+"' /></li>";
								inquilinos+="<li class='border p-3'><input type='text' class='form-control' name='sexo' value='"+retorno[i]['sexo']+"' /></li>";
								inquilinos+="<li class='border p-3'><input type='text' class='form-control' name='telefone' value='"+retorno[i]['telefone']+"' /></li>";
								inquilinos+="<li class='border p-3'><input type='text' class='form-control' name='email' value='"+retorno[i]['email']+"' /></li>";
								inquilinos+="<li class='border p-3'><input type='text' class='form-control' name='unidade' value='"+retorno[i]['unidade']+"' /></li>";
								inquilinos+="<li><button value='"+retorno[i]['id']+"' class='form-control btn btn-outline-success mt-3 btFormulariosDeEdicaoInquilinos' type='button'>Editar</button></li>";
								inquilinos+="<li><button value='"+retorno[i]['id']+"' class='form-control btn btn-outline-danger mt-3 btFormulariosDeEdicaoInquilinos' type='button'>Excluir</button></li>";
							inquilinos+="</form></ul>";
						}
						$("#linhaEdicaoDeInquilinos").html(inquilinos);
						contador = contador+4;
						objeto.editar(objeto);
					},
					error: function () { ferramentas("Aguarde", 0, 0); }
				});				
				toggle=1;				
			}else{
				$("#linhaEdicaoDeInquilinos").html("");
				toggle=0;
			}
		});
	}
	editar(objeto){
		$(".formulariosDeEdicaoInquilinos").submit(function(event){ event.preventDefault(); });
		$(".btFormulariosDeEdicaoInquilinos").click(function(){
			let tipoDeFuncao = $(this).text();
			let idFormulario = $(this).val();
			let url = $("#formEdicaoInquilinos"+idFormulario).attr("action");
			if(tipoDeFuncao == "Editar"){
				ferramentas("Aguarde", 1, 0);
				let data = $("#formEdicaoInquilinos"+idFormulario).serialize();
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
		if(confirm("Tem certeza que deseja excluir este inquilino?")){
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

let edicaoDeInquilinos = new EdicaoDeInquilinos();