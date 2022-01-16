class ListarInquilinos{
	constructor(){
		this.listar();
	}
	listar(){
		$(".btListagemDeInquilinos").click(function(){
			alert("btListagemDeInquilinos");
		});
	}
}
let listarInquilinos = new ListarInquilinos();