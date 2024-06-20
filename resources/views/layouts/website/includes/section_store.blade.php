@php
    use App\Models\Producto;
    use App\Models\Ciudad;
    use App\Models\Categoria;

    if(empty($productos)){
        $productos = Producto::paginate(15);
    }
    if(empty($priceRange)) {
        $priceRange = 'all';
    }
    if(empty($category)) {
        $category = 'all';
    }
    if(empty($city)) {
        $city = 'all';
    }
    $ciudades = Ciudad::all();
    $categoriasDB = Categoria::all();

    $categorias= [];
    foreach ($categoriasDB as $categoria) {
        if (strpos($categoria->nombre, '-') !== false) {
            $parts = explode('-', $categoria->nombre);
            $categorias[$parts[0]][] = $parts[1];
        } else {
            $categorias['Categorias'][] = $categoria->nombre;
        }
    }


    function formatCurrency($amount) {
        return '$' . number_format($amount, 0, ',', '.');
    }
@endphp

<section id="website_main_section_store">
    <div id="website_main_section_store_content" class="container-xxl pt-4 pb-4">
        <div class="row ps-3">
            <aside id="website_main_section_store_aside" class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-12  p-0">
                <div class="w-100 website_main_section_store_aside_filters mb-2">
                    <h1>Por ciudad</h1>
                    <ul>
                        @foreach ($ciudades as $ciudad)
                            <li><a href="{{ route('productos.index', ['city' => $ciudad->id, 'price_range' => $priceRange, 'category' => $category]) }}">{{ $ciudad->nombre }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="w-100 website_main_section_store_aside_filters mb-2">
                    <h1>Por precio</h1>
                    <ul>
                        <li><a href="{{ route('productos.index', ['price_range' => null, 'city' => $city, 'category' => $category]) }}">Todas</a></li>
                        <li><a href="{{ route('productos.index', ['price_range' => '0-50000', 'city' => $city, 'category' => $category]) }}">$0 - $50.000</a></li>
                        <li><a href="{{ route('productos.index', ['price_range' => '50000-100000', 'city' => $city, 'category' => $category]) }}">$50.000 - $100.000</a></li>
                        <li><a href="{{ route('productos.index', ['price_range' => '100000-150000', 'city' => $city, 'category' => $category]) }}">$100.000 - $150.000</a></li>
                        <li><a href="{{ route('productos.index', ['price_range' => '200000+', 'city' => $city, 'category' => $category]) }}">$200.000 +</a></li>
                    </ul>
                </div>
                    
                @foreach ($categorias as $nombreCategoria => $subcategorias)
                    <div class="w-100 website_main_section_store_aside_filters mb-2">
                        <h1>Por {{ $nombreCategoria }}</h1>
                        <ul>
                            @foreach ($subcategorias as $subcategoria)
                                <li><a href="{{ route('productos.index', ['category' => ($nombreCategoria=='Categorias'?'':$nombreCategoria.'-').$subcategoria, 'price_range' => $priceRange, 'city' => $city]) }}">{{ $subcategoria }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach

            </aside>
    
            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-2 ">
                <div id="website_main_section_store_content_row" class="row">
                    @foreach ($productos as $product)
                    <div class="product_card m-2 p-0">
                        <div class="w-100 product_card_img">
                            <a href="#"><img width="100%" height="100%" src="{{ asset('img/mock.jpg') }}"></a>
                        </div>
                        <div class="w-100 product_card_info">
                            <h1>{{ $product->nombre }}</h1>
                            <p>{{ formatCurrency($product->precio) }}</p>
                            <button>AGREGAR AL CARRITO</button>
                        </div>
                    </div>
                    @endforeach
                </div>

                    {{ $productos->links() }}
            </div>
        </div>
    </div>