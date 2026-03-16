function loadAccount() {
    fetch('../Admin/akun.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('akun-container').innerHTML = data;
        });
}
document.addEventListener('DOMContentLoaded', loadAccount);