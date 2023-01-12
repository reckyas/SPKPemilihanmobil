const btn_submit_bandingkan = document.getElementById(
    "button_submit_badingkan"
);
const checkboxmobil = document.getElementsByName("mobil[]");
const form_pilihan_mobil = document.getElementById("form_pilihan_mobil");
form_pilihan_mobil.addEventListener("submit", (e) => {
    e.preventDefault();
    checkboxmobil.forEach((mobil) => {
        if (mobil.checked) {
            e.target.submit();
        }
    });
});
