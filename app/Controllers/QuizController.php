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

    public function quizform()
    {

        // si il y x=1 => true
        // else => false
        //$data = serialize(array_values($_POST));
        $data = $_POST;
        $return = array();
        foreach ($data as $key => $value) {
            /*   test    */
            if ($value == prop1){
                //$return[$key]= $res;
                $code = true;
                $return[$key]= $code;
            }else {
                $code = false;
                $return[$key]= $code;
                // $return[$key]= $res;
            }


            /** origine ***/
            //$res = (int)$data[$key];
            // if ($res == 1){
            //     //$return[$key]= $res;
            //     $code = true;
            //     $return[$key]= $code;
            // }else {
            //     $code = false;
            //     $return[$key]= $code;
            //     // $return[$key]= $res;
            // }
        }

        // $res = (int)$data[64];
        // if ($res == 1){
        //     $code = 'Vrai';
        // }else {
        //     $code = 'Faux';
        // }

        $this->sendJSON([
            'code' => $return,
            //'data' => $data,
            // 'test' => $data[61]
        ]);

    }

}//end class
