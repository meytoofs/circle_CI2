<?php

namespace App\Twig;

use PhpParser\Node\Expr\Cast\String_;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class UidExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('duku', [$this, 'myUniqId']),
            new TwigFunction('jambe_de_bois', [$this, 'moncul']),
        ];
    }

    public function myUniqId()
    {
        $uid = uniqid($prefix = "coucou");
        $uid = date('Y-m-d');
        return $uid;
    }
    public function moncul()
    {
        $pipe = "Ma div est un volcan";
        return $pipe;

    }
}
