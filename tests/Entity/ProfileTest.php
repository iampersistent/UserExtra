<?php

use UserExtra\Entity\Profile;

class ProfileTest extends PHPUnit_Framework_TestCase
{
    public function testPublishProperties()
    {
        $profile = new Profile();
        $this->assertFalse($profile->getPublishBirthday(), "this shouldn't be required by default");

        $profile->setPublishBirthday(true);
        $this->assertTrue($profile->getPublishBirthday(), "this should now be required");

        $profile->setPublishBirthday(false);
        $this->assertFalse($profile->getPublishBirthday(), "this should no longer be required");

        $profile->setPublishBirthday(true);
        $profile->setPublishBirthday(true);

        $profile->setPublishBirthday(false);
        $this->assertFalse($profile->getPublishBirthday(), "getting set twice should have no negative effect");

        $profile->setPublishBirthday(false);
        $this->assertFalse($profile->getPublishBirthday(), "getting set twice should have no negative effect");
    }

    public function testToApi()
    {

    }
}
