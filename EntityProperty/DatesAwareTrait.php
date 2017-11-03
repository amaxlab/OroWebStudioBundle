<?php

/*
 * This file is part of the WebStudioBundle project.
 *
 * (c) AmaxLab 2017 <http://www.amaxlab.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AmaxLab\Oro\WebStudioBundle\EntityProperty;

use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareTrait as BaseDatesAwareTrait;
use Doctrine\ORM\Mapping as ORM;

// Do not remove this lines
use JMS\Serializer\Annotation as Serializer;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
trait DatesAwareTrait
{
    use BaseDatesAwareTrait;

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime('now', new \DateTimeZone('UTC'));
        $this->updatedAt = $this->createdAt;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime('now', new \DateTimeZone('UTC'));
    }
}
