<?php

class Controller {
    public $load;
    public $model;
  
    
    function __construct(){
        $this->load = new Load();
        $this->model = new Model();
        $this->home();
        // $this->signin();
    }
    
    function home() {
      $this->load->view('index.php');
    }

    function signin(){
        $this->load->view('sign-in.php');
    }



}
