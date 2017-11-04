<?php

/*
 * This file is part of the WebStudioBundle project.
 *
 * (c) AmaxLab 2017 <http://www.amaxlab.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AmaxLab\Oro\WebStudioBundle\Entity;

use AmaxLab\Oro\WebStudioBundle\EntityProperty\DatesAwareTrait;
use AmaxLab\Oro\WebStudioBundle\EntityProperty\IdAwareTrait;
use AmaxLab\Oro\WebStudioBundle\EntityProperty\NameAwareTrait;
use AmaxLab\Oro\WebStudioBundle\Model\ExtendApplication;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\OrganizationBundle\Entity\Ownership\BusinessUnitAwareTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @ORM\Entity(repositoryClass="AmaxLab\Oro\WebStudioBundle\Repository\ApplicationRepository")
 * @ORM\Table(name="web_studio_application")
 * @ORM\HasLifecycleCallbacks()
 * @Config(
 *      defaultValues={
 *          "entity"={
 *              "icon"="fa-cube"
 *          },
 *          "security"={
 *              "type"="ACL",
 *              "group_name"="",
 *              "category"="web-studio"
 *          },
 *          "ownership"={
 *              "owner_type"="BUSINESS_UNIT",
 *              "owner_field_name"="owner",
 *              "owner_column_name"="business_unit_owner_id",
 *              "organization_field_name"="organization",
 *              "organization_column_name"="organization_id"
 *          },
 *          "grid"={
 *              "default"="web-studio-application-grid"
 *          }
 *      }
 * )
 */
class Application extends ExtendApplication
{
    use IdAwareTrait, NameAwareTrait, BusinessUnitAwareTrait, DatesAwareTrait;

    /**
     * @var Environment
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AmaxLab\Oro\WebStudioBundle\Entity\Environment", inversedBy="applications")
     * @ORM\JoinColumn(name="environment_id", referencedColumnName="id", nullable=false)
     */
    private $environment;

    /**
     * @return Environment
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param Environment $environment
     *
     * @return $this
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;

        return $this;
    }
}
