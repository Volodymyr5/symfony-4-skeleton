<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class UserPersonalData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $gp_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gp_firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gp_lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gp_email;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $gp_image;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getGpId(): ?string
    {
        return $this->gp_id;
    }

    public function setGpId(?string $gp_id): self
    {
        $this->gp_id = $gp_id;

        return $this;
    }

    public function getGpFirstname(): ?string
    {
        return $this->gp_firstname;
    }

    public function setGpFirstname(?string $gp_firstname): self
    {
        $this->gp_firstname = $gp_firstname;

        return $this;
    }

    public function getGpLastname(): ?string
    {
        return $this->gp_lastname;
    }

    public function setGpLastname(?string $gp_lastname): self
    {
        $this->gp_lastname = $gp_lastname;

        return $this;
    }

    public function getGpEmail(): ?string
    {
        return $this->gp_email;
    }

    public function setGpEmail(?string $gp_email): self
    {
        $this->gp_email = $gp_email;

        return $this;
    }

    public function getGpImage()
    {
        return $this->gp_image;
    }

    public function setGpImage($gp_image): self
    {
        $this->gp_image = $gp_image;

        return $this;
    }
}
