@extends('layouts.app')

@section('content')
<!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  @include('components.header')
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  @include('components.hero')
  <!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    @include('components.about')
    <!-- End About Section -->

    <!-- ======= Facts Section ======= -->
    @include('components.facts')
    <!-- End Facts Section -->

    <!-- ======= Skills Section ======= -->
    @include('components.skills')
    <!-- End Skills Section -->

    <!-- ======= Resume Section ======= -->
    @include('components.resume')
    <!-- End Resume Section -->

    <!-- ======= Contact Section ======= -->
    @include('components.contact')
    <!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@endsection
