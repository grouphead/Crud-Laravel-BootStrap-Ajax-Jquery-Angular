@extends('layouts.templateadmin')
@section('title', 'BSN Teste')
@section('content') 
<div class="container" style="padding: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inicio Admin</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Você está logado
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
