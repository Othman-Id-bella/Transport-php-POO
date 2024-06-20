<?php
abstract class Transport {
    protected $idTrans;
    protected $vitesse;
    protected $capacite;

    public function __construct($idTrans, $vitesse, $capacite) {
        $this->idTrans = $idTrans;
        $this->vitesse = $vitesse;
        $this->capacite = $capacite;
    }

    public function infos() {
        echo "ID Transport: " . $this->idTrans . "<br>";
        echo "Vitesse: " . $this->vitesse . " km/h<br>";
        echo "Capacité: " . $this->capacite . " places<br>";
    }

    abstract public function montant();
}

class Autocar extends Transport {
    private $marque;
    private $prixTicket;

    public function __construct($idTrans, $vitesse, $capacite, $marque, $prixTicket) {
        parent::__construct($idTrans, $vitesse, $capacite);
        $this->marque = $marque;
        $this->prixTicket = $prixTicket;
    }

    public function infos() {
        parent::infos();
        echo "Marque: " . $this->marque . "<br>";
        echo "Prix du ticket: " . $this->prixTicket . " euros<br>";
    }

    public function montant() {
        return $this->capacite * $this->prixTicket;
    }
}

require_once 'Transport.php';

$autocar = new Autocar(1, 100, 50, "Mercedes", 20);

$autocar->infos();
echo "Montant total si toutes les places sont occupées: " . $autocar->montant() . " euros<br>";

?>
