<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AuthorRepository;
use App\Entity\Author;
use App\Form\AuthorType;
use Doctrine\Persistence\ManagerRegistry;

class AuthorsController extends AbstractController
{
    #[Route('/authors', name: 'app_authors')]
    public function index(): Response
    {
        return $this->render('authors/index.html.twig', [
            'controller_name' => 'AuthorsController',
        ]);
    }

    #[Route('/showauthors', name: 'app_showauthors')]
    public function showauthors(AuthorRepository  $a): Response
    {
        $authors = $a->findAll();
        return $this->render('authors/showauthors.html.twig', [
            'tabauthors' => $authors,
        ]);
    }

    #[Route('/addauthors', name: 'app_addauthors')]
    public function addauthors(ManagerRegistry $m): Response
    {
        $em = $m->getManager();
        $authors = new Author();
        $authors->setUsername("3a42");
        $authors->setEmail('3a42@esprit.tn');
        $em->persist($authors);
        $em->flush();
        return $this->redirectToRoute('app_showauthors');
    }

    #[Route('/addformauthors', name: 'app_addformauthors')]
    public function addformauthors(ManagerRegistry $m,Request $req): Response
    {
        $em = $m->getManager();
        $authors = new Author();
        $form = $this->createForm(AuthorType::class, $authors);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($authors);
            $em->flush();
        }
        return $this->render('authors/addformauthors.html.twig', [
            'formadd' =>$form ,
        ]);
    }


    #[Route('/updateformauthors/{id}', name: 'app_updateformauthors')]
    public function updateformauthors(ManagerRegistry $m,Request $req,$id,AuthorRepository $rep): Response
    {
        $em = $m->getManager();
        $authors = $rep->find($id);
        $form = $this->createForm(AuthorType::class, $authors);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($authors);
            $em->flush();
            return $this->redirectToRoute('app_showauthors');
        }
        return $this->render('authors/addformauthors.html.twig', [
            'formadd' =>$form ,
        ]);
    }


    #[Route('/deleteformauthors/{id}', name: 'app_deleteformauthors')]
    public function deleteformauthors(ManagerRegistry $m,Request $req,$id,AuthorRepository $rep): Response
    {
        $em = $m->getManager();
        $authors = $rep->find($id);
            $em->remove($authors);
            $em->flush();
            return $this->redirectToRoute('app_showauthors');
        
      
    }
}