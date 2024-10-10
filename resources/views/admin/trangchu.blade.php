@extends('admin.layout.headerend')

@section('title', 'Trang Chủ')

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->   
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <!-- <h3>150</h3> -->
                                <p>Đổi Mật Khẩu</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-key" style="font-size: 40px;"></i>
                            </div>
                            <a href="{{url('admin/changepassword')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
                                <p>Thư Liên Hệ</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-address-book"  style="font-size: 40px;"></i>
                            </div>
                            <a href="{{url('admin/quanlinhantin')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <!-- <div class="col-lg-3 col-6"> -->
                        <!-- small box -->
                        <!-- <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>
    
                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> -->
                    <!-- ./col -->
                    <!-- <div class="col-lg-3 col-6"> -->
                        <!-- small box -->
                        <!-- <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>
    
                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> -->
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Thống Kê truy cập
                                </h3>
                            </div><!-- /.card-header -->
                                <div class="row m-2">
                                    <div class="col-sm-12">
                                            <form action="{{ url('admin/trang-chu')}}" id="thongke" method="get">
    
                                                <div class="store-sort">
    
                                                    <label style="margin-right:50px">
                                                        <h3>Ngày Hiện Tại</h3>
                                                    </label>
    
                                                    <label>
                                                        Lọc Theo:
                                                        <select class="input-select thongke" name="gia_tri"
                                                            onchange="submitForm1()">
                                                            <!-- <option>--Chọn--</option> -->
                                                            <option {{ request('gia_tri')=='7day' ? 'selected' :'' }}
                                                                value="7day">7 ngày qua</option>
                                                            <option {{ request('gia_tri')=='30day' ? 'selected' :'' }}
                                                                value="30day">tháng này</option>
                                                            <!-- <option {{ request('gia_tri')=='1year' ? 'selected' :'' }}
                                                                value="1year">trong năm</option> -->
                                                        </select>
                                                    </label>
                                                </div>
                                            </form>
                                        </div>
                                </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <!-- Biểu Đồ Thống kê -->
                                    <div id="myfirstchart" style="height: 300px;"></div>
                                    <br>
                                </div>
                                <div class="chart_name d-flex text-center align-items-center ">
                                    <h3><b>Biểu đồ: </b> </h3>Thống kê truy cập
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @if(session('success'))
    <div class="modal" id="successModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success">Đăng Nhập Thành Công</h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button id="confirmDelete" type="button" class="btn btn-success" data-dismiss="modal" onclick="closeModal()">OK</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('javascript')
<script>

    // Function to open the modal
    function openModal() {
    document.getElementById("successModal").style.display = "block";
    }

    // Function to close the modal
    function closeModal() {
    document.getElementById("successModal").style.display = "none";
    }
    setTimeout(openModal, 1000); // Open modal after 1 second (adjust as needed)

    function submitForm1(){
        document.getElementById('thongke').submit();
    }



    // lấy api dữ liệu người dùng từ gg analytics
    var chart ="";
    var analyticsData = <?php echo json_encode($modifiedData); ?>;
    const datasave = [];
    for (let i = 0; i < analyticsData.length; i++) {
        datasave.push({
                    date: analyticsData[i].date,
                    activeUsers: analyticsData[i].activeUsers,
                    screenPageViews: analyticsData[i].screenPageViews
                });
            }

    chart = new Morris.Line({
                element: 'myfirstchart',
                parseTime: true,
                hideHover: 'auto',
                data: datasave,
                xkey: ['date'],
                ykeys: ['screenPageViews'],
                labels: [ 'Tổng số lượt truy cập page: '],
                dateFormat: function(x) {
                    return new Date(x).toLocaleDateString();
                }
            });

</script>

@endsection