<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <form action="{{ route('importar') }}" enctype="multipart/form-data" method="POST">
        @csrf 
        <div class="jumbotron">
        @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                      <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-ban"></i> Error!</h4>
                          @foreach($errors->all() as $error)
                          {{ $error }} <br>
                          @endforeach      
                      </div>
                    </div>
                </div>
         @endif
         @if (isset($failures))
   <div class="alert alert-danger" role="alert">
      <strong>Errors:</strong>
      
      <ul>
         @foreach ($failures as $failure)
            @foreach ($failure->errors() as $error)
                <li>{{ $error }}</li>
            @endforeach
         @endforeach
      </ul>
   </div>
@endif

         @if (session()->has('success'))
         <div class="alert alert-success" role="alert">
            <h1>{{ session('success') }}</h1>
        </div>
        @endif

        <h1 class="display-4">Desafio Iclinic !</h1>
             <p class="lead">Isto é uma implementação básica de importação de CSV utilizando a biblioteca <b>Laravel Excel</b><br/> Insira um aquivo de extensão <b>.CSV</b></p>
             <div class=" alert alert-warning">
             <b>ATENÇÃO, LEVANDO EM CONSIDERAÇÃO QUE O PROJETO FOI REALIZADO APENAS UM AMBIENTE DE DESENVOLVIMENTO, ARQUIVOS IGUAIS OU MAIORES QUE 500000 BYTES ESTÃO SENDO PROCESSADOS EM FILA, PARA TAL É NECESSÁRIO UTILIZAR UMA DIRETIVA NO TERMINAL : <code>php artisan queue:work</code> PARA QUE O ARQUIVO SEJA PROCESSADO ! </b>    
             </div>
             <div class="form-group">
            <label for="file"></label>
            <input type="file" class="form-control-file" name="import_file" accept=".csv">
        </div>
        
            <p class="lead">
            <button class="btn btn-primary btn-lg" type="submit">Importar CSV</button>
            </p>
        </div>

         </form>

         
  @if (isset($pacientes))
         <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Sobrenome</th>
      <th scope="col">CPF</th>
      <th scope="col">Email</th>
      <th scope="col">Data de Nascimento</th>
      <th scope="col">Genêro</th>
      <th scope="col">Tipo Sanguíneo</th>
      <th scope="col">Endereço</th>
      <th scope="col">Cidade</th>
      <th scope="col">Estado</th>
      <th scope="col">Cep</th>
    </tr>
  </thead>
  <tbody>
  @foreach($pacientes as $paciente) 
    <tr>
      <th scope="row">{{$paciente->id}}</th>
      <td>{{$paciente->nome}}</td>
      <td>{{$paciente->sobrenome}}</td>
      <td>{{$paciente->cpf}}</td>
      <td>{{$paciente->email}}</td>
      <td>{{$paciente->dataNascimento}}</td>
      <td>{{$paciente->genero}}</td>
      <td>{{$paciente->idTipoSanquineo}}</td>
      <td>{{$paciente->endereco}}</td>
      <td>{{$paciente->cidade}}</td>
      <td>{{$paciente->estado}}</td>
      <td>{{$paciente->cep}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif
    </body>
</html>