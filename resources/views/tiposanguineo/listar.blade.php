@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h3>Lista de Tipo Sanguineo</h3>
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
                                <th>Descrição</th>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->descricao}}</td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection