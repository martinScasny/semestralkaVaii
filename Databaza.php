<?php
declare(strict_types=1);
require_once "Prispevok.php";

class Databaza
{
    private $user = "root";
    private $pass = "dtb456";
    private $db = "databaza";
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
        $stmt = $this->pdo->query("SELECT * FROM databaza.prispevky ORDER BY id DESC");
        $prispevky=[];
        while ($row = $stmt->fetch()) {
            $prispevok = new Prispevok($row['nazov'], $row['text'], (int) $row['id'], $row['datum']);
            $prispevky[] = $prispevok;
        }
        return $prispevky;
    }

    public function createPost(string $nazov, string $text, int $id) : bool
    {
        try {
            $prispevok = new Prispevok($nazov, $text, $id, date("D M j G:i:s T Y", strtotime("+1 hours")));
            $this->saveArticle($prispevok);
            return true;
        } catch (PDOException $exception) {
            return false;
        }

    }

    public function saveArticle(Prispevok $prispevok) : bool
    {
        try {
        if ($prispevok->getNazov() != "" && $prispevok->getText() != "") {
            $stmt = $this->pdo->prepare("INSERT INTO databaza.prispevky (nazov, text, id, datum) values (?, ?, ?, ?)");
            $stmt->execute([$prispevok->getNazov(), $prispevok->getText(), $prispevok->getId(), $prispevok->getDatum()]);
            return true;
        } else return false;
        } catch(PDOException $exception) {
            return false;
        }
    }

    public function removeArticle(int $id) : void
    {
        $stmt = $this->pdo->prepare("DELETE FROM databaza.prispevky WHERE id = (?)");
        $stmt->execute([$id]);
    }

    public function editArticle(int $id, string $nazov, string $text) : bool
    {
        try {
            if ($nazov != "" && $text != "") {
                $date = date("D M j G:i:s T Y", strtotime("+1 hours"));
                $stmt = $this->pdo->prepare("UPDATE databaza.prispevky SET nazov = (?), text = (?), datum = (?) WHERE id = (?)");
                $stmt->execute([$nazov, $text,$date,$id]);
                return true;
            } else  return false;
        }catch (PDOException $exception) {
            return false;
        }

    }

    public function getTextPreId(int $id) : array{
        $stmt = $this->pdo->prepare("SELECT * FROM databaza.prispevky WHERE id = (?)");
        $stmt->execute([$id]);
        $prispevky=[];
        $row = $stmt->fetch();
        $prispevky['nazov'] = $row['nazov'];
        $prispevky['text'] = $row['text'];

        return $prispevky;
    }

    public function generujID() : int {
        try {
            $stmt = $this->pdo->query("SELECT MAX(id) FROM databaza.prispevky");
            $row = $stmt->fetch();
            $maxID = $row['MAX(id)'];
            return (int)$maxID;

        } catch (PDOException $exception) {
            return 1;
        }

    }
}