<script>

(function ($) {
        var _window = { w: window };

        function adjust_dfs(e) {
            var _fsx, _fsy, _fs, _adj, _n;

            // get the window dimensions
            _window.x = _window.w.innerWidth || _window.e.clientWidth || _window.g.clientWidth;
            _window.y = _window.w.innerHeight || _window.e.clientHeight || _window.g.clientHeight;

            // we get the "base font-size" by dividing into our "core" dimension on 1024x768 and multiplying
            // the result by 16 (initial font size for most 
            var _fsx = (_window.x / 1024) * 16;
            var _fsy = (_window.y / 768) * 16;

            // if width > height, then we get the average font size from width and height calculations
            // otherwise, if the width of the window is less than the height, we use the width based size
            var _fs = (_window.x > _window.y ? ((_fsx + _fsy) * 0.5) : _fsx );

            // our minimum base font-size should be 8px
            if (_fs < 10) {
                _fs = 10;
            }

            // our maximum base font-size should be 20px
            if (_fs > 30) {
                _fs = 30;
            }


            // we bring the decimal point down to two places, so our performance doesn't take a hit
            // when trying to calculate text at a size of 8.1294129836928352903862391em 
            _n = parseFloat(_fs, 10).toFixed(2);

            // setup the css definition object once
            _adj = {
                fontSize: _n + 'px'
            };

            // set the base font size onto our dfs class elements                
            $('.dfs').css(_adj);

        }

        // run once on load
        adjust_dfs();

        // run on window resize
        $(window).on('resize', adjust_dfs);

    })(jQuery);
    
</script>