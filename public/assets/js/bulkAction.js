document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk menangani bulk actions
    function handleBulkAction(action) {
        const selectedCheckboxes = document.querySelectorAll('input[type="checkbox"][name="selected_users[]"]:checked');
        const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            alert('Please select at least one item.');
            return false;
        }

        return selectedIds;
    }

    // Bulk Delete
    const bulkDeleteBtn = document.querySelector('.bulk-delete-btn');
    if (bulkDeleteBtn) {
        bulkDeleteBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const selectedIds = handleBulkAction('delete');
            if (!selectedIds) return;

            if (confirm(`Are you sure you want to delete ${selectedIds.length} selected items?`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = bulkDeleteBtn.dataset.route;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;
                form.appendChild(csrfToken);

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                selectedIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'selected_users[]';
                    input.value = id;
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Bulk Export (contoh action lain)
    const bulkExportBtn = document.querySelector('.bulk-export-btn');
    if (bulkExportBtn) {
        bulkExportBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const selectedIds = handleBulkAction('export');
            if (!selectedIds) return;

            // Redirect ke route export dengan parameter
            window.location.href = `${bulkExportBtn.dataset.route}?selected=${selectedIds.join(',')}`;
        });
    }

    // Select all checkbox functionality
    const selectAllCheckbox = document.getElementById('select-all');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function () {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name="selected_users[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    }
});