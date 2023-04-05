<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoriesController extends AbstractController
{

    //index don't exist throw 404    page not foune
    #[Route('/{slug}', name: 'list')]
    public function list(Category $category): Response
    {
        return $this->render('category/list.html.twig',compact('category'));
    }

}
