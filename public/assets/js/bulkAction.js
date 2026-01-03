document.addEventListener('DOMContentLoaded', function () {
    
    // 1. Logic Select All Checkbox
    const selectAllCheckbox = document.getElementById('select-all');
    // PERBAIKAN: Gunakan selector spesifik agar checkbox header tidak ikut dianggap sebagai item
    const itemCheckboxes = document.querySelectorAll('input[name="ids[]"]');

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function () {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const allChecked = document.querySelectorAll('input[name="ids[]"]:checked').length === itemCheckboxes.length;
                const someChecked = document.querySelectorAll('input[name="ids[]"]:checked').length > 0;
                
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = someChecked && !allChecked;
            });
        });
    }

    // 2. Helper: Get Selected IDs
    function getSelectedIds() {
        // PERBAIKAN: Hanya ambil checkbox yang punya name="ids[]"
        // Ini MENCEGAH nilai "on" dari header checkbox ikut terkirim
        return Array.from(document.querySelectorAll('input[name="ids[]"]:checked')).map(cb => cb.value);
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
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ ids: ids })
                })
                .then(async response => {
                    const isJson = response.headers.get('content-type')?.includes('application/json');
                    const data = isJson ? await response.json() : null;

                    if (response.status === 422) {
                        console.error("Validation Error:", data); 
                        let errorMsg = data.message || "Validation Failed";
                        if (data.errors && Object.keys(data.errors).length > 0) {
                            const firstKey = Object.keys(data.errors)[0];
                            errorMsg += "\nDetails: " + data.errors[firstKey][0];
                        }
                        throw new Error(errorMsg);
                    }

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
                    alert(error.message); 
                    this.innerHTML = originalContent;
                    this.disabled = false;
                });
            }
        });
    });
});