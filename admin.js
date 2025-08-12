// Fungsi untuk mengambil data booking dari database dan menampilkannya di tabel admin
async function fetchBookings() {
    try {
        // Mengambil data booking dari server melalui fetch_data.php
        const response = await fetch('fetch_data.php');
        if (!response.ok) throw new Error('Network response was not ok');
        const bookings = await response.json();
        renderBookings(bookings); // Menampilkan data ke tabel
    } catch (error) {
        console.error('Error fetching bookings:', error);
    }
}

// Fungsi untuk menampilkan data booking ke dalam tabel admin
function renderBookings(bookings) {
    const tableBody = document.getElementById("bookingTable").getElementsByTagName("tbody")[0];
    tableBody.innerHTML = ""; // Membersihkan tabel sebelum menambahkan data baru

    // Iterasi setiap booking dan tambahkan ke tabel
    bookings.forEach((booking) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${booking.user}</td>
            <td>${booking.date}</td>
            <td>${booking.start_time}</td>
            <td>${booking.end_time}</td>
            <td>${booking.whatsapp}</td>
            <td>${booking.keterangan}</td>
            <td>${booking.upload_file ?
                `<a href="uploads/${booking.upload_file}" target="_blank">Lihat File</a>` :
                "Tidak ada file"}</td>
            <td class="${booking.status === 'Pending' ? 'status-pending' : ''}">${booking.status}</td>
            <td>
                <button class="btn btn-approve" onclick="updateStatus(${booking.id}, 'Approved')">Setuju</button>
                <button class="btn btn-reject" onclick="updateStatus(${booking.id}, 'Rejected')">Tolak</button>
                <button class="btn btn-delete" onclick="deleteBooking(${booking.id})">Hapus</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

// Fungsi untuk mengupdate status booking (Setuju/Tolak) berdasarkan ID booking
async function updateStatus(id, status) {
    try {
        // Mengirim permintaan update status ke server (update_status.php)
        const response = await fetch('update_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id, status })
        });

        if (!response.ok) throw new Error('Network response was not ok');
        const result = await response.json();
        if (result.success) {
            fetchBookings(); // Refresh data booking setelah update
        } else {
            alert('Error updating status');
        }
    } catch (error) {
        console.error('Error updating status:', error);
        alert('Error updating status');
    }
}

// Fungsi untuk menghapus booking berdasarkan ID
async function deleteBooking(id) {
    // Konfirmasi sebelum menghapus
    if (confirm('Apakah Anda yakin ingin menghapus booking ini?')) {
        try {
            // Mengirim permintaan hapus ke server (delete_booking.php)
            const response = await fetch('delete_booking.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id })
            });

            if (!response.ok) throw new Error('Network response was not ok');
            const result = await response.json();
            if (result.success) {
                fetchBookings(); // Refresh data booking setelah dihapus
                alert('Booking berhasil dihapus');
            } else {
                alert('Error menghapus booking');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error menghapus booking');
        }
    }
}

// Memanggil fungsi fetchBookings() saat halaman dimuat untuk menampilkan data booking
fetchBookings();


// Fungsi untuk mengambil data booking yang sudah disetujui dan menampilkannya di tabel "DISETUJUI"
async function fetchApprovedBookings() {
    try {
        // Mengambil data booking yang sudah disetujui dari server
        const response = await fetch('fetch_approved.php');
        const bookings = await response.json();
        renderApprovedBookings(bookings); // Menampilkan data ke tabel
    } catch (error) {
        console.error('Error fetching bookings:', error);
    }
}

// Fungsi untuk menampilkan data booking yang sudah disetujui ke tabel "DISETUJUI"
function renderApprovedBookings(bookings) {
    const tableBody = document.getElementById("approvedTable").getElementsByTagName("tbody")[0];
    tableBody.innerHTML = "";

    bookings.forEach((booking) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${booking.date}</td>
            <td>${booking.start_time}</td>
            <td>${booking.end_time}</td>
            <td>${booking.keterangan}</td>
            <td>${booking.user}</td>
            <td>${booking.upload_file ?
                `<a href="uploads/${booking.upload_file}" target="_blank">Lihat File</a>` :
                "Tidak ada file"}</td>
        `;
        tableBody.appendChild(row);
    });
}

// Memanggil fungsi fetchApprovedBookings() saat halaman dimuat untuk menampilkan data yang sudah disetujui
fetchApprovedBookings();