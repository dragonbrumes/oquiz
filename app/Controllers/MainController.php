<?php

namespace Oquiz\Controllers;

use Oquiz\Models\QuizModel;

class MainController extends CoreController
{
    public function indexAction()
    {
        $quizList = QuizModel::findAll();

        echo $this->templates->render('main/home', [
        'quizList' => $quizList, // $quizList

    ]);
    }
}//end class
