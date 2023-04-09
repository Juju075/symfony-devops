<?php

namespace App\Security\Voter;

use App\Entity\Product;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use \Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;


class ProductsVoter extends Voter
{
    const EDIT = 'PRODUCT_EDIT';
    const DELETE = 'PRODUCT_DELETE';

    private $security;

    protected function __construct(private readonly Security $security)
    {
    }

    public function supports(string $attribute, mixed $subject): bool
    {
        if (!in_array($attribute, [self::EDIT, self::DELETE])) {
            return false;
        }
        if (!$subject instanceof Product) {
            return false;
        }

    }

    public function voteOnAttribute($attribute, $product, TokenInterface $token): bool
    {
        // ROLE_SUPER_ADMIN can do anything! The power!
        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }

        //on recup user from token
        $user = $token->getUser();

        //connected?
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ROLE_SUPER_ADMIN can do anything! The power!
        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }

        //verif permission action
        switch ($attribute)
        {
            case self::EDIT:
                return $this->canEdit();
                break;
            case self::DELETE:
                return $this->canDelete();
        }
        return false;
    }

    function canEdit(): bool
    {
        return $this->security->isGranted('ROLE_PRODUCT_ADMIN');
    }

    function canDelete(): bool
    {
        return $this->security->isGranted('ROLE_PRODUCT_ADMIN');
    }
}