<?php

/**
 * @copyright 2019 Jonas Linn
 *
 * @license LGPL-3.0+
 */

namespace Jl\OnepageNav\ContaoManager;

use Jl\OnepageNav\JlOnepageNav;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

/**
 * @author Jonas Linn
 * @package Jl\OnepageNav
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(JlOnepageNav::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}