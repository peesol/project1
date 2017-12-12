<?php

namespace Closet\Mail;

use App;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Ordering extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $locale;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $locale)
    {
        App::setLocale($locale);
        $this->order = $order;
        $this->locale = $locale;
        $this->subject = __('message.ordering_subject').' '.$this->order->sender.' ['. $this->order->created_at->format('d-m-Y') .']';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->subject(__('message.ordering_subject').' '.$this->order->sender.' ['. $this->order->created_at->format('d-m-Y') .']')
        //         ->view('email.order.ordering');
        return $this->view('email.order.ordering');
    }
}
