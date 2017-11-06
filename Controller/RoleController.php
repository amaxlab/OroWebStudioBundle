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

use AmaxLab\Oro\WebStudioBundle\Entity\Role;
use AmaxLab\Oro\WebStudioBundle\Form\Handler\RoleHandler;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 *
 * @Route("role")
 */
class RoleController extends Controller
{
    /**
     * @Route(
     *      "/{_format}",
     *      name="web_studio_role_index",
     *      requirements={"_format"="html|json"},
     *      defaults={"_format" = "html"}
     * )
     * @AclAncestor("web_studio_role_view")
     * @Template
     * @return array
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Route("/view/{id}", name="web_studio_role_view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="web_studio_domian_view",
     *      type="entity",
     *      class="WebStudioBundle:Role",
     *      permission="VIEW"
     * )
     * @param Role $entity
     * @return array
     */
    public function viewAction(Role $entity)
    {
        return [
            'entity' => $entity,
            'entityClass' => Role::class,
        ];
    }

    /**
     * @Route("/widget/info/{id}", name="web_studio_role_widget_info", requirements={"id"="\d+"})
     * @Template("WebStudioBundle:Role/widget:info.html.twig")
     * @AclAncestor("web_studio_role_view")
     * @param Role $entity
     * @return array
     */
    public function infoAction(Role $entity)
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * @Route("/create", name="web_studio_role_create")
     * @Template("WebStudioBundle:Role:update.html.twig")
     * @Acl(
     *      id="web_studio_role_create",
     *      type="entity",
     *      class="WebStudioBundle:Role",
     *      permission="CREATE"
     * )
     * @return array
     */
    public function createAction()
    {
        return $this->update(new Role());
    }

    /**
     * @Route("/update/{id}", name="web_studio_role_update", requirements={"id"="\d+"}, defaults={"id"=0})
     * @Template
     * @Acl(
     *      id="web_studio_role_update",
     *      type="entity",
     *      class="WebStudioBundle:Role",
     *      permission="EDIT"
     * )
     * @param Role $entity
     * @return array
     */
    public function updateAction(Role $entity)
    {
        return $this->update($entity);
    }

    /**
     * @param Role $entity
     * @return array
     */
    protected function update(Role $entity)
    {
        if ($this->get(RoleHandler::class)->process($entity)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('oro.business_unit.controller.message.saved') //TODO:change this
            );

            return $this->get('oro_ui.router')->redirect($entity);
        }

        return [
            'entity' => $entity,
            'entityClass' => Role::class,
            'form' => $this->get('web_studio.form.role')->createView(),
        ];
    }
}
