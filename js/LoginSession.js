// Fungsi untuk memeriksa status login
function checkLoginStatus() {
    const userName = localStorage.getItem('userName'); // Mengambil nama pengguna dari localStorage
    const loginButton = document.querySelector('.btn-login'); // Menemukan tombol login

    if (userName) {
        // Jika pengguna sudah login, ubah teks tombol login
        loginButton.innerHTML = `<i class="fas fa-user"></i> ${userName}`; // Mengubah teks tombol
        loginButton.href = 'profile.html'; // Mengarahkan ke halaman profil
    }
}

// Panggil fungsi saat halaman dimuat
document.addEventListener('DOMContentLoaded', checkLoginStatus);

// Contoh fungsi login
function login() {
    const userName = 'NamaPengguna'; // Ganti dengan nama pengguna yang sebenarnya
    localStorage.setItem('userName', userName); // Simpan nama pengguna
    // Lakukan proses login lainnya...
}