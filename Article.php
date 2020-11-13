<?php
declare(strict_types=1);

class Article
{
    private string $nazov;
    private string $text;
    private int $id;

    public function __construct(string $nazov, string $text, int $id) {
        $this->nazov = $nazov;
        $this->text = $text;
        $this->id = $id;
    }

    public function setNazov(string $nazov) {
        $this->nazov = $nazov;
    }

    public function setText(string $text) {
        $this->text = $text;
    }


    public function setId(int $id) {
        $this->id = $id;
    }

    public function getNazov() : string {
        return $this->nazov;
    }

    public function getText() : string {
        return $this->text;
    }

    public function getId() : int {
        return $this->id;
    }


}