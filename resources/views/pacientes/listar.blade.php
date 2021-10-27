@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h3>Lista de Pacientes</h3>
                        </div>
                        <div class="col-2"> <a href="{{url('/')}}" class="btn btn-lg btn-primary">Voltar</a></div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <thead>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Sobrenome</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th>Data Nascimento</th>
                                <th>Genero</th>
                                <th>Id do Tipo Sangúineo</th>
                                <th>Endereco</th>
                                <th>Cidade</th>
                                <th>Estado </th>
                                <th>CEP</th>
                            </thead>
                            <tbody>
                                @foreach($dados as $key => $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->nome}}</td>
                                    <td>{{$row->sobrenome}}</td>
                                    <td>{{$row->cpf}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->data_nascimento}}</td>
                                    <td>{{$row->genero}}</td>
                                    <td>{{$row->id_tipo_sanguineo}}</td>
                                    <td>{{$row->endereco}}</td>
                                    <td>{{$row->cidade}}</td>
                                    <td>{{$row->estado}}</td>
                                    <td>{{$row->cep}}</td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                        {{ $dados->links() }}
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection