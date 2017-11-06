<?php

/*
 * This file is part of the WebStudioBundle project.
 *
 * (c) AmaxLab 2017 <http://www.amaxlab.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AmaxLab\Oro\WebStudioBundle\Controller;

use AmaxLab\Oro\WebStudioBundle\Entity\DomainDnsService;
use AmaxLab\Oro\WebStudioBundle\Form\Handler\DomainDnsServiceHandler;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 *
 * @Route("domain_dns_service")
 */
class DomainDnsServiceController extends Controller
{
    /**
     * @Route(
     *      "/{_format}",
     *      name="web_studio_domain_dns_service_index",
     *      requirements={"_format"="html|json"},
     *      defaults={"_format" = "html"}
     * )
     * @AclAncestor("web_studio_domain_dns_service_view")
     * @Template
     * @return array
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Route("/view/{id}", name="web_studio_domain_dns_service_view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="web_studio_domain_dns_service_view",
     *      type="entity",
     *      class="WebStudioBundle:DomainDnsService",
     *      permission="VIEW"
     * )
     * @param DomainDnsService $entity
     * @return array
     */
    public function viewAction(DomainDnsService $entity)
    {
        return [
            'entity' => $entity,
            'entityClass' => DomainDnsService::class,
        ];
    }

    /**
     * @Route("/widget/info/{id}", name="web_studio_domain_dns_service_widget_info", requirements={"id"="\d+"})
     * @Template("WebStudioBundle:DomainDnsService/widget:info.html.twig")
     * @AclAncestor("web_studio_domain_dns_service_view")
     * @param DomainDnsService $entity
     * @return array
     */
    public function infoAction(DomainDnsService $entity)
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * @Route("/create", name="web_studio_domain_dns_service_create")
     * @Template("WebStudioBundle:DomainDnsService:update.html.twig")
     * @Acl(
     *      id="web_studio_domain_dns_service_create",
     *      type="entity",
     *      class="WebStudioBundle:DomainDnsService",
     *      permission="CREATE"
     * )
     * @return array
     */
    public function createAction()
    {
        return $this->update(new DomainDnsService());
    }

    /**
     * @Route("/update/{id}", name="web_studio_domain_dns_service_update", requirements={"id"="\d+"}, defaults={"id"=0})
     * @Template
     * @Acl(
     *      id="web_studio_domain_dns_service_update",
     *      type="entity",
     *      class="WebStudioBundle:DomainDnsService",
     *      permission="EDIT"
     * )
     * @param DomainDnsService $entity
     * @return array
     */
    public function updateAction(DomainDnsService $entity)
    {
        return $this->update($entity);
    }

    /**
     * @param DomainDnsService $entity
     * @return array
     */
    protected function update(DomainDnsService $entity)
    {
        if ($this->get(DomainDnsServiceHandler::class)->process($entity)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('oro.business_unit.controller.message.saved') //TODO:change this
            );

            return $this->get('oro_ui.router')->redirect($entity);
        }

        return [
            'entity' => $entity,
            'entityClass' => DomainDnsService::class,
            'form' => $this->get('web_studio.form.domain_dns_service')->createView(),
        ];
    }
}
