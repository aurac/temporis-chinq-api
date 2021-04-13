<?php
/**
 * RecipeListener.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 10/04/2021
 *
 * @version 1.0
 */

namespace App\Doctrine;


use App\Entity\Recipe;
use Symfony\Component\Security\Core\Security;

class RecipeListener
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(Recipe $recipe)
    {
        if (!$this->security->getUser()) {
            return;
        }

        $recipe->setUpdatedBy($this->security->getUser());

        if ($recipe->getCreatedBy()) {
            return;
        }

        $recipe->setCreatedBy($this->security->getUser());
    }

    public function preUpdate(Recipe $recipe)
    {
        if ($this->security->getUser()) {
            $recipe->setUpdatedBy($this->security->getUser());
        }
    }
}