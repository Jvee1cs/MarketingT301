// Link.js

document.addEventListener('DOMContentLoaded', function () {
    // Select all toggle buttons
    const toggleButtons = document.querySelectorAll('.toggle-btn');

    // Loop through each toggle button
    toggleButtons.forEach(button => {
        // Add click event listener
        button.addEventListener('click', function (event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Retrieve the link ID and current status from data attributes
            const linkId = this.getAttribute('data-id');
            const currentStatus = this.getAttribute('data-status');

            // Determine the new status based on the current status
            const newStatus = currentStatus === 'Active' ? 'Inactive' : 'Active';

            // Send an AJAX request to update the link status
            fetch(this.getAttribute('href'), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    status: newStatus
                })
            })
            .then(response => {
                // Check if the request was successful
                if (response.ok) {
                    // Update the button text and status indicator
                    this.textContent = newStatus === 'Active' ? 'Deactivate' : 'Activate';
                    const statusSpan = document.getElementById(`status_${linkId}`);
                    statusSpan.textContent = newStatus;
                    statusSpan.classList.remove(newStatus === 'Active' ? 'text-red-500' : 'text-green-500');
                    statusSpan.classList.add(newStatus === 'Active' ? 'text-green-500' : 'text-red-500');
                    // Update the data-status attribute
                    this.setAttribute('data-status', newStatus);
                } else {
                    // Handle errors
                    console.error('Error updating link status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
