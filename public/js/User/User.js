
// Function to toggle checkbox state and handle row click
function toggleCheckboxAndRow(event) {
     var checkbox = event.target.closest('tr').querySelector('input[type="checkbox"]');
     checkbox.checked = !checkbox.checked;
 }

 // Event listener for row clicks
 document.querySelectorAll('tbody tr').forEach(function(row) {
     row.addEventListener('click', function(event) {
         // Check if the click was not on an anchor tag to avoid interfering with link clicks
         if (event.target.tagName !== 'A') {
             toggleCheckboxAndRow(event);
         }
     });
 });

 // Event listener for checkbox clicks
 document.querySelectorAll('tbody tr input[type="checkbox"]').forEach(function(checkbox) {
     checkbox.addEventListener('click', function(event) {
         event.stopPropagation(); // Prevent row click event from triggering
     });
 });

 // Event listener for Select All checkbox
 document.getElementById('selectAll').addEventListener('change', function() {
     var checkboxes = document.getElementsByName('selected_users[]');
     checkboxes.forEach(function(checkbox) {
         checkbox.checked = document.getElementById('selectAll').checked;
     });
 });
 document.querySelectorAll('.view-details').forEach(function(link) {
     link.addEventListener('click', function(event) {
         event.preventDefault();
         var userId = link.getAttribute('data-id');
         fetch('/users/' + userId)
             .then(response => response.text())
             .then(data => {
                 document.getElementById('userDetailsContent').innerHTML = data;
                 document.getElementById('userDetailsModal').classList.remove('hidden');
             })
             .catch(error => console.error('Error:', error));
     });
 });

 document.getElementById('deleteSelected').addEventListener('click', function() {
     var selectedUsers = document.querySelectorAll('input[name="selected_users[]"]:checked');
     var userIds = [];
     selectedUsers.forEach(function(checkbox) {
         userIds.push(checkbox.value);
     });

     if (userIds.length > 0 && confirm('Are you sure you want to delete selected users?')) {
         fetch('/users/bulk-delete', {
             method: 'POST',
             headers: {
                 'Content-Type': 'application/json',
                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
             },
             body: JSON.stringify({ user_ids: userIds })
         })
         .then(response => {
             if (response.ok) {
                 location.reload();
             } else {
                 console.error('Error:', response.statusText);
             }
         })
         .catch(error => console.error('Error:', error));
     } else {
         alert('Please select at least one user to delete.');
     }
 });

 document.querySelectorAll('.edit-details').forEach(function(link) {
     link.addEventListener('click', function(event) {
         event.preventDefault();
         var userId = link.getAttribute('data-id');
         fetch('/users/' + userId + '/edit')
             .then(response => response.text())
             .then(data => {
                 document.getElementById('userDetailsContent').innerHTML = data;
                 document.getElementById('userDetailsModal').classList.remove('hidden');
             })
             .catch(error => console.error('Error:', error));
     });
 });

 document.getElementById('closeModal').addEventListener('click', function() {
     document.getElementById('userDetailsModal').classList.add('hidden');
 });

 document.getElementById('exportButton').addEventListener('click', function() {
     document.getElementById('userForm').submit();
 });

 document.querySelectorAll('.delete-user').forEach(function(button) {
     button.addEventListener('click', function(event) {
         event.preventDefault();
         var userId = button.getAttribute('data-id');
         if (confirm('Are you sure you want to delete this user?')) {
             fetch('/users/' + userId, {
                 method: 'DELETE',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                 }
             })
             .then(response => {
                 if (response.ok) {
                     // Reload the page or update the user list
                     location.reload();
                 } else {
                     console.error('Error:', response.statusText);
                 }
             })
             .catch(error => console.error('Error:', error));
         }
     });
 });

