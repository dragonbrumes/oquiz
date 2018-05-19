<?php

namespace Oquiz\Controllers;

use Oquiz\Models\QuizModel;
use Oquiz\Models\QuestionModel;

class QuestionController extends CoreController
{

    // agrège les questions et les extras d'un quiz
    public function questions($allParams)
    {
        // récupère l'id du quiz cliqué et transforme en interger
        $id = (int) $allParams['id'];
        // va chercher l'id du quiz
        $quiz = QuizModel::find($id);
        // va chercher TOUT les éléments liées au quiz
        $questions = QuestionModel::questionsExtra($quiz->getId());
        // va chercher tout SAUF les questions
        // $questions = QuestionModel::questionsExtra($quiz->getId());
        //$shuffle = $questions->shuffle($quiz->getId());

        // envoi les infos a la view
        echo $this->templates->render('quiz/quiz', [
        'quiz' => $quiz, // $quizList
        'questionsList' => $questions, // $questionsList
        //'questionsExtra' => $questionsExtra, // $questionsExtra
    ]);
    }

    public function questionsSave($allParams)
    {
        // récupère l'id du quiz cliqué
        $id = (int) $allParams['id'];
        // va chercher l'id du quiz
        $quiz = QuizModel::find($id);
        // va chercher les questions liées au quiz
        $questions = QuestionModel::questions($quiz->getId());
        // envoi les infos a la view
        echo $this->templates->render('quiz/quiz', [
        'quiz' => $quiz, // $quizList
        'questionsList' => $questions, // $questionsList
    ]);
    }


}//end class
