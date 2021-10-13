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
         
         @if (session()->has('success'))
            <h1>{{ session('success') }}</h1>
        @endif
        
        <h1 class="display-4">Hello, world!</h1>
             <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
             <div class="form-group">
            <label for="file"></label>
            <input type="file" class="form-control-file" name="import_file" accept=".csv">
        </div>
        
            <p class="lead">
            <button class="btn btn-primary btn-lg" type="submit">Importar CSV</button>
            </p>
        </div>

         </form>
    </body>
</html>