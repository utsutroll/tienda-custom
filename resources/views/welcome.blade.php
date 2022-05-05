<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="En la tienda online de la Mega Tienda Turén podrás hacer tus compra de una manera segura y evitarás las molestas colas de espera. Solo debes armar tu carrito de compra, pagar por los distintos metódos de pago e ir a retirar tu pedido. Proximamente contaremos con Delivery.">
    <meta name="author" content="Space DigitalSolutions C.A">
  
	<title>La Mega Tienda Turén</title>
	<!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.svg">
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-EDPVXK5MPB"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-EDPVXK5MPB');
	</script>
</head>
<body>
	<div class="min-h-screen flex flex-col text-center">
		<nav class="bg-white shadow-sm" x-data="{ open:false }">
	    	<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
	      		<div class="relative flex items-center justify-between h-16">
	  
			        <!-- Mobile menu button-->  
			        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
			          
			          <button x-on:click=" open = true " type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
			            <span class="sr-only">Abrir menú principal</span>

			            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
			              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
			            </svg>

			            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
			              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
			            </svg>
			          </button>
			        </div>
	  
			        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
			          <!-- Logo-->  
			          <a href="/" class="flex-shrink-0 flex items-center">
			            <img class="block lg:hidden h-10 w-auto" src="img/logo-main.svg" alt="LaMegaTiendaTuren">
			            <img class="hidden lg:block h-10 w-auto" src="img/logo-main-text.svg" alt="LaMegaTiendaTuren">
			          </a>
			      	</div>
			    </div>
			</div>  	
		</nav>
	  	<div class="bg-gray-100 p-6 flex-grow">
	  		<div class="flex justify-center">
		  		<div>
		  			<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" style="fill: rgba(241, 132, 58, 1);transform: ;msFilter:;"><path d="M21,6h-2V3h-2v3H7V3H5v3H3C2.447,6,2,6.448,2,7v7c0,0.553,0.447,1,1,1h2v6h2v-6h10v6h2v-6h2c0.553,0,1-0.447,1-1V7 C22,6.448,21.553,6,21,6z M4.42,13l2.857-5H9.58l-2.857,5H4.42z M12.277,8h2.303l-2.857,5H9.42L12.277,8z M17.277,8h2.303l-2.857,5 H14.42L17.277,8z"></path></svg>
		  		</div>
		  		<div>
		  			<h1 class="text-4xl mt-5 font-medium">En Construcción</h1> 
		  		</div>
		  		<div>
		  			<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" style="fill: rgba(241, 132, 58, 1);transform: ;msFilter:;"><path d="M21,6h-2V3h-2v3H7V3H5v3H3C2.447,6,2,6.448,2,7v7c0,0.553,0.447,1,1,1h2v6h2v-6h10v6h2v-6h2c0.553,0,1-0.447,1-1V7 C22,6.448,21.553,6,21,6z M4.42,13l2.857-5H9.58l-2.857,5H4.42z M12.277,8h2.303l-2.857,5H9.42L12.277,8z M17.277,8h2.303l-2.857,5 H14.42L17.277,8z"></path></svg>
		  		</div>
	  		</div>
	  		<div class=" grid grid-cols-8 gap-2 justify-items-stretch">
				  	<div class="col-start-4 justify-self-center">
				  		<svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 animate-spin opacity-50" viewBox="0 0 20 20" fill="currentColor">
  							<path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
						</svg>
				  	</div>
				  	<div class="col-start-5">
				  		<svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 animate-spin opacity-50" viewBox="0 0 20 20" fill="currentColor">
  							<path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
						</svg>
				  	</div>
				  	<div class="col-start-5">
				  		<svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 animate-spin opacity-50" viewBox="0 0 20 20" fill="currentColor">
  							<path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
						</svg>
				  	</div>
				</div>
	  	</div>

	  	<div class="bg-white p-4 h-15 text-left">
	  		<footer class="flex">
        		© 2021 La Mega Tienda Turén by <a href="https://instagram.com/spacedigitalsolutions" title="Instagram de Space DicitalSolutions C.A" class="ml-1 hover:text-blue-600 flex" target="_blank">
        			 Space DigitalSolutions C.A <i class="mt-1"><svg class="hover:text-blue-600" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M13 3L16.293 6.293 9.293 13.293 10.707 14.707 17.707 7.707 21 11 21 3z"></path><path d="M19,19H5V5h7l-2-2H5C3.897,3,3,3.897,3,5v14c0,1.103,0.897,2,2,2h14c1.103,0,2-0.897,2-2v-5l-2-2V19z"></path></svg></i>
        		</a>
    		</footer>
	  	</div>
	</div>
</body>
</html>