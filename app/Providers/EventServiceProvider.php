<?php

namespace App\Providers;

use App\Events\CancelOrderEvent;
use App\Events\OrderEvent;
use App\Listeners\CancelOrderListener;
use App\Listeners\OrderListener;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductEntry;
use App\Models\ProductOutput;
use App\Observers\OrderItemObserver;
use App\Observers\OrderObserver;
use App\Observers\ProductEntryOrserver;
use App\Observers\ProductOrserver;
use App\Observers\ProductOutputOrserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;



class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderEvent::class => [
            OrderListener::class,
        ],
        CancelOrderEvent::class => [
            CancelOrderListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(ProductOrserver::class);
        ProductEntry::observe(ProductEntryOrserver::class);
        ProductOutput::observe(ProductOutputOrserver::class);
        Order::observe(OrderObserver::class);
        OrderItem::observe(OrderItemObserver::class);
    }
}