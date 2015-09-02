<?php
/*
 *  Created on Dec 6, 2012
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Magazento_Easybestsellers_Block_Review extends Mage_Catalog_Block_Product_Abstract {
    
    function getReviewsData(){
        $pending  = 2;  
        $declined = 3;  
        $reviews = $this->getReviews();
        $count = 0;  
        foreach ($reviews as $review){  
          if($review['status_id'] != $pending || $review['status_id'] != $declined){
              
            $_product = Mage::getModel('catalog/product')->load($review->getData('entity_pk_value'));
            
            $vals = $this->getRatingValues($review);
            $allReviews[$count]['review_url'] = $review->getReviewUrl($review->getId());
            $allReviews[$count]['product_id'] =  $review->getData('entity_pk_value');
            $allReviews[$count]['product'] =  $_product;
            
            $num = $count +1;
            $allReviews[$count]['title'] = $num.'. '.$review['title'];
            $allReviews[$count]['detail'] = $review['detail'];  
            $allReviews[$count]['nickname'] = $review['nickname'];  
            $allReviews[$count]['ratings'] = $vals;  
            $count++;      
          }  
        }  

        return $allReviews;
    }
    function getRatingValues(Mage_Review_Model_Review $review){
      $avg = 0;
      if( count($review->getRatingVotes()) ) {
        $ratings = array();
        $c = 0;
        foreach( $review->getRatingVotes() as $rating ) {
          $type = $rating->getRatingCode();
          $pcnt = $rating->getPercent();
        if($type){
          $val[$c][$type] = $pcnt;

        }
        $ratings[] = $rating->getPercent();
        }
        $c++;
        $avg = array_sum($ratings)/count($ratings);
      }
      return $val;
    }
    
    function getReviews() {
        $reviews = Mage::getModel('review/review')->getResourceCollection();
        $reviews->addStoreFilter( Mage::app()->getStore()->getId() )
                ->addStatusFilter( Mage_Review_Model_Review::STATUS_APPROVED )
                ->setDateOrder()
                ->addRateVotes()
                ->load();
      
        //products
        $catId = $this->getData('item_bestsellercategory');
        
        $return = array();
        if ($this->getData('item_count')) {
            if ( $catId > 0 ){
                $category = $this -> getModel() -> getCategory($catId);
                $collection = Mage::getModel('catalog/product') 
                                    -> getCollection() 
                                    -> addStoreFilter() 
                                    -> setOrder($order, 'ASC') 
                                    -> addAttributeToSelect('entity_id') 
                                    -> addCategoryFilter($category)
                                    -> addAttributeToFilter('status', array('eq' => '1'));        

                //category filter
                $product_array = array();
                foreach ($collection as $_product) {
                    $product_array[] = $_product -> getId();
                }
                $i = 0;
                foreach ($reviews as $review) {
                    if (in_array($review->getData('entity_pk_value'), $product_array)) {
                        $return[] = $review;
                        $i++; 
                    } 
                    if ($i == $this->getData('item_count')) break;
                }  

            } else {
                $i=0;
                foreach ( $reviews as $review) {
                    $return[] = $review;
                    $i++; 
                    if ($i == $this->getData('item_count')) break;

                }
            }
        }
        
        // MANUAL FILTERS
        $model = Mage::getModel('easybestsellers/item')->load($this->getData('item_id'));
        if ($model->getData('assignedreview_id')) {
            $returnManual = array();
            foreach ($reviews as $review) {
                if (in_array($review->getData('review_id'), $model->getData('assignedreview_id'))) {
                    $returnManual[] = $review;
                    $i++; 
                } 
            }     
            $return = array_merge($return, $returnManual);
        }           
        
        return $return;
    }


    
    public function getModel() {
        return Mage::getModel('easybestsellers/Data');
    }

}

