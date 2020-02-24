@php
    $total = 0;
@endphp

<table class="table table-striped">
        <thead class="thead-light">
          <tr>
            <th scope="col">Tên mặt hàng</th>
            <th scope="col">Số lượng</th>
          </tr>
        </thead>
        <tbody>
@if(count($listGoods) > 0)
@foreach ($listGoods as $goods)
    @if(array_get($listCart,$goods->id) != null)
	<tr>
		<th scope="row">{{$goods->name}}</th>
        <td>{{array_get($listCart,$goods->id)}}</td>
        @php
            $total = $total + $goods->price * array_get($listCart,$goods->id);
        @endphp
    </tr>
    @endif
@endforeach
@else
Chưa có mặt hàng nào !
@endif
</tbody>
</table>
<hr>
<p class="text-success">Tổng thanh toán : </p><b> {{$total}} </b>