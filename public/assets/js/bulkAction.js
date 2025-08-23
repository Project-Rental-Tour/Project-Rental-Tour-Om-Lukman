document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk menangani bulk actions
    function handleBulkAction() {
        const selectedCheckboxes = document.querySelectorAll('.bulk-checkbox:checked');
        const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            showToast('Please select at least one blog post.', 'error');
            return false;
        }

        return selectedIds;
    }

    // Bulk Delete - Non-AJAX Approach
    const bulkDeleteBtn = document.querySelector('.bulk-delete-btn');
    if (bulkDeleteBtn) {
        bulkDeleteBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const selectedIds = handleBulkAction();
            if (!selectedIds) return;

            // Hapus langsung tanpa konfirmasi
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = bulkDeleteBtn.dataset.route;

            // CSRF Token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;
            form.appendChild(csrfToken);

            // Method override
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            // Selected IDs
            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        });
    }

    // Select all checkbox functionality
    const selectAllCheckbox = document.getElementById('select-all');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function () {
            const checkboxes = document.querySelectorAll('.bulk-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    }

    // Update select all checkbox when individual checkboxes change
    const userCheckboxes = document.querySelectorAll('.bulk-checkbox');
    userCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const allChecked = document.querySelectorAll('.bulk-checkbox:checked').length === userCheckboxes.length;
            const someChecked = document.querySelectorAll('.bulk-checkbox:checked').length > 0;

            selectAllCheckbox.checked = allChecked;
            selectAllCheckbox.indeterminate = someChecked && !allChecked;
        });
    });
});