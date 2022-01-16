class ListarDespesas{
	constructor(){
		this.listar();
	}
	listar(){
		$(".btListagemDeDespesas").click(function(){
			alert("btListagemDeDespesas");
		});
	}
}
let listarDespesas = new ListarDespesas();