<!DOCTYPE html>
<html >


<head>
    <title>MessangerBot</title>

</head>


<body>
<div id="inizio" class="center">
    {{ Form::open(array('url' => route('broadcast', $message), 'method' => 'POST')) }}
        {{ Form::text('rate', '', array('placeholder' => 'messaggio broadcast')) }}
        {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}


</div>
</body>
<footer>

</footer>
</html>
