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

use AmaxLab\Oro\WebStudioBundle\Entity\Project;
use AmaxLab\Oro\WebStudioBundle\Form\Handler\ProjectHandler;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 *
 * @Route("project")
 */
class ProjectController extends Controller
{
    /**
     * @Route(
     *      "/{_format}",
     *      name="web_studio_project_index",
     *      requirements={"_format"="html|json"},
     *      defaults={"_format" = "html"}
     * )
     * @AclAncestor("web_studio_project_view")
     * @Template
     * @return array
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Route("/view/{id}", name="web_studio_project_view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="web_studio_domian_view",
     *      type="entity",
     *      class="WebStudioBundle:Project",
     *      permission="VIEW"
     * )
     * @param Project $entity
     * @return array
     */
    public function viewAction(Project $entity)
    {
        return [
            'entity' => $entity,
            'entityClass' => Project::class,
        ];
    }

    /**
     * @Route("/widget/info/{id}", name="web_studio_project_widget_info", requirements={"id"="\d+"})
     * @Template("WebStudioBundle:Project/widget:info.html.twig")
     * @AclAncestor("web_studio_project_view")
     * @param Project $entity
     * @return array
     */
    public function infoAction(Project $entity)
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * @Route("/create", name="web_studio_project_create")
     * @Template("WebStudioBundle:Project:update.html.twig")
     * @Acl(
     *      id="web_studio_project_create",
     *      type="entity",
     *      class="WebStudioBundle:Project",
     *      permission="CREATE"
     * )
     * @return array
     */
    public function createAction()
    {
        return $this->update(new Project());
    }

    /**
     * @Route("/update/{id}", name="web_studio_project_update", requirements={"id"="\d+"}, defaults={"id"=0})
     * @Template
     * @Acl(
     *      id="web_studio_project_update",
     *      type="entity",
     *      class="WebStudioBundle:Project",
     *      permission="EDIT"
     * )
     * @param Project $entity
     * @return array
     */
    public function updateAction(Project $entity)
    {
        return $this->update($entity);
    }

    /**
     * @param Project $entity
     * @return array
     */
    protected function update(Project $entity)
    {
        if ($this->get(ProjectHandler::class)->process($entity)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('oro.business_unit.controller.message.saved') //TODO:change this
            );

            return $this->get('oro_ui.router')->redirect($entity);
        }

        return [
            'entity' => $entity,
            'entityClass' => Project::class,
            'form' => $this->get('web_studio.form.project')->createView(),
        ];
    }
}
