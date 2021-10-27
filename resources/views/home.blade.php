@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="row justify-content-center">
                        <div class="card col-md-3 mr-3" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Importar arquivo Csv</h5>
                                <a href="{{url('pacientes/cadastro')}}" class="btn btn-primary">Importa Csv</a>
                            </div>
                        </div>
                        <div class="card col-md-3 mr-3" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Lista pacientes</h5>
                                <a href="{{url('/pacientes')}}" class="btn btn-primary">Listar</a>
                            </div>
                        </div>
                        <div class="card col-md-3 mr-3" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Lista tipo sangueneo</h5>
                                <a href="{{url('/tiposanguineo')}}" class="btn btn-primary">Listar</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection