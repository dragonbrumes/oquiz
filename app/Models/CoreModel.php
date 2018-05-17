<?php

namespace Oquiz\Models;
use Oquiz\Database;
use PDO;

/**
 *
 */
// abstract = classe abstraite = interdiction d'intancier cette classe!
abstract class CoreModel{

    // Si je factorise des propriétés, je factorise aussi leurs Getters & Setters
    /**
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $status;
    /**
     * @var string
     */
    protected $date_inserted;
    /**
     * @var string
     */
    protected $date_updated;

 // Méthode permettant de gérer la sauvegarde en BDD
    // elle va détecter seul si elle insère ou met à jour
    public function save() {
      // Si on a un id => alors la ligne existe dans la table
      // => on met à jour
      if ($this->id > 0) {
        $retour = $this->update();
        return $retour;
      }
      // Sinon, la ligne n'existe pas dans la table
      // => on insère dans la table
      else {
        return $this->insert();
      }
    }

   // Déclaration de la méthode en "static"
    // car elle n'est pas liée à l'objet courant ($this)
    // mais à la classe en "général"
  public static function find($id) {
      //$this-> = objet courant
      //self = classe dans laquelle est écrit le mot-clé (CoreModel)
      //static = classes depuis laquelle est appelé la méthode (Community, event)
    $sql = '
          SELECT *
          FROM '.static::TABLE_NAME.'
          WHERE id = :id';
    // Je prépare
    $pdoStatement = Database::getPDO()->prepare($sql);

    // Je fais mes "binds"
    $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

    // j'exécute la requête préparée
    $pdoStatement->execute();

    // Je récupère les données sous forme d'objet EventModel
    $result = $pdoStatement->fetchObject(static::class);

    return $result;
  }


  public static function findAll() {
      //self = classe dans laquelle est écrit le mot-clé (CoreModel)
      //static = classes depuis laquelle est appelé la méthode (Community, event)
      echo self::class; //le code est sur la classe (class en cours)
      echo static::class; //on fait le fecth sur = sur la class appelé. peut donc se référer à un enfant

    $sql = "
      SELECT *
      FROM ".static::TABLE_NAME."
    ";
    // Utilisation de notre classe Database pour se connecter à la database
    $pdo = Database::getPDO();

    // exécution de la requête
    $pdoStatement = $pdo->query($sql);

    // Je veux récupérer tous les résultats sous forme de tableau d'objet CommunityModel
    // on doit préciser le FQCN de la classe
    $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);

    // On retourne les résultats
    return $results;
  }

public function delete() {
        $sql = '
            DELETE FROM '.static::TABLE_NAME.'
            WHERE id = :id
        ';
        // Je prépare
        $pdoStatement = Database::getPDO()->prepare($sql);

        // Je fais mes "binds"
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);

        // j'exécute la requête préparée
        $affectedRows = $pdoStatement->execute();

        return $affectedRows;
    }

  // ce sont les enfants qui travaillent, pas cette classes
  //elle peut donner des ordres à ses enfants : ses efants sont obligé de déclarer ces méthodes

  //Ordre : mon enfant -> définit une méthode "insert"
  protected abstract function insert();
  //Ordre : mon enfant définit une méthode "insert"
  protected abstract function update();

  // *** GETTERS & SETTERS ***
  /**
  * Get the value of Id
  *
  * @return int
  */
  public function getId() {
      return $this->id;
  }
 // PAS de setId !
    /**
     * Get the value of Status
     *
     * @return int
     */
    public function getStatus() {
        return $this->status;
    }
    /**
     * Set the value of Status
     *
     * @param int status
     */
    public function setStatus($status) {
        if (!empty($status)) {
            $this->status = $status;
        }
    }
    /**
     * Get the value of Date Inserted
     *
     * @return string
     */
    public function getDateInserted() {
        return $this->date_inserted;
    }
    /**
     * Get the value of Date Updated
     *
     * @return string
     */
    public function getDateUpdated() {
        return $this->date_updated;
    }

} // end class
