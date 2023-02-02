@extends('admin.layouts.main')

@section('content')
  <div class="row">
    <div class="col-lg-12 col-md-12 order-1">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-4 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  {{-- <img src="{{ asset('backend/assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded"> --}}
                  <span class="bx bxs-package rounded text-info fs-2"></span>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Total Produk</span>
              <h3 class="card-title mb-2" id="totalProduk">0</h3>
            </div>
          </div>
        </div>
    
        <div class="col-lg-4 col-md-4 col-4 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  {{-- <img src="{{ asset('backend/assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded"> --}}
                  <span class="bx bx-user rounded text-secondary fs-2"></span>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Total User</span>
              <h3 class="card-title mb-2" id="totalUser">0</h3>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-4 col-4 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  {{-- <img src="{{ asset('backend/assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded"> --}}
                  <span class="bx bx-image rounded text-danger fs-2"></span>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Total Galeri</span>
              <h3 class="card-title mb-2" id="totalGaleri">0</h3>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-4 col-4 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  {{-- <img src="{{ asset('backend/assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded"> --}}
                  <span class="bx bx-image rounded text-warning fs-2"></span>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Total Foto Slider</span>
              <h3 class="card-title mb-2" id="totalSlider">0</h3>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-4 col-4 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                   {{-- <img src="{{ asset('backend/assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded"> --}}
                  <span class="bx bx-link-alt rounded text-success fs-2"></span>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Total Url Sosmed</span>
              <h3 class="card-title mb-2" id="totalSosmed">0</h3>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-4 col-4 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                   {{-- <img src="{{ asset('backend/assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded"> --}}
                  <span class="bx bx-news rounded text-primary fs-2"></span>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Total Blog</span>
              <h3 class="card-title mb-2" id="totalBlog">0</h3>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
@endsection
