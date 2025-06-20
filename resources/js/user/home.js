document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const prefecture = document.getElementById('prefecture').value;
    if (!prefecture) {
        alert('都道府県を選択してください');
        return;
    }
    
    // Tạo URL với các tham số tìm kiếm
    const formData = new FormData(this);
    const params = new URLSearchParams();
    
    for (let [key, value] of formData.entries()) {
        if (value && key !== 'prefecture') {
            params.append(key, value);
        }
    }
    
    const queryString = params.toString();
    const url = `/${prefecture}/hotelist${queryString ? '?' + queryString : ''}`;
    
    window.location.href = url;
});
