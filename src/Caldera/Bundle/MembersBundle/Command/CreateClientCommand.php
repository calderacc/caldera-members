<?php

namespace Caldera\Bundle\MembersBundle\Command;

use Caldera\Bundle\MembersBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateClientCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fos:oauth-server:create-client')
            ->setDescription('Create an new OAuth client')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Client name'
            )
            ->addArgument(
                'redirect-uri',
                InputArgument::REQUIRED,
                'Select an uri to redirect users'
            )
            ->addArgument(
                'grant-type',
                InputArgument::REQUIRED,
                'List of grantable types'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $oauthServer = $container->get('fos_oauth_server.server');

        $name = $input->getArgument('name');
        $redirectUri = $input->getArgument('redirect-uri');
        $grantType = $input->getArgument('grant-type');

        $clientManager = $container->get('fos_oauth_server.client_manager.default');

        /** @var Client $client */
        $client = $clientManager->createClient();
        $client->setName($name);
        $client->setRedirectUris([$redirectUri]);
        $client->setAllowedGrantTypes([$grantType]);
        $clientManager->updateClient($client);

        $output->writeln(sprintf('Created client <info>%s</info> with public id <comment>%s</comment> and secret <comment>%s</comment>',
            $client->getId(),
            $client->getPublicId(),
            $client->getSecret()));
    }
}