<?php

declare(strict_types=1);

namespace App\Homepage;

final class HomepageHtmlViewModel
{
    /** @var array<array{type:string,message:string}> */
    public array $flashMessages = [];
    public string $labelActionAdd = 'Add a new record';
    public int $mileage = 1000;
    public string $pageTitle = 'Homepage';
    public bool $redirectToHomepage = false;
}
