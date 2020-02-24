@php
    $total = 0;
@endphp
<div class="row">
    <div class="col-md-12 col-sm-12 col-12">
<table class="table table-striped">
        <thead class="thead-light">
          <tr>
            <th scope="col">Tên mặt hàng</th>
            <th scope="col">Số lượng</th>
          </tr>
        </thead>
        <tbody>
@if(count($listDetail) > 0)
@foreach ($listDetail as $detail)
	<tr>
		<th scope="row">
            @foreach ($listGoods as $goods)
            @if ($detail->idgoods == $goods->id)
                {{$goods->name}}
            @endif
            @endforeach
        </th>
        <td>
            {{$detail->num}}
        </td>
        @php
            $total = $total + $goods->price * $detail->num;
        @endphp
    </tr>
@endforeach
@else
Chưa có mặt hàng nào !
@endif
</tbody>
</table>
<hr>
<p class="text-success">Tổng thanh toán : <b> {{$total}} </b></p>
</div>
</div>