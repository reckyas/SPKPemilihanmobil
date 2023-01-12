const btn_submit_bandingkan = document.getElementById(
    "button_submit_badingkan"
);
btn_submit_bandingkan.classList.add("hidden");
const checkboxmobil = document.getElementsByName("mobil[]");
const form_pilihan_mobil = document.getElementById("form_pilihan_mobil");
form_pilihan_mobil.addEventListener("submit", (e) => {
    e.preventDefault();
    if (checkIfHasValue(checkboxmobil)) {
        e.target.submit();
        btn_submit_bandingkan.classList.remove("hidden");
    }
});
for (let i = 0; i < checkboxmobil.length; i++) {
    const mobil = checkboxmobil[i];
    mobil.addEventListener("click", (e) => {
        if (checkIfHasValue(checkboxmobil)) {
            btn_submit_bandingkan.classList.remove("hidden");
        } else {
            btn_submit_bandingkan.classList.add("hidden");
        }
    });
}
function checkIfHasValue(data) {
    let status;
    for (let i = 0; i < data.length; i++) {
        const mobil = data[i];
        if (mobil.checked) {
            status = true;
            break;
        } else {
            status = false;
        }
    }
    return status;
}
