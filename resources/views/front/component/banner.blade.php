<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js"
        async>
    {
        "symbols"
    :
        [
            {
                "proName": "OANDA:SPX500USD",
                "title": "SP 500"
            },
            {
                "proName": "FX_IDC:XAUTRYG",
                "title": "Gram Altın"
            },
            {
                "proName": "FX_IDC:XAUTRY",
                "title": "Ons Altın"
            },
            {
                "proName": "BIST:XU100",
                "title": "BIST"
            },
            {
                "proName": "FX_IDC:EURUSD",
                "title": "EUR/USD"
            },
            {
                "proName": "BITSTAMP:BTCUSD",
                "title": "BTC/USD"
            },
            {
                "proName": "BITSTAMP:ETHUSD",
                "title": "ETH/USD"
            },

            {
                "proName": "FX_IDC:EURTRY",
                "title": "EUR/TRY"
            },
            {
                "proName": "FX_IDC:USDTRY",
                "title": "USD/TRY"
            }
        ],
            "colorTheme"
    :
        "light",
            "isTransparent"
    :
        false,
            "displayMode"
    :
        "adaptive",
            "locale"
    :
        "tr"
    }
</script>
<div class="flash-news-banner">
    <div class="container">
        <div class="d-lg-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <span class="badge badge-dark mr-3">Flash news</span>
                <marquee>
                    <p class="mb-0">
                        Haber Akışları Borsa Durumu Ve Hava Durumu Bilgileri Burada Gösterilecektir!
                    </p>
                </marquee>

            </div>
            <div class="d-flex">
                <span class="">Hava Durumu <span class="text-danger">{{$status_weather}}</span> Sıcaklık <span
                        class="text-danger">{{$temp}}°C</span>   Şehir <span
                        class="text-danger">{{$city_name}}</span></span>
            </div>
        </div>
    </div>
</div>

