<?php

namespace App\Services;

use App\Controller\PostController;
use App\Repository\PostRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

class RemovePost
{
    private PostController $postController;aeffaef

    public function __construct(PostController $postController, Conta)
    {
        $this->container
        $this->postController = $postController;
    }
faefaef
    public function remove($id, ManagerRegistry $manager, PostRepository $postRepository): Response
    {
        $this->postController->remove($id, $manager, $postRepository);
    }
}
