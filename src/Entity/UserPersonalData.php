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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fb_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fb_firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fb_lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fb_email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fb_hometown;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $fb_image;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $fb_cover_photo;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $fb_gender;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $fb_locale;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $fb_profile_link;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fb_timezone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fb_min_age;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fb_max_age;

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

    /**
     * @return mixed
     */
    public function getFbId()
    {
        return $this->fb_id;
    }

    /**
     * @param mixed $fb_id
     */
    public function setFbId($fb_id): void
    {
        $this->fb_id = $fb_id;
    }

    /**
     * @return mixed
     */
    public function getFbFirstname()
    {
        return $this->fb_firstname;
    }

    /**
     * @param mixed $fb_firstname
     */
    public function setFbFirstname($fb_firstname): void
    {
        $this->fb_firstname = $fb_firstname;
    }

    /**
     * @return mixed
     */
    public function getFbLastname()
    {
        return $this->fb_lastname;
    }

    /**
     * @param mixed $fb_lastname
     */
    public function setFbLastname($fb_lastname): void
    {
        $this->fb_lastname = $fb_lastname;
    }

    /**
     * @return mixed
     */
    public function getFbEmail()
    {
        return $this->fb_email;
    }

    /**
     * @param mixed $fb_email
     */
    public function setFbEmail($fb_email): void
    {
        $this->fb_email = $fb_email;
    }

    /**
     * @return mixed
     */
    public function getFbHometown()
    {
        return $this->fb_hometown;
    }

    /**
     * @param mixed $fb_hometown
     */
    public function setFbHometown($fb_hometown): void
    {
        $this->fb_hometown = $fb_hometown;
    }

    /**
     * @return mixed
     */
    public function getFbImage()
    {
        return $this->fb_image;
    }

    /**
     * @param mixed $fb_image
     */
    public function setFbImage($fb_image): void
    {
        $this->fb_image = $fb_image;
    }

    /**
     * @return mixed
     */
    public function getFbCoverPhoto()
    {
        return $this->fb_cover_photo;
    }

    /**
     * @param mixed $fb_cover_photo
     */
    public function setFbCoverPhoto($fb_cover_photo): void
    {
        $this->fb_cover_photo = $fb_cover_photo;
    }

    /**
     * @return mixed
     */
    public function getFbGender()
    {
        return $this->fb_gender;
    }

    /**
     * @param mixed $fb_gender
     */
    public function setFbGender($fb_gender): void
    {
        $this->fb_gender = $fb_gender;
    }

    /**
     * @return mixed
     */
    public function getFbLocale()
    {
        return $this->fb_locale;
    }

    /**
     * @param mixed $fb_locale
     */
    public function setFbLocale($fb_locale): void
    {
        $this->fb_locale = $fb_locale;
    }

    /**
     * @return mixed
     */
    public function getFbProfileLink()
    {
        return $this->fb_profile_link;
    }

    /**
     * @param mixed $fb_profile_link
     */
    public function setFbProfileLink($fb_profile_link): void
    {
        $this->fb_profile_link = $fb_profile_link;
    }

    /**
     * @return mixed
     */
    public function getFbTimezone()
    {
        return $this->fb_timezone;
    }

    /**
     * @param mixed $fb_timezone
     */
    public function setFbTimezone($fb_timezone): void
    {
        $this->fb_timezone = $fb_timezone;
    }

    /**
     * @return mixed
     */
    public function getFbMinAge()
    {
        return $this->fb_min_age;
    }

    /**
     * @param mixed $fb_min_age
     */
    public function setFbMinAge($fb_min_age): void
    {
        $this->fb_min_age = $fb_min_age;
    }

    /**
     * @return mixed
     */
    public function getFbMaxAge()
    {
        return $this->fb_max_age;
    }

    /**
     * @param mixed $fb_max_age
     */
    public function setFbMaxAge($fb_max_age): void
    {
        $this->fb_max_age = $fb_max_age;
    }
}
