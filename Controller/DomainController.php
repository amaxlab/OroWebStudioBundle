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

use AmaxLab\Oro\WebStudioBundle\Entity\Domain;
use AmaxLab\Oro\WebStudioBundle\Form\Handler\DomainHandler;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 *
 * @Route("domain")
 */
class DomainController extends Controller
{
    /**
     * @Route(
     *      "/{_format}",
     *      name="web_studio_domain_index",
     *      requirements={"_format"="html|json"},
     *      defaults={"_format" = "html"}
     * )
     * @AclAncestor("web_studio_domain_view")
     * @Template
     * @return array
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Route("/view/{id}", name="web_studio_domain_view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="web_studio_domian_view",
     *      type="entity",
     *      class="WebStudioBundle:Domain",
     *      permission="VIEW"
     * )
     * @param Domain $entity
     * @return array
     */
    public function viewAction(Domain $entity)
    {
        return [
            'entity' => $entity,
            'entityClass' => Domain::class,
        ];
    }

    /**
     * @Route("/widget/info/{id}", name="web_studio_domain_widget_info", requirements={"id"="\d+"})
     * @Template("WebStudioBundle:Domain/widget:info.html.twig")
     * @AclAncestor("web_studio_domain_view")
     * @param Domain $entity
     * @return array
     */
    public function infoAction(Domain $entity)
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * @Route("/create", name="web_studio_domain_create")
     * @Template("WebStudioBundle:Domain:update.html.twig")
     * @Acl(
     *      id="web_studio_domain_create",
     *      type="entity",
     *      class="WebStudioBundle:Domain",
     *      permission="CREATE"
     * )
     * @return array
     */
    public function createAction()
    {
        return $this->update(new Domain());
    }

    /**
     * @Route("/update/{id}", name="web_studio_domain_update", requirements={"id"="\d+"}, defaults={"id"=0})
     * @Template
     * @Acl(
     *      id="web_studio_domain_update",
     *      type="entity",
     *      class="WebStudioBundle:Domain",
     *      permission="EDIT"
     * )
     * @param Domain $entity
     * @return array
     */
    public function updateAction(Domain $entity)
    {
        return $this->update($entity);
    }

    /**
     * @param Domain $entity
     * @return array
     */
    protected function update(Domain $entity)
    {
        if ($this->get(DomainHandler::class)->process($entity)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('oro.business_unit.controller.message.saved') //TODO:change this
            );

            return $this->get('oro_ui.router')->redirect($entity);
        }

        return [
            'entity' => $entity,
            'entityClass' => Domain::class,
            'form' => $this->get('web_studio.form.domain')->createView(),
        ];
    }
}
