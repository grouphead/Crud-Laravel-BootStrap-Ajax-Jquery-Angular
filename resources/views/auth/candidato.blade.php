@extends('layouts.template')
@section('title','BSN Candidatos')
@section('content')
<div class="container" style="padding: 20px">
    <form method="POST" action="{{route('enviar.candidatos')}}">
        @csrf
        <div class="form-group">
        <input type="hidden" name="id" value="{{Auth::user()->id}}">
        <label for="exampleFormControlInput1">Nome do candidato</label>
        <input type="text" name="nome" class="form-control" id="nome" placeholder="Digite seu nome">
        </div>
        <div class="form-group">
        <label for="exampleFormControlSelect1">Vaga na qual deseja</label>
        <select name="vaga" class="form-control" id="vaga">
            <option disabled selected selected>Escolha a vaga</option>
            @foreach ($vaga as $item)
            <option name="vaga" value="{{$item->id}}">{{$item->nome}}</option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
        <label for="exampleFormControlSelect2">Selecione a linguagem</label>
        <select name="linguagem" class="form-control" id="linguagem"
         >
        </select>
        </div>
        <div class="form-group">
            <button type="submit" id="sub" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function () {
                $('#vaga').on('change', function () {
                let id = $(this).val();
                $('#linguagem').empty();
                $('#linguagem').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                type: "GET",
                url: 'api/crudCandidatos/' + id,
                success: function (response) {
                console.log(response);
                var respons = JSON.parse(response);
                console.log(respons);
                $('#linguagem').empty();
                $('#linguagem').append(`<option value="0" disabled selected>Selecione a linguagem</option>`);
                respons.forEach(element => {
                    $('#linguagem').append(`<option name="linguagem" value="${element['id']}">${element['nome']}</option>`);                   
                    });
                }
            });
        });
    });
</script>
@endsection