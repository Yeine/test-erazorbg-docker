<?php

namespace App\Controller;

use App\Entity\Problem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $manager): JsonResponse
    {
        $problem1 = new Problem();
        $problem1->setTitle('MAIN');

        $problem2 = new Problem();
        $problem2->setTitle('CHILDREN 1');

        $problem3 = new Problem();
        $problem3->setTitle('CHILDREN 2');

        $problem1->addOtherProblem($problem2)->addOtherProblem($problem3);
        $manager->persist($problem1);
        $manager->persist($problem2);
        $manager->persist($problem3);

        $manager->flush();
        dump('DONE ADDING');
        dump('REMOVING CHILDREN 1 FROM MAIN');
        $problem1->removeOtherProblem($problem2);
        $manager->persist($problem1);
        $manager->persist($problem2);
        $manager->flush();


        dump('REMOVING CHILDREN 2 FROM MAIN');
        $problem1->removeOtherProblem($problem3);
        $manager->persist($problem1);
        $manager->persist($problem3);
        $manager->flush();

        dump($problem1);

        $manager->remove($problem1);
        $manager->remove($problem2);
        $manager->remove($problem3);
        $manager->flush();
        dump('Deleted all problem to avoid filling DB');


        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/HomeController.php',
        ]);
    }
}
