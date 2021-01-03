<?php

declare(strict_types=1);

namespace App\PrivateArea\Car;

use App\Entity\User;
use Mileage\Garage\Application\GetCarsByOwner\GetCarsByOwner;
use Mileage\Garage\Application\GetCarsByOwner\GetCarsByOwnerRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/private/car")
 */
final class CarController extends AbstractController
{
    /**
     * @Route("/", name="private_car_index")
     */
    public function index(GetCarsByOwner $handler, CarIndexHtmlPresenter $presenter, CarIndexHtmlView $view): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $ucRequest = new GetCarsByOwnerRequest();
        $ucRequest->ownerId = (string) $user->uuid;
        $handler->handle($ucRequest, $presenter);

        return $view->render($presenter->getViewModel());
    }
}
