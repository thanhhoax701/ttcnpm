<header>
    <div class="main-logo col" style="height:30px">
        <div class="row" style="width:100% ;margin-left :0px;">
            <div class="title-logo">Thi tuyển Trung tâm CNPM ĐHCT</div>

            @if(Auth::check())
            <div class="col-auto justify-content-end align-items-end desktop-only user-header" id="logoutButtonDesktop">
                <div class="input-group" style="align-items: center;">
                    <img src="{{url((auth()->user()!=null)?auth()->user()->avatar:'')}}" alt="" width="32" height="32" class="rounded-circle">
                    <span class="p-2" style="color:white">{{(auth()->user()!=null)?auth()->user()->name:''}}</span>
                    <a href="{{route('logout')}}">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-sign-out-alt"></i>
                            </span>
                        </div>
                    </a>
                </div>

            </div>
            @endif
        </div>

        <!-- top-banner.jpg -->
    </div>

</header>

<script>
    window.addEventListener('resize', () => {
        const logoutButtonDesktop = document.getElementById('logoutButtonDesktop');

        // Kiểm tra kích thước màn hình khi trang được tải
        const isDesktop = window.matchMedia('(max-width: 767px)').matches;

        // Ẩn nút đăng xuất nếu là giao diện di động
        if (isDesktop) {
            logoutButtonDesktop.style.display = 'none';
        }
    });
</script>