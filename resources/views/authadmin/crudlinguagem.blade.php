@extends('layouts.templateadmin')
@section('title', 'BSN Teste')
@section('content')
<style>
    .body{
        padding: 20px;
    }
</style>
<div class="container body">
    <div class="card text-center">
        <div class="card-header">
            Tabela de Linguagem
        </div>
        <div class="card-body">
            <h5 class="card-title" id="cardtitle">
                
            </h5>
            <table class="table table-hover" id="tabelaClientes">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Lucas</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <nav id="paginator">
                <ul class="pagination">
                </ul>
            </nav>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    function getItem(data, i){
                    if (data.current_page == i) 
                    s = '<li class="page-item active">';
                    else
                        s = '<li class="page-item">';
                    s += '<a class="page-link" ' + 'pagina="'+i+'" ' + ' href="javascript:void(0);">' + i + '</a></li>';
                    return s;
                }
    
                function getItemProximo(data){
                    i = data.current_page+1;
                    if (data.current_page == data.last_page) 
                        s = '<li class="page-item disabled">';
                    else
                        s = '<li class="page-item">';
                    s += '<a class="page-link" ' + 'pagina="'+i+'" ' + ' href="javascript:void(0);">Próximo</a></li>';
                    return s;
                }
    
                function getItemAnterior(data){
                    i = data.current_page-1;
                    if (data.current_page == 1) 
                        s = '<li class="page-item disabled">';
                    else
                        s = '<li class="page-item">';
                    s += '<a class="page-link" ' + 'pagina="'+i+'" ' + ' href="javascript:void(0);">Anterior</a></li>';
                    return s;
                }
    
                function montarPaginator(data){
                    $("#paginator>ul>li").remove();
                    $("#paginator>ul").append(getItemAnterior(data));
                    n = 10;
            
                    if (data.current_page - n/2 <= 1)
                        inicio = 1;
                    else if (data.last_page - data.current_page < n)
                        inicio = data.last_page - n + 1;
                    else 
                        inicio = data.current_page - n/2;
                    
                    fim = inicio + n-1;
                    for (i = inicio; i <= fim; i++){
                        s = getItem(data,i);
                        $("#paginator>ul").append(s);
                    }
                    $("#paginator>ul").append(getItemProximo(data));
                }
    
                function montarLinha(linguagem){
                    return '<tr>' + 
                                '<td>' + linguagem.id + '</td>' +
                                '<td>' + linguagem.nome + '</td>' +
                            '</tr>';
                }
    
                function montarTabela(data){
                    $("#tabelaClientes>tbody>tr").remove();
                    for (i = 0; i < data.data.length; i++) {
                        s = montarLinha(data.data[i]);
                        $("#tabelaClientes>tbody").append(s);
                    }
                }
    
                function carregarClientes(pagina){
                    $.get('/json', {page: pagina}, function(resp){
                        console.log(resp);
                        montarTabela(resp);
                        montarPaginator(resp);
                    $("#paginator>ul>li>a").click(function(){
                        // console.log($(this).attr('pagina') );
                        carregarClientes($(this).attr('pagina'));
                    })
                    $("#cardtitle").html( "Exibindo " + resp.total + 
                        " linguagens de " + resp.per_page + 
                        " (" + resp.from + " a " + resp.to +  ")" );
                    });
                }
    
                $(function(){
                    carregarClientes(1);
                });
    </script>
<app-root></app-root>

<script src="{{asset('js/runtime-es2015.js')}}" type="module"></script>
<script src="{{asset('js/runtime-es5.js')}}"" nomodule defer></script>
<script src="{{asset('js/polyfills-es5.js')}}"" nomodule defer></script>
<script src="{{asset('js/polyfills-es2015.js')}}"" type="module"></script>
<script src="{{asset('js/styles-es2015.js')}}"" type="module"></script>
<script src="{{asset('js/styles-es5.js')}}"" nomodule defer></script>
<script src="{{asset('js/vendor-es2015.js')}}"" type="module"></script>
<script src="{{asset('js/vendor-es5.js')}}"" nomodule defer></script>
<script src="{{asset('js/main-es2015.js')}}"" type="module"></script>
<script src="{{asset('js/main-es5.js')}}"" nomodule defer></script>
@endsection