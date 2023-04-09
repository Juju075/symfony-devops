<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



#[Route('/admin/products','admin_products')]
class ProductsController extends AbstractController
{
    #[Route('/admin/products', name: 'admin_products')]
    public function index(): Response
    {
        return $this->render('admin/products/index.html.twig');
    }

    #[Route('/add', name: 'add')]
    public function add(): Response
    {
        return $this->render('admin/products/index.html.twig');
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Product $product): Response
    {
        // check for "product" access: calls all voters
        $this->denyAccessUnlessGranted('PRODUCT_EDIT', $product);
        return $this->render('admin/products/index.html.twig');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Product $product): Response
    {
        $this->denyAccessUnlessGranted('PRODUCT_DELETE', $product);
        return $this->render('admin/products/index.html.twig');
    }
}