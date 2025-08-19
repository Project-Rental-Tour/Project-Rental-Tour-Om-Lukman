// assets/js/destinationPriceFormatter.js
document.addEventListener('DOMContentLoaded', function () {
    // Format price input on both create and edit forms
    const formatPriceInput = (input) => {
        const cursorPosition = input.selectionStart;
        const originalValue = input.value;

        // Remove all formatting except numbers
        let numericValue = originalValue.replace(/[^\d]/g, '');

        // Format only if there's a value
        if (numericValue.length > 0) {
            // Convert to number and format with dots for thousands
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
    document.querySelectorAll('input[name="price"]').forEach(input => {
        // Format initial value if exists
        if (input.value) {
            // Convert numeric value to formatted string
            const numericValue = parseFloat(input.value) || 0;
            input.value = numericValue.toLocaleString('id-ID');
        }

        // Format on input
        input.addEventListener('input', function () {
            formatPriceInput(this);
        });

        // Format on focus (in case user pastes content)
        input.addEventListener('focus', function () {
            formatPriceInput(this);
        });

        // Format on blur (final formatting)
        input.addEventListener('blur', function () {
            formatPriceInput(this);
        });
    });

    // Form submission handling - convert formatted price back to number
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (e) {
            const priceInput = this.querySelector('input[name="price"]');
            if (priceInput) {
                // Remove formatting dots before submission
                const rawValue = priceInput.value.replace(/\./g, '');

                // Create a temporary input to set the raw value
                priceInput.value = rawValue;
            }
        });
    });

    // Handle modal show events to format existing prices
    document.querySelectorAll('[id^="edit-modal-"]').forEach(modal => {
        modal.addEventListener('show.bs.modal', function () {
            const destinationId = this.id.replace('edit-modal-', '');
            const priceInput = document.querySelector(`#edit-title-${destinationId}[name="price"]`);

            if (priceInput && priceInput.value) {
                const numericValue = parseFloat(priceInput.value) || 0;
                priceInput.value = numericValue.toLocaleString('id-ID');
            }
        });
    });
});