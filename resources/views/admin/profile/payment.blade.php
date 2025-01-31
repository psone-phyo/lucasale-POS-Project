@extends('admin.layout.master')

@section('content')
<div class="row d-flex">
    <div class="col-3">
                <!-- DataTales Example -->
        <div class="card shadow mb-4 ">
            <div class="card-header py-3 ">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Add Category Page</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Drinks...">
                </div>

                <input type="submit" value="Create" class="btn btn-primary">
            </div>
        </div>
    </div>
    <div class="col">
        <!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between">
            <div class="">
                <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
            </div>
            <div class="">
                <a href=""><i class="fa-solid fa-plus"></i> Add Category</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                    <tr>
                        <td>Garrett Winters</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>63</td>
                        <td>2011/07/25</td>
                        <td>$170,750</td>
                    </tr>
                    <tr>
                        <td>Ashton Cox</td>
                        <td>Junior Technical Author</td>
                        <td>San Francisco</td>
                        <td>66</td>
                        <td>2009/01/12</td>
                        <td>$86,000</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
    </div>
</div>
@endsection
