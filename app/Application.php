<?php

// namespace de la classe
namespace Oquiz;

// Importe AltoRouter d'un autre namespace
use \AltoRouter;

class Application
{

    // Je crée une propriété $router
    // pour pouvoir utiliser cette propriété dans toutes mes méthodes
    // Cette propriété n'a pas besoin d'être publique, car utile uniquement dans ma Class
    private $router;

    // Ma propriété contenant les données du fichier de config
    private $config;

    public function __construct()
    {
        // Récupération de la configuration
        $this->config = parse_ini_file(__DIR__.'/config.conf');
        //dump($this->config);exit;

        // J'instancie AltoRouter
        $this->router = new AltoRouter();
        //dump($this->router);exit;

        // Si on bosse sous localhost, on doit indiquer à AltoRouter le chemin complet (tout ce qui est après "localhost" dans la barre d'adresse)
        // Sans slash de début mais avec slash de fin
        $this->router->setBasePath($this->config['BASEPATH']);

        // Je définis mes routes
        // (j'ai créé une méthode qui s'occupe de cela)
        $this->defineRoutes();
    }


    public function defineRoutes()
    {
        // - GET = méthode HTTP GET (ou POST ou les 2)
        // - "/" => correspond à l'URL (barre d'adresse)
        // - 'MainController#home'
        //  - 'MainController' = le nom du controller qui va s'occuper de cette page
        //  - '#' séparateur des 2 infos
        //  'home' méthode du controller qui va s'occuper de la page
        // - 'main_home' => le nom de cette route
        $this->router->map('GET', '/', 'MainController#indexAction', 'main_indexaction');
        $this->router->map('GET', '/quiz', 'QuizController#singleQuiz', 'quiz_singlequiz');
        $this->router->map('GET', '/quiz/[i:id]', 'QuestionController#questions', 'question_questions');

        $this->router->map('GET', '/login', 'UserController#login', 'user_login');
        $this->router->map('POST', '/login', 'UserController#loginPost', 'user_loginPost');

        $this->router->map('GET', '/logout', 'UserController#logout', 'user_logout');
        $this->router->map('GET', '/compte', 'UserController#compte', 'user_compte');
        $this->router->map('GET', '/signin', 'UserController#signin', 'user_signin');
        $this->router->map('POST', '/quizform', 'QuizController#quizform', 'quiz_quizform');
        //dump($this->router);exit;
    }
    public function run()
    {
        // Je fais le match d'une route par rapport à l'URL courante
        $match = $this->router->match();

        //dump($match);exit;

        // si on a un résultat (une route qui correspond)
        if ($match !== false) {
            // DISPATCH !
            // explode() = renvoie une tableau de string, à partir d'un autre string, en les séparant pour chaque #
            //dump($match['target']);
            $tmp = explode('#', $match['target']);
            //dump($tmp);
            // list permet d'affecter chaque élément du tableau $tmp dans des variables, en suivant l'ordre des variables
            list($controllerName, $methodName) = $tmp;
            //dump($controllerName);
            //dump($methodName);

            // Je construis le FQCN correspond au controller
            // On a besoin d'instancier la classe à partir de son FQCN ("chemin absolu")
            // car on fait un new $fqcnControllerName (PHP nous y oblige)
            $fqcnControllerName = '\Oquiz\Controllers\\'.$controllerName;

            // On instancie le controller
            $controller = new $fqcnControllerName($this);
            //dump($controller);

            // J'appelle la méthode
            $controller->$methodName($match['params']);
        }
        // Si ça match pas => 404
        else {
            // On envoie l'entete HTTP disant "Page not found"
            header("HTTP/1.0 404 Not Found");
            // On peut même afficher un truc !
            echo 'Dude, there is nothing here!<br>';
            exit;
        }
    }

    // Getter plus précis pour la propriété config
    public function getConfig($key)
    {
        // Si $key existe dans $this->config
        if (array_key_exists($key, $this->config)) {
            // Je ne retourne pas toute la propriété config
            // mais uniquement une des données du tableau
            return $this->config[$key];
        }
        return false;
    }

    // Getter simple
    public function getRouter()
    {
        return $this->router;
    }
}
