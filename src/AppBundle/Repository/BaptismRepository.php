<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Baptism;

use datetime;
/**
 * BaptemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BaptismRepository extends \Doctrine\ORM\EntityRepository
{

    public function findSearch($city,$restaurant, $baptismDate, $service) {

        $service = $this->_em->getRepository('service')->find($service);

        $query = $this->createQueryBuilder('b')
                ->innerJoin('b.restaurant', 'r')
                ->innerJoin('b.service', 's')
                ->where('b.places >= 0');

        if (! is_null($restaurant)) {
            $query = $query->andWhere('r.name = :restaurant')
                ->setParameter('restaurant', $restaurant);
        } elseif (! is_null($city)) {
            $cityInformation = $this->_em->getRepository('city')->find($city);
            $query = $query->andWhere('r.city = :city')
                    ->setParameter('city',$cityInformation->getName())
                    ->andWhere('r.postalCode = :postalCode')
                    ->setParameter('postalCode',$cityInformation->getPostalCode());
        }

        if (! is_null($baptismDate)) {
            $query = $query->andWhere('b.date = :date')
                    ->setParameter('date', $baptismDate);
        }
    }

    /**
     * function findAllFree
     * Object: generate the query for the search for free baptism date
     * @param $city
     * @param $restaurant
     * @param $nb
     * @param $baptismDate
     * @param $service
     */
    public function findAllFree($city, $restaurant, $nb, $baptismDate, $service){

        $week = array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');
        $select = " SELECT b.id, b.service_id, b.status, b.date, b.places , b.restaurant_id ";
        $select1 = " SELECT b.restaurant_id ";
        $from = " FROM baptism b ";
        if (is_null($nb)) {
            $nb = 0;
        }
        $where = " WHERE (places -$nb)>= 0 ";

        $baptismCityInfo = false;
        if (! is_null($city)) {
            $from .= " INNER JOIN restaurant r on r.id= b.restaurant_id ";
            $from .= " INNER JOIN city c on c.name= r.city or c.postal_code = r.postal_code ";
            $where .= " AND r.city = :city " ;
            $baptismCityInfo = true;
        }

        $baptismRestaurantInfo = false;
        if (! is_null($restaurant)) {
            if  (!$baptismCityInfo) {
                $from .= " INNER JOIN restaurant r on r.id= b.restaurant_id ";
            }
            $where .= " AND r.name = :restaurant ";
            $baptismRestaurantInfo = true;
        }

        $now = new DateTime();
        $now->setTime(0, 0, 0);
        $baptismDateInfo = false;

        if (! is_null($baptismDate)) {
            $startDate = DateTime::createFromFormat('Y-m-d', $baptismDate);
            if ($startDate instanceof DateTime) {
                $startDate->setTime(0, 0, 0);
            }
            if (!$startDate || $startDate < $now) {
                $startDate = $now;
            }
            $weekDay = $startDate->format ('w');
            $where .= " AND date = :baptismdate ";
            // we must use parameters to set this correctly this data in the query
            $baptismDateInfo = true;
        }

        $baptismServiceInfo = false;
        if (!is_null($service)) {
            $where .= " AND service_id = $service";
            $baptismServiceInfo = true;
        }

        $select2 ="";
        $from2 = "";
        $where2="";
        if ($baptismDateInfo && $baptismServiceInfo) {
            $select2 = " SELECT -1 , so.service_id, 'Pending', :baptismdate, ifnull(soe.status,$week[$weekDay]) ";
            $select2 .= " as places, so.restaurant_id ";
            $from2 = " FROM service_opening so ";
            $from2 .= " LEFT JOIN service_opening_exception soe on (soe.service_id = so.service_id ";
            $from2 .= " and soe.restaurant_id = so.restaurant_id ";
            $from2 .= " and soe.date = :baptismdate) ";
            $where2 = " WHERE so.service_id = $service ";
            $where2 .= " AND $week[$weekDay] > $nb ";
            $where2 .= " AND so.restaurant_id not in ( ";
            $where2 .= $select1 . $from . $where . ")";

            if ($baptismCityInfo) {
                $from2 .= " INNER JOIN restaurant r on r.id= so.restaurant_id ";
                $from2 .= " INNER JOIN city c on c.name= r.city or c.postal_code = r.postal_code ";
                $where2 .= " AND r.city = :city " ;
            }

            if ($baptismRestaurantInfo) {
                if  (!$baptismCityInfo) {
                    $from2 .= " INNER JOIN restaurant r on r.id= so.restaurant_id ";
                }
                $where2 .= " AND r.name = :restaurant ";
            }
            return ($select . $from . $where . " union " . $select2 . $from2 . $where2 . ";");

        }

        return ($select . $from . $where . ";");

    }
}
