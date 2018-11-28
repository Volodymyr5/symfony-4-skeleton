<?php

namespace App\Security;

use App\Entity\User; // your user entity
use App\Entity\UserPersonalData;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\FacebookUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FacebookAuthenticator extends SocialAuthenticator
{
    /**
     * @var ClientRegistry
     */
    private $clientRegistry;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $entityManager)
    {
        $this->clientRegistry = $clientRegistry;
        $this->entityManager = $entityManager;
    }

    public function supports(Request $request)
    {
        // continue ONLY if the current ROUTE matches the check ROUTE
        return $request->attributes->get('_route') === 'connect_facebook_check' && $request->isMethod('GET');
    }

    public function getCredentials(Request $request)
    {
        return $this->fetchAccessToken($this->getFacebookClient());
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        /** @var FacebookUser $facebookUser */
        $facebookUser = $this->getFacebookClient()->fetchUserFromToken($credentials);

        $email = $facebookUser->getEmail();

        $user = $this->entityManager->getRepository('App:User')->findOneBy(['email' => $email]);
        if (!$user || ($user->getPresonalData() && !$user->getPresonalData()->getFbId())) {
            if (!$user) {
                $user = new User();
                $userPersonalData = new UserPersonalData();
            } else {
                $userPersonalData = $user->getPresonalData();
            }

            $userPersonalData->setFbId($facebookUser->getId());
            $userPersonalData->setFbFirstname($facebookUser->getFirstName());
            $userPersonalData->setFbLastname($facebookUser->getLastName());
            $userPersonalData->setFbEmail($facebookUser->getEmail());
            $userPersonalData->setFbHometown($facebookUser->getHometown());

            if ($facebookUser->getPictureUrl()) {
                $path = $facebookUser->getPictureUrl();
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                $userPersonalData->setFbImage($base64);
            }
            if ($facebookUser->getCoverPhotoUrl()) {
                $path = $facebookUser->getCoverPhotoUrl();
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                $userPersonalData->setFbCoverPhoto($base64);
            }
            $userPersonalData->setFbGender($facebookUser->getGender());
            $userPersonalData->setFbLocale($facebookUser->getLocale());
            $userPersonalData->setFbProfileLink($facebookUser->getLink());
            $userPersonalData->setFbTimezone($facebookUser->getTimezone());
            $userPersonalData->setFbMinAge($facebookUser->getMinAge());
            $userPersonalData->setFbMaxAge($facebookUser->getMaxAge());

            $user->setEmail($facebookUser->getEmail());
            $user->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
            $user->setPresonalData($userPersonalData);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        return $user;
    }

    /**
     * @return \KnpU\OAuth2ClientBundle\Client\OAuth2Client
     */
    private function getFacebookClient()
    {
        return $this->clientRegistry->getClient('facebook');
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());

        return new Response($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed, but it's not sent.
     * This redirects to the 'login'.
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse('/login');
    }
}