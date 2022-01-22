function selectComUnidades(){
	$.ajax({
		url: $("#formCadastroDeInquilinos").attr("action"),
		type: "POST",
		data: {"selectUnidades": "selectUnidades"},
		dataType: "JSON",
		success: function(retorno){
			ferramentas("Aguarde", 0, 0);
			let options="<option>Selecione a Unidade:</option>";
			for(let c=0; c < retorno.length; c++){
				options += "<option value="+retorno[c]["id"]+">Identificação: "+retorno[c]["identificacao"]+" | Proprietario: "+retorno[c]["proprietario"]+" | Condomínio: "+retorno[c]["condominio"]+" | Endereço: "+retorno[c]["endereco"]+"</option>";
			}
			$("#selectComUnidades").html(options);
			$("#selectDespesasComUnidades").html(options);
			$("#selectComUnidadesFiltroDespesas").html(options);				
		},
		error: function () { ferramentas("Aguarde", 0, 0); }
	});
}

selectComUnidades();