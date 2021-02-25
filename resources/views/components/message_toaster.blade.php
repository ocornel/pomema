<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        if ("{{Session::get('success')}}".length > 0) {
            toast("{{Session::get('success')}}", 'success');
        }

        if ("{{Session::get('error')}}".length > 0) {
            toast("{{Session::get('error')}}", 'error');
            console.error('{{Session::get('error')}}')
        }

        if ('{{Session::get('hidden_error')}}'.length > 0) {
            console.error('{{Session::get('hidden_error')}}')
        }

        if ('{{Session::get('message')}}'.length > 0) {
            toast("{{Session::get('message')}}", 'info');
        }

        {{--if ('{{Session::get('message1')}}'.length > 0) {--}}
        {{--    note("{{Session::get('message1')}}");--}}
        {{--}--}}

        {{--if ('{{Session::get('message2')}}'.length > 0) {--}}
        {{--    note("{{Session::get('message2')}}");--}}
        {{--}--}}

        {{--if ('{{Session::get('message3')}}'.length > 0) {--}}
        {{--    note("{{Session::get('message3')}}");--}}
        {{--}--}}
    });

    function toast(message, status) {
        console.log(message);
        template = '<div id="toast-container" class="toast-top-right"><div class="toast toast-'+status+'" aria-live="polite" style="display: block; opacity: 0.9;"><div class="toast-progress" style="width: 100%;"></div><button type="button" class="toast-close-button" role="button"></button><div class="toast-title">'+status+'</div><div class="toast-message">'+message+'</div></div></div>';
        document.getElementById('toaster').innerHTML = template;
        setInterval(function() {
            document.getElementById('toaster').innerHTML = '';
        }, 5000);
    }
</script>

{{Session::forget('message','success','error','hidden_error','message1','message2')}}
{{ Session::save() }}
