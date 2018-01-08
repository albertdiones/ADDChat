<?php

/**
 * Created by PhpStorm.
 * @author albert
 * Date: 1/8/18
 * Time: 1:03 AM
 */
CLASS offline_message EXTENDS model_rwd {

   const TABLE = 'offline_messages';

/*   public function claim_messages($address,$signature) {

      if ($address) {

      }


      $messages = static::get_where_order_page(array('recipient_address' =>$address));

   }*/

   public static function db() {
      return addchat_mysql::singleton();
   }
}