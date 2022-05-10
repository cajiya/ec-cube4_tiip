<?php

namespace Plugin\TheItemIsPopular\Repository;

use Eccube\Entity\CartItem;
use Eccube\Repository\AbstractRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query;
use Doctrine\DBAL\Connection;


class TiipCartItemRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CartItem::class);
    }

    /**
     *
     * @return array
     */
    public function findCartInItems( $ProductId )
    {
        $result = [];
        $qb = $this->createQueryBuilder('ci');
        $CartItems = $qb->select('ci')
            ->addSelect('pc')
            ->innerJoin('ci.ProductClass', 'pc')
            ->getQuery()
            ->getResult();
        
        foreach( $CartItems as $CartItem )
        {
            $ProductClass = $CartItem->getProductClass();
            $Product = $ProductClass->getProduct();
            if( $Product->getId() === $ProductId )
            {
                $result[] = $ProductClass;
            }
        }
        
        return $result;

    }
}



