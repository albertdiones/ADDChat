<?php
/**
 * Created by PhpStorm.
 * @author albert
 * Date: 1/8/18
 * Time: 12:10 AM
 */

class ctrl_page_index EXTENDS ctrl_tpl_page {


   public function process_mode_default() {

   }

   /**
    * {
    * recipient_address: "MDwwDQYJKoZIhvcNAQEBBQADKwAwKAIhAI3LWsF/GHjK1ui0a0CgS018ZXjhXACr54I+iyUbXdNrAgMBAAE=",
    * encrypted_key: "Ye4cNLi85eiGF87+K1/2cOWcWzOgiWjhDjkzFjY+MTA=",
    * encrypted_data: "U2FsdGVkX18uNPuHw++vAmbwzW3ZdVxM6vLEvzXPE0P1y/6nzk…DitFKtmrDlDm1K3ezPbAoYOj17kUcOgPGf4lX71O+YIxCLf1v"}
   encrypted_data
   :
   "U2FsdGVkX18uNPuHw++vAmbwzW3ZdVxM6vLEvzXPE0P1y/6nzkg46UyuSHDWb6txPMDGGVtQlaYe5+QI0GDGv00vlK1rx5XE3yLHEMAP9ZEWMocnfYBPL9F5dTR5LkKcTpRNQgmHoSFVAaoNaLgw8/HBk2OFZxbcPuAiShnVeQryRKLwNKxDFygbo7K3Z/5NgEJCAo0wjrmF6u/DitFKtmrDlDm1K3ezPbAoYOj17kUcOgPGf4lX71O+YIxCLf1v"
   encrypted_key
   :
   "Ye4cNLi85eiGF87+K1/2cOWcWzOgiWjhDjkzFjY+MTA="
   recipient_address
   :
   "MDwwDQYJKoZIhvcNAQEBBQADKwAwKAIhAI3LWsF/GHjK1ui0a0CgS018ZXjhXACr54I+iyUbXdNrAgMBAAE="
   __proto__
   :
   Object
    */



   public $mode_gpc_claim_messages = array(
      '_REQUEST' => array(
         'address',
         'signature',
      )
   );
   public function process_mode_claim_messages($gpc) {
      add::content_type('text/plain');
      $data['response'] = array( 'status' => 'unknown' );
      $data['response']['gpc'] = $gpc;
      #$data['response']['request'] = $gpc;

      // validate the signature

      add::load_lib('phpseclib');

      $rsa = new phpseclib\Crypt\RSA();

      $rsa->setPublicKey($gpc['address']);
      $decrypted_signature = $rsa->decrypt($gpc['signature']);

      debug::var_dump($gpc['signature'],$decrypted_signature);

      // $offline_messages =

      if ($offline_messages) {
         $data['response']['status'] = 'success';
      }
      else {
         $data['response']['status'] = 'failed';
      }

      $this->assign($data);
   }



   public $mode_gpc_send_message = array(
      '_REQUEST' => array(
         'recipient_address',
         'encrypted_key',
         'encrypted_data'
      )
   );
   public function process_mode_send_message($gpc) {
      add::content_type('text/plain');
      $data['response'] = array();
      #$data['response']['request'] = $gpc;

      $offline_message = offline_message::add_new(
         array(
            'recipient_address' => $gpc['recipient_address'],
            'encrypted_key' => $gpc['encrypted_key'],
            'encrypted_data' => $gpc['encrypted_data'],
         )
      );

      if ($offline_message) {
         $data['response']['status'] = 'success';
      }
      else {
         $data['response']['status'] = 'failed';
      }

      $this->assign($data);
   }

   public function print_response( $data ) {
      echo(json_encode($data['response']));
      add::$handle_shutdown = false;
      return;
   }

}