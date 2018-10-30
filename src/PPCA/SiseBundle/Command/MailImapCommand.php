<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 29/10/2018
 * Time: 16:40
 */

namespace PPCA\SiseBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;


class MailImapCommand extends Command
{
    protected static $defaultEmail = 'fos:user:activate';

    private $userManipulator;

    public function __construct(UserManipulator $userManipulator)
    {
        parent::__construct();

        $this->userManipulator = $userManipulator;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('dano:email:receive')
            ->setDescription('Recupération des mails de DANO')
            /*->setDefinition(array(
                new InputArgument('username', InputArgument::REQUIRED, 'The username'),
            ))*/
            ->setHelp(<<<'EOT'
The <info>dano:email:receive</info> Commande de récupération de mail envoyé pour création de DANO:

  <info>php %command.full_name% Mike</info>
EOT
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');

        $this->userManipulator->activate($username);

        $output->writeln(sprintf('User "%s" has been activated.', $username));
    }


}