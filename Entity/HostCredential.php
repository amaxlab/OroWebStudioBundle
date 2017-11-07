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

use AmaxLab\Oro\WebStudioBundle\Model\ExtendHostCredential;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @ORM\Entity(repositoryClass="AmaxLab\Oro\WebStudioBundle\Repository\HostCredentialRepository")
 * @ORM\Table(name="web_studio_host_credential")
 * @ORM\HasLifecycleCallbacks()
 * @Config(
 *      defaultValues={
 *          "entity"={
 *              "icon"="fa-key"
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
 *              "default"="web-studio-host-credential-grid"
 *          }
 *      }
 * )
 */
class HostCredential extends ExtendHostCredential
{
    /**
     * @var Host
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AmaxLab\Oro\WebStudioBundle\Entity\Host", inversedBy="hostCredentials")
     * @ORM\JoinColumn(name="host_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $host;

    /**
     * @return Host
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param Host $host
     *
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }
}
