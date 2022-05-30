<li id="lg-bag" class="" wire:poll.keep-alive>
    <a id="LiCart" href="{{ route('cart') }}" class="relative inline-flex"><i class="far fa-shopping-bag"></i>
        @if(Cart::instance('cart')->count() > 0)
        <span class="flex absolute text-sm noty animate-pulse">{{ Cart::instance('cart')->count() }}</span>
        @endif
    </a>
</li>
