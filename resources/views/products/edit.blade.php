@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
<div class="card-header">
<div class="float-start">
Editar Produto
</div>
<div class="float-end">

<a href="{{ route('products.index') }}" class="btn btn-
primary btn-sm">&larr; Voltar</a>

</div>
</div>
<div class="card-body">
<form action="{{ route('products.update', $product->id) }}"
method="post">
@csrf

@method("PUT")

<div class="mb-3 row">

<label for="name" class="col-md-4 col-form-label text-md-
end text-start">Nome</label>

<div class="col-md-6">
<input type="text" class="form-control @error('name')
is-invalid @enderror" id="name"
name="name" value="{{ $product->name }}">
@error('name')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>
</div>
<div class="mb-3 row">
<label for="description"

class="col-md-4 col-form-label text-md-end text-
start">Descrição</label>

<div class="col-md-6">
<textarea class="form-control @error('description')
is-invalid @enderror" id="description"
name="description">{{ $product->description
}}</textarea>
@error('description')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>
</div>
<div class="mb-3 row">

<input type="submit" class="col-md-3 offset-md-5 btn btn-
primary" value="Atualizar Produto">

</div>
</form>
</div>
</div>
</div>
</div>
@endsection
show.blade.php
@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
<div class="col-md-8">

<div class="card">
<div class="card-header">
<div class="float-start">
Informações do Produto
</div>
<div class="float-end">

<a href="{{ route('products.index') }}" class="btn btn-
primary btn-sm">&larr; Voltar</a>

</div>
</div>
<div class="card-body">
<div class="row">
<label for="name"

class="col-md-4 col-form-label text-md-end text-
start"><strong>Nome:</strong></label>

<div class="col-md-6" style="line-height: 35px;">
{{ $product->name }}
</div>
</div>
<div class="row">
<label for="description"

class="col-md-4 col-form-label text-md-end text-
start"><strong>Descrição:</strong></label>

<div class="col-md-6" style="line-height: 35px;">
{{ $product->description }}
</div>
</div>
</div>
</div>
</div>
</div>
@endsection