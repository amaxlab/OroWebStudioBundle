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
use AmaxLab\Oro\WebStudioBundle\Model\ExtendProject;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\OrganizationBundle\Entity\Ownership\BusinessUnitAwareTrait;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @ORM\Entity(repositoryClass="AmaxLab\Oro\WebStudioBundle\Repository\ProjectRepository")
 * @ORM\Table(name="web_studio_project")
 * @ORM\HasLifecycleCallbacks()
 * @Config(
 *      routeName="web_studio_project_index",
 *      routeView="web_studio_project_view",
 *      routeCreate="web_studio_project_create",
 *      defaultValues={
 *          "entity"={
 *              "icon"="fa-sticky-note-o"
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
 *              "default"="web-studio-project-grid"
 *          }
 *      }
 * )
 */
class Project extends ExtendProject
{
    use IdAwareTrait, NameAwareTrait, BusinessUnitAwareTrait, DatesAwareTrait;

    /**
     * @var Environment[]
     * @ORM\OneToMany(targetEntity="AmaxLab\Oro\WebStudioBundle\Entity\Environment", mappedBy="project")
     */
    private $environments;

    /**
     * Project constructor.
     */
    public function __construct()
    {
        $this->environments = new ArrayCollection();
    }

    /**
     * @return Environment[]
     */
    public function getEnvironments()
    {
        return $this->environments;
    }

    /**
     * @param Environment[] $environments
     *
     * @return $this
     */
    public function setEnvironments($environments)
    {
        $this->environments = $environments;

        return $this;
    }
}
