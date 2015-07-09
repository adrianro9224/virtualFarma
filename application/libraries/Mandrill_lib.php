<?php
class Mandrill_lib {
	/*
	protected  $config = array(
			'apikey' => '9c163a9dedc7c0953f55d177f86f9518-us11', // Insert your api key
			'secure' => FALSE   // Optional (defaults to FALSE)
	);*/
	
	public function send_register_email( $account ){
		
		$list_id = 'e7d9615355';
		$language = 'es_ES';
		

		
		$merge_vars = array('FNAME' => $account->first_name,
							'LNAME' => $account->last_name,
							'MC_LANGUAGE' => $language 
		);

        $campaign_id = "ea588c4f49";

        try {

            $CI =& get_instance();

            $CI->load->library('mandrill');

/*
            $result = $CI->$mandrill->users->ping();
            print_r($result);
*/


            // template name ->string, $message->array

            $template_name = 'finalRegister';
            $template_content = array(
                array(
                    'name' => 'example name',
                    'content' => 'example content'
                )
            );
            $message = array(
                //'html' => '<p>Example HTML content</p>',
                //'text' => 'Example text content',
                'subject' => 'Gracias por registrarte',
                'from_email' => 'registro@virtualfarma.com.co',
                'from_name' => 'Equipo Virtualfarma.com.co',
                'to' => array(
                    array(
                        'email' => $account->email,
                        'name' => $account->first_name,
                        'type' => 'to'
                    )
                ),
                //'headers' => array('Reply-To' => 'registro@virtualfarma.com.co'),
                'important' => false,
                //'track_opens' => null,
               //track_clicks' => null,
                //'auto_text' => null,
                //'auto_html' => null,
                //'inline_css' => null,
                //'url_strip_qs' => null,
                //'preserve_recipients' => null,
                'view_content_link' => null,
                'bcc_address' => 'adrian.romero9224@gmail.com',
                //'tracking_domain' => null,
                //'signing_domain' => null,
               // 'return_path_domain' => null,
                //'merge' => true,
                'merge_language' => 'mailchimp',
                'global_merge_vars' => array(
                    array(
                        'name' => 'merge1',
                        'content' => 'merge1 content'
                    )
                ),
                'merge_vars' => array(
                    array(
                        'rcpt' => $account->email,
                        'vars' => array(
                            array(
                                'name' => 'FNAME',
                                'content' => $account->first_name,
                            ),
                            array(
                                'name' => 'COMPANY',
                                'content' => "virtuafarma.com.co"
                            )
                        )
                    )
                ),
                'tags' => array('register'),
               // 'subaccount' => 'customer-123',
              //  'google_analytics_domains' => array('example.com'),
               // 'google_analytics_campaign' => 'message.from_email@example.com',
                //'metadata' => array('website' => 'www.virtualfarma.com.co'),
                //'recipient_metadata' => array(
                  //  array(
                    //    'rcpt' => $account->email,
                      //  'values' => array('user_id' => 123456)
                    //)
                /*),
                'attachments' => array(
                    array(
                        'type' => 'text/plain',
                        'name' => 'myfile.txt',
                        'content' => 'ZXhhbXBsZSBmaWxl'
                    )
                ),
                'images' => array(
                    array(
                        'type' => 'image/png',
                        'name' => 'IMAGECID',
                        'content' => 'ZXhhbXBsZSBmaWxl'
                    )
                )*/




            );
            $async = false;
            $ip_pool = 'Register';
           // $send_at = 'example send_at';
            $result = $CI->mandrill->messages->sendTemplate($template_name, $template_content, $message, $async, $ip_pool);
         //   print_r($result);



        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }

		return FALSE;
		
	}


    public function send_pqrs( $account ){


       // die(var_dump($account));

        try {

            $CI =& get_instance();

            $CI->load->library('mandrill');

            $template_name = 'NewPqrs';
            $template_content = array(
                array(
                    'name' => 'example name',
                    'content' => 'example content'
                )
            );
            $message = array(
                //'html' => '<p>Example HTML content</p>',
                //'text' => 'Example text content',
                'subject' => 'Nuevo pqrs',
                'from_email' => 'contacto@virtualfarma.com.co',
                'from_name' => 'Equipo Virtualfarma.com.co',
                'to' => array(
                    array(
                        'email' => 'contacto@virtualfarma.com.co',//replace it for contacto@virtualfarma.com.co
                        'name' => "Contact admin",
                        'type' => 'to'
                    )
                ),
              //  'headers' => array('Reply-To' => 'adrian.romero9224@gmail.com'),
                'important' => false,
                //'track_opens' => null,
                //track_clicks' => null,
                //'auto_text' => null,
                //'auto_html' => null,
                //'inline_css' => null,
                //'url_strip_qs' => null,
                //'preserve_recipients' => null,
                'view_content_link' => null,
                'bcc_address' => 'adrian.romero9224@gmail.com',
                //'tracking_domain' => null,
                //'signing_domain' => null,
                // 'return_path_domain' => null,
                //'merge' => true,
                'merge_language' => 'mailchimp',
                'global_merge_vars' => array(
                    array(
                        'name' => 'merge1',
                        'content' => 'merge1 content'
                    )
                ),
                'merge_vars' => array(
                    array(
                        'rcpt' => 'contacto@virtualfarma.com.co',
                        'vars' => array(
                            array(
                                'name' => 'NAME',
                                'content' => $account['name'],
                            ),
                            array(
                                'name' => 'EMAIL',
                                'content' => $account['email']
                            ),
                            array(
                                'name' => 'COMMENT',
                                'content' => $account['pqrs']
                            ),
                            array(
                                'name' => 'DATE',
                                'content' => $account['date_of_pqrs_request']
                            )

                        )
                    )
                ),
                'tags' => array('pqrs_request'),
                // 'subaccount' => 'customer-123',
                //  'google_analytics_domains' => array('example.com'),
                // 'google_analytics_campaign' => 'message.from_email@example.com',
                //'metadata' => array('website' => 'www.virtualfarma.com.co'),
                //'recipient_metadata' => array(
                //  array(
                //    'rcpt' => $account->email,
                //  'values' => array('user_id' => 123456)
                //)
                /*),
                'attachments' => array(
                    array(
                        'type' => 'text/plain',
                        'name' => 'myfile.txt',
                        'content' => 'ZXhhbXBsZSBmaWxl'
                    )
                ),
                'images' => array(
                    array(
                        'type' => 'image/png',
                        'name' => 'IMAGECID',
                        'content' => 'ZXhhbXBsZSBmaWxl'
                    )
                )*/




            );
            $async = false;
            $ip_pool = 'pqrs_request';
            // $send_at = 'example send_at';
            $result = $CI->mandrill->messages->sendTemplate($template_name, $template_content, $message, $async, $ip_pool);
            //   print_r($result);



        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }

        return FALSE;

    }



} 