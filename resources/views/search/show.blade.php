@extends('layouts.app')

@section('title', 'Resultados de búsqueda')

@section('styles')
    <style>
        .team .row .col-md-4 {
            margin-bottom: 5em;
        }
        .team .row {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
        }
        .team .row > [class*='col-'] {
            display: flex;
            flex-direction: column;
        }
    </style>
@endsection

@section('body-class', 'profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('/img/examples/city.jpg');"></div>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="profile">
                    <div class="avatar">
                        <img src="/img/search.jpg" alt="Busqueda" class="rounded img-responsive img-raised">
                    </div>
                    <br>
                    @if (session('notification'))
                        <div class="alert alert-success">
                            {{ session('notification') }}
                        </div>
                    @endif

                </div>
            </div>

            <div class="name text-center">
                <h3 class="title">Resultados de la búsqueda</h3>
            </div>

            <div class="description text-center">
                <p>Se encontraron {{ $products->count() }} resultados para el término {{ $query }}.</p>
            </div>

            <div class="section text-center">
                <div class="team">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-md-4">
                            <div class="team-player">
                                <img src="{{ $product->featured_image_url }}" alt="Thumbnail Image" class="img-raised rounded">
                                <h4 class="title">
                                    <a href="{{ url('/products/'.$product->id) }}">{{ $product->name }}</a>
                                    <br />
                                    <small class="text-muted">{{ $product->category_name }}</small>
                                </h4>
                                <p class="description">{{ $product->description }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('includes.footer')
@endsection
