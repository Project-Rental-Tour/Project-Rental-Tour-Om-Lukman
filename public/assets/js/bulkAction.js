document.addEventListener('DOMContentLoaded', function () {
    
    // 1. Logic Select All Checkbox
    const selectAllCheckbox = document.getElementById('select-all');
    const itemCheckboxes = document.querySelectorAll('.bulk-checkbox');

    if (selectAllCheckbox) {
        // Toggle all checkboxes
        selectAllCheckbox.addEventListener('change', function () {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Update 'Select All' status based on individual checkboxes
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

    // 3. Handle Bulk Action Buttons (Delete & Compress)
    const actionButtons = document.querySelectorAll('.bulk-action-btn');

    actionButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const route = this.dataset.route;
            const method = this.dataset.method || 'POST'; // Default POST (dipakai untuk compress)
            const confirmMessage = this.dataset.confirmMessage || 'Are you sure?';
            const ids = getSelectedIds();

            // Validasi Client Side: Harus ada item yang dipilih
            if (ids.length === 0) {
                alert('Please select at least one item.');
                return;
            }

            // Konfirmasi Aksi
            if (!confirm(confirmMessage)) {
                return;
            }

            // --- STRATEGI 1: Form Submit (Khusus DELETE) ---
            if (method === 'DELETE') {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = route;

                // CSRF Token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;
                form.appendChild(csrfToken);

                // Method Override (untuk DELETE)
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                // Input IDs
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
                        'Accept': 'application/json', // PENTING: Meminta JSON dari Laravel
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ ids: ids })
                })
                .then(async response => {
                    const isJson = response.headers.get('content-type')?.includes('application/json');
                    const data = isJson ? await response.json() : null;

                    // 1. Handle Validasi Error (422)
                    if (response.status === 422) {
                        console.error("Validation Error:", data); 
                        let errorMsg = data.message || "Validation Failed";
                        if (data.errors && Object.keys(data.errors).length > 0) {
                            const firstKey = Object.keys(data.errors)[0];
                            errorMsg += "\nDetails: " + data.errors[firstKey][0];
                        }
                        throw new Error(errorMsg);
                    }

                    // 2. Handle Server Error (500, 404, etc)
                    if (!response.ok) {
                        const text = data ? JSON.stringify(data) : await response.text();
                        console.error("Server Error Response:", text);
                        throw new Error("Server Error: Check Browser Console (F12) for details.");
                    }

                    return data;
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
                    alert(error.message); // Tampilkan pesan error spesifik
                    this.innerHTML = originalContent;
                    this.disabled = false;
                });
            }
        });
    });
});