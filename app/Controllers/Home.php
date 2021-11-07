<?php
    class Home extends Controller {

        public function index($id){
            $this->view('home', ['titulo' => 'Pagina Inicial']);
        }
    }
?>