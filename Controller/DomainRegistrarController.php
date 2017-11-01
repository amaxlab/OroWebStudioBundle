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

use AmaxLab\Oro\WebStudioBundle\Entity\DomainRegistrar;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 *
 * @Route("domain_registrar")
 */
class DomainRegistrarController extends Controller
{
    /**
     * @Route(
     *      "/{_format}",
     *      name="web_studio_domain_registrar_index",
     *      requirements={"_format"="html|json"},
     *      defaults={"_format" = "html"}
     * )
     * @AclAncestor("web_studio_domain_registrar_view")
     * @Template
     * @return array
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Route("/view/{id}", name="web_studio_domain_registrar_view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="web_studio_domain_registrar_view",
     *      type="entity",
     *      class="WebStudioBundle:DomainRegistrar",
     *      permission="VIEW"
     * )
     * @param DomainRegistrar $entity
     * @return array
     */
    public function viewAction(DomainRegistrar $entity)
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * @Route("/widget/info/{id}", name="web_studio_domain_registrar_widget_info", requirements={"id"="\d+"})
     * @Template("WebStudioBundle:DomainRegistrar/widget:info.html.twig")
     * @AclAncestor("web_studio_domain_registrar_view")
     * @param DomainRegistrar $entity
     * @return array
     */
    public function infoAction(DomainRegistrar $entity)
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * @Route("/create", name="web_studio_domain_registrar_create")
     * @Template("WebStudioBundle:DomainRegistrar:update.html.twig")
     * @Acl(
     *      id="web_studio_domain_registrar_create",
     *      type="entity",
     *      class="WebStudioBundle:DomainRegistrar",
     *      permission="CREATE"
     * )
     * @return array
     */
    public function createAction()
    {
        return $this->update(new DomainRegistrar());
    }

    /**
     * @Route("/update/{id}", name="web_studio_domain_registrar_update", requirements={"id"="\d+"}, defaults={"id"=0})
     * @Template
     * @Acl(
     *      id="web_studio_domain_registrar_update",
     *      type="entity",
     *      class="WebStudioBundle:DomainRegistrar",
     *      permission="EDIT"
     * )
     * @param DomainRegistrar $entity
     * @return array
     */
    public function updateAction(DomainRegistrar $entity)
    {
        return $this->update($entity);
    }

    /**
     * @param DomainRegistrar $entity
     * @return array
     */
    protected function update(DomainRegistrar $entity)
    {
        if ($this->get('web_studio.form.handler.domain_registrar')->process($entity)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('oro.business_unit.controller.message.saved') //TODO:change this
            );

            return $this->get('oro_ui.router')->redirect($entity);
        }

        return [
            'entity' => $entity,
            'form' => $this->get('web_studio.form.domain_registrar')->createView(),
        ];
    }
}
