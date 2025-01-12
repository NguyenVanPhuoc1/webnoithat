
/**
 * Tạo slug từ một chuỗi
 * @param {string} str Chuỗi đầu vào
 * @returns {string} Slug đã được tạo
 */
function createSlug(str) {
    str = str.toLowerCase();
        str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
        str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
        str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
        str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
        str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
        str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
        str = str.replace(/(đ)/g, 'd');
        str = str.replace(/([^0-9a-z-\s])/g, '');
        str = str.replace(/(\s+)/g, '-');
        str = str.replace(/-+/g, '-');
        str = str.replace(/^-+/g, '');
        str = str.replace(/-+$/g, '');
    return str;
}

/**
 * Áp dụng hàm tự động tạo slug cho các trường cụ thể
 * @param {string} sourceSelector Selector của input nguồn (ví dụ: tên danh mục)
 * @param {string} targetSelector Selector của input đích (slug)
 */
function autoUpdateSlug(sourceSelector, targetSelector) {
    const sourceInput = document.querySelector(sourceSelector);
    const targetInput = document.querySelector(targetSelector);

    if (!sourceInput || !targetInput) return;

    sourceInput.addEventListener("input", function () {
        targetInput.value = createSlug(sourceInput.value);
    });
}
