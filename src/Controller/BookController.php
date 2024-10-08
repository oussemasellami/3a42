<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/showbook', name: 'app_showbook')]
    public function showbook(BookRepository $bookrep): Response
    {
        $book = $bookrep->findAll();
        return $this->render('book/showbook.html.twig', [
            'tabbook' => $book,
        ]);
    }
}
