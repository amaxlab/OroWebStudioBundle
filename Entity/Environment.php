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
use AmaxLab\Oro\WebStudioBundle\Model\ExtendEnvironment;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\OrganizationBundle\Entity\Ownership\BusinessUnitAwareTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @ORM\Entity(repositoryClass="AmaxLab\Oro\WebStudioBundle\Repository\EnvironmentRepository")
 * @ORM\Table(name="web_studio_environment")
 * @ORM\HasLifecycleCallbacks()
 * @Config(
 *      defaultValues={
 *          "entity"={
 *              "icon"="fa-cubes"
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
 *              "default"="web-studio-environment-grid"
 *          }
 *      }
 * )
 */
class Environment extends ExtendEnvironment
{
    use IdAwareTrait, NameAwareTrait, BusinessUnitAwareTrait, DatesAwareTrait;

    /**
     * @var Project
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AmaxLab\Oro\WebStudioBundle\Entity\Project", inversedBy="environments")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=false)
     */
    private $project;

    /**
     * @var Application
     * @ORM\OneToMany(targetEntity="AmaxLab\Oro\WebStudioBundle\Entity\Application", mappedBy="environment")
     */
    private $applications;

    /**
     * Environment constructor.
     */
    public function __construct()
    {
        $this->applications = new ArrayCollection();
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param Project $project
     *
     * @return $this
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @return Application
     */
    public function getApplications()
    {
        return $this->applications;
    }

    /**
     * @param Application $applications
     *
     * @return $this
     */
    public function setApplications($applications)
    {
        $this->applications = $applications;

        return $this;
    }
}
