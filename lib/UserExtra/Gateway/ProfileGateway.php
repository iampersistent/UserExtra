<?php

namespace UserExtra\Gateway;

use UserExtra\Entity\Profile;
use UserExtra\Exception\InvalidArgumentException;
use Molino\MolinoInterface;
use Molino\SelectQueryInterface;

class ProfileGateway
{
    protected $managedClass = 'UserExtra\Entity\Profile';
    protected $molino;

    public function __construct(MolinoInterface $molino)
    {
        $this->molino = $molino;
    }

    public function createQuery($type, $queryClass = null)
    {
        $type = ucfirst(strtolower($type));
        if (!in_array($type, array('Delete', 'Select', 'Update'))) {
            throw new InvalidArgumentException($type . ' is not a valid Query type');
        }
        $queryFunction = 'create' . $type . 'Query';

        if (!$queryClass) {
            $queryClass = $this->managedClass;
        }
        return $this->molino->$queryFunction($queryClass);
    }

    public function findProfiles(SelectQueryInterface $query)
    {
        return $query->all();
    }

    public function findProfileById($id)
    {
        $query = $this->createQuery('Select');
        $query->filterEqual('id', $id);

        return $query->one();
    }

    public function findProfileBySlug($slug)
    {
        $query = $this->createQuery('Select');
        $query->filterEqual('slug', $slug);

        return $query->one();
    }

    public function persistProfile(Profile $profile)
    {
        $this->molino->save($profile);
    }

    public function updateProfile(Profile $profile)
    {
        $this->molino->save($profile);
    }
}
