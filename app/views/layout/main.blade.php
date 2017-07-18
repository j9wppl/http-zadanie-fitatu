<html>
<body>
@section('sidebar')
    @include('layout.sidebar')
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>