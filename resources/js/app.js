import './bootstrap';
import '../scss/app.scss';
import '../scss/header.scss';
import '../scss/admin-header.scss';
import '../scss/admin-main.scss';
import '../scss/sidebar.scss';
import '../scss/footer.scss';
import '../scss/user/home.scss';
import '../scss/user/hotel-detail.scss';
import '../scss/admin/dashboard.scss';
import '../scss/admin/create-hotel.scss';
import '../scss/modal.scss';
import '../scss/admin/search-hotel.scss';
import '../scss/admin/result-hotel.scss';
import '../scss/admin/update-hotel.scss';
import '../scss/admin/search-booking.scss';

window.showGlobalLoading = function () {
    const loader = document.getElementById('global-loading');
    if (loader) loader.style.display = 'block';
};

document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function () {
            showGlobalLoading();
        });
    });

    const anchors = document.querySelectorAll('a[href]:not([target="_blank"]):not([href^="#"])');
    anchors.forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = anchor.getAttribute('href');
            const isSamePage = href === window.location.pathname;

            if (!isSamePage) {
                e.preventDefault(); 
                showGlobalLoading();

                setTimeout(function () {
                    window.location.href = href;
                }, 300);
            }
        });
    });
});

window.addEventListener('beforeunload', function () {
    showGlobalLoading();
});
