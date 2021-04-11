<?php
/**
 * RecipeLevelListener.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 11/04/2021
 *
 * @version 1.0
 */

namespace App\Doctrine;


use App\Entity\RecipeLevel;
use Symfony\Component\Security\Core\Security;

class RecipeLevelListener
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function preUpdate(RecipeLevel $recipeLevel)
    {
        if ($this->security->getUser()) {
            $recipeLevel->setUpdatedBy($this->security->getUser());
        }
    }
}