let header = document.getElementById('header');

if (header) {
    header.innerHTML = `
     <div class="sidebar shadow-sm p-5" style="min-height: 100vh; background-color: #2a2a16;">
        <div class="sidebar-brand d-flex justify-content-start align-items-center">
            <img src="./asset/img/kcst1.png" alt="" style="height: 50px;">
            <h1 class="text-light">KCST</h1>
        </div>
        <div class="sidebar-nav mt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="" class="nav-link text-light">Post Announcement</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-light">Post Event</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-light">Delete Announcement</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-light">Delete Events</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-light">Logout</a>
                </li>
            </ul>
        </div>
    </div>`;
}