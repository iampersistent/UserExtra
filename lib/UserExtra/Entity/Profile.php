<?php

namespace UserExtra\Entity;

use FOS\UserBundle\Model\UserInterface;
use Vespolina\Media\Entity\MediaInterface;

class Profile
{
    protected $avatar;
    protected $avatarUrl;
    protected $bio;
    protected $birthday;
    protected $firstName;
    protected $gender;
    protected $id;
    protected $lastName;
    protected $location;
    protected $publishedFields = array();
    protected $profession;
    protected $slug;
    protected $user;

    /**
     * All the fields that the user *must* fill out
     *
     * @var array
     */
    protected static $requiredFields = array(
        'firstName',
        'lastName',
        'displayName',
        'gender',
        'birthday',
        'location'
    );

    protected static $requiredPublishedFields = array(
        'displayName'
    );

    public function __call($name, $arguments)
    {
         if (substr($name, 0, 10) == 'getPublish') {
             $field = lcfirst(substr($name, 10));
             if (in_array($field, self::$requiredPublishedFields) ) {
                 return true;
             }
             if (in_array($field, $this->publishedFields) ) {
                 return true;
             }

             return false;
        }
        if (substr($name, 0, 10) == 'setPublish') {
            $set = (bool)$arguments[0];
            $field = lcfirst(substr($name, 10));
            $key = array_search($field, $this->publishedFields);

            if (!$set && $key !== false) {
                unset($this->publishedFields[$key]);
            } elseif ($key === false && $set) {
                $this->publishedFields[] = $field;
            }

            return $this;
        }
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param MediaInterface $avatar
     * @return $this
     */
    public function setAvatar(MediaInterface $avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return MediaInterface
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatarUrl
     * @return $this
     */
    public function setAvatarUrl($avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * @param string $bio
     * @return $this
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param \DateTime $birthday
     * @return $this
     */
    public function setBirthday(\DateTime $birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param string $displayName
     * @return $this
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $gender
     * @return $this
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $location
     * @return $this
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $profession
     * @return $this
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @param string $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param FOS\UserBundle\Model\UserInterface $user
     * @return $this
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
        if (!$this->id) {
            $this->setId($user->getId());
        }

        return $this;
    }

    /**
     * @return FOS\UserBundle\Model\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    public function isAllRequiredFieldsFilled()
    {
        foreach(self::$requiredFields as $requiredField) {
            if ($this->{$requiredField} === null) {
                return false;
            }
        }

        return true;
    }

    public function setDisplayBirthday($displayBirthday)
    {
        $this->displayBirthday = (bool)$displayBirthday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isDisplayBirthday()
    {
        return $this->displayBirthday;
    }

    public function setDisplayGender($displayGender)
    {
        $this->displayGender = (bool)$displayGender;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isDisplayGender()
    {
        return $this->displayGender;
    }

    public function setDisplayLocation($displayLocation)
    {
        $this->displayLocation = (bool)$displayLocation;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isDisplayLocation()
    {
        return $this->displayLocation;
    }

    public function toApi()
    {

    }
}
