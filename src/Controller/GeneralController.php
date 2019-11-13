<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GeneralController extends AbstractController
{
    /**
     * @Route("/general", name="general")
     */
    public function index()
    {
        $user = $this->getUser();

        if(in_array("ROLE_SUPER_ADMIN", $user->getRoles())){
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('general/index.html.twig', [
            'controller_name' => 'GeneralController',
        ]);
    }
}
