<?php

namespace App\Command;

use App\Repository\PostRepository;
use App\Services\RemovePost;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Controller\PostController;

#[AsCommand(
    name: 'app:test-output',
    description: 'Tester la creation de commandes',
)]
class TestOutputCommand extends Command
{

    public function __construct(RemovePost $removePost )
    {
        $this->RemovePost = $removePost;
        parent::__construct();
    }
    protected function configure(): void
    {
        $this
            ->addArgument('id', $this->postController ? InputArgument::REQUIRED, 'ID du post à supprimer')
    }

    public function execute(InputInterface $input, OutputInterface $output, EntityManager $manager, PostRepository $postRepository): int
    {
        $io = new SymfonyStyle($input, $output);
        $id = $input->getArgument('id');

        $this->RemovePost->remove($id, $manager, $postRepository);

        $io->success('Post est supprimé');

        return Command::SUCCESS;
    }
}
