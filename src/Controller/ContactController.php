<?php

namespace App\Controller;

use App\Form\Type\ContactType;
use App\Infra\Services\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    public function __construct(
       private readonly MailerService $mailerService
   )
   {

   }

   #[Route('/contact', name: 'app_contact')]
    public function __invoke(Request $request)
    {

        $contactForm = $this->createForm(ContactType::class)->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {

            $this->mailerService->sendMail(
                $_ENV['MAIL'],
                $_ENV['MAIL'],
                'Nouveau message de ' . $contactForm->get('name')->getData(),
                'emails/contact.html.twig',
                [
                    'name' => $contactForm->get('name')->getData(),
                    'lastname' => $contactForm->get('lastName')->getData(),
                    'mail' => $contactForm->get('email')->getData(),
                    'subject' => $contactForm->get('subject')->getData(),
                    'phone' => $contactForm->get('phone')->getData(),
                    'message' => $contactForm->get('message')->getData()
                ]
            );


            $this->addFlash('success', 'Votre message a bien été envoyé');
            $this->redirect($this->generateUrl('app_index'));
        }

        return $this->render('contact.html.twig', [
            'contactForm' => $contactForm->createView()
        ]);
    }
}
