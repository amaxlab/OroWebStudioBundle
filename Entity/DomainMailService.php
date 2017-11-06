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
use AmaxLab\Oro\WebStudioBundle\Model\ExtendDomainMailService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\OrganizationBundle\Entity\Ownership\BusinessUnitAwareTrait;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @ORM\Entity(repositoryClass="AmaxLab\Oro\WebStudioBundle\Repository\DomainMailServiceRepository")
 * @ORM\Table(name="web_studio_domain_mail_service")
 * @ORM\HasLifecycleCallbacks()
 * @Config(
 *      routeName="web_studio_domain_mail_service_index",
 *      routeView="web_studio_domain_mail_service_view",
 *      routeCreate="web_studio_domain_mail_service_create",
 *      defaultValues={
 *          "entity"={
 *              "icon"="fa-envelope"
 *          },
 *          "security"={
 *              "type"="ACL",
 *              "group_name"="",
 *              "category"="web-studio"
 *          },
 *          "merge"={
 *              "enable"=true
 *          },
 *          "ownership"={
 *              "owner_type"="BUSINESS_UNIT",
 *              "owner_field_name"="owner",
 *              "owner_column_name"="business_unit_owner_id",
 *              "organization_field_name"="organization",
 *              "organization_column_name"="organization_id"
 *          },
 *          "grid"={
 *              "default"="web-studio-domain-mail-service-grid"
 *          }
 *      }
 * )
 */
class DomainMailService extends ExtendDomainMailService
{
    use IdAwareTrait, NameAwareTrait, BusinessUnitAwareTrait, DatesAwareTrait;

    /**
     * @var Domain[]
     * @ORM\OneToMany(targetEntity="AmaxLab\Oro\WebStudioBundle\Entity\Domain", mappedBy="domainMailService")
     */
    private $domains;

    /**
     * DomainMail_service constructor.
     */
    public function __construct()
    {
        $this->domains = new ArrayCollection();
    }

    /**
     * @return Domain[]
     */
    public function getDomains()
    {
        return $this->domains;
    }

    /**
     * @param Domain[] $domains
     *
     * @return $this
     */
    public function setDomains($domains)
    {
        $this->domains = $domains;

        return $this;
    }
}
