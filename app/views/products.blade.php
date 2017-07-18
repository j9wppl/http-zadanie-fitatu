@extends('layout.main')
@section('content')
    @if(count($products) > 0)
        <table border="1">
            <thead>
                <tr>
                    <th>{{trans('nazwa')}}</th>
                    <th>{{trans('kategoria')}}</th>
                    <th>{{trans('cena netto')}}</th>
                    <th>{{trans('cena brutto')}}</th>
                    <th>{{trans('stawka VAT')}}</th>
                    <th>{{trans('akcja')}}</th>
                </tr>
            </thead>
            @foreach($products as $product)
                <tr>
                    <td>{{{$product->name}}}</td>
                    <td>{{{$product->category->name}}}</td>
                    <td>{{{$product->price_net}}}</td>
                    <td>{{{$product->price_gross}}}</td>
                    <td>{{{$product->tax->rate}}}</td>
                    <td>
                        <a href="{{ URL::route('add-to-cart', $product->id)}}">{{trans('dodaj do koszyka')}}</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        {{trans('Brak produktów.')}}
    @endif
@stop
