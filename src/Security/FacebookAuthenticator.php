<?php

namespace App\Security;

use App\Entity\User; // your user entity
use App\Entity\UserPersonalData;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\FacebookUser;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FacebookAuthenticator extends CoreAuthentificator
{
    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $entityManager, RouterInterface $router)
    {
        parent::__construct($clientRegistry, $entityManager, $router);

        $this->client = 'facebook';
        $this->checkRoute = 'connect_facebook_check';
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        /** @var FacebookUser $facebookUser */
        $facebookUser = $this->getClient()->fetchUserFromToken($credentials);

        $email = $facebookUser->getEmail();

        $user = $this->entityManager->getRepository('App:User')->findOneBy(['email' => $email]);
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

        return $user;
    }
}