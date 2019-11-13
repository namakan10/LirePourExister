<?php
/**
 * Created by IntelliJ IDEA.
 * User: Guest
 * Date: 10/26/2019
 * Time: 3:21 PM
 */

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\MemberRepository;
use App\Repository\ThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     */
    public function AdminDashAction(MemberRepository $members, BookRepository $books, ThemeRepository $themes,
                       AuthorRepository $author ){
        $nbreMembers = count($members->findAll());
        $nbreBooks = count($books->findAll());
        $nbreAuthors = count($author->findAll());
        $nbreThemes = count($themes->findAll());
        return $this->render('Admin/dashborad.html.twig', [
            "nbreMembers" => $nbreMembers,
            "nbreBooks" => $nbreBooks,
            "nbreAuthors" => $nbreAuthors,
            "nbreThemes" => $nbreThemes,
        ]);
    }
}