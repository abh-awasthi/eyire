<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Notify library to send Mails and SMSs
 *
 * @author anujaggarwal
 */
class Notify {

    var $My_CI;

    function __Construct() {
        $this->My_CI = & get_instance();

        $this->My_CI->load->helper(array('form', 'url'));
        $this->My_CI->load->library('email');
        $this->My_CI->load->model('Master_model');
    }

    /**
     *  @desc : This method is used to send mail
     *  @param : From, To, CC, BCC, Subject, Message, Attachment
     *  @return : if mail send return true else false
     */
    function sendEmail($from, $to, $cc, $bcc, $subject, $message, $attachment, $template_tag, $attachment2 = "", $booking_id = "") {
        switch (ENVIRONMENT) {
            case 'production':
                //Clear previous email
                if (!empty($to) && !empty($from)) {
                    $this->My_CI->email->clear(TRUE);

                    //Attach file with mail
                    if (!empty($attachment)) {
                        $this->My_CI->email->attach($attachment, 'attachment');
                    }

                    if (!empty($attachment2)) {
                        $this->My_CI->email->attach($attachment2, 'attachment');
                    }


                    $this->My_CI->email->to($to);
                    $this->My_CI->email->bcc($bcc);
                    $this->My_CI->email->cc($cc);

                    $this->My_CI->email->subject($subject);
                    $this->My_CI->email->message($message);
                    if ($this->My_CI->email->send()) {
                        $this->add_email_send_details($from, $to, $cc, $bcc, $subject, $message, $attachment, $template_tag, $booking_id);
                        return true;
                    } else {
                        log_message('info', __FUNCTION__ . ' Email Failed:  From =>' . $from . " To =>" . $to . " CC =>" . $cc . " Subject =>" . $subject);
                        return false;
                    }
                } else {
                    log_message('info', __FUNCTION__ . ' Email Failed:  From =>' . $from . " To =>" . $to . " CC =>" . $cc . " Subject =>" . $subject);
                    return false;
                }

                break;
        }
    }

    function sendTransactionalSms($phone_number, $body, $tag) {
        $post_data = array();
        $url = "http://sms.hspsms.com/sendSMS?username=mlpsed&message=" . $body . "&sendername=" . SMS_SENDER_NAME . "&smstype=TRANS&numbers=" . $phone_number . "&apikey=" . SMS_API_KEY;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));
        $data = $curl_response = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    function send_sms($sms) {
        $template = $this->My_CI->Master_model->get_matser('sms_template', '*', array('tag' => $sms['tag']));
        if (!empty($template)) {
            $smsBody = vsprintf($template[0]['template'], $sms['smsData']);
            if ($smsBody) {
                $data = $this->sendTransactionalSms($sms['phone_no'], $smsBody, $sms['tag']);
            } else {
                
            }
        }
    }

}
