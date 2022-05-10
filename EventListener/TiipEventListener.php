<?php

namespace Plugin\TheItemIsPopular\EventListener;

use Eccube\Request\Context;
use Eccube\Event\TemplateEvent;

use Plugin\TheItemIsPopular\Repository\TiipCartItemRepository;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class TiipEventListener implements EventSubscriberInterface
{
    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var Context
     */
    protected $requestContext;

    protected $tiipCartItemRepository;

    public function __construct(
      RequestStack $requestStack,
      Context $requestContext,
      TiipCartItemRepository $tiipCartItemRepository
    )
    {
        $this->requestStack = $requestStack;
        $this->requestContext = $requestContext;
        $this->tiipCartItemRepository = $tiipCartItemRepository;
    }

    public function TiipEventListenerFunction(TemplateEvent $event)
    {
        $ProductId = $event->getParameter('Product')->getId();
        $findCartInItems = $this->tiipCartItemRepository->findCartInItems($ProductId);

        log_info('[TTIP]$findCartInItems',[$findCartInItems]);
        if( empty( $findCartInItems ) ) return false;
        
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
      
      $count = count($findCartInItems);
      $output = <<< EOM
      <div class="js-tiip-pop" style="display:none;position: fixed;bottom: 15px;left: 15px;background: #eda106d1;color: white;padding: 15px;border-radius: 5px;">
      この商品を{$count}人の人がカートに追加しています
      </div>
      <script>
      $(function(){
        $('.js-tiip-pop').fadeIn().delay(5000).fadeOut();
      });
      </script>
EOM;
      $event->addSnippet( $output , false);

    }

    public static function getSubscribedEvents()
    {

        return [
          'Product/detail.twig' => ['TiipEventListenerFunction'],
        ];
    }

}
