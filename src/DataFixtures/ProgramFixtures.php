<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{ 
    public const PROGRAMS = [
        [
            'title' => 'Walking Dead',
            'synopsis' => 'Des zombies envahissent la terre.',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Sons Of Anarchy',
            'synopsis' => 'Suivez le quotidien d\'un gang de motard.',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Breaking Bad',
            'synopsis' => 'Suivez l\'ascension d\'un traficant de metamphetamines',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Indiana Jones',
            'synopsis' => 'some texte',
            'category' => 'category_Aventure',
        ],
        [
            'title' => 'One Piece',
            'synopsis' => 'Suivez Luffy et ses compagnons à la recherche du One Piece',
            'category' => 'category_Animation',
        ],
        [
            'title' => 'Harry Potter',
            'synopsis' => 'Suivez Harry dans son apprentissage à l\'ecole des sorciers',
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'Paranormal Activity',
            'synopsis' => 'Un jeune couple suspecte leur maison d’être hantée par un esprit démoniaque. ',
            'category' => 'category_Horreur',
        ],
     ];
     
    public function load(ObjectManager $manager): void
    {   
        foreach(self::PROGRAMS as $programName){ 

        $program = new Program();
        $program->setTitle($programName["title"]);
        $program->setSynopsis($programName["synopsis"]);
        $program->setCategory($this->getReference($programName["category"]));
        $manager->persist($program);
        }
        $manager->flush(); 

    } 
    public function getDependencies()
    {
   
        return [
          CategoryFixtures::class,
        ];
    }
}
