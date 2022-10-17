<?php
namespace App\Demo\Manager;

use Faker\Factory;
use App\Demo\Entity\Personne;
use PDO;

/**
 * Gère la connexion à la base de données
 * Gère l'API Faker
 * Gère le CRUD
 * 
 * @author Parasmo Marco 
 * 
 * PersonneManager
 */
class PersonneManager 
{
    
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;

    public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost')
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    private function getPdo()
    {
        if ($this->pdo === null) {
            $pdo = new PDO('mysql:dbname=poo_php;host=localhost', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }
    
    /**
     * Permets de se connecter à la BD personne 
     * Insert les données récus de l'object $statement dans la BD
     * 
     * @method insert
     *
     * @param  mixed $statement
     * @return void
     */
    public function insert(object $statement): void
    {
        $req = $this->getPdo()->prepare('INSERT INTO personne SET nom=:nom, prenom=:prenom , adresse=:adresse , codepostal =:codepostal , pays =:pays , societe=:societe  ');
        $req->execute([
            'nom'           => $statement->getNom(),
            'prenom'        => $statement->getPrenom(),
            'adresse'       => $statement->getAdresse(),
            'codepostal'    => $statement->getCodePostal(),
            'pays'          => $statement->getPays(),
            'societe'       => $statement->getSociete()
        ]);

        /* Une autre possibilité  */

        // $req->bindValue(':nom', $statement->getNom());
        // $req->bindValue(':prenom', $statement->getPrenom());
        // $req->bindValue(':adresse', $statement->getAdresse());
        // $req->bindValue(':codepostal', $statement->getCodePostal());
        // $req->bindValue(':pays', $statement->getPays());
        // $req->bindValue(':societe', $statement->getSociete());

        // $req->execute(); 
    }
    
    /**
     * Fait appel à la methode static create et insert pour crée une personne dans la BD
     * 
     * @method getCreate
     *
     * @return void
     */
    public function getCreate(): void
    {
        $this->insert(self::create(1)[0]);
    }
    
    /**
     * $statement est un nombre affiche la personne de la BD avec l'ID équivalent 
     * $statement = true affiche la dernière insertion 
     * $statement = false affiche tout 
     * 
     * @method read
     *
     * @param  mixed $statement
     * @return void
     */
    public function read($statement = false)
    {

        if (is_int($statement)) {

            $req = $this->getPdo()->prepare('SELECT * FROM personne WHERE id= :id');
            $req->execute([
                'id'           => $statement
            ]);
        } else {
            $req = $this->getPdo()->query('SELECT * FROM personne');
        }


        if ($statement) {

            $datas = $req->fetch(PDO::FETCH_OBJ);
        } else {

            $datas = $req->fetchAll(PDO::FETCH_OBJ);
        }

        return $datas;
    }
    
    /**
     * Modifier une personne de la BD grâce à l'ID
     * 
     * @method update
     *
     * @param  mixed $id l'ID de la personne à modifier 
     * @param  mixed $statement object contenant les informations à modifier 
     * @return void
     */
    public function update(int $id, object $statement): void
    {
        $req = $this->getPdo()->prepare('UPDATE personne SET nom=:nom, prenom=:prenom , adresse=:adresse , codepostal =:codepostal , pays =:pays , societe=:societe WHERE id= :id');
        $req->execute([
            'id'            => $id,
            'nom'           => $statement->getNom(),
            'prenom'        => $statement->getPrenom(),
            'adresse'       => $statement->getAdresse(),
            'codepostal'    => $statement->getCodePostal(),
            'pays'          => $statement->getPays(),
            'societe'       => $statement->getSociete()
        ]);
    }
    
    /**
     * Grace à int $id, supprime la personne de la BD
     * 
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete(int $id): void
    {
        $req = $this->getPdo()->prepare('DELETE FROM personne WHERE id= :id');
        $req->execute([
            'id'            => $id
        ]);
    }
    
    /**
     * Permets grâce à l'API Faker de générer une ou plusieurs personnes
     * 
     * @method static create
     *
     * @param  mixed $nbr
     * @return array Instance de la Class Personne
     */
    public static function create(int $nbr): array
    {
        /** @var array $personnes c'est un tableau */
        $personnes = [];

        // Instanciation de l'API Faker
        $faker = Factory::create('fr_BE');

        for ($i = 1; $i <= $nbr; $i++) {

            $personnes[] = new Personne(

                $faker->lastName(),
                $faker->firstName(),
                $faker->address(),
                $faker->postcode(),
                $faker->country(),
                $faker->company()

            );
        }
        return $personnes;
    }
}