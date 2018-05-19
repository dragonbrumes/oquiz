<?php

namespace Oquiz\Models;

// import des classes utiles se trouvant dans un autre namespace
use Oquiz\Database;
use PDO;

/**
 * Class de gestion des questions contenu dans les quiz
 */
class QuestionModel
{

    // propriétés pour chaque champ/colonne de la table
    private $id;
    private $id_quiz;
    private $question;
    private $prop1;
    private $prop2;
    private $prop3;
    private $prop4;
    private $id_level;
    private $anecdote;
    private $wiki;

    // constante de la table
    const TABLE_NAME = 'questions';

    //récupére toutes les questions selon l'id du quiz passé en param
    public static function questions ($id){
        $sql = "
            SELECT *
            FROM ".self::TABLE_NAME."
            WHERE id_quiz = :id";
        // prépare la requête
        $pdoStatement = Database::getPDO()->prepare($sql);

        // "bind" les données/token/jeton de la requête
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

        // exécute la requête
        $pdoStatement->execute();

        // récupère les résultats
        // $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        //dump($results);
        //$disorder = self::disorder($results);

        return $results;
    }

    public static function shuffle($id)
    {
        $sql = "
            SELECT prop1, prop2, prop3, prop4
            FROM ".self::TABLE_NAME."
            WHERE id_quiz = :id";
        // prépare la requête
        $pdoStatement = Database::getPDO()->prepare($sql);

        // "bind" les données/token/jeton de la requête
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

        // exécute la requête
        $pdoStatement->execute();

        // récupère les résultats
        // $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        $results = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        //dump($results);
        //$disorder = self::disorder($results);


        return $results;
    }

    public static function disorder($data)
    {
        foreach ($data as $key => $currentQuestion) {
            dump($data);
            //dump($currentQuestion['prop1']);
            dump($data[0]['prop1']);
            dump($data[0]['prop2']);
            //dump($key);
            $ques = [
            $data[$key++]['prop1'],
            $data[$key++]['prop2'],
            $data[$key++]['prop3'],
            $data[$key++]['prop4'],

        ];
            shuffle($ques);
            dump($ques);exit;
            return $ques;
        }
        // exit;
    }



    /**
     * Get the value of Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param int id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Id Quiz
     *
     * @return int
     */
    public function getIdQuiz()
    {
        return $this->id_quiz;
    }

    /**
     * Set the value of Id Quiz
     *
     * @param int id_quiz
     *
     * @return self
     */
    public function setIdQuiz($id_quiz)
    {
        $this->id_quiz = $id_quiz;

        return $this;
    }

    /**
     * Get the value of Question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set the value of Question
     *
     * @param string question
     *
     * @return self
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return string
     */
    public function getProp1()
    {
        return $this->prop1;
    }

    /**
     * Set the value of Prop
     *
     * @param string prop1
     *
     * @return self
     */
    public function setProp1($prop1)
    {
        $this->prop1 = $prop1;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return string
     */
    public function getProp2()
    {
        return $this->prop2;
    }

    /**
     * Set the value of Prop
     *
     * @param string prop2
     *
     * @return self
     */
    public function setProp2($prop2)
    {
        $this->prop2 = $prop2;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return string
     */
    public function getProp3()
    {
        return $this->prop3;
    }

    /**
     * Set the value of Prop
     *
     * @param string prop3
     *
     * @return self
     */
    public function setProp3($prop3)
    {
        $this->prop3 = $prop3;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return string
     */
    public function getProp4()
    {
        return $this->prop4;
    }

    /**
     * Set the value of Prop
     *
     * @param string prop4
     *
     * @return self
     */
    public function setProp4($prop4)
    {
        $this->prop4 = $prop4;

        return $this;
    }

    /**
     * Get the value of Id Level
     *
     * @return int
     */
    public function getIdLevel()
    {
        return $this->id_level;
    }

    /**
     * Set the value of Id Level
     *
     * @param mixed id_level
     *
     * @return int
     */
    public function setIdLevel($id_level)
    {
        $this->id_level = $id_level;

        return $this;
    }

    /**
     * Get the value of Anecdote
     *
     * @return string
     */
    public function getAnecdote()
    {
        return $this->anecdote;
    }

    /**
     * Set the value of Anecdote
     *
     * @param string anecdote
     *
     * @return self
     */
    public function setAnecdote($anecdote)
    {
        $this->anecdote = $anecdote;

        return $this;
    }

    /**
     * Get the value of Wiki
     *
     * @return string
     */
    public function getWiki()
    {
        return $this->wiki;
    }

    /**
     * Set the value of Wiki
     *
     * @param mixed wiki
     *
     * @return string
     */
    public function setWiki($wiki)
    {
        $this->wiki = $wiki;

        return $this;
    }

}
