<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="app_category")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/category/create", name="create_category")
     */
    public function create(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Your category was created'
            );
            return $this->redirectToRoute('app_category');
        }
        return $this->render('category/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/category/{id}", name="show_category")
     */
    public function show(Request $request, CategoryRepository $categoryRepository)
    {
        $cateId = $request->attributes->get('id');
        $category = $categoryRepository->find($cateId);
        return $this->render('category/show.html.twig', [
            'category' => $category
        ]);
    }

    /**
     * @Route("/category/{id}/edit", name="edit_category")
     */
    public function edit(Category $category, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Your category was edited'
            );
            return $this->redirectToRoute('app_category', ['id' => $category->getId()]);
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'editForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/category/{id}/delete", name="delete_category")
     */
    public function delete(Category $category, Request $request, CategoryRepository $categoryRepository)
    {
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->request->get('_csrf_token'))) {
            $categoryRepository->remove($category, true);
        }

        return $this->redirectToRoute('app_category');
    }
}
