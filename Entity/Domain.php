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
use AmaxLab\Oro\WebStudioBundle\Model\ExtendDomain;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\OrganizationBundle\Entity\Ownership\BusinessUnitAwareTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @ORM\Entity(repositoryClass="AmaxLab\Oro\WebStudioBundle\Repository\DomainRepository")
 * @ORM\Table(name="web_studio_domain")
 * @ORM\HasLifecycleCallbacks()
 * @Config(
 *      routeName="web_studio_domain_index",
 *      routeView="web_studio_domain_view",
 *      routeCreate="web_studio_domain_create",
 *      defaultValues={
 *          "entity"={
 *              "icon"="fa-globe"
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
 *              "default"="web-studio-domain-grid"
 *          }
 *      }
 * )
 */
class Domain extends ExtendDomain
{
    use IdAwareTrait, NameAwareTrait, BusinessUnitAwareTrait, DatesAwareTrait;

    /**
     * @var DateTime
     * @Assert\NotBlank()
     * @Assert\Date()
     * @ORM\Column(name="expired_at", type="date", nullable=false)
     */
    private $expiredAt;

    /**
     * @var DomainRegistrar
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AmaxLab\Oro\WebStudioBundle\Entity\DomainRegistrar", inversedBy="domains")
     * @ORM\JoinColumn(name="domain_registrar_id", referencedColumnName="id", nullable=false)
     */
    private $domainRegistrar;

    /**
     * @var DomainMailService
     * @ORM\ManyToOne(targetEntity="AmaxLab\Oro\WebStudioBundle\Entity\DomainMailService", inversedBy="domains")
     * @ORM\JoinColumn(name="domain_mail_service_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $domainMailService;

    /**
     * @var DomainDnsService
     * @ORM\ManyToOne(targetEntity="AmaxLab\Oro\WebStudioBundle\Entity\DomainDnsService", inversedBy="domains")
     * @ORM\JoinColumn(name="domain_dns_service_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $domainDnsService;

    /**
     * @var Site[]
     * @ORM\OneToMany(targetEntity="AmaxLab\Oro\WebStudioBundle\Entity\Site", mappedBy="domain")
     */
    private $sites;

    /**
     * @var MailBox[]
     * @ORM\OneToMany(targetEntity="AmaxLab\Oro\WebStudioBundle\Entity\MailBox", mappedBy="domain")
     */
    private $mailBoxes;

    /**
     * Domain constructor.
     */
    public function __construct()
    {
        $this->sites = new ArrayCollection();
        $this->mailBoxes = new ArrayCollection();
    }

    /**
     * @return DateTime
     */
    public function getExpiredAt()
    {
        return $this->expiredAt;
    }

    /**
     * @param DateTime $expiredAt
     *
     * @return $this
     */
    public function setExpiredAt($expiredAt)
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }

    /**
     * @return DomainRegistrar
     */
    public function getDomainRegistrar()
    {
        return $this->domainRegistrar;
    }

    /**
     * @param DomainRegistrar $domainRegistrar
     *
     * @return $this
     */
    public function setDomainRegistrar($domainRegistrar)
    {
        $this->domainRegistrar = $domainRegistrar;

        return $this;
    }

    /**
     * @return Site[]
     */
    public function getSites()
    {
        return $this->sites;
    }

    /**
     * @param Site[] $sites
     *
     * @return $this
     */
    public function setSites($sites)
    {
        $this->sites = $sites;

        return $this;
    }

    /**
     * @return DomainMailService
     */
    public function getDomainMailService()
    {
        return $this->domainMailService;
    }

    /**
     * @param DomainMailService $domainMailService
     *
     * @return $this
     */
    public function setDomainMailService($domainMailService)
    {
        $this->domainMailService = $domainMailService;

        return $this;
    }

    /**
     * @return DomainDnsService
     */
    public function getDomainDnsService()
    {
        return $this->domainDnsService;
    }

    /**
     * @param DomainDnsService $domainDnsService
     *
     * @return $this
     */
    public function setDomainDnsService($domainDnsService)
    {
        $this->domainDnsService = $domainDnsService;

        return $this;
    }

    /**
     * @return MailBox[]
     */
    public function getMailBoxes()
    {
        return $this->mailBoxes;
    }

    /**
     * @param MailBox[] $mailBoxes
     *
     * @return $this
     */
    public function setMailBoxes($mailBoxes)
    {
        $this->mailBoxes = $mailBoxes;

        return $this;
    }
}
