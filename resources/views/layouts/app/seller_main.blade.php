
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-new_product-tab" data-bs-toggle="pill" data-bs-target="#pills-new_product" type="button" role="tab" aria-controls="pills-new_product" aria-selected="true">Nuevo Producto</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-enter_sale-tab" data-bs-toggle="pill" data-bs-target="#pills-enter_sale" type="button" role="tab" aria-controls="pills-enter_sale" aria-selected="false">Registrar Venta</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-list_sales-tab" data-bs-toggle="pill" data-bs-target="#pills-list_sales" type="button" role="tab" aria-controls="pills-list_sales" aria-selected="false">Listado de ventas</button>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-new_product" role="tabpanel" aria-labelledby="pills-new_product-tab" tabindex="0">
        @include('layouts.app.includes.new_product') 
    </div>
    <div class="tab-pane fade" id="pills-enter_sale" role="tabpanel" aria-labelledby="pills-enter_sale-tab" tabindex="0">
        @include('layouts.app.includes.enter_sale')
    </div>
    <div class="tab-pane fade" id="pills-list_sales" role="tabpanel" aria-labelledby="pills-list_sales-tab" tabindex="0">
        @include('layouts.app.includes.list_sales')
    </div>
</div>