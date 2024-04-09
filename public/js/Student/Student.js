
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
    var checkboxes = document.getElementsByName('selected_students[]');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('selectAll').checked;
    });
});
document.querySelectorAll('.view-details').forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        var studentId = link.getAttribute('data-id');
        fetch('/students/' + studentId)
            .then(response => response.text())
            .then(data => {
                document.getElementById('studentDetailsContent').innerHTML = data;
                document.getElementById('studentDetailsModal').classList.remove('hidden');
            })
            .catch(error => console.error('Error:', error));
    });
});

document.getElementById('deleteSelected').addEventListener('click', function() {
    var selectedStudents = document.querySelectorAll('input[name="selected_students[]"]:checked');
    var studentIds = [];
    selectedStudents.forEach(function(checkbox) {
        studentIds.push(checkbox.value);
    });

    if (studentIds.length > 0 && confirm('Are you sure you want to delete selected students?')) {
        fetch('/students/bulk-delete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ student_ids: studentIds })
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
        alert('Please select at least one student to delete.');
    }
});

document.querySelectorAll('.edit-details').forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        var studentId = link.getAttribute('data-id');
        fetch('/students/' + studentId + '/edit')
            .then(response => response.text())
            .then(data => {
                document.getElementById('studentDetailsContent').innerHTML = data;
                document.getElementById('studentDetailsModal').classList.remove('hidden');
            })
            .catch(error => console.error('Error:', error));
    });
});

document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('studentDetailsModal').classList.add('hidden');
});

document.getElementById('exportButton').addEventListener('click', function() {
    document.getElementById('studentForm').submit();
});

document.querySelectorAll('.delete-student').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        var studentId = button.getAttribute('data-id');
        if (confirm('Are you sure you want to delete this student?')) {
            fetch('/students/' + studentId, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    // Reload the page or update the student list
                    location.reload();
                } else {
                    console.error('Error:', response.statusText);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
});
