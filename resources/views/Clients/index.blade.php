@extends('Layouts.LayoutFull')
    
@push('css')

@endpush
@if (Session::has('success'))
            toastr["success"]("<b>SUCESSO: </b>"<br>
            {{ Session::get('success') }}");
@endif
@section('conteudo')
<div style="text-align:center">
    <h1>CLIENTES CADASTRADOS</h1>
</div>
<div>
    <a href="{{route('client.create')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Adicionar</a>
</div>
<br />
<div>
    <table class="table table-dark">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">E-mail</th>
            <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
                @foreach($clients as $client)
                    <tr>
                        <th scope="row">{{$client->id}}</th>
                        <td>{{$client->name}}</td>
                        <td>{{$client->cpf}}</td>
                        <td>{{$client->email}}</td>
                        <td>
                            <button class="btn btn-primary" type="submit">Editar</button>
                            <button class="btn btn-primary" type="submit">Excluir</button>
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>
@endsection
@push('scripts') 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script>
        $(".cpf-mask").mask('000.000.000-00');
</script>
@endpush