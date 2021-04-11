<?php
/**
 * RecipeVoter.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 10/04/2021
 *
 * @version 1.0
 */

namespace App\Security\Voter;


use App\Entity\Recipe;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class RecipeVoter extends Voter
{
    const EDIT = 'EDIT';
    const VIEW = 'VIEW';
    const CREATE = 'CREATE';
    const DELETE = 'DELETE';
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject): bool
    {
        return in_array($attribute, [self::DELETE])
            && (!$subject || $subject instanceof Recipe);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::DELETE:
                return $this->security->isGranted('ROLE_ADMIN');
        }

        return false;
    }
}