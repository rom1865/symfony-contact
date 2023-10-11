<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello', name: 'app_hello')]
    public function index(): Response
    {
        return $this->render('hello/index.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }

    #[Route('/hello/{name}/{times}', requirements: ['times' => '\d+'])]
    public function manyTimes(string $name, int $times = 3): Response
    {
        if ($times > 10 or $times <= 0) {
            $times = 3;
        }

        return $this->render('hello/many_times.html.twig', ['name' => $name, 'times' => $times]);
    }

    // les routes sont check dans l'ordres declarée
    #[Route('/hello/{name}')]
    public function world(string $name): Response
    {
        return $this->render('hello/world.html.twig', ['name' => $name]);
    }
}
