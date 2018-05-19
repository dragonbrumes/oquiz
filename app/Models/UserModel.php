<?php

namespace Oquiz\Models;

// J'importe les classes qui se trouvent dans un autre namespace
use Oquiz\Database;
use PDO;

class UserModel  {
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $first_name;
    /**
     * @var string
     */
    private $last_name;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */


    // Constante de la table
    const TABLE_NAME = 'users';

    //  méthode récupérant une liste des quiz de l'utilisateur
    public function getQuiz() {
        return QuizModel::findAllByUserId($this->id);
    }

    //méthode pour trouver un user par son email
    public static function findByEmail($email) {
        $sql = '
            SELECT *
            FROM '.self::TABLE_NAME.'
            WHERE email = :email
            LIMIT 1
        ';
        $pdoStatement = Database::getPDO()->prepare($sql);

        $pdoStatement->bindValue(':email', $email, PDO::PARAM_STR);

        $pdoStatement->execute();

        $result = $pdoStatement->fetchObject(self::class);

        return $result;
    }

    /**
    * Get the value of user id
     *
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
    * Get the value of user First Name
     *
     * @return string
     */
    public function getFirstName() {
        return $this->first_name;
    }

    /**
     * Set the value of user First Name
     *
     * @param string username
     */
    public function setFirstName($first_name) {
        if (!empty($first_name)) {
            $this->first_name = $first_name;
        }
    }

    /**
    * Get the value of user Last Name
     *
     * @return string
     */
    public function getLastName() {
        return $this->last_name;
    }

    /**
     * Set the value of user Last Name
     *
     * @param string username
     */
    public function setLastName($last_name) {
        if (!empty($last_name)) {
            $this->last_name = $last_name;
        }
    }

    /**
     * Get the value of Email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @param string email
     */
    public function setEmail($email) {
        if (!empty($email)) {
            $this->email = $email;
        }
    }

    /**
     * Get the value of Password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set the value of Password
     *
     * @param string password
     */
    public function setPassword($password) {
        if (!empty($password)) {
            $this->password = $password;
        }
    }


}
