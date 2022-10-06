<h1>Test-2</h1>

<h2>Hello @{{$name}}</h2>


@if ($id == -1)
<p>-1 az id, tehát nincs megadva vagy -1</p>
@elseif ($id == 1)
<p>Az id az pont 1</p>
@else
<p>Nem -1 és nem is 1, tehát meg van adva az $id, de nem 1</p>
@endif

@each('sub-test', $toIterate, 'element')

