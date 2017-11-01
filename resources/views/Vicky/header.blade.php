<link href="{{ URL::asset('/vicky/css/header.css') }}" rel="stylesheet" type="text/css"/>

<header class="header">
    <div class="wrapper container">
        <nav>
            <a id="logo-maka" href="/">
                <h1 class="logo-title" style="display: none;">
                    Vicky
                </h1>
                <img class="logo"
                     src="{{ URL::asset('/vicky/img/logo.png') }}"
                     width="121" height="75" alt="Vicky">
            </a>
            {{--<ul class="nav ">--}}
                {{--<li class="active">--}}
                    {{--<a href="/">Home</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
            <div style="position: absolute;right: 20px;color: #fa9898;margin-top: 3px">
                Vicky, I have fallen in love with you for
                <div id="elapseClock"></div>
            </div>
        </nav>
    </div>
</header>

<script>

    var together = new Date();
    together.setFullYear(2016, 0, 26);
    together.setHours(12);
    together.setMinutes(0);
    together.setSeconds(0);
    together.setMilliseconds(0);

    timeElapse(together);

    setInterval(function () {
        timeElapse(together);
    }, 500);

    function timeElapse(c) {
        var e = Date();
        var f = (Date.parse(e) - Date.parse(c)) / 1000;
        var g = Math.floor(f / (3600 * 24));
        f = f % (3600 * 24);
        var b = Math.floor(f / 3600);
        if (b < 10) {
            b = "0" + b
        }
        f = f % 3600;
        var d = Math.floor(f / 60);
        if (d < 10) {
            d = "0" + d
        }
        f = f % 60;
        if (f < 10) {
            f = "0" + f
        }
        var a = '<span class="digit">' + g + '</span> days <span class="digit">' + b + '</span> hours <span class="digit">' + d + '</span> minutes <span class="digit">' + f + "</span> seconds";
        $("#elapseClock").html(a)
    }
</script>
