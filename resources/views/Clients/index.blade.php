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
                            <a href="{{ route('client.edit',[ $client->id]) }}" class="btn btn-primary btn-sm text-white">
                                <i class="fal fa-pencil"></i>
                                <span class="d-none d-md-inline"> Editar</span>
                            </a>
                            <span data-url="{{ route('client.destroy',[ $client->id]) }}" data-idClient='{{ $client->id }}' class="btn btn-warring btn-sm text-white deleteButton">
                                <i class="fal fa-trash"></i>
                                <span class='d-none d-md-inline'> Deletar</span>
                            </span>
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
        $('.deleteButton').on('click', function (e) {
        var url = $(this).data('url');
        var idClient = $(this).data('idClient');
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            method: 'DELETE',
            url: url
        });
        $.ajax({
            data: {
                'idClient': idClient,
            },
            success: function (data) {
                console.log(data);
                if (data['status'] ?? '' == 'success') {
                    if (data['reload'] ?? '') {
                        location.reload();
                    }
                } else {
                   console.log('error');
                }
            },
            error: function (data) {
                console.log(data);
            }
            });
        });

</script>
@endpush