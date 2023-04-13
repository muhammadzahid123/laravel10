<div class="div row">
    @foreach ($products as $product)
    <div class="col-md-4">
        <div class="card">
            @php $i = 1; @endphp
            @foreach ($product->images as $image)
            @if($i > 0)
            <a href="{{!! route('products.show', $product->slug) !!}}">
                <img class="card-img-top feature-img" src="{{ asset('images/'.$image->image) }}" alt="{{ $product->title }}">
            </a>
            @endif

            @php $i--; @endphp
            @endforeach

            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('products.show', $product->slug) }}">{{ $product->title }}</a>
                </h5>
                <p class="card-text">Rs-{{ $product->price }}</p>
                <a href="#" class="btn btn-outline-info">Add to cart</a>
            </div>
        </div>
    </div>
    @endforeach
    <div class="mt-4">
        {!! $products->links() !!}
    </div>
</div>
