<?php

namespace Oquiz\Controllers;

use Oquiz\Models\QuizModel;

class QuizController extends CoreController
{

    public function singleQuiz($allParams)
    {
        $id = (int) $allParams['id'];
        $quiz = QuizModel::find($id);
        //dump($quiz); exit;
        echo $this->templates->render('quiz/quiz', [
        'quiz' => $quiz, // $quizList

    ]);
    }
}//end class
