<?php

namespace Plugin\TheItemIsPopular\Repository;

use Eccube\Entity\CustomerFavoriteProduct;
use Eccube\Repository\AbstractRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query;
use Doctrine\DBAL\Connection;


class TiipCustomerFavoriteProductRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomerFavoriteProduct::class);
    }

    /**
     *
     * @return array
     */
    public function getFavoriteItemCount( $ProductId )
    {
        $result = [];
        $qb = $this->createQueryBuilder('fp');
        $result = $qb->select('count(fp.id)')
            ->innerJoin('fp.Product', 'p')
            ->where('p.id = :product_id')
            ->setParameter("product_id", $ProductId )
            ->getQuery()
            ->getSingleScalarResult();

        return $result;

    }
}



