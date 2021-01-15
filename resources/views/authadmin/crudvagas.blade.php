@extends('layouts.templateadmin')
@section('title','BSN Vagas')
@section('content')
<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Vagas</h5>

        <table class="table table-ordered table-hover" id="tabelaVagas">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Linguagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
       
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onClick="novoProduto()">Nova Vaga</a>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgVaga">
    <div class="modal-dialog" role="document"> 
        <div class="modal-content">
            <form class="form-horizontal" id="formVaga">
                <div class="modal-header">
                    <h5 class="modal-title">Nova Vaga</h5>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="nomeVaga" class="control-label">Nome do Vaga</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nomeVaga" placeholder="Nome do produto">
                        </div>
                    </div>                  

                    <div class="form-group">
                        <label for="categoriaLinguagem" class="control-label">Linguagem</label>
                        <div class="input-group">
                            <select class="form-control" id="categoriaLinguagem" >
                            </select>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
    
    function novoProduto() {
        $('#id').val('');
        $('#nomeVaga').val('');
        $('#dlgVaga').modal('show');
    }
    
    function carregarCategorias() {
        $.getJSON('/api/admin/crudlinguagens', function(data) { 
            for(i=0;i<data.length;i++) {
                opcao = '<option value ="' + data[i].id + '">' + 
                    data[i].nome + '</option>';
                $('#categoriaLinguagem').append(opcao);
            }
        });
    }
    
    function montarLinha(p) {
        var linha = "<tr>" +
            "<td>" + p.id + "</td>" +
            "<td>" + p.nome + "</td>" +
            "<td>" + p.linguagem_id + "</td>" +
            "<td>" +
              '<button class="btn btn-sm btn-primary" onclick="editar(' + p.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onclick="remover(' + p.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }
    
    function editar(id) {
               
    }
    
    function remover(id) {
        $.ajax({
            type: "DELETE",
            url: "/api/admin/crudVagas/" + id,
            context: this,
            success: function() {
                console.log('Apagou OK');
                linhas = $("#tabelaVagas>tbody>tr");
                e = linhas.filter( function(i, elemento) { 
                    return elemento.cells[0].textContent == id; 
                });
                if (e)
                    e.remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    
    function carregarProdutos() {
        $.getJSON('/api/admin/crudVagas', function(produtos) { 
            for(i=0;i<produtos.length;i++) {
                linha = montarLinha(produtos[i]);
                $('#tabelaVagas>tbody').append(linha);
            }
        });        
    }
    
    function criarProduto() {
        prod = { 
            nome: $("#nomeVaga").val(), 
            linguagem_id: $("#categoriaLinguagem").val() 
        };
        $.post("/api/admin/crudVagas", prod, function(data) {
            produto = JSON.parse(data);
            linha = montarLinha(produto);
            $('#tabelaVagas>tbody').append(linha);            
        });
    }
    
    function salvarProduto() {
        prod = { 
            id : $("#id").val(), 
            nome: $("#nomeVaga").val(), 
            categoria_id: $("#categoriaLinguagem").val() 
        };
        $.ajax({
            type: "PUT",
            url: "/api/admin/crudVagas/" + prod.id,
            context: this,
            data: prod,
            success: function(data) {
                prod = JSON.parse(data);
                linhas = $("#tabelaVagas>tbody>tr");
                e = linhas.filter( function(i, e) { 
                    return ( e.cells[0].textContent == prod.id );
                });
                if (e) {
                    e[0].cells[0].textContent = prod.id;
                    e[0].cells[1].textContent = prod.nome;
                    e[0].cells[2].textContent = prod.linguagem_id;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });        
    }
    
    $("#formVaga").submit( function(event){ 
        event.preventDefault(); 
        if ($("#id").val() != '')
            salvarProduto();
        else
            criarProduto();
            
        $("#dlgVaga").modal('hide');
    });
    
    $(function(){
        carregarCategorias();
        carregarProdutos();
    })
    
</script>
@endsection