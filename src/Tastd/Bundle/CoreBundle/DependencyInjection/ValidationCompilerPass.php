<?php
namespace Tastd\Bundle\CoreBundle\DependencyInjection;

use Symfony\Component\Finder\Finder;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Class ValidationCompilerPass
 *
 * @package Tastd\Bundle\CoreBundle\DependencyInjection
 */
class ValidationCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $validatorBuilder = $container->getDefinition('validator.builder');
        $validatorFiles = array();
        $finder = new Finder();

        foreach ($finder->files()->in(__DIR__ . '/../Resources/config/validation') as $file) {
            $validatorFiles[] = $file->getRealPath();
        }

        $validatorBuilder->addMethodCall('addXmlMappings', array($validatorFiles));
    }
}