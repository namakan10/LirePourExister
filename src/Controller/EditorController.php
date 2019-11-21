<?php

namespace App\Controller;

use App\Entity\Editor;
use App\Entity\EditorSearch;
use App\Form\EditorSearchType;
use App\Form\EditorType;
use App\Repository\BookRepository;
use App\Repository\EditorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class EditorController extends AbstractController
{
    /**
     * @Route("/List_of_Editor", name="editor_index", methods={"GET"})
     */
    public function index(EditorRepository $editorRepository,
                          PaginatorInterface $paginator,
                          Request $request): Response
    {
        $search = new EditorSearch();
        $form = $this->createForm(EditorSearchType::class, $search);
        $form->handleRequest($request);
        $editors = $paginator->paginate(
            $editorRepository->findEditor($search),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('editor/index.html.twig', [
            'editors' => $editors,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/newEditor", name="editor_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $editor = new Editor();
        $form = $this->createForm(EditorType::class, $editor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($editor);
            $entityManager->flush();

            return $this->redirectToRoute('editor_show', ['id' => $editor->getId()]);
        }

        return $this->render('editor/new.html.twig', [
            'editor' => $editor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ShowEditor/{id}", name="editor_show", methods={"GET"})
     */
    public function show(Editor $editor): Response
    {
        return $this->render('editor/show.html.twig', [
            'editor' => $editor,
        ]);
    }

    /**
     * @Route("/editEditor/{id}", name="editor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Editor $editor): Response
    {
        $form = $this->createForm(EditorType::class, $editor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('editor_show', [
                'id' => $editor->getId()
            ]);
        }

        return $this->render('editor/edit.html.twig', [
            'editor' => $editor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete_editor/{id}", name="editor_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Editor $editor, BookRepository $bookRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$editor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $book = $bookRepository->findBy(array(
                'editor' => $editor
            ));
            if($book != null){
                $this->addFlash('failed', 'Cet éditeur a publier certains livres, impossible de supprimer !');
                return $this->redirectToRoute('editor_show', ['id' => $editor->getId()]);
            }
            $entityManager->remove($editor);
            $entityManager->flush();
        }
        $this->addFlash('success', "Supprimer avec succès !");
        return $this->redirectToRoute('editor_index');
    }
}
