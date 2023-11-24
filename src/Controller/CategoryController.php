<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Contact;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $qb = $categoryRepository->createQueryBuilder('c')
            ->leftJoin('c.contacts', 'co') // On joint avec la propriete et non pas avec l'entité
            ->orderBy('c.name');

        $query = $qb->getQuery();

        return $this->render('category/index.html.twig', [
            'categories' => $query->execute(),
        ]);
    }

    #[Route('/category/{id}')]
    public function show(Category $category): Response
    {
        $contacts = $category->getContacts();

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'contacts' => $contacts,
        ]);
    }
}
