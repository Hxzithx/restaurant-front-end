@extends('layouts.app')

@section('content')

@include('header.header-1')

<!-- Page Title -->
<section id="page-title" class="page-title bg-overlay bg-parallax bg-overlay-gradient">
    <div class="bg-section">
        <img src="{{ asset('assets/images/page-title/14.jpg') }}" alt="Background" />
    </div>
    <div id="orderTypeModal" class="order-modal">
        <div class="order-modal-content">
            <h3>Select Your Order Type</h3>

            <button class="order-btn" data-type = "dine-in">Dine In</button>
            <button class="order-btn" data-type = "takeaway">Take Away</button>
            <button class="order-btn" data-type="online">Online Order</button>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-4 text-center">
                    <div class="title--content">
                        <div class="title--subtitle">Discover</div>
                        <div class="title--heading">
                            <h1>Our Menu</h1>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/home') }}">Home</a></li>
                        <li><a href="{{ url('/menu') }}">Menu</a></li>
                        <li><a href="{{ url('/shopping-cart') }}">Cart</a></li>
                    </ol>
                    <div class="divider--shape-1down"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- #page-title end -->

<!-- Menu Board -->
<section id="menuBoard" class="bg-white">
    <div class="container">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                <div class="heading heading-1 mb-50 text--center">
                    <p class="heading--subtitle">Taste the best</p>
                    <h2 class="heading--title mb-0">Fresh Ingredient, Tasty Meals</h2>
                    <div class="divider--shape-4"></div>
                    <p class="heading--desc">Everyone has taste, even if they don't realize it. Even if you're not a great chef, there's nothing to stop you understanding the difference between what tastes good and what doesn't.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pr-0 pl-0 tabs">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">

                @if($groupedItems->isEmpty())
                    <div class="text-center" style="padding: 50px;">
                        <p>No menu items available at the moment. Please check back later.</p>
                    </div>
                @else

                    {{-- Nav Tabs --}}
                    <ul class="nav nav-tabs">
                        @foreach($groupedItems as $category => $items)
                            <li class="{{ $loop->first ? 'active' : '' }}">
                                <a href="#{{ Str::slug($category) }}" data-toggle="tab">
                                    {{ $category }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    {{-- Tab Content --}}
                    <div class="tab-content">
                        @foreach($groupedItems as $category => $items)
                            <div class="tab-pane fade {{ $loop->first ? 'in active' : '' }}"
                                 id="{{ Str::slug($category) }}">

                                <div class="menu menu-7 bg-white">
                                    <div class="container">
                                        <div class="row">

                                            @foreach($items as $item)
                                                <div class="col-xs-12 col-sm-6 col-md-4" style="margin-bottom: 30px;">
                                                    <div class="dish-panel-inner">

                                                        {{-- Dish Image --}}
                                                        <div class="dish--img">
                                                            <a href="{{ route('menu.show', $item['id']) }}">
                                                                @if($item['image_url'])
                                                                    <img src="{{ $item['image_url'] }}"
                                                                         alt="{{ $item['base_name'] }}">
                                                                @else
                                                                    <img src="{{ asset('assets/images/menu/menu-board/1.jpg') }}"
                                                                         alt="{{ $item['base_name'] }}">
                                                                @endif
                                                            </a>
                                                        </div>

                                                        {{-- Dish Content --}}
                                                        <div class="dish--content">

                                                            {{-- Type Tag --}}
                                                            @if($item['item_type'])
                                                                <div class="dish--tag {{ strtolower($item['item_type']) }}">
                                                                    {{ ucfirst($item['item_type']) }}
                                                                </div>
                                                            @endif

                                                            {{-- Price --}}
                                                            @if(isset($item['real_price']) && $item['real_price'])
                                                                <span class="dish--price">
                                                                    Rs. {{ number_format($item['real_price'], 2) }}
                                                                </span>
                                                            @endif

                                                            {{-- Title --}}
                                                            <h3 class="dish--title">
                                                                <a href="{{ route('menu.show', $item['id']) }}">
                                                                    {{ $item['base_name'] }}
                                                                </a>
                                                            </h3>

                                                            {{-- Divider --}}
                                                            <div class="dish-divider"></div>

                                                            {{-- Description --}}
                                                            <p class="dish--desc">
                                                                {{ $item['description'] ?? 'A delicious dish prepared with the finest ingredients.' }}
                                                            </p>

                                                            {{-- View Button --}}
                                                            <a href="{{ route('menu.show', $item['id']) }}"
                                                               class="dish-view-btn">
                                                                View Details →
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>
<!-- #menuBoard end -->

<div class="clearfix"></div>
@include('footer.footer-1')

@endsection

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const savedType = localStorage.getItem('orderType');
        const modal = document.getElementById('orderTypeModal');
        const currentPath = window.location.pathname;

        if(!savedType){
            modal.style.display = 'flex';
        }else {
            modal.style.display = 'none';
        }

        document.querySelectorAll('.order-btn').forEach(function(btn) {

            btn.addEventListener('click', function() {
            const type = this.getAttribute('data-type');

            //save selection
            localStorage.setItem('orderType', type);

            //dine in
            if(type === 'dine-in'){
                window.location.href = "{{ route('reservation') }}"
                return;
            }

            //take-away and online
            modal.style.display = 'none';
            });
        });
    });
</script>
    
@endpush