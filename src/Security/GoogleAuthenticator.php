<?php

namespace App\Security;

use App\Entity\User;
use App\Entity\UserPersonalData;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\GoogleUser;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class GoogleAuthenticator extends CoreAuthentificator
{
    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $entityManager, RouterInterface $router)
    {
        parent::__construct($clientRegistry, $entityManager, $router);

        $this->client = 'google';
        $this->checkRoute = 'connect_google_check';
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     * @return User|null|object|\Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        /** @var GoogleUser $googleUser */
        $googleUser = $this->getClient()->fetchUserFromToken($credentials);

        $email = $googleUser->getEmail();

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        if (!$user) {
            $user = new User();
            $userPersonalData = new UserPersonalData();
        } else {
            $userPersonalData = $user->getPresonalData();
        }

        $userPersonalData->setGpId($googleUser->getId());
        $userPersonalData->setGpFirstname($googleUser->getFirstName());
        $userPersonalData->setGpLastname($googleUser->getLastName());
        $userPersonalData->setGpEmail($googleUser->getEmail());
        if ($googleUser->getAvatar()) {
            $path = $googleUser->getAvatar();
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $userPersonalData->setGpImage($base64);
        }

        $user->setEmail($googleUser->getEmail());
        $user->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
        $user->setPresonalData($userPersonalData);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}