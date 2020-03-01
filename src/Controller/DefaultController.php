<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DefaultController.php',
        ]);
    }

    /**
     * @Route("/all", name="all")
     */
    public function all(): Response
    {
        $items = [
            [
                'first_name' => 'Joe',
                'last_name' => 'Star',
                'date_of_birth' => (new \DateTime('1970-01-01'))->format('Y-m-d')
            ],
            [
                'first_name' => 'Foo',
                'last_name' => 'Bar',
                'date_of_birth' => (new \DateTime('1975-04-01'))->format('Y-m-d')
            ],
        ];

        return $this->json([
            'items' => $items,
            'count' => \count($items)
        ]);
    }
}
