<?php
declare(strict_types=1);

class Prispevok
{
    private string $nazov;
    private string $text;
    private int $id;
    private string $datum;

    public function __construct(string $nazov, string $text, int $id, string $datum) {
        $this->nazov = $nazov;
        $this->text = $text;
        $this->id = $id;
        $this->datum = $datum;
    }

    /**
     * @return string
     */
    public function getDatum(): string
    {
        return $this->datum;
    }

    /**
     * @param string $datum
     */
    public function setDatum(string $datum): void
    {
        $this->datum = $datum;
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