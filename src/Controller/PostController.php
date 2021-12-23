<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\ManagerRegistry as DoctrineManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post', name: 'post.')]

class PostController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts
        ]);
    }
    #[Route('/create', name: 'create')]
    public function create(Request $request, ManagerRegistry $manager)
    {
        $post = new Post();

        $post->setTitle('This is going to be a title');

        $em = $manager->getManager();

        $em->persist($post);

        $em->flush();

        return new Response('Post was created');
    }

    /**
     * @Route("/show/{id}", name="show")
     * @param Post $post
     */
    public function show($id, PostRepository $postRepository): Response
    {
        $post = $postRepository->find($id);

        return $this->render('post/show.html.twig', [
            'post' => $post
        ]);
    }
    /**
     * @Route("delete/{id}", name="delete")
     */
    public function remove($id, ManagerRegistry $manager, PostRepository $postRepository): Response
    {
        $em = $manager->getManager();

        $post = $postRepository->find($id);

        $em->remove($post);

        $em->flush();

        return $this->redirect($this->generateUrl('post.index'));
    }
}
