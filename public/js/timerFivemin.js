function mulaiHitungMundur(queueTimeMeTime, tanggalTujuan) {
    const hitungMundur = setInterval(function(){
        const sekarang = new Date().getTime();
        const selisih = tanggalTujuan - sekarang + queueTimeMeTime;

        const menit = Math.floor(selisih % (1000 * 60 * 60) / (1000 * 60));
        const detik = Math.floor(selisih % (1000 * 60) / 1000);

        const timer = document.getElementById('timer');
        timer.innerHTML = menit + ':' + detik;

        if (selisih <= 0) {
            clearInterval(hitungMundur);
            timer.innerHTML = 'Waktu habis';
        }
    }, 1000);
}

