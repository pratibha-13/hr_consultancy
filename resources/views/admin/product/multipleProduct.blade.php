<div>
    <table class="table table-striped">
        <thead>
                <tr class="table-head">
                    <th>Product Name</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Action</th>
                </tr>
        </thead>
        <tbody>

        @if(count($product)>0)
            @foreach ($product AS $item)
            @php
                $color = Helper::color($item['color_id']);
                $size = Helper::size($item['size_id']);
            @endphp
                <tr class="table-body">
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $color }}</td>
                    <td>{{ $size }}</td>
                    <td><button type="button" class="btn" data-toggle="modal" data-target="#myModal" onclick="getProduct($item['product_id'])">Edit</button>
                    <button type="button" class="btn" data-toggle="modal" data-target="#myModal">View</button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>