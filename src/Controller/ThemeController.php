<?php

namespace App\Controller;

use App\Entity\Theme;
use App\Entity\ThemeSearch;
use App\Form\ThemeSearchType;
use App\Form\ThemeType;
use App\Repository\BookRepository;
use App\Repository\ThemeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class ThemeController extends AbstractController
{
    /**
     * @Route("/ListeTheme", name="theme_index", methods={"GET"})
     */
    public function index(ThemeRepository $themeRepository,
                          PaginatorInterface $paginator,
                          Request $request): Response
    {
        $search = new ThemeSearch();
        $form = $this->createForm(ThemeSearchType::class, $search);
        $form->handleRequest($request);

        $theme = $paginator->paginate(
            $themeRepository->findtheme($search),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('theme/index.html.twig', [
            'theme' => $theme,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/newTheme", name="theme_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $theme = new Theme();
        $form = $this->createForm(ThemeType::class, $theme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($theme);
            $entityManager->flush();

            return $this->redirectToRoute('theme_index', ['id' => $theme->getId()]);
        }

        return $this->render('theme/new.html.twig', [
            'theme' => $theme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show_theme/{id}", name="theme_show", methods={"GET"})
     */
    public function show(Theme $theme): Response
    {
        return $this->render('theme/show.html.twig', [
            'theme' => $theme,
        ]);
    }

    /**
     * @Route("/theme_edit/{id}", name="theme_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Theme $theme): Response
    {
        $form = $this->createForm(ThemeType::class, $theme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('theme_edit', ['id' => $theme->getId()]);
        }

        return $this->render('theme/edit.html.twig', [
            'theme' => $theme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/theme_delete/{id}", name="theme_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Theme $theme, BookRepository $bookRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$theme->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $book = $bookRepository->findByTheme($theme->getId());
            if($book != null){
                $this->addFlash('failed', "Certains livres sont enregistrés avec ce thème
                            ! Changez l'auteur de ces livres avant de supprimer ce thème");
                return $this->redirectToRoute('theme_show', ['id' => $theme->getId()]);
            }
            $entityManager->remove($theme);
            $entityManager->flush();
        }

        $this->addFlash('success', "Supprimer avec succès !");
        return $this->redirectToRoute('theme_index');
    }
}
