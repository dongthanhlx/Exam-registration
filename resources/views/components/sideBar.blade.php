<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img class="ml-4" style="width:200px;" src="https://uet.vnu.edu.vn/wp-content/uploads/2019/03/logo-outline.png">
            </a>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="#student" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-white">Sinh viên</a>
                <ul class="collapse list-unstyled" id="student">
                    <li class="ml-3">
                        <a href="{{ route('admin.student.index') }}">Danh sách sinh viên</a>
                    </li>
                    <li class="ml-3">
                        <a href="{{ route('admin.account.index') }}">Danh sách tài khoản</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#subject" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Môn thi</a>
                <ul class="collapse list-unstyled" id="subject">
                    <li class="ml-3">
                        <a href="{{ route('admin.subject.index') }}">Môn học</a>
                    </li>
                    <li class="ml-3">
                        <a href="{{ route('admin.SubjectClass.index') }}">Học phần</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#exam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Kỳ thi</a>
                <ul class="collapse list-unstyled" id="exam">
                    <li class="ml-3">
                        <a href="{{ route('admin.exam.create') }}">Tạo kỳ thi</a>
                    </li>
                    <li class="ml-3">
                        <a href="{{ route('admin.scheduling.create') }}">Lập lịch</a>
                    </li>
                    <li class="ml-3">
                        <a href="{{ route('admin.scheduling.index') }}">Kết quả lập lịch</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin.room.index') }}">Địa điểm</a>
            </li>
            <li>
                <a href="#result" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Kết quả đăng ký</a>
                <ul class="collapse list-unstyled" id="result">
                    <li class="ml-3">
                        <a href="{{ route('admin.registrationStudy.index') }}">Kết quả đăng ký học</a>
                    </li>
                    <li class="ml-3">
                        <a href="{{ route('admin.scheduling.index') }}">Kết quả đăng ký thi</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

</div>