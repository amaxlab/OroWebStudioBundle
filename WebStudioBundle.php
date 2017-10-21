<?php

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
