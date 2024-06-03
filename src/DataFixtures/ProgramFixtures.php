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
            'title' => 'Titre 2',
            'synopsis' => 'some texte',
            'category' => 'category_Aventure',
        ],
        [
            'title' => 'Titre 3',
            'synopsis' => 'some texte',
            'category' => 'category_Animation',
        ],[
            'title' => 'Titre 4',
            'synopsis' => 'some texte',
            'category' => 'category_Fantastique',
        ],[
            'title' => 'Titre 5',
            'synopsis' => 'some texte',
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
