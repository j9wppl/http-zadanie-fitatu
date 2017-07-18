@extends('layout.main')

@section('content')
    @if(count($cartItemsByTax) > 0)

            @foreach($cartItemsByTax as $taxId => $cartItems)
            <span style="color:red">{{$taxes[$taxId]}}</span>
            <table border="1">
                <thead>
                <tr>
                    <th>nazwa</th>
                    <th>cena brutto</th>
                    <th>ilość</th>
                    <th>wartość brutto</th>
                    <th>akcja</th>
                </tr>
                </thead>
                @foreach($cartItems as $cartItem)
                    <tr>
                        <td>{{{$cartItem->product}}}</td>
                        <td>{{{$cartItem->price_gross}}}</td>
                        <td>
                            {{{$cartItem->quantity}}}
                            <a href="{{ URL::route('add-to-cart', $cartItem->product_id)}}">{{trans('+')}}</a>
                            <a href="{{ URL::route('decrement-item', $cartItem->id)}}">{{trans('-')}}</a>
                        </td>
                        <td>{{{$cartItem->value_gross}}}</td>
                        <td>
                            {{ Form::open([
                                'method' => 'DELETE',
                                'class' => 'submit',
                                'route' =>['remove-from-cart', $cartItem->id],
                                'data-confirm' => trans('Usunąć?')])
                            }}
                            <input type="submit" value="{{trans('Usuń')}}">
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" style="text-align: right">{{trans('Suma')}}:&nbsp;{{$cartItems->totalGross()}}</td>
                </tr>

            </table>
            @endforeach
        <div>
            {{trans('Wartość całości')}}: {{$totalGross}}
        </div>
    @else
        {{trans('Koszyk jest pusty.')}}
    @endif
@stop
