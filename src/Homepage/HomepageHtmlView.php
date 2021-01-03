<?php

declare(strict_types=1);

namespace App\Homepage;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class HomepageHtmlView
{
    private FlashBagInterface $flashBag;
    private Environment $twig;
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator, FlashBagInterface $flashBag)
    {
        $this->flashBag = $flashBag;
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param FormInterface<FormInterface> $form
     */
    public function render(HomepageHtmlViewModel $viewModel, FormInterface $form): Response
    {
        foreach ($viewModel->flashMessages as $message) {
            $this->flashBag->add($message['type'], $message['message']);
        }

        if ($viewModel->redirectToHomepage) {
            return new RedirectResponse($this->urlGenerator->generate('app_homepage'));
        }

        return new Response(
            $this->twig->render(
                'default/index.html.twig',
                [
                    'form' => $form->createView(),
                    'vm' => $viewModel,
                ]
            )
        );
    }
}
