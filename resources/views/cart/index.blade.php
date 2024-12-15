<x-layout>
    <div class="app m-5">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-3">
                    <div class="card h-100">
                        <img src="{{ $product['image'] }}" class="card-img-top" alt="{{ $product['name'] }}">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product['name'] }}</h5>

                            <p class="card-text text-truncate" style="max-height: 3.6em; overflow: hidden;">{{ $product['description'] }}</p>

                            <div class="mt-auto">
                                <p class="fw-bold mb-3">{{ __('messages.price') }}: ${{ number_format($product['price'], 2) }}</p>

                                <button class="btn btn-primary add-to-cart" data-id="{{ $product['id'] }}">{{ __('messages.add_to_cart') }}</button>
                                <input type="number" id="quantity-{{ $product['id'] }}" value="1" min="1" class="quantity-input">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $products->appends(request()->query())->links() }}
    </div>
    <script src="{{ mix('js/cart.js') }}"></script>
</x-layout>

