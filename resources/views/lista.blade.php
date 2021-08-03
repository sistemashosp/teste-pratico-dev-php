<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teste iClinic</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>


    <div class="card">
        <div class="card-header">
            <h4>
                <div style="float: left; padding-right: 20px;">
                    Pacientes
                </div>      
                <div style="float: left; padding-right: 20px;">
                    <a href="{{route('site')}}" class="btn btn-sm btn-info">Voltar</a>
                </div>                        
            </h4>
        </div>
        
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>                    
                        <th>Sobrenome</th>                    
                        <th>Tip.</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Data Nasc</th>
                        <th>Gênero</th>
                        <th>Endereço</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>CEP</th>

                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($pacientes as $paciente)
                        
                        <tr>
                        <td>{{$paciente->id}}</td>
                        <td>{{$paciente->nome}}</td>                    
                        <td>{{$paciente->sobrenome}}</td>                    
                        <td>{{$paciente->descricao}}</td>                    
                        <td>{{$paciente->cpf}}</td>                    
                        <td>{{$paciente->email}}</td>                    
                        <td>{{date('d/m/Y', strtotime($paciente->data_nascimento))}}</td>                    
                        <td>{{($paciente->genero == 'M') ? 'Masculino' : 'Feminino'}}</td>                    
                        <td>{{$paciente->endereco}}</td>                    
                        <td>{{$paciente->cidade}}</td>                    
                        <td>{{$paciente->estado}}</td>                    
                        <td>{{$paciente->cep}}</td>              
                        </tr>    
                    @endforeach
                
                </tbody>            
                {{$pacientes->links();}}
            </table>        
            
        </div>
    </div>    
    
    

    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>