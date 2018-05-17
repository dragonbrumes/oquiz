<?php

namespace Oquiz\Models;

// J'importe les classes se trouvant dans un autre namespace
use Oquiz\Database;
use PDO;

// class QuizModel extends CoreModel {
class QuizModel
{
    // Je crée une propriété pour chaque champ/colonne de la table
    private $id;
    private $title;
    private $description;
    private $id_author;
    private $uid;
    private $first_name;
    private $last_name;

    // constante de la table
    const TABLE_NAME = 'quizzes';

    public static function findAll()
    {
        $sql = "
      SELECT *
      FROM ".self::TABLE_NAME."
    ";
    // LEFT JOIN users ON ".self::TABLE_NAME.".id_author = users.id
        // Utilisation de notre classe Database pour se connecter à la database
        $pdo = Database::getPDO();

        // exécution de la requête
        $pdoStatement = $pdo->query($sql);

        // Je veux récupérer tous les résultats sous forme de tableau d'objet CommunityModel
        // on doit préciser le FQCN de la classe
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        // On retourne les résultats
        return $results;
    }

    public static function find($id)
    {
        $sql = '
          SELECT *
          FROM '.self::TABLE_NAME.'
          WHERE id = :id';
        // Je prépare ma requête
        $pdoStatement = Database::getPDO()->prepare($sql);

        // Je "bind" les données/token/jeton de ma requête
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

        // J'exécute ma requête
        $pdoStatement->execute();

        $result = $pdoStatement->fetchObject(self::class);

        return $result;
    }


    public static function findAllByUserId($userId)
    {
        $sql = '
            SELECT '.self::TABLE_NAME.'.*
            FROM user
            INNER JOIN community_has_user ON community_has_user.user_id = user.id
            INNER JOIN community ON community_has_user.community_id = community.id
            WHERE user.id = :userId
        ';
        // Je prépare ma requête
        $pdoStatement = Database::getPDO()->prepare($sql);

        // Je fais mes "binds"
        $pdoStatement->bindValue(':userId', $userId, PDO::PARAM_INT);

        // Exécution de la requête
        $pdoStatement->execute();

        // Je récupère les résultats sous forme de tableau d'objets
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        return $results;
    }


    // Getters
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

    public function getAuthorFirstName()
    {
        return $this->first_name;
    }

    public function getAuthorLastName()
    {
        return $this->last_name;
    }

    // Setters
    public function setId($id)
    {
        // test si la valeur à affecter à la propriété est une "string" ou non vide
        if (is_string($id) && !empty($id)) {
            $this->id = $id;
        }
    }

    public function setTitle($title)
    {
        // test si la valeur à affecter à la propriété est une "string" ou non vide
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
