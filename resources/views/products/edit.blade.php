<x-app-layout>

    

    <x-slot name="header">
        <h2>
            {{ __('Edit Product') }}
        </h2>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i>
                Back</a>
        </div>
    </x-slot>

    <x-slot name="app_asset">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    </x-slot>   

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                            placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Detail:</strong>
                        <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Price:</strong>
                        <input type="text" name="price" value="{{ $product->price }}" class="form-control"
                            placeholder="Price">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Latitude:</strong>
                        <input type="text" id="latitude" name="latitude" value="{{ $product->latitude }}" class="form-control"
                            readonly required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Longitude:</strong>
                        <input type="text" id="longtitude" name="longtitude" value="{{ $product->longtitude }}" class="form-control"
                            readonly required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 pt-2">
                    <div id="map" style="height: 250px"></div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btn-sm mb-2 mt-2"><i
                            class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
            </div>
        </form>
    </div>
    
    <x-slot name="page_script">
        <script>
            // Initialize map centered on the product's existing location
            var map = L.map('map').setView([{{ $product->latitude }}, {{ $product->longtitude }}], 13);
            var marker;

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            // Add marker
            marker = L.marker([{{ $product->latitude }}, {{ $product->longtitude }}]).addTo(map);
            console.log();

            // Event Click On The Map
            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;
                
                // Update Latitude and Longtitude
                document.getElementById('latitude').value = lat;
                document.getElementById('longtitude').value = lng;

                // Add or Move Marker
                if (marker) {
                    marker.setLatLng([lat, lng]);
                } else {
                    marker = L.marker([lat, lng]).addTo(map);
                }
            })
        </script>
    </x-slot>
</x-app-layout>

