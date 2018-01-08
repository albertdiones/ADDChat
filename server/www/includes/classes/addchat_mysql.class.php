<?php

CLASS addchat_mysql EXTENDS add_adodb_mysql {

   public function Connect() {
      $this->adodb->Connect( add::config()->mysql_host, add::config()->mysql_username,add::config()->mysql_password, add::config()->mysql_db_name );
      return $this;
   }

   /**
    * varname()
    * @since Reload 0.0
    */
   public static function varname() {
      return self::VARNAME;
   }
}