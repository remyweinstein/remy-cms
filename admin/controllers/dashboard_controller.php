<?php
class dashboard_Controller extends Admin {
	public $all_users = 0;
	public $new_users = 0;
	public $newmails = 0;

    public function __construct() {
        parent::__construct();
		
	if(Engine::$settings['mail_imap_server'] != "") {
            //$mbox = imap_open("{".Engine::$settings['mail_imap_server'].":".Engine::$settings['mail_imap_server_port']."/readonly/novalidate-cert/ssl}INBOX", Engine::$settings['mail_address_mail'], Engine::$settings['mail_address_mail_pass']);

            if($mbox) {
                $newmail_status = imap_status($mbox, "{".Engine::$settings['mail_imap_server']."}", SA_ALL);
		$this->newmails = $newmail_status->unseen;
		imap_close($mbox);
            }
	}
	 
	$this->new_users = dB::countNewUsers();
	$this->all_users = dB::countAllUsers();
        $this->getView(Engine::$curUrlName);
	}
	
}