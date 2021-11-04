@include('partials._header')
<body>
    <div id="app">
        @include('partials._navmenu')

        @include('partials._messages')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @include('partials._footer')

    @yield('specialsection')

</body>
</html>
