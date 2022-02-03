<?php

namespace App\Services;

use App\Controller\PostController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{

    private ParameterBagInterface $parameterBag;
    private PostController $postController;

    public function __construct(
        ParameterBagInterface $parameterBag,
        PostController        $postController
    )
    {
        $this->parameterBag = $parameterBag;
        $this->postController = $postController;
    }

    public function uploadFile(UploadedFile $file, SluggerInterface $slugger)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $filename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
        $file->move(
            $this->parameterBag->get('uploads_dir'), $filename
        );
        return $filename;
    }
}