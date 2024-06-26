<div id="bg-white-fullwidth"></div>
<nav class="container-xl mt-1 position-sticky">
    <div>
        <a id="NavlinkHome" href="{{ route('home') }}" class="position-absolute">
            <div id="button_home" class="float-start h-100 d-inline-block px-4 py-4">
                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
                </svg>                  
            </div>
        </a>
        <div id="menu-toggle" class="menu-toggle">
            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" stroke="currentColor" width="30" height="30">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </div>
        <div class="menu-background"></div> <!-- Fondo blanco detrás del menú -->
        <ul class="menu">
            <a href="{{ route('home') }}" class="pt-4 pb-4 position-relative"><li class="ps-4 pe-4">INICIO</li></a>
            <a href="{{ route('home') }}" class="pt-4 pb-4 position-relative"><li class="ps-4 pe-4">CATEGORÍAS</li></a>
            <a href="{{ route('home') }}" class="pt-4 pb-4 position-relative"><li class="ps-4 pe-4">OCACIÓN</li></a>
            <a href="{{ route('home') }}" class="pt-4 pb-4 position-relative"><li class="ps-4 pe-4">RAMOS ECONOMICOS</li></a>
            <a href="{{ route('home') }}" class="pt-4 pb-4 position-relative"><li class="ps-4 pe-4">COLECCIÓN DELUXE</li></a>
        </ul>
    </div>
</nav>
<hr class="p-0 m-0 position-sticky">
