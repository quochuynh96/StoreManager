<div class="row">
<div class="col-md-8">
        Tên mặt hàng : <input type="text" id="name" name="name" placeholder=" Tên mặt hàng..." value="{{$goods->name}}">
        Link hình ảnh : <input type="text" id="image" name="image" placeholder=" Hình ảnh đại diện..." value="{{$goods->image}}">
        Chi tiết sản phẩm : <input type="text" id="detail" name="detail" placeholder=" Chi tiết sản phẩm..." value="{{$goods->detail}}">
        Số lượng nhập : <input type="number" id="num" name="num" placeholder=" Số lượng nhập vào..." value="{{$goods->num}}">
        Giá : <input type="number" id="price" name="price" placeholder=" Giá..." value="{{$goods->price}}">
        <br><br><center><button id="btnAddGoods" type="button" class="btn btn-success">Tiến hành nhập</button></center>
        <br><center><div id="notification"></div></center>
</div>
<div class="col-md-4">
    <div id='goods-image'><img width="100%" height="auto" src="{{$goods->image}}" alt="#"></div>
</div>
</div>
<script>
    $(document).ready(function () {
        $('#btnAddGoods').click(function (e) { 
				var name = $('#name').val();
				var image = $('#image').val();
				var detail = $('#detail').val();
				var num = $('#num').val();
				var price = $('#price').val();
				$.get("{{ route('addGoods') }}", 
					{
						name : name,
						image : image,
						detail : detail,
						num : num,
						price : price
					}
					,function (data, textStatus, jqXHR) {
						$('#notification').html(data);
						$("#notification").slideDown();
						if(data.indexOf("tự động") != -1)
						setTimeout(function(){ window.location = "{{ route('getManager') }}";}, 3000)
						}
				);
			});
    });
</script>