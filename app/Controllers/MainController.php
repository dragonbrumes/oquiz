<?php

namespace Oquiz\Controllers;

class MainController extends CoreController {

  public function home() {
    
    echo $this->templates->render('main/home', [
        'name' => 'Ben', // => $name dans la template
    ]);
  }
}//end class
