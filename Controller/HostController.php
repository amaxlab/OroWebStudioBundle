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

use AmaxLab\Oro\WebStudioBundle\Entity\Host;
use AmaxLab\Oro\WebStudioBundle\Form\Handler\HostHandler;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 *
 * @Route("host")
 */
class HostController extends Controller
{
    /**
     * @Route(
     *      "/{_format}",
     *      name="web_studio_host_index",
     *      requirements={"_format"="html|json"},
     *      defaults={"_format" = "html"}
     * )
     * @AclAncestor("web_studio_host_view")
     * @Template
     * @return array
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Route("/view/{id}", name="web_studio_host_view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="web_studio_domian_view",
     *      type="entity",
     *      class="WebStudioBundle:Host",
     *      permission="VIEW"
     * )
     * @param Host $entity
     * @return array
     */
    public function viewAction(Host $entity)
    {
        return [
            'entity' => $entity,
            'entityClass' => Host::class,
        ];
    }

    /**
     * @Route("/widget/info/{id}", name="web_studio_host_widget_info", requirements={"id"="\d+"})
     * @Template("WebStudioBundle:Host/widget:info.html.twig")
     * @AclAncestor("web_studio_host_view")
     * @param Host $entity
     * @return array
     */
    public function infoAction(Host $entity)
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * @Route("/create", name="web_studio_host_create")
     * @Template("WebStudioBundle:Host:update.html.twig")
     * @Acl(
     *      id="web_studio_host_create",
     *      type="entity",
     *      class="WebStudioBundle:Host",
     *      permission="CREATE"
     * )
     * @return array
     */
    public function createAction()
    {
        return $this->update(new Host());
    }

    /**
     * @Route("/update/{id}", name="web_studio_host_update", requirements={"id"="\d+"}, defaults={"id"=0})
     * @Template
     * @Acl(
     *      id="web_studio_host_update",
     *      type="entity",
     *      class="WebStudioBundle:Host",
     *      permission="EDIT"
     * )
     * @param Host $entity
     * @return array
     */
    public function updateAction(Host $entity)
    {
        return $this->update($entity);
    }

    /**
     * @param Host $entity
     * @return array
     */
    protected function update(Host $entity)
    {
        if ($this->get(HostHandler::class)->process($entity)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('oro.business_unit.controller.message.saved') //TODO:change this
            );

            return $this->get('oro_ui.router')->redirect($entity);
        }

        return [
            'entity' => $entity,
            'entityClass' => Host::class,
            'form' => $this->get('web_studio.form.host')->createView(),
        ];
    }
}
