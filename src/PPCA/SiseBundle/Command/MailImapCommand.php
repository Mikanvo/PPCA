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
use PPCA\SiseBundle\Service\MailInbox;


class MailImapCommand extends Command
{

    private $mailInbox;


    public function __construct(MailInbox $mailInbox)
    {
        parent::__construct();
        $this->mailInbox = $mailInbox;
    }
    

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            //->setName('dano:email:insert')
            ->setDescription('Recupération et insertions des mails de DANO')
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
        $result = $this->mailInbox->processInsert();

        if ($result > 0) {
            $output->writeln($result . ' message(s) inséré(s)');
        } else {
            $output->writeln('Aucun message non lu');
        }
    }


}