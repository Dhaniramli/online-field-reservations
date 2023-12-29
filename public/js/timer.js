const tanggalTujuan = new Date('Dec 25, 2023 23:00:00').getTime();

const hitungMundur = setInterval(function(){
    
    const sekarang = new Date().getTime();
    const selisih = tanggalTujuan - sekarang;
    
    const hari = Math.floor(selisih / (1000 * 60 * 60 * 24));
    const jam = Math.floor(selisih % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
    const menit = Math.floor(selisih % (1000 * 60 * 60) / (1000 * 60));
    const detik = Math.floor(selisih % (1000 * 60) / 1000);
    
    const teks = document.getElementById('teks');
    teks.innerHTML = jam + ':' + menit + ':' + detik;

}, 1000);

// var countDownDate = new Date('Dec 25, 2023 23:00:00').getTime();

//         var x = setInterval(function() {
//             var now = new Date().getTime();
//             var distance = countDownDate - now;

//             var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//             var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//             var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//             var seconds = Math.floor((distance % (1000 * 60)) / 1000);

//             document.getElementById("timer").innerHTML = (days > 0 ? days + " hari " : "") +
//                 hours + " jam " +
//                 minutes + " menit " +
//                 seconds + " detik ";

//         }, 1000);