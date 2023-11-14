<link rel="stylesheet" href="/css/user/footer.css">

<footer>
    <div class="container">
        <a href="#" class="brand">Karsa Mini Soccer</a>
        <ul class="menu">
            <li>
                <a href="#">Kontak Kami</a>
            </li>
            <li>
                <a href="#">Kebijakan Privasi</a>
            </li>
            <li>
                <a href="#">Cara Booking</a>
            </li>
            <li>
                <a href="#">Pembayaran</a>
            </li>
            <li>
                <a href="#">Pembatalan</a>
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