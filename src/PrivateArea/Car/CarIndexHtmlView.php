<?php

declare(strict_types=1);

namespace App\PrivateArea\Car;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class CarIndexHtmlView
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(CarIndexHtmlViewModel $viewModel): Response
    {
        return new Response(
            $this->twig->render(
                'private/car/index.html.twig',
                ['vm' => $viewModel]
            )
        );
    }
}
