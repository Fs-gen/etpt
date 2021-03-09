// let base_url = "http://localhost/Gammara/";

// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable();
});
$(document).ready(function() {
    $('#dataTable1').DataTable();
});

flatpickr("#date", {
    enableTime: false,
    dateFormat: "d-m-Y"
});

flatpickr("#datetime", {
    enableTime: true,
    dateFormat: "d-m-Y H:i",
    time_24hr: true
});

// $('.imagePopup').magnificPopup({
//     type: 'image'
// });
// function deleteData(id, db) {
//     Swal.fire({
//         title: 'Data Ini Akan Dihapus?',
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Ya, Lanjutkan',
//         cancelButtonText: 'Batal'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             window.location.href = base_url + "Delete/hapus/" + id + "/" + db;
//         }
//     })
// }

// function resetPassword(id, akun) {
//     Swal.fire({
//         title: 'Yakin Akan Mereset Password ' + akun + ' ?',
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Ya, Lanjutkan',
//         cancelButtonText: 'Batal'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             window.location.href = base_url + "home/resetPassword/" + id;
//         }
//     })
// }


// function customSwitch(method) {
//     $.ajax({
//         type: 'POST',
//         dataType: 'JSON',
//         url: base_url + 'home/' + method,
//         success: function (result) {
//             // console.log(result.status)
//         }
//     })
// }

// function customSwitchUser(method, id) {
//     $.ajax({
//         type: 'POST',
//         dataType: 'JSON',
//         url: base_url + 'home/' + method + '/' + id,
//         success: function (result) {
//             // console.log(result.status)
//         }
//     })
// }