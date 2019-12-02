@include ('components.header')
<div id="app">
    @include('components.studentNav')
    <main class="py-4">
        @yield('content')
    </main>
</div>
@include('components.footer')
