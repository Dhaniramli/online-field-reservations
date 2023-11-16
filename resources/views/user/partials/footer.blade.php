<link rel="stylesheet" href="/css/user/footer.css">

<footer>
    <div class="container">
        <a href="#" class="brand">Karsa Mini Soccer</a>
        <ul class="menu">
            {{-- <li>
                <a href="/kontak-kami">Kontak Kami</a>
            </li> --}}
            <li>
                <a href="/kebijakan-privasi">Kebijakan Privasi</a>
            </li>
            <li>
                <a href="/cara-booking">Cara Booking</a>
            </li>
            <li>
                <a href="/pembayaran">Pembayaran</a>
            </li>
            <li>
                <a href="/pembatalan">Pembatalan</a>
            </li>
        </ul>

        <ul class="media-icons">
            <li>
                <a href="{{ $facebookLink ? $facebookLink->link : '#' }}">
                    <i class="fab fa-facebook"></i>
                </a>
            </li>
            <li>
                <a href="{{ $twitterLink ? $twitterLink->link : '#' }}">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
            <li>
                <a href="{{ $instagramLink ? $instagramLink->link : '#' }}">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
            <li>
                <a href="{{ $youtubeLink ? $youtubeLink->link : '#' }}">
                    <i class="fa-brands fa-youtube"></i>
                </a>
            </li>
            <li>
                <a href="{{ $linkedinLink ? $linkedinLink->link : '#' }}">
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
        </ul>
        <p>&copy; <a href="https://instagram.com/rdhani.rmli?igshid=OGQ5ZDc2ODk2ZA==">2023 Supported Developer By Rahmadani Ramli</a></p>
    </div>
</footer>