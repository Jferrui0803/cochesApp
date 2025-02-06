@extends('base')

@section('titulo', 'Paginacion')

@section('content')

<div class="d-flex">
  <form>
    <input type="hidden" value="{{$orderBy}}" name="orderBy">
    <input type="hidden" value="{{$orderType}}" name="orderType">
    <input type="hidden" value="{{$q}}" name="q">
    <select name="rpp" id="">
      @foreach($rpps as $index => $value)
        <option value="{{$value}}" @if($rpp == $value) selected @endif>{{$value}}</option>
      @endforeach
    </select>
    <button type="submit">ver</button>
  </form>
  <form class="mx-3">
    <input type="hidden" value="{{$orderBy}}" name="orderBy">
    <input type="hidden" value="{{$orderType}}" name="orderType">
    <input type="hidden" value="{{$rpp}}" name="rpp">
    <input type="search" name="q" placeholder="buscar" value="{{$q}}">
    <button type="submit">filtrar</button>
  </form>
</div>
<div class="table-responsive small">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
        <th scope="col">
            #
            <a href="{{route('index', ['orderBy' => 'c.id', 'orderType' => 'asc', 'q' => $q, 'rpp' => $rpp, ])}}"><svg class="bi"><use xlink:href="#down" /></svg></a>
            <a href="{{route('index', ['orderBy' => 'c.id', 'orderType' => 'desc', 'q' => $q, 'rpp' => $rpp, ])}}"><svg class="bi"><use xlink:href="#up" /></svg></a>
          </th>
          <th scope="col">
            marca
            <a href="{{route('index', ['orderBy' => 'c.marca', 'orderType' => 'asc', 'q' => $q, 'rpp' => $rpp, ])}}"><svg class="bi"><use xlink:href="#down" /></svg></a>
            <a href="{{route('index', ['orderBy' => 'c.marca', 'orderType' => 'desc', 'q' => $q, 'rpp' => $rpp, ])}}"><svg class="bi"><use xlink:href="#up" /></svg></a>
          </th>
          <th scope="col">
            modelo
            <a href="{{route('index', ['orderBy' => 'c.modelo', 'orderType' => 'asc', 'q' => $q, 'rpp' => $rpp, ])}}"><svg class="bi"><use xlink:href="#down" /></svg></a>
            <a href="{{route('index', ['orderBy' => 'c.modelo', 'orderType' => 'desc', 'q' => $q, 'rpp' => $rpp, ])}}"><svg class="bi"><use xlink:href="#up" /></svg></a>
          </th>
          <th scope="col">
            precio
            <a href="{{route('index', ['orderBy' => 'c.precio', 'orderType' => 'asc', 'q' => $q, 'rpp' => $rpp, ])}}"><svg class="bi"><use xlink:href="#down" /></svg></a>
            <a href="{{route('index', ['orderBy' => 'c.precio', 'orderType' => 'desc', 'q' => $q, 'rpp' => $rpp, ])}}"><svg class="bi"><use xlink:href="#up" /></svg></a>
          </th>
      </thead>
      <tbody>
        @foreach($coches as $coche)
            <tr>
                <td>{{ $coche->id }}</td>
                <td>
                  {{ $coche->marca }}
                </td>
                <td>
                  {{ $coche->modelo }}
                </td>
                <td>
                  {{ $coche->precio }}
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>
<div>
  {{ $coches->appends(['orderBy' => $orderBy, 'orderType' => $orderType, 'q' => $q, 'rpp' => $rpp])->onEachSide(2)->links() }}
</div>
@endsection