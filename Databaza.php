<?php
declare(strict_types=1);
require_once "Prispevok.php";

class Databaza
{
    private $user = "root";
    private $pass = "dtb456";
    private $db = "blog";
    private $host = "localhost";

    private PDO $pdo;

    /**
     * Databaza constructor.
     */
    public function __construct()
    {
        $this->pdo = new PDO("mysql:dbname{$this->db};host={$this->host}",$this->user, $this->pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }

    /**
     * @return Prispevok[]
     */


    public function getAll() : array {
        $stmt = $this->pdo->query(
            "SELECT * FROM blog.articles"
        );
        $articles=[];
        while ($row = $stmt->fetch()) {
            $article = new Prispevok($row['nazov'], $row['text'], (int) $row['id']);
            $articles[] = $article;
        }
        return $articles;
    }

    public function createPost(string $nazov, string $text, int $id) : void
    {
        $article = new Prispevok($nazov, $text, $id);
        $this->saveArticle($article);
    }

    public function saveArticle(Prispevok $article) : bool
    {
        if ($article->getNazov() != "" && $article->getText() != "") {
            $stmt = $this->pdo->prepare("INSERT INTO blog.articles (nazov, text, id) values (?, ?, ?)");
            $stmt->execute([$article->getNazov(), $article->getText(), $article->getId()]);
            return true;
        } else return false;
    }

    public function removeArticle(int $id) : void
    {
        $stmt = $this->pdo->prepare("DELETE FROM blog.articles WHERE id = (?)");
        $stmt->execute([$id]);
    }

    public function editArticle(int $id, string $nazov, string $text) : bool
    {
        if ($nazov != "" && $text != "") {
            $stmt = $this->pdo->prepare("UPDATE blog.articles SET nazov = (?), text = (?) WHERE id = (?)");
            $stmt->execute([$nazov, $text, $id]);
            return true;
        } else  return false;
    }

    public function getTextPreId(int $id) : array{
        $stmt = $this->pdo->prepare("SELECT * FROM blog.articles WHERE id = (?)");
        $stmt->execute([$id]);
        $prispevky=[];
        $row = $stmt->fetch();
        $prispevky['nazov'] = $row['nazov'];
        $prispevky['text'] = $row['text'];

        return $prispevky;
    }
}