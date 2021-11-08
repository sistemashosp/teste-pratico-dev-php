<?php

namespace Source\Models;

use Source\Controller\PacienteController;

class Upload{
    private $name;
    private $extension;
    private $type;
    private $tmpName;
    private $error;
    private $size;

    public function __construct($file){
        $this->type = $file['type'];
        $this->tmpName = $file['tmp_name'];
        $this->error = $file['error'];
        $this->size = $file['size'];

        $info = pathinfo($file['name']);
        $this->name = $info['filename'];
        $this->extension = $info['extension'];
    }

    public function getBasename(){
        $extension = strlen($this->extension)? '.'.$this->extension : '';
        return $this->name.$extension;
    }

    public function upload($dir){
        if($this->error !=0) return false;

        $path =  $dir.'/'.$this->getBasename();

        $saveOnDB = new PacienteController();
        $saveOnDB->importDataCsv($path);

        return move_uploaded_file($this->tmpName, $path);
    }

}

