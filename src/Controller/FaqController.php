<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FaqController extends AbstractController
{

   #[Route('/faq', name: 'app_faq')]
    public function __invoke()
    {
        return $this->render('faq.html.twig');
    }
}
