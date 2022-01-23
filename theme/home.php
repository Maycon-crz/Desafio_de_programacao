<?php $v->layout("_theme", ["title" => "Usuários"]); ?>
<div class="row">
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center">        
        <form id="formCadastroDeUnidades" class="linhaUnidades ocultar" action="<?= url('source/Models/Registration/Unidades.php'); ?>">            
            <h2 class="text-success">Cadastro de Unidades de um condomínio</h2>                
            <input type="text" name="identificacao" placeholder="Identificação" class="form-control mt-3">                
            <input type="text" name="proprietario" placeholder="Proprietário" class="form-control mt-3">                
            <input type="text" name="condominio" placeholder="Condomínio" class="form-control mt-3">                
            <input type="text" name="endereco" placeholder="Endereço" class="form-control mt-3">                
            <button type="submit" class="form-control btn btn-outline-success my-3">Cadastrar</button>
        </form>
    </div>
    <div class="col-2 text-center">&nbsp;</div>
</div>
<div class="row">
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center">
        <form id="formCadastroDeInquilinos" class="linhaInquilinos ocultar" action="<?= url('source/Models/Registration/Inquilinos.php'); ?>">
            <h2 class="text-success">Cadastro de Inquilinos</h2>
            <input type="text" name="nome" placeholder="Nome" class="form-control mt-3">
            <input type="number" name="idade" max="200" placeholder="Idade" class="form-control mt-3">
            <div class="border mt-3">
                <label class="form-control">Sexo:</label>
                <input type="radio" name="sexo" id="sexoFeminino" value="f">
                <label for="sexoFeminino">Feminino</label>
                <input type="radio" name="sexo" id="sexoMasculino" value="m">
                <label for="sexoMasculino">Masculino</label>
                <input type="radio" name="sexo" id="sexoOutro" value="o">
                <label for="sexoOutro">Outro</label>
            </div>
            <input type="text" name="telefone" placeholder="Telefone" class="form-control mt-3 telefoneMask">
            <input type="text" name="email" placeholder="E-mail" class="form-control mt-3">
            <select name="unidade" class="form-select mt-3" id="selectComUnidades">
                <option>Selecione a Unidade:</option>                
            </select>
            <button type="submit" class="form-control btn btn-outline-success my-3">Cadastrar</button>
        </form>
    </div>
    <div class="col-2 text-center">&nbsp;</div>
</div>
<div class="row">
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center">        
        <form id="formCadastroDeDespesas" class="linhaDespesas ocultar" action="<?= url('source/Models/Registration/Despesas.php'); ?>">            
            <h2 class="text-success">Cadastro de Despesas das unidades</h2>                
            <select name="unidade" class="form-select mt-3" id="selectDespesasComUnidades">
            <option>Selecione a Unidade:</option>
            <option></option>
            </select>                
            <input type="text" name="descricao" placeholder="Descrição" class="form-control mt-3">                
            <input type="text" name="tipo_despesa" placeholder="Tipo da despesa" class="form-control mt-3">                
            <input type="text" name="valor" placeholder="Valor" class="form-control mt-3">                
            <input type="datetime-local" name="vencimento_fatura" placeholder="Selecione o vencimento fatura" class="form-control mt-3">
            <div class="border mt-3">
                <label class="form-control">Status do pagamento:</label>
                <input type="radio" name="status_pagamento" id="Pago" value="1">
                <label for="Pago">Pago</label>        
                <input type="radio" name="status_pagamento" id="Pendente" value="0">            
                <label for="Pendente">Pendente</label>                    
            </div>
            <button type="submit" class="form-control btn btn-outline-success my-3">Cadastrar</button>
        </form>
    </div>  
</div>
<div class="row">
    <div class="col-1 text-center">&nbsp;</div>
    <div class="col-10 text-center" id="linhaListagem"></div>
    <div class="col-1 text-center">&nbsp;</div>
</div>
<div class="row">
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center" id="linhaEdicao"></div>
    <div class="col-2 text-center">&nbsp;</div>
</div>
<div class="row">
    <div class="col-2">&nbsp;</div>
    <div class="col-8 border">
        <ul class="p-0">
            <li><h2 class="text-success text-center">Tecnologias utilizadas</h2></li>
            <li class="border ps-3">* PHP</li>
            <li class="border ps-3">* Javascript</li>
            <li class="border ps-3">* SQL / MySQL</li>
            <li class="border ps-3">* XAMPP / Apache</li>
            <li class="border ps-3">* HTML</li>
            <li class="border ps-3">* CSS</li>
            <li class="border ps-3">* Jquery</li>
            <li class="border ps-3">* Plugin jquery.mask</li>            
            <li class="border ps-3">* Ajax</li>            
            <li class="border ps-3">* Bootstrap</li>
            <li class="border ps-3">* Arquitetura MVC</li>
            <li class="border ps-3">* Composer</li>
            <li class="border ps-3">* Packagist</li>            
            <li class="border ps-3">* Package: coffeecode/router: 1.0.*</li>
            <li class="border ps-3">* Package: league/plates: v4.0.0-alpha</li>            
        </ul>
    </div>
    <div class="col-2">&nbsp;</div>
</div>
<footer class="row border mt-3">
    <div class="col-2">&nbsp;</div>
    <div class="col-8 text-center p-5">
        <p>Desenvolvido por: Maycon Nascimento de Oliveira</p>
    </div>
    <div class="col-2">&nbsp;</div>
</footer>
<?php $v->start("js"); ?>
    <script src="<?= url("/theme/assets/js/Listing/Inquilinos.js"); ?>"></script>
    <script src="<?= url("/theme/assets/js/Listing/Unidades.js"); ?>"></script>
    <script src="<?= url("/theme/assets/js/Listing/Despesas.js"); ?>"></script>    
    <script src="<?= url("/theme/assets/js/Edition/Inquilinos.js"); ?>"></script>
    <script src="<?= url("/theme/assets/js/Edition/Unidades.js"); ?>"></script>
    <script src="<?= url("/theme/assets/js/Edition/Despesas.js"); ?>"></script>    
    <script src="<?= url("/theme/assets/js/Registration/Inquilinos.js"); ?>"></script>
    <script src="<?= url("/theme/assets/js/Registration/Unidades.js"); ?>"></script>
    <script src="<?= url("/theme/assets/js/Registration/Despesas.js"); ?>"></script>
<?php $v->end(); ?>