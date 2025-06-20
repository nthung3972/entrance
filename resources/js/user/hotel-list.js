document.addEventListener('DOMContentLoaded', function() {
    const prefectureSelect = document.querySelector('select[name="prefecture_select"]');
    
    if (prefectureSelect) {
        prefectureSelect.addEventListener('change', function() {
            const prefecture = this.value;
            
            if (prefecture) {
                const currentUrl = new URL(window.location);
                const params = currentUrl.searchParams;
                
                const queryString = params.toString();
                const url = `/${prefecture}/hotelist${queryString ? '?' + queryString : ''}`;
                
                window.location.href = url;
            } else {
                alert('都道府県を選択してください');
            }
        });
    }
});