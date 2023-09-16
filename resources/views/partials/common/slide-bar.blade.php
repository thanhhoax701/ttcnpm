@php
$quyen=null;
if(auth()->user()){
    if(auth()->user()->quyennguoidungs()){
        if(auth()->user()->quyennguoidungs()->first()){
            $quyen = auth()->user()->quyennguoidungs()->first()->Q_MaQ;
        }
    }
}
@endphp
<nav id="sidebar" class="show-window hide-mobile">
    <div class="user mt-3 d-flex justify-content-center">
        <div>
            <div class="input-group" style="align-items: center;">
                <img src=".\avatar\VNPT-Logo.png" alt="" width="150" height="40" class="rounded-circle">
            </div>
        </div>
    </div>
    <hr/>
    <ul class="list-unstyled">
        <li class="{{mb_strtolower($title)=='trang chủ'?'active':''}}">
            <a href="{{route('home')}}">Trang Chủ</a>
        </li>
    </ul>
</nav>

<script>
    window.addEventListener('resize', () => {
        const logoutButtonMobile = document.getElementById('logoutButtonMobile');

        // Kiểm tra kích thước màn hình khi trang được tải
        const isMobile = window.matchMedia('(min-width: 768px)').matches;

        // Ẩn nút đăng xuất nếu là giao diện desktop
        if (isMobile) {
            logoutButtonMobile.style.display = 'none';
        }
    });
</script>