<li id="lg-bag" class="">
    <a id="LiCart" href="{{ route('cart') }}" class="relative inline-flex"><i class="far fa-shopping-bag"></i>
        @if(Cart::instance('cart')->count() > 0)
        <span class="flex absolute text-sm noty animate-pulse">{{ Cart::instance('cart')->count() }}</span>
        @endif
    </a>
</li>
<li id="lg-bag" class="">
    <a id="LiCart" href="{{ route('wishlist') }}" class="relative inline-flex"><i class="far fa-heart"></i>
        @if(Cart::instance('wishlist')->count() > 0)
        <span class="flex absolute text-sm noty animate-pulse">{{ Cart::instance('wishlist')->count() }}</span>
        @endif
    </a>
</li>
