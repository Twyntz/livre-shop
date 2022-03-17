<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuteurFixtures extends Fixture
{
    public function load(ObjectManager $manager) {
		// Exemples de données à insérer dans la base de données
		$auteur_list = [
			['name' => 'Koyoharu Gotouge', 
		'book' => ['name' => 'Demon Slayer tome 01', 'pages' => '192', 'price' => '7.30', 'description' => "Le Japon, au début du XXe siècle. Tanjiro, un jeune marchand de charbon, mène une vie paisible jusqu'au jour funeste où il découvre que son village a été décimé. Sa jeune soeur, Nezuko, est la seule survivante. Mais, depuis cette effroyable tragédie, elle semble possédée... Afin de sauver sa soeur et de venger sa famille, Tanjiro entame une longue quête, dans les pas des mystérieux pourfendeurs de démons ! Le manga Demon Slayer, issu du célèbre magazine Shonen Jump, est un véritable phénomène au Japon, également adapté en anime.", 'image' => 'https://static.fnac-static.com/multimedia/Images/FR/NR/ca/72/ab/11236042/1540-1/tsp20190923113407/Demon-Slayer.jpg']],
			['name' => 'Ken Follett',
		'book' => ['name' => 'Pour rien au monde', 'pages' => '880', 'price' => '24.90', 'description' => "De nos jours, dans le désert du Sahara, deux agents secrets sont sur la piste d'un groupe de terroristes trafiquants de drogue et risquent leur vie à chaque instant. Non loin, une jeune veuve se bat contre des passeurs tout en voyageant illégalement pour rejoindre l'Europe. Elle est aidée par un homme mystérieux qui cache sa véritable identité. En Chine, un membre du gouvernement à l'ambition démesurée pour lui et son pays lutte contre les vieux faucons communistes de l'administration qui poussent leur pays – et la Corée du Nord, son alliée militaire – vers un point de non-retour.", 'image' => 'https://static.fnac-static.com/multimedia/Images/FR/NR/ff/bc/ce/13548799/1507-1/tsp20210521073224/Pour-rien-au-monde.jpg']],
			['name' => 'Veronica Roth',
		'book' => ['name' => "Divergente - tome 02 : L'insurrection", 'pages' => '528', 'price' => '8.30', 'description' => "Différente. Déterminée. Dangereuse. DIVERGENTE. Le monde de Triss a volé en éclats. La guerre a dressé entre elles les factions qui régissent la société, elle a tué ses parents et fait de ses amis des tueurs. Triss est rongée par le chagrin et la culpabilité. Mais elle est divergente. Plus que tout autre, elle doit choisir son camp et se battre pour sauver ce qui peut encore l'être.", 'image' => 'https://static.fnac-static.com/multimedia/Images/FR/NR/17/20/84/8658967/1540-1/tsp20200911070441/Divergente-tome-2-L-insurrection.jpg']],
			['name' => 'James Dashner',
		'book' => ['name' => "Le Labyrinthe", 'pages' => '464', 'price' => '7.95', 'description' => "Quand Thomas reprend connaissance, sa mémoire est vide, seul son nom lui est familier... Il se retrouve entouré d'adolescents dans un lieu étrange, à l'ombre de murs infranchissables. Quatre portes gigantesques, qui se referment le soir, ouvrent sur un labyrinthe peuplé de monstres d'acier. Chaque nuit, le plan en est modifié. Thomas comprend qu'une terrible épreuve les attend tous. Comment s'échapper par le labyrinthe maudit sans risquer sa vie ? Si seulement il parvenait à exhumer les sombres secrets enfouis au plus profond de sa mémoire...", 'image' => 'https://static.fnac-static.com/multimedia/Images/FR/NR/3b/30/78/7876667/1540-1/tsp20160623084115/L-epreuve.jpg']],
		];
		// Boucle pour chaque ligne
		foreach ($auteur_list as $auteur_data) {
			// Crée une nouvelle entité
			$book = new Book();
			// Donne des valeurs à ses attributs
			$book->setName($auteur_data['book']['name']);
            $book->setPrice($auteur_data['book']['price']);
            $book->setPages($auteur_data['book']['pages']);
            $book->setDescription($auteur_data['book']['description']);
            $book->setImage($auteur_data['book']['image']);
			// Enregistre dans la BDD (INSERT)
			$manager->persist($book);
			// Donne des valeurs à ses attributs
			$auteur = new Auteur();
			$auteur->setName($auteur_data['name']);
			$auteur->addBook($book);
			// Enregistre dans la BDD (INSERT)
			$manager->persist($auteur);
		}
		$manager->flush();
	}
}
