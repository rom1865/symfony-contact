<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $contactRepository, Request $request): Response
    {
        $contacts = $contactRepository->search($request->get('search', ''));

        return $this->render('contact/index.html.twig', ['contacts' => $contacts,
                                                    'search' => $request->get('search', '')]);
    }

    #[Route('/contact/{id}', requirements: ['id' => '\d+'])] // Cherche en faisant un findby ID, si le parametre est une entité il comprends
    public function show(
        #[MapEntity(expr: 'repository.findWithCategory(id)')]
        Contact $contact): Response
    {
        return $this->render('contact/show.html.twig', ['contact' => $contact]);
    }

    #[Route('/contact/create')]
    public function create(): Response
    {
        return $this->render('contact/contact_create.html.twig');
    }

    #[Route('/contact/{id}/update', requirements: ['id' => '\d+'])]
    public function update(
        #[MapEntity(expr: 'repository.findWithCategory(id)')]
        Contact $contact, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_show', ['id' => $contact->getId()]);
        }

        return $this->render('contact/contact_update.html.twig', ['contact' => $contact,
                                                                         'form' => $form]);
    }

    #[Route('/contact/{id}/delete', requirements: ['id' => '\d+'])]
    public function delete(
        #[MapEntity(expr: 'repository.findWithCategory(id)')]
        Contact $contact): Response
    {
        return $this->render('contact/contact_delete.html.twig', ['contact' => $contact]);
    }
}
