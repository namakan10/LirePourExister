<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\BookSearch;
use App\Form\BookSearchType;
use App\Form\BookType;
use App\Repository\BookRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin")
 */
class BookController extends AbstractController
{
    /**
     * @Route("/bookList", name="book_index", methods={"GET"})
     */
    public function index(BookRepository $bookRepository,
                          PaginatorInterface $paginator,
                          Request $request): Response
    {
        $search = new BookSearch();
        $form = $this->createForm(BookSearchType::class, $search);
        $form->handleRequest($request);

        $books = $paginator->paginate(
            $bookRepository->findByTitleAvailability($search),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('book/index.html.twig', [
            'books' => $books,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/bookList/{var}/{id}/{name}", name="bookByAuthEdit", methods={"GET"})
     */
    public function booksByAuthEdit($var, $id, $name, BookRepository $bookRepository,
                                    PaginatorInterface $paginator,
                                    Request $request) : Response{
        $search = new BookSearch();
        $form = $this->createForm(BookSearchType::class, $search);
        $form->handleRequest($request);
        $message = "";

        if($var == "Author"){
            $books = $paginator->paginate(
                $bookRepository->findByAuthors($id),
                $request->query->getInt('page', 1), /*page number*/
                10 /*limit per page*/
            );
            $message = "Livres écrit par ".$name;
        }
        else if($var == "Theme"){
            $books = $paginator->paginate(
                $bookRepository->findByTheme($id),
                $request->query->getInt('page', 1), /*page number*/
                10 /*limit per page*/
            );
            $message = "Livres appartenants au thème : ".$name;
        }
        else{
            $books = $paginator->paginate(
                $bookRepository->findByEditor($id),
                $request->query->getInt('page', 1), /*page number*/
                10 /*limit per page*/
            );
            $message = "Livres publiés par ".$name;
        }

        return $this->render('book/booksByAuthorsOrEditors.html.twig', [
            'books' => $books,
            'form' => $form->createView(),
            'message' => $message,
        ]);
    }

    /**
     * @Route("/newBook", name="book_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $book = new Book();
        $book->setPublishedDt(new \DateTime());
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $book->setNbreTotal($book->getNbreCopies());
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('book_show', ['id' => $book->getId()]);
        }

        return $this->render('book/new.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/showBook/{id}", name="book_show", methods={"GET"})
     */
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="book_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Book $book): Response
    {

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('book_show', ['id' => $book->getId()]);
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Book $book): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        $this->addFlash('success', "Supprimer avec succès !");
        return $this->redirectToRoute('book_index');
    }
}
