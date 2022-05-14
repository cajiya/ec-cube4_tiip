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
    public function getCartInItemCount( $ProductId )
    {

        $today = new \DateTime('30 days ago');
        $limit = $today->format('Y-m-d 00:00:00');

        $qb = $this->createQueryBuilder('ci');
        $result = $qb->select('count(ci.id)')
            ->innerJoin('ci.ProductClass', 'pc')
            ->innerJoin('ci.Cart', 'c')
            ->innerJoin('pc.Product', 'p')
            ->where('p.id = :product_id')
            ->setParameter("product_id", $ProductId )
            ->andWhere('c.update_date >= :limit')
            ->setParameter("limit", $limit )
            ->getQuery()
            ->getSingleScalarResult();
            
        return $result;

    }
}



