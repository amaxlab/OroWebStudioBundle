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
use AmaxLab\Oro\WebStudioBundle\Model\ExtendHost;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\OrganizationBundle\Entity\Ownership\BusinessUnitAwareTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @ORM\Entity(repositoryClass="AmaxLab\Oro\WebStudioBundle\Repository\HostRepository")
 * @ORM\Table(name="web_studio_host")
 * @ORM\HasLifecycleCallbacks()
 * @Config(
 *      routeName="web_studio_host_index",
 *      routeView="web_studio_host_view",
 *      routeCreate="web_studio_host_create",
 *      defaultValues={
 *          "entity"={
 *              "icon"="fa-server"
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
 *              "default"="web-studio-host-grid"
 *          }
 *      }
 * )
 */
class Host extends ExtendHost
{
    use IdAwareTrait, NameAwareTrait, BusinessUnitAwareTrait, DatesAwareTrait;

    /**
     * @var HostProvider
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AmaxLab\Oro\WebStudioBundle\Entity\HostProvider", inversedBy="hosts")
     * @ORM\JoinColumn(name="host_provider_id", referencedColumnName="id", nullable=false)
     */
    private $hostProvider;

    /**
     * @var string
     * @ORM\Column(name="os", type="string", length=255, nullable=true)
     */
    private $os;

    /**
     * @var int
     * @ORM\Column(name="cpu", type="integer", nullable=true)
     */
    private $cpu;

    /**
     * @var int
     * @ORM\Column(name="memory", type="integer", nullable=true)
     */
    private $memory;

    /**
     * @return HostProvider
     */
    public function getHostProvider()
    {
        return $this->hostProvider;
    }

    /**
     * @param HostProvider $hostProvider
     *
     * @return $this
     */
    public function setHostProvider($hostProvider)
    {
        $this->hostProvider = $hostProvider;

        return $this;
    }

    /**
     * @return string
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * @param string $os
     *
     * @return $this
     */
    public function setOs($os)
    {
        $this->os = $os;

        return $this;
    }

    /**
     * @return int
     */
    public function getCpu()
    {
        return $this->cpu;
    }

    /**
     * @param int $cpu
     *
     * @return $this
     */
    public function setCpu($cpu)
    {
        $this->cpu = $cpu;

        return $this;
    }

    /**
     * @return int
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * @param int $memory
     *
     * @return $this
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;

        return $this;
    }
}
