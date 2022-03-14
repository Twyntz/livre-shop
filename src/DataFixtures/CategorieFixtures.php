<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager) {
		// Exemples de données à insérer dans la base de données
		$categorie_list = [
			['name' => 'Mangas'],
			['name' => 'Policier'],
			['name' => 'Science-fiction'],
			['name' => 'Jeunesse'],
		];
		// Boucle pour chaque ligne
		foreach ($categorie_list as $categorie_data) {
			// Crée une nouvelle entité
			$categorie = new Categorie();
			// Donne des valeurs à ses attributs
			$categorie->setName($categorie_data['name']);
			// Enregistre dans la BDD (INSERT)
			$manager->persist($categorie);
		}
		$manager->flush();
	}
}
