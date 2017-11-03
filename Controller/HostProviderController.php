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

use AmaxLab\Oro\WebStudioBundle\Entity\HostProvider;
use AmaxLab\Oro\WebStudioBundle\Form\Handler\HostProviderHandler;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 *
 * @Route("host_provider")
 */
class HostProviderController extends Controller
{
    /**
     * @Route(
     *      "/{_format}",
     *      name="web_studio_host_provider_index",
     *      requirements={"_format"="html|json"},
     *      defaults={"_format" = "html"}
     * )
     * @AclAncestor("web_studio_host_provider_view")
     * @Template
     * @return array
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Route("/view/{id}", name="web_studio_host_provider_view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="web_studio_domian_view",
     *      type="entity",
     *      class="WebStudioBundle:HostProvider",
     *      permission="VIEW"
     * )
     * @param HostProvider $entity
     * @return array
     */
    public function viewAction(HostProvider $entity)
    {
        return [
            'entity' => $entity,
            'entityClass' => HostProvider::class,
        ];
    }

    /**
     * @Route("/widget/info/{id}", name="web_studio_host_provider_widget_info", requirements={"id"="\d+"})
     * @Template("WebStudioBundle:HostProvider/widget:info.html.twig")
     * @AclAncestor("web_studio_host_provider_view")
     * @param HostProvider $entity
     * @return array
     */
    public function infoAction(HostProvider $entity)
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * @Route("/create", name="web_studio_host_provider_create")
     * @Template("WebStudioBundle:HostProvider:update.html.twig")
     * @Acl(
     *      id="web_studio_host_provider_create",
     *      type="entity",
     *      class="WebStudioBundle:HostProvider",
     *      permission="CREATE"
     * )
     * @return array
     */
    public function createAction()
    {
        return $this->update(new HostProvider());
    }

    /**
     * @Route("/update/{id}", name="web_studio_host_provider_update", requirements={"id"="\d+"}, defaults={"id"=0})
     * @Template
     * @Acl(
     *      id="web_studio_host_provider_update",
     *      type="entity",
     *      class="WebStudioBundle:HostProvider",
     *      permission="EDIT"
     * )
     * @param HostProvider $entity
     * @return array
     */
    public function updateAction(HostProvider $entity)
    {
        return $this->update($entity);
    }

    /**
     * @param HostProvider $entity
     * @return array
     */
    protected function update(HostProvider $entity)
    {
        if ($this->get(HostProviderHandler::class)->process($entity)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('oro.business_unit.controller.message.saved') //TODO:change this
            );

            return $this->get('oro_ui.router')->redirect($entity);
        }

        return [
            'entity' => $entity,
            'entityClass' => HostProvider::class,
            'form' => $this->get('web_studio.form.host_provider')->createView(),
        ];
    }
}
