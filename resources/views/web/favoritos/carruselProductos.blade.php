@foreach($productos AS $producto)
    <div class="col-lg-3 col-md-4 col-12 mb-md-5 mb-5">
        @include('web.productos.partes.itemProducto',['producto' => $producto])
    </div>
@endforeach


<div class="col-md-12 col-md-12 col-12 text-center">
    {{ $productos->links() }}
</div>
