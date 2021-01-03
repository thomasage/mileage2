<?php

declare(strict_types=1);

namespace App\Homepage;

use Mileage\Recording\Application\AddRecord\AddRecordPresenter;
use Mileage\Recording\Application\AddRecord\AddRecordResponse;
use Symfony\Contracts\Translation\TranslatorInterface;

final class HomepageHtmlPresenter implements AddRecordPresenter
{
    private TranslatorInterface $translator;
    private HomepageHtmlViewModel $viewModel;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
        $this->viewModel = new HomepageHtmlViewModel();
    }

    public function present(AddRecordResponse $response): void
    {
        if ($response->created) {
            $this->viewModel->flashMessages[] = [
                'type' => 'success',
                'message' => $this->translator->trans('notification.record_added'),
            ];
            $this->viewModel->redirectToHomepage = true;
        }
    }

    public function getViewModel(): HomepageHtmlViewModel
    {
        return $this->viewModel;
    }
}
