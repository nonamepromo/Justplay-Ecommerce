@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="user-nav" class="navbar navbar-inverse">
                <ul class="nav">
                    <li class=""><a title="" href="javascript:void(0)"><span class="text">Benvenuto
                {{Session::get('adminDetails')['username']}} ({{Session::get('adminDetails')['type']}})</span></a></li>
                    <li class=""><a title="" href="{{ url('/admin/settings') }}"><i class="icon icon-cog"></i> <span class="text">Impostazioni</span></a></li>
                    <li class=""><a title="" href="{{ url('/logout') }}"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
                </ul>
            </div>
            <div id="breadcrumb"> <a href="{{url ('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="">Videogames</a> <a href="" class="current">Edit Videogame</a> </div>
            @if(Session::has('flash_message_error'))
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{!! session('flash_message_error') !!}</strong>
                </div>
            @endif
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                </div>
            @endif
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Edit Videogame</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post"
                                  action="{{ url('/admin/edit-product/'.$productDetails->id) }}" name="edit_product"
                                  id="edit_product" novalidate="novalidate"> {{csrf_field()}}
                                <div class="control-group">
                                    <label class="control-label">Platform</label>
                                    <div class="controls">
                                        <select name="category_id" id="category_id" style="width: 220px;">
                                            <?php echo $categories_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Videogame Name</label>
                                    <div class="controls">
                                        <input type="text" name="product_name" id="product_name" value="{{ $productDetails->product_name }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Videogame Code</label>
                                    <div class="controls">
                                        <input type="text" name="product_code" id="product_code" value="{{ $productDetails->product_code }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Videogame Brand</label>
                                    <div class="controls">
                                        <input type="text" name="product_brand" id="product_brand" value="{{ $productDetails->product_brand }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Videogame Genre</label>
                                    <div class="controls">
                                        <select name="product_genre" id="product_genre" style="width: 220px;">
                                            @if($productDetails->product_genre == "Avventura")
                                                <option selected>Avventura</option>
                                            @else
                                                <option>Avventura</option>
                                            @endif
                                            @if($productDetails->product_genre == "Azione")
                                                <option selected>Azione</option>
                                            @else
                                                <option>Azione</option>
                                            @endif
                                            @if($productDetails->product_genre == "Sport")
                                                <option selected>Sport</option>
                                            @else
                                                <option>Sport</option>
                                            @endif
                                            @if($productDetails->product_genre == "Sparatutto")
                                                <option selected>Sparatutto</option>
                                            @else
                                                <option>Sparatutto</option>
                                            @endif
                                            @if($productDetails->product_genre == "Simulazione")
                                                <option selected>Simulazione</option>
                                            @else
                                                <option>Simulazione</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Videogame Pegi</label>
                                    <div class="controls">
                                        <select name="product_pegi" id="product_pegi" style="width: 220px;">
                                            @if($productDetails->product_pegi == "3")
                                                <option selected>3</option>
                                            @else
                                                <option>3</option>
                                            @endif
                                            @if($productDetails->product_pegi == "7")
                                                <option selected>7</option>
                                            @else
                                                <option>7</option>
                                            @endif
                                            @if($productDetails->product_pegi == "12")
                                                <option selected>12</option>
                                            @else
                                                <option>12</option>
                                            @endif
                                            @if($productDetails->product_pegi == "16")
                                                <option selected>16</option>
                                            @else
                                                <option>16</option>
                                            @endif
                                            @if($productDetails->product_pegi == "18")
                                                <option selected>18</option>
                                            @else
                                                <option>18</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea style="height: 100%" class="textarea_editor span8 " name="description" id="description">
                                            {{ $productDetails->description }}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Price</label>
                                    <div class="controls">
                                        <input type="text" name="price" id="price" value="{{ $productDetails->price }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Image</label>
                                    <div class="controls">
                                        <input type="file" name="image" id="image">
                                        <input type="hidden" name="current_image" value="{{ $productDetails->image }}">
                                        @if(!empty($productDetails->image))
                                        <img style="width: 50px;" src="{{ asset('/images/backend_images/products/small/'.$productDetails->image) }}">
                                            | <a href="{{url('/admin/delete-product-image/'.$productDetails->id)}}">Delete</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Stock</label>
                                    <div class="controls">
                                        <input type="text" name="stock" id="stock" value="{{ $productDetails->stock }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Feature Item</label>
                                    <div class="controls">
                                        <input type="checkbox" name="feature_item" id="feature_item"
                                        @if($productDetails->feature_item == "1") checked @endif value ="1">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Edit Product" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
