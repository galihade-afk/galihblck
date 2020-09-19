
@extends('layouts.admin')
@section('content')
<section class="content">
    <a href="" class="btn btn-primary btn-md active mb-3 mt-3" data-toggle="modal" data-target="#addModal">
        <i class="fas far fa-image">&nbsp Add ToDo List</i>
    </a>  

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="cont"></div>
        </div>

        

        <div class="container mt-2 contain">
            <div class="ada">
            </div>
            <tr class="loading">
                <td colspan="7">
                    <div class="d-flex align-items-center text-primary">
                        <strong>Loading...</strong>
                        <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                    </div>
                </td>
            </tr>
        </div>

        
        <div class="master"></div>
        
       
        
        <!-- Pagination -->
            {{-- <div class="form-group row  mx-3 mt-2">
                <label class="control-label">Show</label>
                <div>
                    <select class="form-control show-qty">
                        <option value="5">5</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <label class="control-label col-md-3 col-sm-3 ">Entries</label>
            </div>
            <div class="row float-right mx-3">
                <div id="backward-js" class="backward"></div>
                <div id="previus-js" class="prev"></div>
                <div id="pagination-js" class="js">
                    <!-- data catergory insert after clone-->
                </div>
                <div id="next-js" class="next"> </div>
                <div id="forward-js" class="forrward"> </div>
            </div> --}}
        <!-- Pagination End -->
        {{-- <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Images</th>
                        <th>Description</th>
                        <th>Config</th>
                    </tr>
                </thead>
                <tbody id="list-data-todo">
                    <tr class="loading">
                        <td colspan="7">
                            <div class="d-flex align-items-center text-primary">
                                <strong>Loading...</strong>
                                <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- data catergory insert after clone-->
                    
                </tbody>
            </table>
            <table class="text-center">
                <tr id="master-todo" style="display:none">
                    <td class="todo-id"></td>
                    <td class="todo-title"></td>
                    <td class="todo-date reminder"></td>
                    <td>
                        <img src="" class="img-thumbnail mt-2 image-todo" width="100" height="100">
                    </td>
                    <td class="todo-description"></td>
                    <td class="todo-config text-center">
                        <i class='btn btn-warning fas fa-edit edit-btn' data-toggle="modal" data-target="#editModal"></i> &nbsp
                        <i class='btn btn-danger fas fa-trash-alt delete-btn'></i>
                    </td>
                </tr>
            </table>
        </div> --}}
        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>

<!-- Start Add ToDo Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add ToDo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="post" id="upload-form">
                        @csrf
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="d-flex flex-row bd-highlight">
                                        <label class="col-md-3">Input Title</label>
                                        <div class="input-group col-md-9 mb-3">
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user-secret"></span>
                                                </div>
                                            </div>
                                            <span class="badge badge-warning msg-title-error"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row bd-highlight">
                                        <label class="col-md-3">Input Date</label>
                                        <div class="input-group col-md-9 mb-3">
                                            <input type="date" name="date" id="date" class="form-control">
                                            <span class="badge badge-warning msg-date-error"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row bd-highlight">                
                                        <label  class="col-md-3">Select Image</label>
                                        <div class="input-group col-md-9 mb-3">                    
                                            <div class="custom-file">                        
                                                <input type="file" name="img" id="img" class="custom-file-input todo-image" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                <span class="badge badge-warning msg-img-error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <img alt="..." src="{{asset('storage/find.png')}}" class="img-thumbnail mt-2" width="100" height="100"><br>
                                </div>
                                <label  class="col-md-3">Input Descriptions</label>
                                <div class="card-body pad">
                                        <span class="badge badge-warning msg-description-error"></span>
                                    <div class="mb-3">
                                        <textarea class="textarea" name="description" placeholder="Place some text here"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="d-flex flex-row bd-highlight">
                                <button type="reset" class="btn btn-secondary btn-md reset">Reset</button> &nbsp
                                <button type="submit" class="btn btn-success btn-md"><i class="fas fa-cloud-upload-alt"> Save</i></button> &nbsp
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End ToDo Modal -->


<!-- Start Edit ToDo Modal -->
<div class="modal fade editModal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit ToDo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="post" id="update-form">
                        @csrf
                        <input type="hidden" name="id" class="todo-id">
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="d-flex flex-row bd-highlight">
                                        <label class="col-md-3">Input Title</label>
                                        <div class="input-group col-md-9 mb-3">
                                            <input type="text" name="title" class="todo-title" class="form-control" placeholder="Title">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user-secret"></span>
                                                </div>
                                            </div>
                                            <span class="badge badge-warning msg-title-error"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row bd-highlight">
                                        <label class="col-md-3">Input Date</label>
                                        <div class="input-group col-md-9 mb-3">
                                            <input type="date" name="date" class="todo-date" class="form-control">
                                            <span class="badge badge-warning msg-date-error"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row bd-highlight">                
                                        <label  class="col-md-3">Select Image</label>
                                        <div class="input-group col-md-9 mb-3">                    
                                            <div class="custom-file">                        
                                                <input type="file" name="img" id="img" class="custom-file-input todo-image" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                <span class="badge badge-warning msg-img-error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <img alt="..." class="img-thumbnail mt-2 todo-img" width="100" height="100"><br>
                                </div>
                                <label  class="col-md-3">Input Descriptions</label>
                                <div class="card-body pad">
                                        <span class="badge badge-warning msg-description-error"></span>
                                    <div class="mb-3">
                                        <textarea class="textarea todo-description" name="description" placeholder="Place some text here"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer butt">
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End Edit ToDo Modal -->

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function ()
    {
            // var show_qty                = $(this).children("option:selected").val();
            // var token                   = '{{csrf_token()}}';
            // var user_id                 = {{auth()->user()->id}};

            function refresh()
            {
                
                $.get("{{route('todo.list')}}",function(todolist)
                {
                    $(".loading").hide();
                    $('.contain').html("");
                    $.each(todolist, function(ind,val)
                    {                 
                        $('.contain').append('<div class="list-group master" data-id="'+val.id+'"><a href="#" class="list-group-item list-group-item-action flex-column align-items-start backg"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1 title">'+val.title+'</h5><small class="day">'+val.dateFrom+' days ago</small></div><p class="mb-1 desc">'+val.description+'</p><small class="date">'+val.date+'</small></a></div>');   
                    })

                    $('.master').click(function()
                    {
                            id      = $(this).attr('data-id');
                            token   = '{{csrf_token()}}';
                            // $(".editModal").find(".delete").removeAttr('data-id');
                            $(".editModal").modal('show');
                            $(".delete").attr('data-id',id);
                            $('.butt').html('');
                            $.post('{{route("todo.edit")}}', {id:id, _token:token},
                            function(response)
                            {
                                
                                $(".editModal").find(".todo-id").val(response.id);
                                $(".editModal").find(".todo-title").val(response.title);
                                $(".editModal").find(".todo-date").val(response.date);
                                $(".editModal").find(".todo-description").summernote('code', response.description);
                                $(".editModal").find(".custom-file-label").html(response.img);
                                $(".editModal").find(".todo-img").attr('src','{{asset("storage/todo")}}/'+response.img);
                                $(".editModal").find(".butt").append('<div class="d-flex flex-row bd-highlight"><button type="button" class="btn btn-secondary btn-md delete" data-id="'+id+'">Delete</button> &nbsp<button type="submit" class="btn btn-success btn-md subed"><i class="fas fa-cloud-upload-alt"> Save</i></button> &nbsp</div>');


                                refresh();

                                $(".delete").click(function()
                                {
                                    var id = $(this).data('id');
                                    var token   = '{{csrf_token()}}';
                                    console.log(id);
                                    $.post('{{route("todo.delete")}}', {id:id, _token:token},
                                    function(response)
                                    {
                                        $('.addModal').modal('hide');
                                        refresh();
                                    });
                                    
                                });

                                
                            });

                    })
                    
                })

                
            }
            refresh();
        
        
        $("select.show-qty").trigger("change");
        
        // Custom File Input
        bsCustomFileInput.init();

        $('.textarea').summernote();

        // function preview image
        function readURL(input)
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader();                    
                reader.onload = function(e)
                {
                    $(".modal").find("img").removeAttr('src');
                    $(".modal").find("img").attr('src', e.target.result);
                }                    
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(".todo-image").change(function()
        {
            readURL(this);
        });

        

        $('#upload-form').on('submit', function(event)
        {
            $.ajax({
                url:"{{route('todo.upload')}}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(response)
                {
                    $('#addModal').modal('hide');
                    $("select.show-qty").trigger("change");
                    refresh();
                },
                error: function(data)
                {
                    message         = data.responseJSON.errors;
                    $.each(message, function(index, value)
                    {
                        $.each(value, function(index1, value1)
                        {
                            $(".msg-"+index+"-error").html(value1);
                        });
                    });
                }
            });
            return false;
        });

        $('#update-form').on('submit', function(event)
        {
            $.ajax({
                url:"{{route('todo.update')}}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(response)
                {
                    $('#editModal').modal('hide');
                    $("select.show-qty").trigger("change");
                    refresh();
                },
                error: function(data)
                {
                    message         = data.responseJSON.errors;
                    $.each(message, function(index, value)
                    {
                        $.each(value, function(index1, value1)
                        {
                            $(".msg-"+index+"-error").html(value1);
                        });
                    });
                }
            });
            return false;
        });

    });
</script>
@endsection