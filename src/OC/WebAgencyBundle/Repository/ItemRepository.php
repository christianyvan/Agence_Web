<?php

namespace OC\WebAgencyBundle\Repository;

/**
 * ItemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ItemRepository extends \Doctrine\ORM\EntityRepository
{
   public function itemInfos ($items)
   {
       foreach ( $items as $item)
       {
           $itemsTitles[] = $item->getTitle();
           $itemsSubtitles[] = $item->getSubtitle();
           $itemsContents[] = $item->getContent();
           $itemsImages[] = $item->getImageName();
       }


       return array($itemsTitles, $itemsSubtitles, $itemsContents, $itemsImages);
   }
}