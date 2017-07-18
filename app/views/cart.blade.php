@extends('layout.main')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    @if(count($cartItems) > 0)
        <table>
            <thead>
                <tr>
                    <th>nazwa</th>
                    <th>ilość</th>
                    <th>akcja</th>
                </tr>
            </thead>
            @foreach($cartItems as $cartItem)
                <tr>
                    <td>{{{$cartItem->product->name}}}</td>
                    <td>{{{$cartItem->quantity}}}</td>
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
        </table>
    @endif
@stop
