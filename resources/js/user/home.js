document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('prefecture');
    const form = document.getElementById('searchForm');

    function updateFormAction() {
        const selectedValue = select.value;
        if (selectedValue) {
            form.action = `/${selectedValue}/hotelist`;
        } else {
            form.action = `/empty/hotelist`;
        }
    }

    select?.addEventListener('change', updateFormAction);

    form?.addEventListener('submit', function (e) {
        e.preventDefault();
        const inputs = this.querySelectorAll('select');
        const params = new URLSearchParams();

        inputs.forEach(input => {
            const name = input.name;
            const value = input.value?.trim();
            if (name && value) {
                params.append(name, value);
            }
        });

        const baseAction = form.action;
        const queryString = params.toString();
        const newUrl = queryString ? `${baseAction}?${queryString}` : baseAction;

        window.location.href = newUrl;
    });

    updateFormAction();
});
