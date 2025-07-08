// Fungsi untuk mengambil data booking dari database
async function fetchBookings() {
    try {
        const response = await fetch('fetch_data.php');
        if (!response.ok) throw new Error('Network response was not ok');
        const bookings = await response.json();
        renderBookings(bookings);
    } catch (error) {
        console.error('Error fetching bookings:', error);
    }
}

// Fungsi untuk menampilkan data booking ke dalam tabel
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

// Fungsi untuk mengupdate status booking (Setuju/Tolak)
async function updateStatus(id, status) {
    try {
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
            fetchBookings();
        } else {
            alert('Error updating status');
        }
    } catch (error) {
        console.error('Error updating status:', error);
        alert('Error updating status');
    }
}

// Fungsi untuk menghapus booking
async function deleteBooking(id) {
    if (confirm('Apakah Anda yakin ingin menghapus booking ini?')) {
        try {
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
                fetchBookings();
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

fetchBookings();


async function fetchApprovedBookings() {
    try {
        const response = await fetch('fetch_approved.php');
        const bookings = await response.json();
        renderApprovedBookings(bookings);
    } catch (error) {
        console.error('Error fetching bookings:', error);
    }
}

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

fetchApprovedBookings();