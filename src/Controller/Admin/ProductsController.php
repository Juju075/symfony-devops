<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


#[Route('/admin/products', 'admin_products')]
class ProductsController extends AbstractController
{
    #[Route('/admin/products', name: 'admin_products')]
    public function index(): Response
    {
        return $this->render('admin/products/index.html.twig');
    }

    #[Route('/add', name: 'add')]
    public function add(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $product = new Product();
        // 1 - Build the form
        $productForm = $this->createForm(ProductFormType::class, $product);

        // 3 - Process the form
        $productForm->handleRequest($request);

        if ($productForm->isSubmitted() && $productForm->isValid()) // Form Data Hydration
        {
            //on genere le slug d'apres le name
            $slug = $slugger->slug($product->getName());
            $product->setSlug($slug);
            //on arrondi le prix getData()
            $price = $product->getPrice() * 100;
            $product->setPrice($price);

            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success', 'Produit ajouter avec succcess');
            return $this->redirectToRoute('admin_products_index');
        }

        // 2 - Render the form   FormInterface
        return $this->renderForm('admin/products/add.html.twig', compact('productForm'));
        // FormInterface
        //return $this->render($productForm);

        //return $this->render('admin/products/add.html.twig', compact('productForm'));
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(
        Product                $product,
        Request                $request,
        EntityManagerInterface $entityManager,
        SluggerInterface       $slugger): Response
    {
        // check for "product" access: calls all voters
        $this->denyAccessUnlessGranted('PRODUCT_EDIT', $product);

        //fields prepopule


        // 1 - Build the form
        $productForm = $this->createForm(ProductFormType::class, $product);

        // 3 - Process the form
        $productForm->handleRequest($request);

        if ($productForm->isSubmitted() && $productForm->isValid()) // Form Data Hydration
        {
            //on genere le slug d'apres le name
            $slug = $slugger->slug($product->getName());
            $product->setSlug($slug);
            //on arrondi le prix getData()
            $price = $product->getPrice() * 100;
            $product->setPrice($price);

            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success', 'Produit ajouter avec succcess');
            return $this->redirectToRoute('admin_products_index');
        }


        // 2 - Render the form   FormInterface
        return $this->renderForm('admin/products/edit.html.twig', compact('productForm'));


        return $this->render('admin/products/edit.html.twig');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Product $product): Response
    {
        $this->denyAccessUnlessGranted('PRODUCT_DELETE', $product);
        return $this->render('admin/products/index.html.twig');
    }
}