<?php

namespace App\Command;

use App\Entity\HostType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-hosttypes',
    description: 'Add a short description for your command',
)]
class CreateHosttypesCommand extends Command
{

    private  EntityManager $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure(): void
    {

    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $hostTypes = ['Standard Host', 'Infrastruktur', 'Virtueller Host'];

        foreach($hostTypes as $hostType) {
            $tmp = new HostType();
            $tmp->setName($hostType);
            $this->entityManager->persist($tmp);
        }
        $this->entityManager->flush();

        $io->success('Default data created!');

        return Command::SUCCESS;
    }
}
