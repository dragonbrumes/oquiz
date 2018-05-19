<?php
namespace Oquiz\Controllers;

use Oquiz\Utils\User;

//class abstraite de définition pour d'autres class
abstract class CoreController {
    // stockage du moteur de template Plates dans une propriété de la classe pour le rendre accessible à toutes ses méthodes
    protected $templates;

    // stockage de l'objet AltoRouter dans une propriété de la classe pour que ce soit accessible à toutes ses méthodes (et tous ses enfants extends)
    protected $router;

    // $app = Application passé en paramètre lors du "dispatch"
    public function __construct($app) {
        // instanciation du moteur de Templates
        $this->templates = new \League\Plates\Engine(__DIR__.'/../Views');

        // Je récupère le router qui est dans $app
        $this->router = $app->getRouter();

        // Je définis des données utiles pour toutes les templates
        $this->templates->addData([
            'title' => 'Oquiz', // => $title
            'basePath' => $app->getConfig('BASEPATH').'/', // => $basePath
            'router' => $this->router, // => $router
            'connectedUser' => User::getUser() // $connectedUser
        ]);
    }

    // Méthode permettant d'afficher un résultat sous forme de JSON
    public static function sendJSON($data) {
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    // Méthode permettant d'envoyer un code HTTP dans l'entête de réponse HTTP
    // on peut en plus afficher un message ou du code HTML
    public function sendHttpError($code, $source='') {
        if ($code == 403) {
            header('HTTP/1.0 403 Forbidden');
            echo $source;
            exit;
        }
    }

    // Méthode permettant de rediriger vers une URL passée en paramètre
    public function redirect($url) {
        header('Location: '.$url);
        exit;
    }

    // Méthode permettant de rediriger vers une route de l'application
    public function redirectToRoute($routeName, $params=array()) {
        $this->redirect($this->router->generate($routeName, $params));
    }
}
