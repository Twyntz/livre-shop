<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuteurFixtures extends Fixture
{
    public function load(ObjectManager $manager) {
		// Exemples de données à insérer dans la base de données
		$auteur_list = [
			['name' => 'Koyoharu Gotouge'],
			['name' => 'Ken Follett'],
			['name' => 'Veronica Roth'],
			['name' => 'James Dashner'],
		];
		// Boucle pour chaque ligne
		foreach ($auteur_list as $auteur_data) {
			// Crée une nouvelle entité
			$auteur = new Auteur();
			// Donne des valeurs à ses attributs
			$auteur->setName($auteur_data['name']);
			// Enregistre dans la BDD (INSERT)
			$manager->persist($auteur);
		}
		$manager->flush();
	}
}
