<?php

namespace Caldera\Bundle\MembersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FrontpageController extends Controller
{
    public function indexAction(): Response
    {
        return $this->render(
            'CalderaMembersBundle:Frontpage:index.html.twig'
        );
    }
}