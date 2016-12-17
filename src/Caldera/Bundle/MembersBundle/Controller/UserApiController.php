<?php

namespace Caldera\Bundle\MembersBundle\Controller;

use Caldera\Bundle\MembersBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserApiController extends Controller
{
    public function infoAction()
    {
        /** @var User $user */
        $user = $this->getDoctrine()->getManager()->getRepository('CalderaMembersBundle:User')->find(1);

        $result = [
            'username' => $user->getUsernameCanonical(),
            'email' => $user->getEmailCanonical()
        ];

        return new JsonResponse($result);
    }
}