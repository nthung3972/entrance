document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('searchForm').addEventListener('submit', function (e) {
        const inputs = this.querySelectorAll('input[name]');

        inputs.forEach(function (input) {
            if (!input.value.trim()) {
                input.removeAttribute('name');
            }
        });
    });

    window.clearForm = function () {
        const form = document.getElementById('searchForm');
        if (!form) return;

        form.reset();

        const cleanUrl = window.location.origin + window.location.pathname;
        window.location.href = cleanUrl;
    };
});
