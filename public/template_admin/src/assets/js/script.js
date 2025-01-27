// Search Functionality
document.getElementById("searchBar").addEventListener("input", function () {
    const query = this.value.toLowerCase();
    const rows = document.querySelectorAll("#beritaTable tr");
    rows.forEach((row) => {
        const title = row.cells[2]?.textContent.toLowerCase();
        const description = row.cells[3]?.textContent.toLowerCase();
        if (title?.includes(query) || description?.includes(query)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});

// Image Modal
function showImageModal(imageUrl) {
    document.getElementById("modalImage").src = imageUrl;
    const imageModal = new bootstrap.Modal(
        document.getElementById("imageModal")
    );
    imageModal.show();
}

// SweetAlert for Deletion
function confirmDeletion(url) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data ini akan dihapus secara permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

function previewImage(event, previewId) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function (e) {
        const preview = document.getElementById(previewId);
        preview.src = e.target.result;
        preview.style.display = "block";
    };
    if (file) {
        reader.readAsDataURL(file);
    }
}

function confirmDelete(id) {
    if (confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?")) {
        document.getElementById("delete-form-" + id).submit();
    }
}

document.addEventListener("DOMContentLoaded", function () {
    tinymce.init({
        selector: 'textarea[name="description"]',
        plugins: "image link media lists",
        toolbar:
            "undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        menubar: false,
        height: 300,
        images_upload_url: '{{ route("upload.image") }}',
        images_upload_credentials: true,
        automatic_uploads: true,
        file_picker_types: "image",
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement("input");
            input.setAttribute("type", "file");
            input.setAttribute("accept", "image/*");
            input.onchange = function () {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = function () {
                    var id = "blobid" + new Date().getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(",")[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
            };
            input.click();
        },
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Mengambil semua elemen dengan kelas 'notification'
    const notifications = document.querySelectorAll('.notification');

    notifications.forEach(function(notification) {
        notification.addEventListener('click', function() {
            // Menyembunyikan elemen yang di-klik
            notification.style.display = 'none';

            // Bisa ditambahkan logika untuk menghapus status dari backend jika perlu
            const notificationId = notification.getAttribute('data-id');
            markNotificationAsRead(notificationId);
        });
    });

    // Fungsi untuk mengirim status read ke server (optional)
    function markNotificationAsRead(notificationId) {
        // Lakukan Ajax request atau update status via fetch
        console.log('Notifikasi ' + notificationId + ' ditandai sebagai sudah dibaca');
        // Contoh menggunakan fetch (pastikan API yang sesuai tersedia di server Anda):
        /*
        fetch('/mark-notification-read', {
            method: 'POST',
            body: JSON.stringify({ id: notificationId }),
            headers: {
                'Content-Type': 'application/json'
            }
        });
        */
    }
});
