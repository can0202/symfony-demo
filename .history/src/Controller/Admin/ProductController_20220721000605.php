<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="app_product")
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('admin/product/index.html.twig', [
            'products' => $productRepository->findAll()
        ]);
    }

    /**
     * @Route("/product/new", name="new_product")
     */
    public function new(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(Product::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Your product was created'
            );
            return $this->redirectToRoute('app_product');
        }

        return $this->render('admin/product/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
