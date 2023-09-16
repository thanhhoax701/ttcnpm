<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid justify-content-start">
        <button type="button" id="sidebarCollapse" class="btn btn-secondary m-2 hidden-mobile">
            <i class="fas fa-align-left"></i>
        </button>
        <!-- page show in mobile -->
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto m-2 hidden-window" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>
        <nav aria-label="breadcrumb " style="height:25px">
            @include('partials.common.breadcrumb')
        </nav>
    </div>
</nav>