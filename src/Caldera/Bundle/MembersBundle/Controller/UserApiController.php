<?php

namespace Caldera\Bundle\MembersBundle\Controller;

use Caldera\Bundle\MembersBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class UserApiController extends Controller
{
    protected function isUserLoggedIn(): bool
    {
        return $this
            ->get('security.authorization_checker')
            ->isGranted('IS_AUTHENTICATED_FULLY');
    }

    public function infoAction(Request $request, UserInterface $user)
    {
        if (!$this->isUserLoggedIn()) {
            return $this->createAccessDeniedException();
        }

        $result = [
            'username' => $user->getUsernameCanonical(),
            'email' => $user->getEmailCanonical()
        ];

        return new JsonResponse($result);
    }
}