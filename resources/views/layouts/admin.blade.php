@include ('components.header')
<div id="app">
    @include('components.adminNav')
    <main class="py-4">
        @yield('content')
    </main>
</div>
@include('components.footer')
