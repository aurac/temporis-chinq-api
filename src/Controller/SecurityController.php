<?php
/**
 * SecurityController.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 05/04/2021
 *
 * @version 1.0
 */

namespace App\Controller;

use ApiPlatform\Core\Api\IriConverterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login", methods={"POST"})
     */
    public function login(IriConverterInterface $iriConverter, SerializerInterface $serializer)
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->json([
                'error' => 'Invalid login request'
            ], 400);
        }

        return new Response($serializer->serialize($this->getUser(), 'jsonld'), 200);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('no');
    }
}