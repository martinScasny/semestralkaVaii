<?php
declare(strict_types=1);
require_once "Article.php";

class Storage
{
    private $user = "root";
    private $pass = "dtb456";
    private $db = "blog";
    private $host = "localhost";

    private PDO $pdo;

    /**
     * Storage constructor.
     */
    public function __construct()
    {
        $this->pdo = new PDO("mysql:dbname{$this->db};host={$this->host}",$this->user, $this->pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }

    /**
     * @return Article[]
     */


    public function getAll() : array {
        $stmt = $this->pdo->query(
            "SELECT * FROM blog.articles"
        );
        $articles=[];
        while ($row = $stmt->fetch()) {
            $article = new Article($row['nazov'], $row['text'], (int) $row['id']);
            $articles[] = $article;
        }
        return $articles;
    }

    public function createPost(string $nazov, string $text, int $id) : void
    {
        $article = new Article($nazov, $text, $id);
        $this->saveArticle($article);
    }

    public function saveArticle(Article $article) : void
    {
        $stmt = $this->pdo->prepare("INSERT INTO blog.articles (nazov, text, id) values (?, ?, ?)");
        $stmt->execute([$article->getNazov(), $article->getText(), $article->getId()]);
    }
}