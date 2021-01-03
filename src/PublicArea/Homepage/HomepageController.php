<?php

declare(strict_types=1);

namespace App\PublicArea\Homepage;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="public_homepage")
 */
final class HomepageController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('public/homepage/index.html.twig');
    }
}
