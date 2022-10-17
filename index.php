<?php
require_once 'vendor/autoload.php';

use Faker\Factory;
use App\Demo\Entity\Personne;
use App\Demo\Manager\PersonneManager;


/* Instanciation de la class PersonneManager */
$db = new PersonneManager('poo_php');


$personne = PersonneManager::create(1)[0];

/* Insert les données dans la BD */
$db->insert($personne);

/* Crée une personne dans la BD */
// $db->getCreate();

/* Modifier la BD grâce à l'ID */
// $db->update(8, $personne);

/* Supprime la BD grâce à l'ID */
// $db->delete(9);

echo '<pre>';
print_r($personne);
echo '</pre>';
$title = 'Exercice 3';
require 'elements/header.php';
?>
<h1>Exercice 3 : Affichez les différentes personnes générées</h1>
<table>

    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Adresse</th>
            <th>Code Postal</th>
            <th>Pays</th>
            <th>Société</th>
        </tr>
    </thead>

    <?php foreach (PersonneManager::create(5) as $personne) : ?>
        <tr>
            <td><?= $personne->getNom() ?></td>
            <td><?= $personne->getPrenom() ?></td>
            <td><?= $personne->getAdresse() ?></td>
            <td><?= $personne->getCodePostal() ?></td>
            <td><?= $personne->getPays() ?></td>
            <td><?= $personne->getSociete() ?></td>
        </tr>
    <?php endforeach ?>

</table>
<?php
require 'elements/footer.php';
?>