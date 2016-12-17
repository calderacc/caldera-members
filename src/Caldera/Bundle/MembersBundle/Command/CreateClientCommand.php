<?php

namespace Caldera\Bundle\MembersBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;

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
}