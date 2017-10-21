<?php

/*
 * This file is part of the WebStudioBundle project.
 *
 * (c) AmaxLab 2017 <http://www.amaxlab.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AmaxLab\Oro\WebStudioBundle;

use AmaxLab\Oro\WebStudioBundle\DependencyInjection\WebStudioExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
class WebStudioBundle extends Bundle
{
    /**
     * @return WebStudioExtension
     */
    public function getContainerExtension()
    {
        if (!$this->extension) {
            $this->extension = new WebStudioExtension();
        }

        return $this->extension;
    }
}
