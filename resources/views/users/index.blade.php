@extends('layouts.app')
@section('content')
<div class="card">
<div class="card-header">Gestão de Usuários</div>
<div class="card-body">
@can('create-user')
<a href="{{ route('users.create') }}" class="btn btn-success btn-sm
my-2"><i class="bi bi-plus-circle"></i> Adicionar Novo Usuário</a>
@endcan
<table class="table table-striped table-bordered">
<thead>
<tr>
<th scope="col">S#</th>
<th scope="col">Nome</th>
<th scope="col">Email</th>
<th scope="col">Papel</th>
<th scope="col">Ação</th>
</tr>

</thead>
<tbody>
@forelse ($users as $user)
<tr>
<th scope="row">{{ $loop->iteration }}</th>
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>
<td>
<ul>
@forelse ($user->getRoleNames() as $role)
<li>{{ $role }}</li>
@empty
@endforelse

</ul>
</td>
<td>

<form action="{{ route('users.destroy', $user->id)
}}" method="post">
@csrf

@method('DELETE')

@if (in_array('Super Admin', $user-
>getRoleNames()->toArray() ?? []))
@if (Auth::user()->hasRole('Super Admin'))
<a href="{{ route('users.edit', $user-
>id) }}" class="btn btn-primary btn-sm"><i
class="bi bi-pencil-square"></i>
Editar</a>
@endif
@else
@can('edit-user')
<a href="{{ route('users.edit', $user-
>id) }}" class="btn btn-primary btn-sm"><i
class="bi bi-pencil-square"></i>
Editar</a>
@endcan
@can('delete-user')
@if (Auth::user()->id != $user->id)
<!-- Botão que abre a modal -->

<button type="button" class="btn btn-
danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModalUser{{ $user->id

}}">
<i class="bi bi-trash"></i>
Deletar
</button>

<!-- Modal Bootstrap -->
<div class="modal fade"

id="deleteModalUser{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{
$user->id }}" aria-hidden="true">

<div class="modal-dialog modal-
dialog-centered">

<div class="modal-content">
<div class="modal-header
bg-danger text-white">

<h5 class="modal-
title" id="deleteModalLabel{{ $user->id }}">Confirmação de Exclusão</h5>

<button type="button"
class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
</div>

<div class="modal-body">
Tem certeza que
deseja apagar o usuário <strong>{{ $user->name }}</strong>?
</div>

<div class="modal-
footer">

<button type="button"

class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-octagon-
fill"></i> Cancelar</button>

<form action="{{
route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
@csrf

@method('DELETE')

<button
type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i>
Deletar</button>
</form>
</div>
</div>
</div>
</div>
@endif
@endcan
@endif
</form>
</td>
</tr>
@empty
<td colspan="5">
<span class="text-danger">
<strong>No User Found!</strong>
</span>
</td>
@endforelse
</tbody>
</table>

{{ $users->links() }}
</div>
</div>
@endsection