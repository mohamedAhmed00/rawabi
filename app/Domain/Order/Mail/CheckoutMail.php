<?php
namespace App\Domain\Order\Mail;

use App\Domain\Order\Repositories\Abstraction\IRepositoryCheckout;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckoutMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    private $request;

    /**
     * @var
     */
    private $products;

    /**
     * @var
     */
    private $settings;

    /**
     * CheckoutMail constructor.
     * @param $request
     * @param $products
     * @param $settings
     * @author Mohamed Ahmed
     */
    public function __construct($request,$products,$settings)
    {
        $this->request = $request;
        $this->products = $products;
        $this->settings = $settings;
    }

    /**
     * Build the message.
     * @author Mohamed Ahmed
     * @return $this
     */
    public function build()
    {
        $checkout = app(IRepositoryCheckout::class)->getFirstBy(['id' => $this->request->id],['*'],['orders']);
        get_invoice($this->request->id,$checkout);
        return $this->view('site.mail.order',
            ['request' => $this->request,'products' => $this->products,'settings' => $this->settings])
            ->attach(storage_path('app/public/uploads/pdf/' . $this->request->id . '.pdf'),  [
                'as' => $this->request->id .'.pdf',
                'mime' => 'application/pdf'
            ])->subject('طلب جديد')->from(env('MESSAGE_SEND_TO_ADDRESS'), 'طلب جديد');
    }
}
