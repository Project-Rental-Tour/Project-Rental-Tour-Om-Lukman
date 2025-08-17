document.addEventListener('DOMContentLoaded', function () {
    // Format salary input on both create and edit forms
    const formatSalaryInput = (input) => {
        const cursorPosition = input.selectionStart;
        const originalValue = input.value;

        // Remove all formatting
        let numericValue = originalValue.replace(/[^\d]/g, '');

        // Format only if there's a value
        if (numericValue.length > 0) {
            numericValue = parseInt(numericValue, 10).toLocaleString('id-ID');
        }

        // Update the input value
        input.value = numericValue;

        // Restore cursor position
        const dotCount = (input.value.match(/\./g) || []).length;
        const originalDotCount = (originalValue.match(/\./g) || []).length;
        const dotDiff = dotCount - originalDotCount;
        let newCursorPosition = cursorPosition + dotDiff;
        newCursorPosition = Math.max(0, Math.min(newCursorPosition, input.value.length));
        input.setSelectionRange(newCursorPosition, newCursorPosition);
    };

    // Handle both create and edit forms
    document.querySelectorAll('input[name="salary"]').forEach(input => {
        // Format initial value if exists
        if (input.value) {
            formatSalaryInput(input);
        }

        // Format on input
        input.addEventListener('input', function () {
            formatSalaryInput(this);
        });
    });

    // Form submission handling
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (e) {
            const salaryInput = this.querySelector('input[name="salary"]');
            if (salaryInput) {
                // Create a hidden input with the raw value
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'salary_raw';
                hiddenInput.value = salaryInput.value.replace(/[^\d]/g, '');
                this.appendChild(hiddenInput);
            }
        });
    });
});