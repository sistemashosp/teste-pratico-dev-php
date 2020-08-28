<?php 

    namespace App\Controllers;
    //os recursos do framework
    use MF\Controller\Action;
    use MF\Model\Container;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    //os models
    //use App\Models\Produto; exemplo
    
    

    class IndexController extends Action {

        public function index(){
            $this->render('index');
        }

        public function salvarArquivo(){

            $file = $_FILES['file'];

            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            
            echo '<pre>'; var_dump($fileTmpName); echo '</pre>';

            $allowed = array('csv');

            if (in_array($fileActualExt, $allowed)) {
                
                if($fileError === 0){

                    $fileDestination = '/home/yagodev/Documentos/demo/App/uploads/'.$fileName;

                    move_uploaded_file($fileTmpName, $fileDestination);
                    header('Location: /salvarDB');

                }else{
                    echo 'Um erro ocorreu. Tente novamente';
                }

            }else{
                echo 'Você deve utilizar arquivos do tipo CSV para essa ação';
            }
        }

        public function salvarDB(){

            //Criação dos arrays de pacientes utilizando o PHPSpreadsheets  **PHPExcel foi descontinuado por isso o uso desse novo módulo
            $inputFileType = 'Csv';
            $inputFileName = '/home/yagodev/Documentos/demo/App/uploads/pacientes.csv';
            $reader = IOFactory::createReader($inputFileType);
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($inputFileName);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            //esta é uma variavel auxiliar que contem o tamanho total do array para realizar um loop classico
            $qtd_pacientes = sizeof($sheetData);

            //setando o model do paciente pelo container
            $paciente = Container::getModel('Paciente');
            $paciente->truncate();

            for ($i=2; $i <= $qtd_pacientes ; $i++) { 
                $paciente = Container::getModel('Paciente');
                $paciente->__set('nome', $sheetData[$i]['A'] );
                $paciente->__set('sobrenome', $sheetData[$i]['B'] );

                //regra de validação para o email
                $sinal = '@';
                if(strpos($sheetData[$i]['C'], $sinal) !== false){
                    $paciente->__set('email', $sheetData[$i]['C'] );
                }

                //regra de validação para data de nascimento
                if(strlen($sheetData[$i]['D']) == 10){ 
                    $paciente->__set('data_nascimento', $sheetData[$i]['D'] );
                }

                $paciente->__set('genero', $sheetData[$i]['E'] );
                $paciente->__set('tipo_sanguineo', $sheetData[$i]['F'] );
                $paciente->__set('endereco', $sheetData[$i]['G'] );
                $paciente->__set('cidade', $sheetData[$i]['H'] );
                $paciente->__set('estado', $sheetData[$i]['I'] );
                $paciente->__set('cep', $sheetData[$i]['J'] );

                //regra de validação para o CPF
                if(strlen($sheetData[$i]['K']) == 11 ){
                    $paciente->__set('CPF', $sheetData[$i]['K'] );
                }

                $this->view->sucesso = 'sucesso';
                $paciente->inserirPaciente();
                
            }
            
            $this->render('index');
            

        }

       public function getAll(){

        $paciente = Container::getModel('Paciente');
        $pacientes = $paciente->getAll();
        $this->view->pacientes = $pacientes;
        $this->render('getAll');




       }

    }

?>