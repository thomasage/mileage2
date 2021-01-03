<?php

declare(strict_types=1);

namespace App\Homepage;

use App\Repository\CarRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

final class HomepageFormType extends AbstractType
{
    /**
     * @var array<string,string>
     */
    private array $cars;

    public function __construct(CarRepository $carRepository)
    {
        $cars = $carRepository->findAll();
        $this->cars = (array) array_combine(
            array_column($cars, 'name'),
            array_map('strval', array_column($cars, 'uuid'))
        );
    }

    /**
     * @param FormBuilderInterface<FormBuilderInterface> $builder
     * @param array<mixed>                               $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'car',
                ChoiceType::class,
                [
                    'choices' => $this->cars,
                    'constraints' => [
                        new NotBlank(),
                    ],
                    'label' => 'field.car',
                    'required' => true,
                ]
            )
            ->add(
                'mileage',
                IntegerType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                        new Range(['min' => 0]),
                    ],
                    'label' => 'field.mileage',
                    'required' => true,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => HomepageFormDto::class]);
    }
}
