<?php

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * @ORM\Entity(repositoryClass=AccountRepository::class)
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    public function getId() : ?int
    {

        return $this->id;
    }

    public function getEmail() : ?string
    {

        return $this->email;
    }

    public function setEmail(string $email) : self
    {

        $this->email = $email;

        return $this;
    }

    public function getUsername() : ?string
    {

        return $this->username;
    }

    public function setUsername(string $username) : self
    {

        $this->username = $username;

        return $this;
    }

    public function __construct()
    {

    }
}
