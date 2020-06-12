<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class IdeaPropositionVoter extends Voter
{
    // const EDIT='edit';
    // const DELETE='delete';
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['edit','delete'])
            && $subject instanceof \App\Entity\IdeaProposition;
    }

    protected function voteOnAttribute($attribute, $idea, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'edit':
                return $idea->getUser()==$user;
                // return $idea->getUser()===$user;
                break;
            case 'delete':
                return $idea->getUser()==$user;
                break;
        }

        return false;
    }
}
