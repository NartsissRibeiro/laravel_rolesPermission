@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('Você está logado!') }}
                    <p>Menu</p>
                    @canany(['create-role', 'edit-role', 'delete-role'])
                        <a class="btn btn-primary" href="{{route('roles.index')}}">
                            <i class="bi bi-person-fill-gear"></i> Gestão de Papéis</a>
                    @endcanany
                    @canany(['create-user', 'edit-user', 'delete-user'])
                        <a class="btn btn-success" href="{{route('users.index')}}">
                            <i class="bi bi-people"></i> Gestão de Usuários</a>
                    @endcanany
                    @canany(['create-product', 'edit-product', 'delete-product'])
                        <a class="btn btn-warning" href="{{route('products.index') }}">
                            <i class="bi bi-bag"></i> Gestão de Produtos</a>
                    @endcanany
                    @can(['view-product'])
                        <a class="btn btn-info" href="{{route('products.index')}}">
                            <i class="bi bi-bag"></i> Visualizar Produtos</a>
                        @endcan
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection