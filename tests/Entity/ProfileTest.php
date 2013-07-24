<?php

use UserExtra\Entity\Profile;

class ProfileTest extends PHPUnit_Framework_TestCase
{
    public function testPublishProperties()
    {
        $profile = new Profile();
        $this->assertTrue($profile->getPublishDisplayName(), 'display is a required to be published');

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

        $profile->setPublishDisplayName(false);
        $this->assertTrue($profile->getPublishDisplayName(), 'a required field cannot be turned off');

        $this->assertSame($profile, $profile->setPublishDisplayName(false), 'this should be fluid');
    }

    public function testToApi()
    {

    }
}
