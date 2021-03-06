@extends('layouts.app')

@section('title', 'Pagos')

@section('breadcrumbs')
    <strong>/</strong> Pagos
@endsection

@section('content')
    <div>
        <form action="{{ url('/pagos') }}" method="POST">
            @csrf
            $ <input type="number" name="amount" id="amount" placeholder="Monto" autofocus>
            <button>Crear pago</button>
        </form>
    </div>
    @if(!$payments->isEmpty())
        <table>
            <tr>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Estado</th>
            </tr>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->created_at }}</td>
                    <td>${{ number_format($payment->total, 0, ',', '.') }}</td>
                    <td>{{ $payment->status }}</td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
