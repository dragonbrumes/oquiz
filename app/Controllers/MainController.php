<?php

namespace Oquiz\Controllers;

use Oquiz\Models\QuizModel;
use Oquiz\Models\QuestionModel;

class MainController extends CoreController
{
    // affiche tout les quiz en home
    public function indexAction()
    {
        $quizList = QuizModel::findAll();

        echo $this->templates->render('main/home', [
        'quizList' => $quizList, // $quizList
        ]);
    } //indexAction

    // vérifie les réponses à un quiz et renvoi si c'est juste ou non
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

    // agrège les questions et les extras d'un quiz
    public function questions($allParams)
    {
        // récupère l'id du quiz cliqué et transforme en interger
        $id = (int) $allParams['id'];
        // va chercher l'id du quiz
        $quiz = QuizModel::find($id);
        $quizId = $quiz->getId();
        // dump($quizId);exit;
        // va chercher TOUT les éléments liées au quiz
        $quizQuestions = QuestionModel::quizInfos($quizId);

        // envoi les infos a la view
        echo $this->templates->render('quiz/quiz', [
        'quiz' => $quiz, // $quizList
        'quizQuestions' => $quizQuestions, // $questionsList
        //'questionsExtra' => $questionsExtra, // $questionsExtra
    ]);
    }

}//end class
