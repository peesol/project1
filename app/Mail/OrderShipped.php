<?php

namespace Closet\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $data;
    public $locale;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $data, $locale)
    {
      $this->order = $order;
      $this->data = $data;
      $this->locale = $locale;
      $this->subject = __('message.shipped_subject', ['name' => $this->order->reciever]).' ['. $this->order->updated_at->format('d-m-Y') .']';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      app()->setLocale($this->locale);
      return $this->markdown('email.order.shipped');
    }
}
