<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Geocaching as GeocachingProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OAuthController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(ClientRegistry $clientRegistry, SessionInterface $session): Response
    {
        $session->set('codeVerifier', GeocachingProvider::createCodeVerifier());

        $code = ['code_challenge'        => GeocachingProvider::createCodeChallenge($session->get('codeVerifier')),
                 'code_challenge_method' => 'S256',
                ];
        return $clientRegistry->getClient('geocaching_main')->redirect([], $code);
    }

    #[Route('/callback', name: 'app_callback')]
    public function callback()
    {
        return $this->redirectToRoute('app_homepage');
    }
}
