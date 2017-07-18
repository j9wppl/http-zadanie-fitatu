@extends('layout.main')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    @if(count($products) > 0)
        <table>
            <thead>
                <tr>
                    <th>nazwa</th>
                    <th>akcja</th>
                </tr>
            </thead>
            @foreach($products as $product)
                <tr>
                    <td>{{{$product->name}}}</td>
                    <td>
                        <a href="{{ URL::route('add-to-cart', $product->id)}}">{{trans('dodaj do koszyka')}} </a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
@stop
