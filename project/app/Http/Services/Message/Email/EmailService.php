<?php

namespace App\Http\Services\Message\Email;

use App\Http\Interfaces\MessageInterface;
use Illuminate\Support\Facades\Mail;

class EmailService implements MessageInterface
{

    private $subject;
    private $details;
    private $from = [
        ['address'=>null , 'name'=>null]
    ];
    private $to;


    public function fire()
    {
       Mail::to($this->to)->send(new MailViewProvider($this->details,$this->subject,$this->from));
    }

    public function getSubject(){
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function setDetails($detail)
    {
         $this->details = $detail;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($address , $name)
    {
        $this->from = [
            [
                'address' => $address,
                'name' => $name,
            ]
        ];
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }


}
