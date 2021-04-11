<?php
/**
 * UserVoter.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 11/04/2021
 *
 * @version 1.0
 */

namespace App\Security\Voter;


use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
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
        return in_array($attribute, [self::EDIT, self::CREATE, self::DELETE])
            && (!$subject || $subject instanceof User);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::CREATE:
            case self::DELETE:
                return $this->security->isGranted('ROLE_ADMIN');
            case self::EDIT:
                return $this->canEdit($subject);
        }

        return false;
    }

    private function canEdit(User $user): bool
    {
        if ($this->security->isGranted('ROLE_ADMIN'))
        {
            return true;
        }

        $authenticatedUser = $this->security->getUser();
        if (!$authenticatedUser) {
            return false;
        }

        return $authenticatedUser->getUsername() === $user->getUsername();
    }
}
