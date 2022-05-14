<?php

namespace Plugin\TheItemIsPopular\EventListener;

use Eccube\Event\TemplateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TiipEventListener implements EventSubscriberInterface
{

    public function __construct(){}

    public function TiipEventListenerFunction(TemplateEvent $event)
    {
      // 拡張されるファイルに充てたSnipetsの退避
      if( $event->hasParameter('plugin_snippets') )
      {
        $snipets = $event->getParameter('plugin_snippets');
        if( $snipets )
        {
          foreach( $snipets as $snippet => $include )
          {
            $event->addSnippet( $snippet , $include);
          }
        }
      }
      // 拡張されるファイルに充てたSnipetsの退避
      if( $event->hasParameter('plugin_assets') )
      {
        $assets = $event->getParameter('plugin_assets');
        if( $assets )
        {
          foreach( $assets as $asset => $include )
          {
            $event->addAsset( $asset , $include);
          }
        }
      }
      $event->addAsset( 'Tiip/asset.twig' );
      $event->addSnippet( 'Tiip/snipet.twig' );
    }

    public static function getSubscribedEvents()
    {
        return [
          'Product/detail.twig' => ['TiipEventListenerFunction'],
        ];
    }

}
