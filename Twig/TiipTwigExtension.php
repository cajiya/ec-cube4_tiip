<?php

namespace Plugin\TheItemIsPopular\Twig;

use Plugin\TheItemIsPopular\Repository\TiipCartItemRepository;
use Plugin\TheItemIsPopular\Repository\TiipCustomerFavoriteProductRepository;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TiipTwigExtension extends AbstractExtension
{

    protected $tiipCartItemRepository;

    protected $tiipCustomerFavoriteProductRepository;

    public function __construct(
        TiipCartItemRepository $tiipCartItemRepository,
        TiipCustomerFavoriteProductRepository $tiipCustomerFavoriteProductRepository
    )
    {
        $this->tiipCartItemRepository = $tiipCartItemRepository;
        $this->tiipCustomerFavoriteProductRepository = $tiipCustomerFavoriteProductRepository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getTiip', function ($ProductId) {
                $cartInCount = $this->tiipCartItemRepository->getCartInItemCount($ProductId);
                $favoriteCount = $this->tiipCustomerFavoriteProductRepository->getFavoriteItemCount($ProductId);
                return [
                    'CartIn' => $cartInCount,
                    'Favorite' => $favoriteCount
                ];
            }, ['pre_escape' => 'html', 'is_safe' => ['html']]),
        ];
    }
}
