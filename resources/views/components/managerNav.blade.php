<div class="navbar-header" id="navbarNavDropdown">
    <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Sinh viên
            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.student.index') }}">Danh sách sinh viên</a>
                    <a class="dropdown-item" href="{{ route('admin.account.index') }}">Danh sách tài khoản</a>
                </li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Môn thi
            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.subject.index') }}">Môn học</a>
                    <a class="dropdown-item" href="{{ route('admin.SubjectClass.index') }}">Học phần</a>
                </li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Kỳ thi
            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.exam.create') }}">Tạo kỳ thi</a>
                    <a class="dropdown-item" href="{{ route('admin.scheduling.index') }}">Lập lịch</a>
                </li>
            </ul>
        </li>

        <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('admin.room.index') }}">Địa điểm</a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Kết quả đăng ký
            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.registrationStudy.index') }}">Kết quả đăng ký học</a>
                    <a class="dropdown-item" href="{{ route('admin.scheduling.index') }}">Kết quả đăng ký thi</a>
                </li>
            </ul>
        </li>
    </ul>
</div>