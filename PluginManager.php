<?php

namespace Plugin\TheItemIsPopular;

use Eccube\Plugin\AbstractPluginManager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;


class PluginManager extends AbstractPluginManager
{

    private $original_file_dir = __DIR__ . "/Resource/template/default";

    public function enable( array $meta, ContainerInterface $container )
    {
        $file_system = new Filesystem();

        $file_system->mirror(
            $this->original_file_dir.'/Tiip' ,
            $container->getParameter('eccube_theme_front_dir') . '/Tiip'
        );

    }

    public function disable( array $meta, ContainerInterface $container )
    {
        $file_system = new Filesystem();
        
        $file_system->remove(
            $container->getParameter('eccube_theme_front_dir') . '/Tiip'
        );
    }


}
