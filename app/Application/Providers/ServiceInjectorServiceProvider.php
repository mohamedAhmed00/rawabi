<?php
namespace App\Application\Providers;

use App\Domain\About\Entities\About;
use App\Domain\About\Repositories\Abstraction\IRepositoryAbout;
use App\Domain\Cart\Entities\Cart;
use App\Domain\Cart\Repositories\Abstraction\IRepositoryCart;
use App\Domain\Cart\Repositories\Concretion\RepositoryCart;
use App\Domain\Cart\Services\Abstraction\IServiceCart;
use App\Domain\Cart\Services\Concretion\ServiceCart;
use App\Domain\City\Entities\City;
use App\Domain\City\Repositories\Abstraction\IRepositoryCity;
use App\Domain\City\Repositories\Concretion\RepositoryCity;
use App\Domain\Features\Entities\Feature;
use App\Domain\HomeSection\Repositories\Concretion\RepositoryHomeSection;
use App\Domain\Order\Entities\Checkout;
use App\Domain\Order\Entities\Order;
use App\Domain\Order\Entities\OrderHistory;
use App\Domain\Order\Entities\OrderStatus;
use App\Domain\Order\Repositories\Abstraction\IRepositoryCheckout;
use App\Domain\Order\Repositories\Abstraction\IRepositoryOrder;
use App\Domain\Order\Repositories\Abstraction\IRepositoryOrderHistory;
use App\Domain\Order\Repositories\Abstraction\IRepositoryOrderStatus;
use App\Domain\Order\Repositories\Concretion\RepositoryCheckout;
use App\Domain\Order\Repositories\Concretion\RepositoryOrder;
use App\Domain\HomeSection\Entities\HomeSection;
use App\Domain\Order\Repositories\Concretion\RepositoryOrderHistory;
use App\Domain\Order\Repositories\Concretion\RepositoryOrderStatus;
use App\Domain\Order\Services\Abstraction\IServiceOrder;
use App\Domain\Order\Services\Concretion\ServiceOrder;
use App\Domain\Product\Entities\ProductCategory;
use App\Domain\Product\Repositories\Abstraction\IRepositoryProductCategory;
use App\Domain\Product\Repositories\Concretion\RepositoryProductCategory;
use App\Domain\Slider\Entities\Slider;
use App\Domain\Slider\Repositories\Abstraction\IRepositorySlider;
use App\Domain\Slider\Repositories\Concretion\RepositorySlider;
use App\Domain\Testimonial\Entities\Testimonial;
use App\Domain\Features\Repositories\Abstraction\IRepositoryFeatures;
use App\Domain\HomeSection\Repositories\Abstraction\IRepositoryHomeSection;
use App\Domain\About\Repositories\Concretion\RepositoryAbout;
use App\Domain\Features\Repositories\Concretion\RepositoryFeatures;
use App\Domain\Testimonial\Repositories\Concretion\RepositoryTestimonial;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Repositories\Abstraction\IRepositoryProduct;
use App\Domain\Product\Repositories\Concretion\RepositoryProduct;
use App\Domain\Setting\Entities\Setting;
use App\Domain\Setting\Repositories\Abstraction\IRepositorySetting;
use App\Domain\Setting\Repositories\Concretion\RepositorySetting;
use App\Domain\Testimonial\Repositories\Abstraction\IRepositoryTestimonial;
use App\Domain\User\Entities\Message;
use App\Domain\User\Entities\Subscriber;
use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\Abstraction\IRepositoryMessage;
use App\Domain\User\Repositories\Abstraction\IRepositorySubscribe;
use App\Domain\User\Repositories\Abstraction\IRepositoryUser;
use App\Domain\User\Services\Abstraction\IServiceMessage;
use App\Domain\User\Repositories\Concretion\RepositoryMessage;
use App\Domain\User\Repositories\Concretion\RepositorySubscribe;
use App\Domain\User\Repositories\Concretion\RepositoryUser;
use App\Domain\User\Services\Concretion\ServiceMessage;
use Illuminate\Support\ServiceProvider;

class ServiceInjectorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IRepositoryTestimonial::class,function ($app){
            return new RepositoryTestimonial($app->make(Testimonial::class));
        });
        $this->app->singleton(IRepositoryAbout::class,function ($app){
            return new RepositoryAbout($app->make(About::class));
        });
        $this->app->singleton(IRepositoryFeatures::class,function ($app){
            return new RepositoryFeatures($app->make(Feature::class));
        });
        $this->app->singleton(IRepositoryHomeSection::class,function ($app){
            return new RepositoryHomeSection($app->make(HomeSection::class));
        });
        $this->app->singleton(IRepositoryCity::class,function ($app){
            return new RepositoryCity($app->make(City::class));
        });
        $this->app->singleton(IRepositoryOrder::class,function ($app){
            return new RepositoryOrder($app->make(Order::class));
        });
        $this->app->singleton(IRepositoryProduct::class,function ($app){
            return new RepositoryProduct($app->make(Product::class));
        });
        $this->app->singleton(IRepositorySetting::class,function ($app){
            return new RepositorySetting($app->make(Setting::class));
        });
        $this->app->singleton(IRepositoryUser::class,function ($app){
            return new RepositoryUser($app->make(User::class));
        });

        $this->app->singleton(IRepositorySubscribe::class,function ($app){
            return new RepositorySubscribe($app->make(Subscriber::class));
        });
        $this->app->singleton(IServiceMessage::class,ServiceMessage::class);
        $this->app->singleton(IRepositoryMessage::class,function ($app){
            return new RepositoryMessage($app->make(Message::class));
        });
        $this->app->singleton(IServiceCart::class,ServiceCart::class);
        $this->app->singleton(IServiceOrder::class,ServiceOrder::class);
        $this->app->singleton(IRepositoryCheckout::class,function ($app){
            return new RepositoryCheckout($app->make(Checkout::class));
        });
        $this->app->singleton(IRepositoryOrder::class,function ($app){
            return new RepositoryOrder($app->make(Order::class));
        });

        $this->app->singleton(IRepositoryProductCategory::class,function ($app){
            return new RepositoryProductCategory($app->make(ProductCategory::class));
        });

        $this->app->singleton(IRepositorySlider::class,function ($app){
            return new RepositorySlider($app->make(Slider::class));
        });

        $this->app->singleton(IRepositoryOrderStatus::class,function ($app){
            return new RepositoryOrderStatus($app->make(OrderStatus::class));
        });

        $this->app->singleton(IRepositoryOrderHistory::class,function ($app){
            return new RepositoryOrderHistory($app->make(OrderHistory::class));
        });

        $this->app->singleton(IRepositoryCart::class,function ($app){
            return new RepositoryCart($app->make(Cart::class));
        });
    }
}
