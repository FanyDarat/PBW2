<x-app-layout>
    <x-slot name="app_asset">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    </x-slot>
    <x-slot name="header">
        <h2>
            {{ __('Show Product') }}
        </h2>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
        </div>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $product->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Details:</strong>
                    {{ $product->detail }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    {{ $product->price }}
                </div>
            </div>
        </div>
        {{-- Map Section --}}
        <div class="mt-4 mb-4">
            <div id="map" style="height: 500px;"></div>
        </div>

        <script>
            //Get Pproduct Coordinates From PHP
            const productLatitude = {{  $product->latitude }};
            const productLongitude = {{  $product->longtitude }};
            const productName = "{{ $product->name }}";

            // Initialize the map
            var map = L.map('map').setView([productLatitude, productLongitude], 13);

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            // Add marker
            L.marker([productLatitude, productLongitude])
                .addTo(map)
                .bindPopup(`<b>${productName}</b>`)
                .openPopup();
        </script>
    </div>
</x-app-layout>
