<link rel="stylesheet" href="iziToast.min.css">
<script src="iziToast.min.js" type="text/javascript"></script>

@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
       <!-- <div class="alert alert-danger">
            {{ $error }}   
        </div> --> 
        <script>
            $(document).ready(function(){
                    iziToast.show({
                        title: '',
                        icon: 'material-icons',
                        iconText: 'report_problem',
                        iconColor: '#d00d20',
                        position: 'topRight',
                        message: '<div style="font-size: 13px; font-family:"Signika",sans-serif">{{ $error }}</div>',
                        displayMode: 'once',
                        timeout: 3000,
                        color: 'red',
                        transitionIn: 'flipInX'
                    });
            });
        </script>
    @endforeach
@endif

@if (session('success'))
    <!-- <div class="alert alert-success">
        {{ session('success') }}
    </div> -->
    <script>
            $(document).ready(function(){
                    iziToast.success({
                        title: '',
                        icon: 'material-icons',
                        iconText: 'done_all',
                        iconColor: '#14b094',
                        position: 'bottomRight',
                        message: '<div style="font-size: 13px; font-family:"Signika",sans-serif">{{ session("success") }}</div>',
                        displayMode: 'once',
                        timeout: 3000
                    });
            });
    </script>
@endif

@if (session('error'))
    <!-- <div class="alert alert-danger">
        {{ session('error') }}
    </div> -->

    <script>
            $(document).ready(function(){
                    iziToast.warning({
                        title: '',
                        icon: 'material-icons',
                        iconText: 'report_problem',
                        iconColor: '#d00d20',
                        position: 'topRight',
                        message: '<div style="font-size: 13px; font-family:"Signika",sans-serif">{{ session("error") }}</div>',
                        displayMode: 'once',
                        timeout: 3000
                    });
            });
    </script>
@endif

{{-- <script>
    $(document).ready(function(){
        $('.alert').delay(3000).fadeOut(1000);
    });
</script>     --}}
