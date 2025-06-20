document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('prefecture');
    const form = document.getElementById('searchForm');

    function updateFormAction() {
        const selectedValue = select.value;
        if (selectedValue) {
            form.action = `/${selectedValue}/hotelist`;
        } else {
            form.action = `/empty/hotelist`; // hoặc dùng route('hotel.list', ...)
        }
    }

    select?.addEventListener('change', updateFormAction);

    form?.addEventListener('submit', function (e) {
        const inputs = this.querySelectorAll('input, select');
        inputs.forEach(input => {
            if (!input.value || input.value.trim() === '') {
                input.removeAttribute('name');
            }
        });
    });

    updateFormAction();
});
