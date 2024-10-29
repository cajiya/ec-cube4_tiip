<?php

namespace Plugin\TheItemIsPopular43;

use Eccube\Plugin\AbstractPluginManager;
use Eccube\Common\EccubeConfig;
use Psr\Container\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;

class PluginManager extends AbstractPluginManager
{

    private $original_file_dir = __DIR__ . "/Resource/template/default";

    public function enable( array $meta, ContainerInterface $container )
    {
        $file_system = new Filesystem();
        $eccubeConfig = $container->get(EccubeConfig::class);

        $file_system->mirror(
            $this->original_file_dir.'/Tiip' ,
            $eccubeConfig->get('eccube_theme_front_dir') . '/Tiip'
        );

    }

    public function disable( array $meta, ContainerInterface $container )
    {
        $file_system = new Filesystem();
        $eccubeConfig = $container->get(EccubeConfig::class);
        
        $file_system->remove(
            $eccubeConfig->get('eccube_theme_front_dir') . '/Tiip'
        );
    }


}
