<div class="list-group list-group-flush">
    {{-- <a href="{{route( 'mypage' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between">
            <p class="mb-0">
                <i class="bi bi-person-fill"></i>
                <span class="ms-3">マイページ</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
    <a href="{{route( 'infomation_list' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between">
            <p class="mb-0">
                <i class="bi bi-bell"></i>
                <span class="ms-3">通知</span>
                <span class="badge  badge-pill badge-danger">100</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a> --}}
    <a href="{{route( 'settings' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between">
            <p class="mb-0">
                <i class="bi bi-gear"></i>
                <span class="ms-3">プロフィール・設定変更</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
    <a href="{{route( 'user_auth.logout' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between">
            <p class="mb-0">
                <i class="bi bi-box-arrow-right"></i>
                <span class="ms-3">ログアウト</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
</div>
