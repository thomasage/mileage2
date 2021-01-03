<?php

declare(strict_types=1);

namespace App\PrivateArea\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/private", name="private_dashboard")
 */
final class DashboardController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('private/dashboard/index.html.twig');
    }
}
