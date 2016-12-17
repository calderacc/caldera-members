<?php

namespace Caldera\Bundle\MembersBundle\Controller;

use Caldera\Bundle\MembersBundle\Entity\AccessToken;
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

    public function infoAction(Request $request)
    {
        $accessTokenString = $request->query->get('access_token');

        if (!$accessTokenString) {
            throw $this->createAccessDeniedException();
        }

        /** @var AccessToken $accessToken */
        $accessToken = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('CalderaMembersBundle:AccessToken')
            ->findOneByToken($accessTokenString)
        ;

        if (!$accessToken) {
            throw $this->createAccessDeniedException();
        }

        /** @var User $user */
        $user = $accessToken->getUser();

        $result = [
            'username' => $user->getUsernameCanonical(),
            'email' => $user->getEmailCanonical()
        ];

        return new JsonResponse($result);
    }
}