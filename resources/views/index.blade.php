@extends('page')
@section('body')
    <h1 id="demo"></h1>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">Tạo</button>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody id="content">
        @if(!($customers == null))
            @foreach($customers as $customer)
                <tr id="row_{{$customer->id}}">
                    <th scope="row">{{$customer->id}}</th>
                    <td id="customerName_{{$customer->id}}">{{$customer->name}}</td>
                    <td id="customerAddress_{{$customer->id}}">{{$customer->address}}</td>
                    <td id="customerPhone_{{$customer->id}}">{{$customer->phone}}</td>
                    <td>
                        <button type="button" class="btn btn-primary show" id="show_{{$customer->id}}" data-bs-toggle="modal" data-bs-target="#modal">Xem</button>
                        <button type="button" class="btn btn-secondary edit" id="edit_{{$customer->id}}" data-bs-toggle="modal" data-bs-target="#modal">Sửa</button>
                        <button type="button" class="btn btn-danger delete" id="delete_{{$customer->id}}" data-bs-toggle="modal" data-bs-target="#modal">Xóa</button>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <th colspan="5" class="text-center">Không có dữ liệu</th>
            </tr>
        @endif
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleAddCustomer">Thêm khách hàng</h5>
                    <h5 class="modal-title" id="titleEditCustomer">Sửa khách hàng</h5>
                    <h5 class="modal-title" id="titleShowCustomer">Thông tin khách hàng</h5>
                    <h5 class="modal-title" id="titleDeleteCustomer">Xóa khách hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="bodyAddAndEditCustomer">
                        <input type="text" name="idCustomer" id="idCustomer" value="" hidden>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="nameCustomer" id="nameCustomer" placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="addressCustomer" id="addressCustomer" placeholder="Address">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" id="phoneCustomer" name="phoneCustomer" placeholder="phone">
                        </div>
                    </div>
                    <div id="bodyShowCustomer">
                        <h1>Created date:</h1>
                        <h3 class='text-primary border border-4 rounded p-3' id="showCustomerCreatedDate"></h3>
                        <h1>Name:</h1>
                        <h3 class='text-primary border border-4 rounded p-3' id="showCustomerName"></h3>
                        <h1>Address:</h1>
                        <h3 class='text-primary border border-4 rounded p-3' id="showCustomerAddress"></h3>
                        <h1>Phone:</h1>
                        <h4 class='text-primary border border-4 rounded p-3' id="showCustomerPhone"></h4>
                    </div>
                    <div id="bodyDeleteCustomer">
                        <h5>Bạn có chắc muốn xóa khách hàng có ID là:</h5>
                        <h4 class='text-primary border border-4 rounded p-3' id="nameCustomerDelete"></h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-success" id="btnAddCustomer">Thêm</button>
                    <button type="button" class="btn btn-success" id="btnUpdateCustomer">Lưu</button>
                    <button type="button" class="btn btn-danger" id="btnDeleteCustomer">Xóa</button>
                </div>
            </div>
        </div>
    </div>

@endsection
