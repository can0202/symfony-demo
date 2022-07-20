<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/", name="app_post")
     */
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        return $this->render('post/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/post/{id}", name="show_post")
     */
    public function show(Request $request, PostRepository $postRepository)
    {
        $postId = $request->attributes->get('id');
        $post = $postRepository->find($postId);
        return $this->render('post/show.html.twig', [
            'post' => $post
        ]);
    }
}
