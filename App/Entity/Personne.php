<?php
namespace App\Demo\Entity;

/**
 * @author Parasmo Marco 
 * 
 * Class Personne
 */
class Personne 
{
    
    private $id;
    private $nom;
    private $prenom;
    private $adresse;
    private $codepostal;
    private $pays;
    private $societe;

    public function __construct(string $nom,string $prenom,string  $adresse,int $codepostal,string  $pays,string  $societe)
    {
        $this->nom          = $nom;
        $this->prenom       = $prenom;
        $this->adresse      = $adresse;
        $this->codepostal   = $codepostal;
        $this->pays         = $pays;
        $this->societe      = $societe;
    }

    public function getId(){
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    public function getCodePostal()
    {
        return $this->codepostal;
    }
    public function setCodePostal($codepostal)
    {
        $this->codepostal = $codepostal;
    }

    public function getPays()
    {
        return $this->pays;
    }
    public function setPays($pays)
    {
        $this->pays = $pays;
    }

    public function getSociete()
    {
        return $this->societe;
    }
    public function setSociete($societe)
    {
        $this->societe = $societe;
    }
}