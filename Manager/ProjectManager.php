<?php

/*
 * This file is part of the WebStudioBundle project.
 *
 * (c) AmaxLab 2017 <http://www.amaxlab.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AmaxLab\Oro\WebStudioBundle\Manager;

use AmaxLab\Oro\WebStudioBundle\Entity\Project;
use Doctrine\ORM\EntityManager;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
class ProjectManager
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Project $project
     * @return Project
     */
    public function create(Project $project)
    {
        $this->manager->persist($project);
        $this->manager->flush();

        return $project;
    }

    /**
     * @param Project $project
     * @return Project
     */
    public function update(Project $project)
    {
        return $project;
    }

    /**
     * @param Project $project
     */
    public function delete(Project $project)
    {
        $this->manager->detach($project);
    }
}
