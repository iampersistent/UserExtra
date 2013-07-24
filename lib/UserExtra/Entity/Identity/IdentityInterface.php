<?php

namespace UserExtra\Entity\Identity;

/**
 * @author Richard Shank <develop@zestic.com>
 */
interface IdentityInterface
{
    function getVendor();

    function getUsername();
}
