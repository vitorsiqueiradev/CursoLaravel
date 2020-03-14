@extends('Layouts.LayoutFull')
    
@push('css')

@endpush
@section('conteudo')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{route('client.store')}}" class="form-horizontal form-validate">
{{csrf_field()}}
        <div style="text-align:center">
            <label>Ativo?</label>
            <input type="checkbox" id="box" name="box" value='{{ old("checkbox") }}'>
        </div>
        <div style="text-align:center">
            <label>
                <br />
                Name:       <input id="nome" name="nome" type="text" required value='{{ old("nome") }}'/><br /><br />
                Write:        <input id="cpf" name="cpf" type="text" class="cpf-mask" value='{{ old("cpf") }}'/><br /><br />
                Page_number:   <input id="end" name="end" type="text" value='{{ old("end") }}'/><br /><br />
                
                <button class="btn btn-success" type="submit">Cadastrar</button>
            </label>
            
        </div>
    </form>
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