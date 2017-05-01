<!DOCTYPE html>
<html lang="pt-br">
    @include('layout.components.head')

    <body>
        <div class="container-fluid">
            @include('layout.components.header')
            <div class="row">
                <div class="col-lg-10 collapsed-canvas clearfix" id="content">
                    <!-- Conteúdo -->
                    @include('layout.components.alerts')
                    @yield('content')
                </div>
            </div>
        </div>

        @include('layout.components.footer')
    </body>
</html>
