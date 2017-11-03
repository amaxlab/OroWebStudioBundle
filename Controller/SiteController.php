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

use AmaxLab\Oro\WebStudioBundle\Entity\Site;
use AmaxLab\Oro\WebStudioBundle\Form\Handler\SiteHandler;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 *
 * @Route("site")
 */
class SiteController extends Controller
{
    /**
     * @Route(
     *      "/{_format}",
     *      name="web_studio_site_index",
     *      requirements={"_format"="html|json"},
     *      defaults={"_format" = "html"}
     * )
     * @AclAncestor("web_studio_site_view")
     * @Template
     * @return array
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Route("/view/{id}", name="web_studio_site_view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="web_studio_domian_view",
     *      type="entity",
     *      class="WebStudioBundle:Site",
     *      permission="VIEW"
     * )
     * @param Site $entity
     * @return array
     */
    public function viewAction(Site $entity)
    {
        return [
            'entity' => $entity,
            'entityClass' => Site::class,
        ];
    }

    /**
     * @Route("/widget/info/{id}", name="web_studio_site_widget_info", requirements={"id"="\d+"})
     * @Template("WebStudioBundle:Site/widget:info.html.twig")
     * @AclAncestor("web_studio_site_view")
     * @param Site $entity
     * @return array
     */
    public function infoAction(Site $entity)
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * @Route("/create", name="web_studio_site_create")
     * @Template("WebStudioBundle:Site:update.html.twig")
     * @Acl(
     *      id="web_studio_site_create",
     *      type="entity",
     *      class="WebStudioBundle:Site",
     *      permission="CREATE"
     * )
     * @return array
     */
    public function createAction()
    {
        return $this->update(new Site());
    }

    /**
     * @Route("/update/{id}", name="web_studio_site_update", requirements={"id"="\d+"}, defaults={"id"=0})
     * @Template
     * @Acl(
     *      id="web_studio_site_update",
     *      type="entity",
     *      class="WebStudioBundle:Site",
     *      permission="EDIT"
     * )
     * @param Site $entity
     * @return array
     */
    public function updateAction(Site $entity)
    {
        return $this->update($entity);
    }

    /**
     * @param Site $entity
     * @return array
     */
    protected function update(Site $entity)
    {
        if ($this->get(SiteHandler::class)->process($entity)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('oro.business_unit.controller.message.saved') //TODO:change this
            );

            return $this->get('oro_ui.router')->redirect($entity);
        }

        return [
            'entity' => $entity,
            'entityClass' => Site::class,
            'form' => $this->get('web_studio.form.site')->createView(),
        ];
    }
}
