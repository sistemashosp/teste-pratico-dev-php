
<?php include('includes/header.php')


?>

  <form action="" method="POST"  id="RgValidate">
    <div class="form-group">
      <label for="nome">Nome:</label>
      <input type="text" class="form-control" id="nome" placeholder="nome" name="nome"  data-rules="required|min=2" >
    </div>
    <div class="form-group">
      <label for="pwd">Sobrenome:</label>
      <input type="text" class="form-control" id="sobrenome" placeholder="Enter password" name="sobrenome" data-rules="required|min=2" >
    </div>

    <div class="form-group">
      <label for="pwd">cpf:</label>
      <input type="text" class="form-control" id="cpf" placeholder="Enter password" name="cpf"  data-rules="required|cpf" >
    </div>

    <div class="form-group">
      <label for="pwd">email:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter password" name="email"  data-rules="required|email">
    </div>

    <div class="form-group">
      <label for="pwd">data nascimento:</label>
      <input type="text" class="form-control" id="datanascimento"  name="datanascimento"  data-rules="required|data">
    </div>

    <div class="form-group">
      <label for="pwd">genero:</label>
    <select name="genero" id="" class="form-control">
      <option value="M">Masculino</option>
      <option value="F">Feminino</option>
    </select>
    </div>

    <div class="form-group">
      <label for="pwd">Tipo Sanguineo:</label>
      <select name="tipo" id="tipo" class="form-control">
        <?php
        
        $Paciente = new Pacientes();
        $tipoSanguineo = $Paciente->ListarTipoSanguineo();
        
        
          
        foreach($tipoSanguineo as $tipo){
            extract($tipo);
        ?>
        <option value="<?php echo $id?>" ><?php echo $descricao?></option>
        <?php }?>
      </select>
    </div>

    <div class="form-group">
      <label for="pwd">endereco:</label>
      <input type="text" class="form-control" id="endereco" placeholder="Endereço" name="endereco">
    </div>

    <div class="form-group">
      <label for="pwd">cidade:</label>
      <input type="text" class="form-control" id="cidade" placeholder="Cidade" name="cidade" >
    </div>

    <div class="form-group">
      <label for="pwd">estado:</label>
      <input type="text" class="form-control" id="estado" placeholder="Estado" name="estado" >
    </div>

    <div class="form-group">
      <label for="pwd">estado:</label>
      <input type="text" class="form-control" id="cep" placeholder="cep" name="cep">
    </div>

    <input type="submit" name="cadastrar" class="btn btn-primary" value="cadastrar">
  </form>
</div>
<script src="assets/main.js"></script>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.js" integrity="sha512-bwanfE29Vxh7VGuxx44U2WkSG9944fjpYRTC3GDUjh0UJ5FOdCQxMJgKWBnlxP5hHKpFJKmawufWEyr5pvwYVA==" crossorigin="anonymous" referrerpolicy="no-referrer">


</script>

