<?php

namespace UserExtra\Entity;

use UserExtra\Entity\Identity\IdentityInterface;
use UserExtra\Entity\Profile;
use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{
    protected $agreeToTOS;
    protected $author;
    protected $createdAt;
    protected $id;
    protected $identities;
    protected $profile;
    protected $updatedAt;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAgreeToTOS()
    {
        return $this->agreeToTOS;
    }

    public function setAgreeToTOS($agreeToTOS)
    {
        $this->agreeToTOS = (boolean)$agreeToTOS;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getIdentity($vendor)
    {
        return isset($this->identities[$vendor]) ? $this->identities[$vendor] : null;
    }

    /**
     * @inheritdoc
     */
    public function getIdentities()
    {
        return $this->identities;
    }

    /**
     * @inheritdoc
     */
    public function setIdentities(array $identities)
    {
        $this->clearIdentities();
        $this->addIdentities($identities);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function clearIdentities()
    {
        $this->identities = array();

        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function addIdentities(array $identities)
    {
        foreach ($identities as $identity) {
            $this->addIdentity($identity);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function addIdentity(IdentityInterface $identity)
    {
        $vendor = $identity->getVendor();
        $this->identities[$vendor] = $identity;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function removeIdentity($identity)
    {
        $vendor = $identity instanceof IdentityInterface ? $identity->getVendor() : $identity;

        if (isset($this->identities[$vendor])) {
            unset($this->identities[$vendor]);
        } else {
            throw new \InvalidArgumentException(sprintf("There is not an identity for '%s' associated with this user", $vendor));
        }

        return $this;
    }

    public function getProfile()
    {
        return $this->profile;
    }

    public function setProfile(Profile $profile = null)
    {
        if ($profile) {
            $profile->setUser($this);
        }
        $this->profile = $profile;

        return $this;
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

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @inheritdoc
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function autoSetCreatedAt()
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTime();
        }
        $this->autoSetUpdatedAt();
    }

    public function autoSetUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }
}
