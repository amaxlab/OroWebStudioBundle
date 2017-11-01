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

use AmaxLab\Oro\WebStudioBundle\Model\ExtendDomain;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\UserBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 *
 * @ORM\Entity(repositoryClass="AmaxLab\Oro\WebStudioBundle\Repository\DomainRepository")
 * @ORM\Table(name="web_studio_domain")
 *
 * @Config(
 *      defaultValues={
 *          "entity"={
 *              "icon"="fa-globe"
 *          },
 *          "security"={
 *              "type"="ACL",
 *              "group_name"="web-studio",
 *              "category"="domain"
 *          },
 *          "merge"={
 *              "enable"=true
 *          },
 *          "ownership"={
 *              "owner_type"="USER",
 *              "owner_field_name"="owner",
 *              "owner_column_name"="user_owner_id",
 *              "organization_field_name"="organization",
 *              "organization_column_name"="organization_id"
 *          }
 *      }
 * )
 */
class Domain extends ExtendDomain
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="255", min="3")
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     */
    private $name;

    /**
     * @var DateTime
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="expired_at", type="date", nullable=false)
     */
    private $expiredAt;

    /**
     * @var DomainRegistrar
     *
     * @ORM\ManyToOne(targetEntity="AmaxLab\Oro\WebStudioBundle\Entity\DomainRegistrar", inversedBy="domains")
     * @ORM\JoinColumn(name="domain_registrar_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $domainRegistrar;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_owner_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $owner;

    /**
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\OrganizationBundle\Entity\Organization")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $organization;
}
