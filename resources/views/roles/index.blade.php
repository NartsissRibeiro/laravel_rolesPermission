@extends('layouts.app')

@section('content')
<div class="card">
<div class="card-header">Gestão de Papéis</div>
<div class="card-body">
@can('create-role')
<a href="{{ route('roles.create') }}" class="btn btn-success btn-sm
my-2"><i class="bi bi-plus-circle"></i> Adcionar Novo Papel</a>
@endcan
<table class="table table-striped table-bordered">
<thead>
<tr>
<th scope="col">S#</th>
<th scope="col" style="max-width:100px;">Nome do Papel</th>
<th scope="col">Permissão</th>
<th scope="col" style="width: 250px;">Ação</th>
</tr>
</thead>
<tbody>
@forelse ($roles as $role)
<tr>
<th scope="row">{{ $loop->iteration }}</th>
<td>{{ $role->name }}</td>
<td>
<ul>
@forelse ($role->permissions as $permission)
<li>{{ $permission->name }}</li>
@empty
@endforelse

</ul>
</td>
<td>

<form action="{{ route('roles.destroy', $role->id)
}}" method="post">
@csrf

@method('DELETE')

@if ($role->name != 'Super Admin')
@can('edit-role')
<a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm"><i
class="bi bi-pencil-square"></i>
Editar</a>
@endcan

@can('delete-role')
@if ($role->name != Auth::user()->hasRole($role->name))
<!-- Botão que abre a modal -->

<button type="button" class="btn btn-
danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModalRole{{ $role->id }}">
<i class="bi bi-trash"></i>
Deletar
</button>
<!-- Modal Bootstrap -->
<div class="modal fade" id="deleteModalRole{{ $role->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $role->id }}" aria-hidden="true">

<div class="modal-dialog modal-dialog-centered">

<div class="modal-content">
<div class="modal-header bg-danger text-white">

<h5 class="modal-title" id="deleteModalLabel{{ $role->id }}">Confirmação de Exclusão</h5>

<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
</div>

<div class="modal-body">
Tem certeza que
deseja apagar o papel <strong>{{ $role->name }}</strong>?
</div>

<div class="modal-footer">

<button type="button"

class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-octagon-fill">    
</i> Cancelar</button>

<form action="{{
route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
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
<td colspan="3">
<span class="text-danger">
<strong>Nenhum papel encontrado!</strong>
</span>
</td>
@endforelse
</tbody>
</table>
{{ $roles->links() }}
</div>
</div>
@endsection