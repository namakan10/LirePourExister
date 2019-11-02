<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberType;
use App\Repository\MemberRepository;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class MemberController extends AbstractController
{
    /**
     * @Route("/memberList", name="member_index", methods={"GET"})
     */
    public function index(MemberRepository $memberRepository): Response
    {
        return $this->render('member/index.html.twig', [
            'members' => $memberRepository->findAll(),
        ]);
    }

    /**
     * @Route("/newMember", name="member_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserManagerInterface $userManager): Response
    {
        $member = new Member();
        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $now = new \DateTime();
            $member->setExpiredAt($now);

            /*
             * CREATE FOS USER
             */
            $matricule = "";
            $chaine = "0123456789";
            $first = $member->getFirtName();
            $last = $member->getLastName();
            $find = true;
            $lenght = 4;

            while ($find == true){
                $matricule = "";
                srand((double)microtime()*1000000);
                while($lenght!=0){
                    $matricule .= $chaine[rand()%strlen($chaine)];
                    $lenght--;
                }
                $matricule = $first[0].$matricule.$last[0];
                $user = $userManager->findUserByUsername($matricule);
                if($user == null){
                    $find = false;
                }
            }
            $user = $userManager->createUser();
            $user->setUsername($matricule);
            if($member->getEmail() != null){
                $user->setEmail($member->getEmail());
                $user->setEmailCanonical($member->getEmail());
            }
            else{
                $user->setEmail($matricule.'@gmail.com');
                $user->setEmailCanonical($matricule.'@gmail.com');
            }
            $user->setEnabled(1);
            $user->setPlainPassword('pass'.$matricule);
            $userManager->updateUser($user);

            $member->setUser($user);
            $entityManager->persist($member);
            $entityManager->flush();

            return $this->redirectToRoute('member_index');
        }

        return $this->render('member/new.html.twig', [
            'member' => $member,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/showMember/{id}", name="member_show", methods={"GET"})
     */
    public function show(Member $member): Response
    {
        return $this->render('member/show.html.twig', [
            'member' => $member,
        ]);
    }

    /**
     * @Route("/editMember/{id}", name="member_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Member $member): Response
    {
        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('member_index');
        }

        return $this->render('member/edit.html.twig', [
            'member' => $member,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/deleteMember/{id}", name="member_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Member $member): Response
    {
        if ($this->isCsrfTokenValid('delete'.$member->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($member);
            $entityManager->flush();
        }

        return $this->redirectToRoute('member_index');
    }
}
