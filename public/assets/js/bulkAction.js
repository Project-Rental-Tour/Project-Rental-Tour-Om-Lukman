document.addEventListener('DOMContentLoaded', function () {
    
    // 1. Logic Select All Checkbox
    const selectAllCheckbox = document.getElementById('select-all');
    const itemCheckboxes = document.querySelectorAll('.bulk-checkbox');

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function () {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const allChecked = document.querySelectorAll('.bulk-checkbox:checked').length === itemCheckboxes.length;
                const someChecked = document.querySelectorAll('.bulk-checkbox:checked').length > 0;
                
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = someChecked && !allChecked;
            });
        });
    }

    // 2. Helper: Get Selected IDs
    function getSelectedIds() {
        return Array.from(document.querySelectorAll('.bulk-checkbox:checked')).map(cb => cb.value);
    }

    // 3. Handle Bulk Action Buttons
    const actionButtons = document.querySelectorAll('.bulk-action-btn');

    actionButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const route = this.dataset.route;
            const method = this.dataset.method || 'POST'; 
            const confirmMessage = this.dataset.confirmMessage || 'Are you sure?';
            const ids = getSelectedIds();

            if (ids.length === 0) {
                alert('Please select at least one item.');
                return;
            }

            if (!confirm(confirmMessage)) {
                return;
            }

            // --- STRATEGI 1: Form Submit (Khusus DELETE) ---
            if (method === 'DELETE') {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = route;

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

                ids.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'ids[]';
                    input.value = id;
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            } 
            
            // --- STRATEGI 2: AJAX Fetch (Khusus COMPRESS) ---
            else {
                const originalContent = this.innerHTML;
                this.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Processing...';
                this.disabled = true;

                fetch(route, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json', // Meminta server return JSON
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ ids: ids })
                })
                .then(async response => {
                    // Cek apakah response sukses (Status 200-299)
                    const isJson = response.headers.get('content-type')?.includes('application/json');
                    
                    if (isJson) {
                        return response.json();
                    } else {
                        // Jika bukan JSON (biasanya HTML Error dari Laravel)
                        const text = await response.text();
                        console.error("SERVER ERROR RESPONSE:", text); // Cek Console Browser (F12) untuk detail
                        throw new Error("Server Error: Cek Console Browser untuk detail.");
                    }
                })
                .then(data => {
                    if (data.success) {
                        window.location.reload(); 
                    } else {
                        alert('Action failed: ' + (data.message || 'Unknown error'));
                        this.innerHTML = originalContent;
                        this.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('JS Error:', error);
                    alert(error.message || 'An error occurred while processing your request.');
                    this.innerHTML = originalContent;
                    this.disabled = false;
                });
            }
        });
    });
});