<?php


namespace AppBundle\Repository;


/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends \Doctrine\ORM\EntityRepository
{
    public function name()
    {
        $q = $this->getEntityManager()->createQuery("SELECT p from AppBundle:Comments p JOIN p.user b  ");
        return $query = $q->getResult();
    }

}