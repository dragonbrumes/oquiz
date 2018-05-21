<?php

namespace Oquiz\Controllers;

use Oquiz\Models\QuizModel;

class QuizController extends CoreController
{

    public static function singleQuiz($allParams)
    {
        $id = (int) $allParams['id'];
        $quiz = QuizModel::find($id);
        //dump($quiz); exit;
        //echo $this->templates->render('quiz/quiz', [
        //'quiz' => $quiz, // $quizList
    //]);
    }

    // vérifie les réponses et renvoi si c'est juste ou non
    public function quizform()
    {

        $data = $_POST;
        $return = array();
        foreach ($data as $key => $value) {

            if ($value == prop1){
                $code = true;
                $return[$key]= $code;
            }else {
                $code = false;
                $return[$key]= $code;
            }
        }

        // renvoi la réponse en Json
        $this->sendJSON([
            'code' => $return
        ]);

    }

}//end class
