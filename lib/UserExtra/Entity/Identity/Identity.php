<?php

namespace UserExtra\Entity\Identity;

use UserExtra\Entity\Identity\IdentityInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
abstract class Identity implements IdentityInterface
{
    protected $createdAt;
    protected $username;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @inheritdoc
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getVendor()
    {
        return $this->vendor;
    }
}
