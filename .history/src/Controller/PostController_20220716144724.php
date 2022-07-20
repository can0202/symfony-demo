<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/", name="app_post")
     */
    public function index(PostRepository $postRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $query = $postRepository->findAll();

        $posts = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            2 /*limit per page*/
        );

        dd($posts);
        return $this->render('post/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/post/{id}", name="show_post")
     */
    public function show(Request $request, PostRepository $postRepository)
    {
        $postId = $request->attributes->get('id'); // Get Id post
        $post = $postRepository->find($postId); // Show post by ID
        return $this->render('post/show.html.twig', [
            'post' => $post
        ]);
    }
}
