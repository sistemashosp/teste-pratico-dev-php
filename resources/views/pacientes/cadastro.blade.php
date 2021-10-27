@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header"><a href="{{url('/')}}">Voltar</a></div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{url('pacientes/cadastro')}}" method="post" id="form-importacao" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputArquivo">Arquivo</label>
                            <input type="file" class="form-control-file" name="arquivo" id="arquivo" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Importar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#form-importacao").on("submit", function(e) {

        console.log('Regis nunes Santos');
        e.preventDefault();
        load("open");
        $("#form-importacao").ajaxSubmit({
            url: 'paciente/cadastro',
            type: "post",
            dataType: "json",
            success: function(response) {
                // load("close");
                if (response[0] == "success") {
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            },
        });
    });
</script>



@endsection