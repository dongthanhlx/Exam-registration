@include ('components.header')
<div id="app">
    @yield('navigation')
    <main class="py-4">
        @yield('content')
    </main>
</div>
@include('components.footer')
