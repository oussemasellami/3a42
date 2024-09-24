<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/showproduct', name: 'app_showproduct')]
    public function showproduct(): Response
    {
        $name = 'hello';
        return $this->render('product/showproduct.html.twig', [
            'nameshow' => $name,
        ]);
    }

    #[Route('/showbyid/{id}', name: 'app_showbyid')]
    public function showbyid($id): Response
    {
        // var_dump($id) . die();
        return $this->render('product/showbyid.html.twig', [
            'notreid' => $id,
        ]);
    }
}
