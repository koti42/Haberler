<p>
    Sayın {{$user->name}} Bey,
</p>
<p>
    Bu Maili şifre sıfırlama talebiniz üzerine almaktasınız.
    <br>
    <br>
    Link İçin Geçerlilik Süresi {{$user->reset_password_expired}} Tarihin de Sona Erecektir.
    <br>
    <br>
    Lütfen Bu Süre İçerisin de Linki Kullanınız.
    <br>
    <br>
    <a href="{{route('reset.password2',$user->reset_password_token)}}">Şifremi Sıfırla</a>
</p>
