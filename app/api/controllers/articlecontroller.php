<?php
require __DIR__ . '/../../services/articleservice.php';

class ArticleController
{

    private $articleService;

    // initialize services
    function __construct()
    {
        $this->articleService = new ArticleService();
    }

    // router maps this to /api/article automatically
    public function index()
    {
        header("Access-Control-Allow-Origin: *"); 
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: *");  
        // Respond to a GET request to /api/article
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            // your code here
            // return all articles in the database as JSON

            $articles = $this->articleService->getAll();
            header("Content-Type:application/json");
            header("Access-Control-Allow-Origin: *"); 
            echo json_encode($articles);
        }

        // Respond to a POST request to /api/article
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // your code here
            // read JSON from the request, convert it to an article object
            // and have the service insert the article into the database

            $body = file_get_contents('php://input');
            $object= json_decode($body);

            $article = new Article();
            $article->setTitle($object->title);
            $article->setContent($object->content);
            $article->setAuthor("Mark");

            $article = $this->articleService->insert($article);
            echo json_encode($articles);

        }
    }
}
?>