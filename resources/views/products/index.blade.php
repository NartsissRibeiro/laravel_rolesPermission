@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Lista de Produtos</div>
        <div class="card-body">
            @can('create-product')
                <a href="{{ route('products.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
                Adicionar Novo Produto</a>
            @endcan
            <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">S#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Mostrar</a>
                                @can('edit-product')
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> 
                                        Editar</a>
                                @endcan

                                @can('delete-product')
                                <!-- Botão que abre a modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModalProduct{{ $product->id }}">
                                    <i class="bi bi-trash"></i> Deletar
</button>
<!-- Modal Bootstrap -->
<div class="modal fade"

id="deleteModalProduct{{ $product->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $product->id }}" aria-hidden="true">

<div class="modal-dialog modal-dialog-centered">

<div class="modal-content">

<div class="modal-header bg-danger text-white">

<h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">Confirmação de Exclusão</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
</div>

<div class="modal-body">

Tem certeza que deseja apagar
o produto <strong>{{ $product->name }}</strong>?
</div>

<div class="modal-footer">
<button type="button"

class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-octagon-fill"></i> Cancelar</button>

<form action="{{
route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
@csrf

@method('DELETE')
<button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Deletar</button>
</form>
</div>
</div>
</div>
</div>
@endcan
</form>
</td>
</tr>
@empty
<td colspan="4">
<span class="text-danger">
<strong>Nenhum produto encontrado!</strong>
</span>
</td>
@endforelse

</tbody>
</table>
{{ $products->links() }}
</div>
</div>
@endsection