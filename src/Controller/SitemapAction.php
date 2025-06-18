<?php

namespace App\Controller;

use App\Action\AbstractAction;
use App\Responder\RedirectResponder;
use App\Responder\TemplateResponder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SitemapAction extends AbstractController
{

    public function __construct(
     protected UrlGeneratorInterface $urlGenerator,
    )
    {
    }


    #[Route('/sitemap.xml', name: 'app_sitemap', defaults: ['_format' => 'xml'])]
    public function __invoke(Request $request): Response
    {
        $hostname = $request->getSchemeAndHttpHost();
        $urls = [];

        $urls[] = ['loc' => $this->urlGenerator->generate('app_index')];
        $urls[] = ['loc' => $this->urlGenerator->generate('app_faq')];
        $urls[] = ['loc' => $this->urlGenerator->generate('app_contact')];


        return $this->render('sitemap.html.twig', [
            'urls' => $urls,
            'hostname' => $hostname
        ]);
    }
}
