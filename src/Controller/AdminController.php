<?php
/**
 * Created by IntelliJ IDEA.
 * User: Guest
 * Date: 10/26/2019
 * Time: 3:21 PM
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     */
    public function AdminDashAction(){
        return $this->render('Admin/dashborad.html.twig');
    }
}