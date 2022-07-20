<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class ApiProductController extends AbstractController
{
    /**
     * @Route("/product", name="index_product", methods={"GET"})
     */
    public function index(): Response
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getId(),
                'title' => $product->getTitle(),
                'description' => $product->getDescription(),
            ];
        }

        return $this->json($data);
    }

    /**
     * @Route("/product", name="new_product", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setTitle($request->request->get('title'));
        $product->setDescription($request->request->get('description'));


        $entityManager->persist($product);
        $entityManager->flush();

        return $this->json('Created new product successfully with id ' + $product->getId());
    }

    /**
     * @Route("/product/{id}", name="show_product", methods={"GET"})
     */
    public function show(int $id): Response
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        if (!$product) {
            return $this->json('No product found for id' . $id, 404);
        }

        $data = [
            'id' => $product->getId(),
            'title' => $product->getTitle(),
            'description' => $product->getDescription(),
        ];

        return $this->json($data);
    }

    /**
     * @Route("/product/{id}", name="edit_product", methods={"PUT"})
     */
    public function edit(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);
        if (!$product) {
            return $this->json('No product found for id' . $id, 404);
        }

        $product->setTitle($request->request->get('title'));
        $product->setDescription($request->request->get('description'));
        $entityManager->flush();

        $data = [
            'id' => $product->getId(),
            'title' => $product->getTitle(),
            'description' => $product->getDescription(),
        ];
        return $this->json($data);
    }
}
