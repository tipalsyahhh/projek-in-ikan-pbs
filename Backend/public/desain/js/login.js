const successAlert = document.getElementById("success-alert");

// Cek apakah elemen pesan ada
if (successAlert) {
    // Setelah 10 detik, sembunyikan elemen pesan
    setTimeout(function () {
        successAlert.style.display = "none";
    }, 10000); // 10 detik
}

const signUpButton = document.getElementById('register');
const signInButton = document.getElementById('login');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
container.classList.remove("right-panel-active");
});

$(document).ready(function () {
    // Saat input berfokus
    $("#inputUsername").focus(function () {
        $(this).next(".input-label").addClass("active");
    });

    // Saat input kehilangan fokus
    $("#inputUsername").blur(function () {
        if (!$(this).val()) {
            $(this).next(".input-label").removeClass("active");
        }
    });
});
