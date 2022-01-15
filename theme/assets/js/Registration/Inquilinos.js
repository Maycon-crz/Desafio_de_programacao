class CadastrosDeInquilinos{
	constructor(){		
		this.cadastrando();
		this.selectComUnidades();
	}	
	cadastrando(){
		$("#formCadastroDeInquilinos").submit(function(event){
			ferramentas("Aguarde", 1, 0);
			event.preventDefault();		
			$.ajax({
				url: $(this).attr("action"),
				type: "POST",
				data: $(this).serialize(),
				dataType: "JSON",
				success: function(retorno){
					ferramentas("Aguarde", 0, 0);
					alert(retorno);
				},
				error: function () { ferramentas("Aguarde", 0, 0); }
			});
		});
	}
	selectComUnidades(){
		$.ajax({
			url: $("#formCadastroDeInquilinos").attr("action"),
			type: "POST",
			data: {"selectUnidades": "selectUnidades"},
			dataType: "JSON",
			success: function(retorno){
				ferramentas("Aguarde", 0, 0);
				console.log(retorno);
				let options="<option>Selecione a Unidade:</option>";
				for(let c=0; c < retorno.length; c++){
					options += "<option value="+retorno[c]["identificacao"]+">Identificação: "+retorno[c]["identificacao"]+" | Proprietario: "+retorno[c]["proprietario"]+" | Condomínio: "+retorno[c]["condominio"]+" | Endereço: "+retorno[c]["endereco"]+"</option>";
				}
				$("#selectComUnidades").html(options);
				$("#selectDespesasComUnidades").html(options);
			},
			error: function () { ferramentas("Aguarde", 0, 0); }
		});
	}
}

let cadastrosDeInquilinos = new CadastrosDeInquilinos();