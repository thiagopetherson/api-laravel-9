<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

use App\Models\Product;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $product;   

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {        
        $this->product = $product;         
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('suporte@example.com', 'Mensagem da Loja'),
            subject: 'Notificação do Produto',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {        
        return new Content(
            view: 'Mail.sendMail',
            with: [
                'name' => $this->product->name,
                'value' => $this->product->value,
                'active' => $this->product->active,
                'store' => $this->product->store->name,
                'email' => $this->product->store->email
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
