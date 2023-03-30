<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        //findBy c all
        return $this->render('main/index.html.twig', [
            'category' =>
                $categoryRepository->findBy([],
                    ['categoryOrder' => 'asc'])
        ]);
    }
}
