<?php

namespace Oquiz\Models;

// import des classes utiles se trouvant dans un autre namespace
use Oquiz\Database;
use PDO;

/**
 * Class de gestion des quiz
 */
// class QuizModel extends CoreModel {
class QuizModel
{
    // propriétés pour chaque champ/colonne de la table
    private $id;
    private $title;
    private $description;
    private $id_author;
    private $uid;
    private $first_name;
    private $last_name;

    // constante de la table
    const TABLE_Q = 'quizzes';
    const TABLE_U = 'users';

    // retourne tout les quiz
    public static function findAll()
    {
        $sql = "
        SELECT quizzes.id, quizzes.title, quizzes.description, quizzes.id_author, users.id AS uid, users.first_name, users.last_name
        FROM ".self::TABLE_Q.", ".self::TABLE_U."
        WHERE users.id = quizzes.id_author
    ";
    //     $sql = "
    //     SELECT quizzes.id AS id_quiz, quizzes.title, quizzes.description, quizzes.id_author, users.id, users.first_name, users.last_name
    //     FROM ".self::TABLE_Q.", ".self::TABLE_U."
    //     WHERE users.id = quizzes.id_author
    // ";

    // LEFT JOIN users ON ".self::TABLE_NAME.".id_author = users.id

        //classe Database pour se connecter à la database
        $pdo = Database::getPDO();

        //exécution de la requête
        $pdoStatement = $pdo->query($sql);

        //récupère les résultats
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        //retourne les résultats
        return $results;
    }

    //Trouve un unique quiz selon l'id passé en param
    public static function find($id)
    {
        $sql = "
        SELECT quizzes.id, quizzes.title, quizzes.description, quizzes.id_author, users.id AS uid, users.first_name, users.last_name
        FROM ".self::TABLE_Q.", ".self::TABLE_U."
        WHERE users.id = quizzes.id_author
        AND quizzes.id = :id
    ";
        // prépare la requête
        $pdoStatement = Database::getPDO()->prepare($sql);

        // "bind" les données/token/jeton de la requête
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

        // exécute la requête
        $pdoStatement->execute();

        // récupère l'unique résultat
        $result = $pdoStatement->fetchObject(self::class);

        return $result;
    }


    /***** Getters *****/
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getIdAuthor()
    {
        return $this->id_author;
    }
    public function getIdUser()
    {
        return $this->uid;
    }

    public function getAuthorFirstName()
    {
        return $this->first_name;
    }

    public function getAuthorLastName()
    {
        return $this->last_name;
    }

    /**** SETTERS *****/
    public function setTitle($title)
    {
        if (is_string($title) && !empty($title)) {
            $this->title = $title;
        }
    }

    public function setDescription($description)
    {
        if (is_string($description) && !empty($description)) {
            $this->description = $description;
        }
    }
    public function setIdAuthor($id_author)
    {
        if (is_string($id_author) && !empty($id_author)) {
            $this->id_author = $id_author;
        }
    }
    public function setIdUser($uid)
    {
        if (is_string($uid) && !empty($uid)) {
            $this->uid = $uid;
        }
    }

    public function setAuthorFirstName($first_name)
    {
        if (is_string($first_name) && !empty($first_name)) {
            $this->first_name = $first_name;
        }
    }

    public function setAuthorLastName($last_name)
    {
        if (is_string($last_name) && !empty($last_name)) {
            $this->last_name = $last_name;
        }
    }
}
