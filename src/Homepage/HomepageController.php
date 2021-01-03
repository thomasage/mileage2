<?php

declare(strict_types=1);

namespace App\Homepage;

use App\Repository\CarRepository;
use Mileage\Recording\Application\AddRecord\AddRecord;
use Mileage\Recording\Application\AddRecord\AddRecordRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomepageController extends AbstractController
{
    private AddRecord $handler;
    private HomepageHtmlPresenter $presenter;
    private HomepageHtmlView $view;

    public function __construct(AddRecord $handler, HomepageHtmlPresenter $presenter, HomepageHtmlView $view)
    {
        $this->handler = $handler;
        $this->presenter = $presenter;
        $this->view = $view;
    }

    /**
     * @Route("/", name="app_homepage")
     */
    public function __invoke(Request $request, CarRepository $carRepository): Response
    {
        $dto = new HomepageFormDto();
        $form = $this->createForm(HomepageFormType::class, $dto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ucRequest = new AddRecordRequest();
            $ucRequest->carId = $dto->car;
            $ucRequest->date = new \DateTime();
            $ucRequest->mileage = $dto->mileage;
            $this->handler->handle($ucRequest, $this->presenter);
        }

        return $this->view->render($this->presenter->getViewModel(), $form);
    }
}
